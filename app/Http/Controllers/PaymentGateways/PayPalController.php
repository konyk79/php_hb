<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceItem;
use App\PaymentSystem;
use App\PaymentSystemConfig;
use App\Subscribe;
use App\UserHasSubscribe;
use BaladevPro\PayPal\Api;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use BaladevPro\PayPal\Services\AdaptivePayments;
use BaladevPro\PayPal\Services\ExpressCheckout;
use Log;

class PayPalController extends Controller
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    public static function refIdField() {
        return 'PROFILEID';
    }
    public static function notificationRefIdField() {
        return 'recurring_payment_id';
    }

    public function __construct()
    {
        $this->provider = new ExpressCheckout($this->getPayPalConfig());
    }
    public function getIndex(Request $request)
    {
        $response = [];
        if (session()->has('code')) {
            $response['code'] = session()->get('code');
            session()->forget('code');
        }
        if (session()->has('message')) {
            $response['message'] = session()->get('message');
            session()->forget('message');
        }
        return view('welcome', compact('response'));
    }
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getExpressCheckout(Request $request, $userHasSubscribeId)
    {
        // We need to create invoice first
        $invoice = new Invoice();
        $invoice->save();

        $subscription = UserHasSubscribe::find($userHasSubscribeId);

        $recurring = ($subscription->subscribe->is_auto_prolangate) ? true : false;

        $cart = $this->getCheckoutData($subscription, $recurring, $invoice);
        $this->updateInvoice($invoice, $cart, 'New');

        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
//            dd($response);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->updateInvoice($invoice, $cart, 'Invalid');
            session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
        }
    }
    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        $invoice = Invoice::find($request->get('invoice'));
        $recurring = ($request->get('mode') === 'recurring') ? true : false;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');

        $cart = $this->getStoredCheckoutData($recurring ,$invoice);

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {
                $userSubscribe = $invoice->items()->first()->user_has_subscribe;
                $subscribe = $userSubscribe->subscribe;

                $dateInterval = new DateInterval('P'.$subscribe->term);

                $billing_period   = Api::BILLINGPERIOD_DAY;
                $billing_frequency= 1;

                if($dateInterval->d > 0) {
                    $billing_period   = Api::BILLINGPERIOD_DAY;
                    $billing_frequency= $dateInterval->d;
                }
                if($dateInterval->m > 0) {
                    $billing_period   = Api::BILLINGPERIOD_MONTH;
                    $billing_frequency= $dateInterval->m;
                }
                if($dateInterval->y > 0) {
                    $billing_period   = Api::BILLINGPERIOD_YEAR;
                    $billing_frequency= 1;
                }

                $response = $this->provider->createSubscription($response['TOKEN'], $userSubscribe->price, $billing_period, $billing_frequency, $cart['subscription_desc']);

                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $userSubscribe->payment_system_refid = $response[self::refIdField()];
                    $userSubscribe->save();
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

            }
            $invoice = $this->updateInvoice($invoice, $cart, $status);

            if ($invoice->paid) {

//                session()->put(['code' => 'success', 'message' => "Order $invoice->id has been paid successfully!"]);

                return redirect('/dashboard/subscribe/success?invoice='. $invoice->id);
            } else {

//                session()->put(['code' => 'danger', 'message' => "Error processing PayPal payment for Order $invoice->id!"]);
                    return redirect('/dashboard/subscribe/error');
            }
        }
    }
    public function getAdaptivePay()
    {
        $this->provider = new AdaptivePayments();
        $data = [
            'receivers'  => [
                [
                    'email'   => 'johndoe@example.com',
                    'amount'  => 10,
                    'primary' => true,
                ],
                [
                    'email'   => 'janedoe@example.com',
                    'amount'  => 5,
                    'primary' => false,
                ],
            ],
            'payer'      => 'EACHRECEIVER', // (Optional) Describes who pays PayPal fees. Allowed values are: 'SENDER', 'PRIMARYRECEIVER', 'EACHRECEIVER' (Default), 'SECONDARYONLY'
            'return_url' => url('payment/success'),
            'cancel_url' => url('payment/cancel'),
        ];
        $response = $this->provider->createPayRequest($data);
        dd($response);
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData(UserHasSubscribe $subscription, $recurring = false, $invoice)
    {
        $data = [];
        $order_id = $invoice->id;
        if ($recurring === true) {
            $data['items'] = [
                [
                    'name'  => 'Subscription to ' . $subscription->subscribe->{'name:en'} . ' plan billed every ' . $subscription->subscribe->{'term_text:en'},
                    'price' => $subscription->price,
                    'user_has_subscribe_id' => $subscription->id,
                    'qty'   => 1,
                ],
            ];
            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring&invoice=' . $invoice->id);
            $data['subscription_desc'] = $data['items'][0]['name'];
        } else {
            $data['items'] = [
                [
                    'name'  =>  'Payment for ' . $subscription->subscribe->{'name:en'} . ' plan',
                    'price' => $subscription->price,
                    'user_has_subscribe_id' => $subscription->id,
                    'qty'   => 1,
                ],
            ];
            $data['return_url'] = url('/paypal/ec-checkout-success?invoice=' . $invoice->id);
        }
        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id.'_'.Carbon::now()->toDateTimeString();
        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/dashboard/subscribe/error');
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;
        return $data;
    }

    protected function getStoredCheckoutData($recurring = false, Invoice $invoice)
    {
        $data = [];
        $order_id = $invoice->id;
        if ($recurring === true) {
            foreach ($invoice->items as $item){
                $data['items'] = [
                    [
                        'name'  => $item->item_name,
                        'price' => $item->item_price,

                        'user_has_subscribe_id' => $item->user_has_subscribe_id,
                        'qty'   => $item->item_qty,
                    ],
                ];
            }
            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring&invoice=' . $invoice->id);
            $data['subscription_desc'] = $item->item_name;
        } else {
            foreach ($invoice->items as $item){
                $data['items'] = [
                    [
                        'name'  => $item->item_name,
                        'price' => $item->item_price,

                        'user_has_subscribe_id' => $item->user_has_subscribe_id,
                        'qty'   => $item->item_qty,
                    ],
                ];
            }
            $data['return_url'] = url('/paypal/ec-checkout-success?invoice=' . $invoice->id);
        }
        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id.'_'.Carbon::now()->toDateTimeString();

        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/dashboard/subscribe/error');
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;
        return $data;
    }

    /**
     * Create invoice.
     *
     * @param array  $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function createInvoice($cart, $status)
    {
        $invoice = new Invoice();
        $invoice->title = $cart['invoice_description'];
        $invoice->price = $cart['total'];
        if (!strcasecmp($status, 'Completed') || !strcasecmp($status, 'Processed')) {
            $invoice->paid = 1;
        } else {
            $invoice->paid = 0;
        }
        $invoice->save();
        collect($cart['items'])->each(function ($product) use ($invoice) {
            $item = new InvoiceItem();
            $item->invoice_id = $invoice->id;
            $item->item_name = $product['name'];
            $item->item_price = $product['price'];
            $item->user_has_subscribe_id = $product['user_has_subscribe_id'];
            $item->item_qty = $product['qty'];
            $item->save();
        });
        return $invoice;
    }
    /**
     * Updates invoice.
     *
     * @param array  $cart
     * @param string $status
     *
     * @return \App\Invoice
     */
    protected function updateInvoice($invoice, $cart, $status)
    {
        if($invoice !== null) {
            $invoice->title = $cart['invoice_description'];
            $invoice->price = $cart['total'];
            if ($status === 'Completed' || $status === 'Processed') {
                $invoice->paid = 1;
            } else {
                $invoice->paid = 0;
            }
            $invoice->save();
            if($invoice->items->isEmpty()) {
                // Meaning invoice is new and we need to propagate items
                collect($cart['items'])->each(function ($product) use ($invoice) {
//                    dd($product);
                    $item = new InvoiceItem();
                    $item->invoice_id = $invoice->id;
                    $item->item_name = $product['name'];
                    $item->item_price = $product['price'];
                    $item->user_has_subscribe_id = $product['user_has_subscribe_id'];
                    $item->item_qty = $product['qty'];
                    $item->save();
                });
            }

            return $invoice;
        }

        return null;
    }

    public function cancelRecurringProfile($profileid) {

        $response = $this->provider->getRecurringPaymentsProfileDetails($profileid);
        if (!empty($response['STATUS']) && in_array($response['STATUS'], ['Active', 'Pending'])) {
            $response = $this->provider->cancelRecurringPaymentsProfile($profileid);
            if (!empty($response['ACK']) && $response['ACK'] === 'Success' ) {
                Log::info(['Paypal canceling recurring payment  success ' => $response['ACK']]);
                return true;
            }

            Log::info(['Paypal canceling recurring payment error $response 2 if[\'PROFILESTATUS\']  ' => $response]);
            return false;

        }
        if (!empty($response['STATUS']) && ($response['STATUS']==='Cancelled')){
            Log::info(['Paypal canceling recurring payment  success ' => $response['ACK']]);
            return true;
        }

        Log::info(['Paypal canceling recurring payment error $response 1 if[\'PROFILESTATUS\']' => $response]);
        return false;
    }


    private function getPayPalConfig()
    {
        return json_decode(PaymentSystem::find(1)->config->config, true);
    }
}

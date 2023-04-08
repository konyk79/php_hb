<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceItem;
use App\PaymentSystemConfig;
use App\UserHasSubscribe;
use BaladevPro\PayPal\Api;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;
use Cartalyst\Stripe\Stripe;
use DateInterval;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Log;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
//use Stripe\Error\Card;

class StripeController extends Controller {


    public static function refIdField() {
        return 'id';
    }
    public static function notificationRefIdField() {
        return 'id';
    }

    public function payWithStripe(Request $request, $userHasSubscribeId) {
        $subscription = UserHasSubscribe::find($userHasSubscribeId);

        return $this->main('dashboard/payment/stripe',
            [
                'total' => $subscription->price,
                'isSubscription' => $subscription->subscribe->is_auto_prolangate,
                'userHasSubscribeId' => $userHasSubscribeId
            ]);
    }

    /**
     * One time payment transaction
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postPaymentWithStripe(Request $request) {

        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'userHasSubscribeId' => 'required',
            'amount' => 'required',
        ]);

        $subscription = UserHasSubscribe::find($request->get('userHasSubscribeId'));

        $input = $request->all();
        if ($validator->passes() && $subscription !== null && (int)\Auth::user()->id ===  (int)$subscription->user_id) {
            $input = array_except($input, array('_token'));
            $stripe = Stripe::make($this->getStripeSecret());
            try {
                $invoice = new Invoice();
                $cart = $this->getCheckoutData($subscription, false, $invoice);

                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);

                // $token = $stripe->tokens()->create([
                //  'card' => [
                //      'number' => '4242424242424242',
                //      'exp_month' => 10,
                //      'cvc' => 314,
                //      'exp_year' => 2020,
                //  ],
                // ]);

//                if (!isset($token['id'])) {
//                    return redirect()->route('addmoney.paywithstripe');
//                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => $request->get('amount'),
                    'description' => 'Subscription to ' . $subscription->subscribe->name . ' single payment',
                ]); // TODO change it
 
                if($charge['status'] === 'succeeded') {
                    /**
                    * Write Here Your Database insert logic.
                    */
                    $this->updateInvoice($invoice, $cart, 'Processed');

                    flash('Successfully payed')->success()->important();
                    return redirect('/dashboard/subscribe/success?invoice='. $invoice->id);
                } else {
                    \Session::put('error','Money not add in wallet!!');
                    flash('Something got wrong during payment processing...')->error()->important();
                    $this->updateInvoice($invoice, $cart, 'Failed');
                    return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
                }
            } catch(CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                flash('Caught exception: ' . $e->getMessage())->error()->important();
                return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
            } catch(MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                flash('Caught exception: ' . $e->getMessage())->error()->important();
                return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                flash('Caught exception: ' . $e->getMessage())->error()->important();
                return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
            }
        }
        flash('Initial form valiadation error. Please recheck your input')->error()->important();
        return back();
    }

    /**
     * Subscribe to plan using Stripe
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitSubscriptionWithStripe(Request $request) {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'userHasSubscribeId' => 'required',
            'amount' => 'required',
        ]);

        $subscription = UserHasSubscribe::find($request->get('userHasSubscribeId'));

        $input = $request->all();
        if ($validator->passes() && $subscription !== null && (int)\Auth::user()->id === (int)$subscription->user_id) {


            $input = array_except($input, array('_token'));
            $stripe = Stripe::make($this->getStripeSecret());

            try {
                $invoice = new Invoice();
                $cart = $this->getCheckoutData($subscription, true, $invoice);
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);

//                if (!isset($token['id'])) {
//                    return redirect()->route('addmoney.paywithstripe');
//                }

                $dateInterval = new DateInterval('P'.$subscription->subscribe->term);

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

                // Define plan (first search for it and then create)
                $plan = $this->recursiveSearchForPlanOrCreateOne($stripe, $subscription, $billing_period, $billing_frequency);
                Log::info('Plan #' . json_encode($plan));

                // Create customer
                $customer = $stripe->customers()->create([
                    'email' => $subscription->user->email,
                    'source' => $token['id']
                ]);

                // Creating subscription
                $stripeSubscription = $stripe->subscriptions()->create($customer['id'], [
                    'plan' => $plan['id'],

                ]);

                if($stripeSubscription['status'] === 'active') {
                    /**
                     * Write Here Your Database insert logic.
                     */

                    $this->updateInvoice($invoice, $cart, 'Processed');
                    $subscription->payment_system_refid = $stripeSubscription[self::refIdField()];
                    $subscription->save();
                    Log::info('Successfully payed user subscription #' . $subscription->id );
                    return redirect('/dashboard/subscribe/success?invoice='. $invoice->id);

                } else {
                    Log::error('Money not add in wallet!! Something got wrong during payment processing...');
                    $this->updateInvoice($invoice, $cart, 'Failed');
                    return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
                }
            } catch(CardErrorException $e) {
                \Session::put('error',$e->getMessage());
                Log::error('Caught exception: ' . $e->getMessage());
                return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
            } catch(MissingParameterException $e) {
                \Session::put('error',$e->getMessage());
                Log::error('Caught exception: ' . $e->getMessage());
                return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
            } catch (Exception $e) {
                \Session::put('error',$e->getMessage());
                Log::error('Caught exception: ' . $e->getMessage());
                return redirect('/dashboard/subscribe/error?invoice='. $invoice->id);
            }
        }
        Log::error('Initial form valiadation error. Please recheck your input');
        return back();
    }

    /**
     * @param Stripe $stripe
     * @param UserHasSubscribe $subscription
     * @param String $billing_period
     * @param $billing_frequency
     * @param array $params
     * @return mixed
     */
    protected function recursiveSearchForPlanOrCreateOne(\Cartalyst\Stripe\Stripe $stripe,
                                                         UserHasSubscribe $subscription,
                                                         String $billing_period,
                                                         $billing_frequency,
                                                         $params = []) {
        $stripePlans = $stripe->plans()->all($params);
        $plans = array_column($stripePlans['data'], 'id');

        // Unique identifier for plan in Stripe (UserHasSubscribe->id + '_' + User->id)
        $subscriptionId = $subscription->subscribe->id . '_' . $subscription->user_id;

        if(in_array($subscriptionId, $plans) ){
            $plan = $stripe->plans()->find($subscriptionId);

            if($plan['name'] !== $subscription->subscribe->name ||
               $plan['amount'] !== $subscription->price ||
               $plan['currency'] !== 'USD' ||
               $plan['interval'] !== strtolower($billing_period) ||
               $plan['interval_count'] !== $billing_frequency) {
                Log::warning('Plan #' . $subscriptionId . ' is outdated on Stripe. We will delete and create new plan instead of it...');

                $stripe->plans()->delete($subscriptionId);

                $plan = $stripe->plans()->create([
                    'id'                   => $subscriptionId,
                    'name'                 => $subscription->subscribe->name,
                    'amount'               => $subscription->price,
                    'currency'             => 'USD',
                    'interval'             => strtolower($billing_period),
                    'interval_count'       => $billing_frequency,
                    'statement_descriptor' => 'Subscription',
                ]);

                Log::info('Plan #' . $subscriptionId . ' successfully created!');
            }

            return $plan;
        }

        if($stripePlans['has_more'] === true) {
            return $this->recursiveSearchForPlanOrCreateOne($stripe,
                                                            $subscription,
                                                            $billing_period,
                                                            $billing_frequency,
                                                            array('starting_after' => $plans[\count($plans)-1]));
        }

        return $stripe->plans()->create([
            'id'                   => $subscriptionId,
            'name'                 => $subscription->subscribe->name,
            'amount'               => $subscription->price,
            'currency'             => 'USD',
            'interval'             => strtolower($billing_period),
            'interval_count'       => $billing_frequency,
            'statement_descriptor' => 'Subscription',
        ]);
    }

    protected function getCheckoutData(UserHasSubscribe $subscription, $recurring = false, $invoice)
    {
        $data = [];
        $order_id = $invoice->id;
        if ($recurring === true) {
            $data['items'] = [
                [
                    'name'  => 'Subscription to ' . $subscription->subscribe->name . ' plan billed every ' . $subscription->subscribe->term_text,
                    'price' => $subscription->price,
                    'user_has_subscribe_id' => $subscription->id,
                    'qty'   => 1,
                ],
            ];
//            $data['return_url'] = url('/paypal/ec-checkout-success?mode=recurring&invoice=' . $invoice->id);
//            $data['subscription_desc'] = $data['items'][0]['name'];
        } else {
            $data['items'] = [
                [
                    'name'  =>  'Payment for ' . $subscription->subscribe->name . ' plan',
                    'price' => $subscription->price,
                    'user_has_subscribe_id' => $subscription->id,
                    'qty'   => 1,
                ],
            ];
//            $data['return_url'] = url('/paypal/ec-checkout-success?invoice=' . $invoice->id);
        }
//$data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id.'_'.Carbon::now()->toDateTimeString();

        $data['invoice_description'] = "Order #$order_id Invoice";
//        $data['cancel_url'] = url('/dashboard/subscribe/error');
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['qty'];
        }
        $data['total'] = $total;
        return $data;
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


    public function cancelRecurringProfile($profileid) {
        \Stripe\Stripe::setApiKey($this->getStripeSecret());

        $subscription = \Stripe\Subscription::retrieve($profileid);
        $subscription->cancel();

        Log::info(['Stripe canceling recurring payment  status ' => $subscription->status]);

        return $subscription->status === 'canceled';
    }

    private function getStripeSecret()
    {
        $config = PaymentSystemConfig::find(2);

        if($config) {
            $config = json_decode($config->config);

            $mode = $config->mode;

            return $config->$mode->secret;
        }

        return '';

    }

}

<?php

namespace App\Http\Controllers;

use App\PaymentSystemNotification;
use App\PaymentSystemTransaction;
use App\UserHasSubscribe;
use BaladevPro\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use Log;
use \Storage;
use Carbon\Carbon;

class PayPalWebhookController extends Controller {
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
        $this->provider = new ExpressCheckout();
    }
    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();
        $response = (string) $this->provider->verifyIPN($post);
        $logFile = 'ipn_paypal_log_'.Carbon::now()->format('Ymd_His').'.txt';
        Storage::disk('local')->put($logFile, $response);

        $date     = (isset($post['payment_date']) &&  $post['payment_date']!=='N/A')     ? Carbon::parse($post['payment_date'])      : null;
        $nextDate = (isset($post['next_payment_date'])  &&  $post['next_payment_date']!=='N/A') ? Carbon::parse($post['next_payment_date']) : null;

        if (!isset($post[PayPalController::notificationRefIdField()])){
            Log::info(['PayPalWebhook : Not recurring payment - OK' ]);
            return  response('Not recurring payment', 200)
                ->header('Content-Type', 'text/plain');
        }

        $refId = $post[PayPalController::notificationRefIdField()];


        $userHasSubscribe = UserHasSubscribe::where('payment_system_refid', '=', $refId)->first();
//        dump( $post);
        // Saving notification before processing it
//        dump($refId);
//        dd($userHasSubscribe);

        if ($userHasSubscribe === null){
            Log::info(['PayPalWebhook : Subscription was not found with refId' . $refId]);
           return  response('Subscription was not found', 200)
                ->header('Content-Type', 'text/plain');
        }

        $notification = PaymentSystemNotification::create(
            [
                'payment_system_id' => $userHasSubscribe->payment_system_id,
                'message_id'        => $refId,
                'message_body'      => implode('&',$this->array_map_assoc(function($k,$v){return "$k=$v";},$post))
            ]
        );

        $notification->save();

            // Handling notification: Recurring payment being cancelled
            if(($post['txn_type'] === 'recurring_payment_profile_cancel' && $post['profile_status'] === 'Cancelled')
//                || ($post['txn_type'] === 'recurring_payment_suspended')
//                || ($post['txn_type'] === 'recurring_payment_suspended_due_to_max_failed_payment')
            ) {
                $userHasSubscribe->notificationAction('canceled', $date, $nextDate);

                $notification->is_processed = true;
            }
        if($post['txn_type'] === 'recurring_payment_expired' || $post['txn_type'] === 'recurring_payment_failed') {
            $userHasSubscribe->notificationAction('failed', $date, $nextDate);
            $notification->is_processed = true;
        }


            // Handling notification: We received payment
            if(isset($post['mc_gross']) && $post['payment_status'] === 'Completed') {
                $userHasSubscribe->notificationAction('paid', $date, $nextDate);

                $transaction = new PaymentSystemTransaction();
                $transaction->sum = $post['mc_gross'];
                $transaction->currency = 'USD';
                $transaction->payment_system_id = $userHasSubscribe->payment_system_id;
                $transaction->notification_id = $notification->id;
                $transaction->subscribe_id = $userHasSubscribe->id;
                $transaction->save();

                $notification->is_processed = true;
            }

        // Saving notification after processing it
        $notification->save();
        Log::info(['PayPalWebhook : sent response 200! USID=' . $userHasSubscribe->id]);
        return response('', 200)
            ->header('Content-Type', 'text/plain');
    }


    private function array_map_assoc( $callback , $array ){
        $r = array();
        foreach ($array as $key=>$value)
            $r[$key] = $callback($key,$value);
        return $r;
    }
}

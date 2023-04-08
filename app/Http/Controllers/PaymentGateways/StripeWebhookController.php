<?php

namespace App\Http\Controllers;

use App\PaymentSystemNotification;
use App\PaymentSystemTransaction;
use App\UserHasSubscribe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;
use Cartalyst\Stripe\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Util\Json;
use Validator;
use URL;
use Session;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\User;
//use Stripe\Error\Card;
use Carbon\Carbon;
use \Storage;

class StripeWebhookController extends Controller
{

    private function saveNotification($refId, $userHasSubscribe, $data)
    {
        // Saving notification before processing it
        $notification = new PaymentSystemNotification();
        $notification->payment_system_id = $userHasSubscribe->payment_system_id;
        $notification->message_id = $refId;
        $notification->message_body = json_encode($data);
        $notification->save();
        return $notification;
    }

    public function notify(Request $request)
    {

        $stripe = Stripe::make(config('stripe.' . config('stripe.mode') . '.secret'));

        // Verification of webhook signature
        $endpoint_secret = config('stripe.webhook_secret');
        $payload = @file_get_contents("php://input"); // TODO the same as $request->all() ???
        $sig_header = $_SERVER["HTTP_STRIPE_SIGNATURE"]; // TODO is it close to $request->header("HTTP_STRIPE_SIGNATURE");
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            $toLog = [
                'endpoint_secret' => $endpoint_secret,
                'payload' => json_encode($payload),
                'sig_header' => $sig_header,
                'event' => $event
            ];

            $logFile = 'ipn_stripe_401_log_' . Carbon::now()->format('Ymd_His') . '.txt';

            http_response_code(401); // PHP 5.4 or greater
            exit();
        } catch (\Stripe\Error\SignatureVerification $e) {
            // Invalid signature

            $toLog = [
                'endpoint_secret' => $endpoint_secret,
                'payload' => json_encode($payload),
                'sig_header' => $sig_header,
                'event' => $event
            ];

            $logFile = 'ipn_stripe_402_log_' . Carbon::now()->format('Ymd_His') . '.txt';
            Storage::disk('local')->put($logFile, json_encode($toLog));

            http_response_code(402); // PHP 5.4 or greater
            exit();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // Webhook verification passed lets continue
        // TODO can we use here $event (\Stripe\Event) object instead of $data ??
        $data = $request->all();
        $logFile = 'ipn_stripe_log_' . Carbon::now()->format('Ymd_His') . '.txt';
        Storage::disk('local')->put($logFile, json_encode($data));

        if (!isset($data['data'])) {
            return Log::info('StripeWebhoocController:Stripe notify - no data error!');
        }

        if (!isset($data['data']['object'][StripeController::notificationRefIdField()])) {
            return Log::info('StripeWebhoocController: No present  notificationRefIdField');
        }


        $date = isset($data['data']['object']['created']) ?
            Carbon::createFromTimestamp($data['data']['object']['created']) : null;

        $nextDate = isset($data['data']['object']['current_period_end']) ?
            Carbon::createFromTimestamp($data['data']['object']['current_period_end']) : null;
        // made global for all ifs:
        $notification = null;


        // Handling notification: Recurring payment being cancelled
        if ($data['object'] === 'event' && $data['type'] === 'customer.subscription.deleted') {
            $refId = $data['data']['object'][StripeController::notificationRefIdField()];
            $userHasSubscribe = UserHasSubscribe::where('payment_system_refid', '=', $refId)->first();
            if ($userHasSubscribe !== null) {
                $notification = $this->saveNotification($refId, $userHasSubscribe, $data);
                $userHasSubscribe->notificationAction('canceled', $date, $nextDate);
            } else {
                Log::info(['StripeWebhook customer.subscription.deleted: Subscription was not found with refId' . $refId]);
                return response('Subscription was not found in customer.subscription.deleted', 200)
                    ->header('Content-Type', 'text/plain');
            }
            $notification->is_processed = true;
        }

        // Handling notification: We received payment
        if ( isset($data['data']['object']['paid']) && $data['data']['object']['paid'] === true && $data['type'] === 'invoice.payment_succeeded') {
            $refId = $data['data']['object']['subscription'];
            $userHasSubscribe = UserHasSubscribe::where('payment_system_refid', '=', $refId)->first();
            if ($userHasSubscribe !== null) {
                $notification = $this->saveNotification($refId, $userHasSubscribe, $data);
                $userHasSubscribe->notificationAction('paid', $date, $nextDate);

                // create transaction record for successful transaction:
                $transaction = new PaymentSystemTransaction();
                $transaction->sum = (double)$data['data']['object']['total'] / 100;
                $transaction->currency = strtoupper($data['data']['object']['currency']);
                $transaction->payment_system_id = $userHasSubscribe->payment_system_id;
                $transaction->notification_id = $notification->id;
                $transaction->subscribe_id = $userHasSubscribe->id;
                $transaction->save();
            } else {
                Log::info(['StripeWebhook payment_succeeded: Subscription was not found with refId' . $refId]);
                return response('Subscription was not found in invoice.payment_succeeded', 200)
                    ->header('Content-Type', 'text/plain');
            }

            $notification->is_processed = true;
        }

        // Handling notification: charge was not successful
        if ($data['object'] === 'event' && $data['type'] === 'charge.failed') {
            $refId = $data['data']['object'][StripeController::notificationRefIdField()];
            $userHasSubscribe = UserHasSubscribe::where('payment_system_refid', '=', $refId)->first();
            if ($userHasSubscribe !== null) {
                $notification = $this->saveNotification($refId, $userHasSubscribe, $data);
                $userHasSubscribe->notificationAction('failed', $date, $nextDate);
            } else {
                Log::info(['StripeWebhook charge.failed: Subscription was not found with refId' . $refId]);
                return response('Subscription was not found in charge.failed', 200)
                    ->header('Content-Type', 'text/plain');
            }
            $notification->is_processed = true;
        }
        // Handling notification: charge was not successful
        if ($data['object'] === 'event' && $data['type'] === 'invoice.payment_failed') {
            $refId = $data['data']['object']['subscription'];
            $userHasSubscribe = UserHasSubscribe::where('payment_system_refid', '=', $refId)->first();
            if ($userHasSubscribe !== null) {
                $notification = $this->saveNotification($refId, $userHasSubscribe, $data);
                $userHasSubscribe->notificationAction('failed', $date, $nextDate);
            } else {
                Log::info(['StripeWebhook invoice.payment_failed: Subscription was not found with refId' . $refId]);
                return response('Subscription was not found in invoice.payment_failed', 200)
                    ->header('Content-Type', 'text/plain');
            }
            $notification->is_processed = true;
        }

        // Saving notification after processing it
        if($notification !== null)
            $notification->save();
        Log::info(['StripeWebhook : sent response 200! ']);
        return response('', 200)
            ->header('Content-Type', 'text/plain');


    }
}

<?php

namespace App\Http\Controllers;

use App\Payment;
use App\UserHasSubscribe;
use Illuminate\Http\Request;
use function Sodium\compare;

//use Payum\Core\Request\GetHumanStatus;
//use Payum\LaravelPackage\Controller\PayumController;
//use Payum\LaravelPackage\Model\GatewayConfig;

class PaymentController extends Controller
{


    /**
     * Mounting point for payment preparation. It passed prepared data to gatewayPrepareRouter
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function prepare($id) {
        $subscription = UserHasSubscribe::find($id);

        if (null === $subscription){
            return back();
        }
        if ($subscription->is_active){
            flash(trans('flash_messages.subscription_already_active',['name' =>$subscription->subscribe->name]))->success()->important();
            return back();
        } else {
            //if payment failed, subscription will be in waiting for payment status      |
            if($subscription->subscribe->is_auto_prolangate){
                $subscription->is_confirmed = false;                                      //|
                $subscription->save();                                                     //|
            }
            //---------------------------------------------------------------------------|
            if($subscription->subscribe->is_auto_prolangate && $subscription->is_terminated!=1 && $subscription->payment_system_refid ){
               if( !$this->cancelRecurring($subscription->id)){          //cancel old recurring plane
                   flash(trans('System can\'t cancel old recurring  plan ',['name' =>$subscription->subscribe->name]))->error()->important();
                   return back();
               }
            }

        }

        $paymentSystemId = $subscription->payment_system->id;

        switch ($paymentSystemId) {
            case 1:
                return redirect(url('/payment/paypalec/submit/' . $id));
                break;
            case 2:
                return redirect(url('/dashboard/payment/stripe/' . $id));
                break;
            default:
                return back();
        }
    }

    /**
     * Mounting point for recurring payment cancellation. It passed prepared data to gatewayCancelRecurringRouter
     * @param Integer $id identifier of UserHasSubscribe object
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelRecurring($id) {
        $subscription = UserHasSubscribe::find($id);

        if (null === $subscription){
            return back();
        }

        $paymentSystemId = $subscription->payment_system->id;
        $profileid = $subscription->payment_system_refid;

        switch ($paymentSystemId) {
            case 1:
                return  app('App\Http\Controllers\PayPalController')->cancelRecurringProfile($profileid);
                //return redirect(url('/payment/paypalec/cancel/' . $profileid));
                break;
            case 2:
                return  app('App\Http\Controllers\StripeController')->cancelRecurringProfile($profileid);
                //return redirect(url('/payment/stripe/cancel/' . $profileid));
                break;
            default:
                return back();
        }
    }

    /**
     * Method route request to appropriate method for payment preparation payment gateways
     * @param UserHasSubscribe $subscription
     * @param $factory
     * @param $subscribe
     * @return \Illuminate\Http\RedirectResponse
     */
    private function gatewayCancelRecurringRouter(UserHasSubscribe $subscription, $factory, $subscribe) {

    }

}

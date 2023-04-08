<?php

namespace App\Http\Controllers;

use App\Form;
use App\Invoice;
use App\Promo;
use App\Subscribe;
use App\UserHasSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function subscribeOrder($id){
    $subscribe = Subscribe::find($id);
        return  $this->main('dashboard/subscribe-order',
            [
                'subscribe'=>$subscribe,
            ]);
    }
    public function terminateSubscription($id)
    {
        $user=Auth::user();
        $user->terminateSubscription($id);
        return back();
    }

    public function previewExist(Subscribe $subscribe)
    {
        $user=Auth::user();
        if($existSubscribe=$user->hasUserSubscribes($subscribe)){
            if($existSubscribe->status->code == 'active' || $existSubscribe->status->code == 'terminating'  ){
                flash(trans('flash_messages.subscription_already_active',['name'=>$existSubscribe->subscribe->name]))->error()->important();
                return redirect(url('/dashboard/my-subscribes'));
            }
            else{
                return  $this->main('dashboard/subscribe-preview',
                    [
                        'userSubscribe' => $existSubscribe,
                        'continue' => true
                    ]);
            }

        }
        else{
            flash(trans('flash_messages.havent_subscription',['name'=>$subscribe->name]))->error()->important();
            return redirect('/dashboard/subscribes');
        }

    }
    public function resultSuccess(Request $request)
    {
        $invoice = Invoice::find($request->get('invoice'));

        $subscription = UserHasSubscribe::find($invoice->items()->first()->user_has_subscribe_id);

        if (is_null($subscription)){
            return back();
        }

        // Changing subscription status to active as we have completed payment successfully
        $subscription->setStatus('active');
        $subscription->is_active=true;
        $subscription->is_terminated=false;
        if($subscription->subscribe->is_auto_prolangate) {
            $subscription->is_confirmed=false;
        }else  $subscription->is_confirmed=true;

        $subscription->save();

        flash(trans('flash_messages.subscription_activated_successfully'))->success()->important();
        return redirect('/dashboard/my-subscribes');
    }
    public function resultError(Request $request)
    {
        flash(trans('flash_messages.havent_subscription'))->error()->important();
        return redirect('/dashboard/my-subscribes');
    }


    public function back($id)
    {
        if (is_null(UserHasSubscribe::find($id)))
            return back();
        UserHasSubscribe::find($id)->delete();
        flash(trans('flash_messages.success_cancel'))->success()->important();
        return redirect(url(url('/dashboard/subscribes')));

    }


    public function preview(Request $request, Subscribe $subscribe)
    {
        $user=Auth::user();
//        dd($subscribe);
//        $subscribe=Subscribe::find($id);
        if (($existSubscribe=$user->hasUserSubscribes($subscribe))) {
//            dd(UserHasSubscribe::find($existSubscribeId));
            flash(trans('flash_messages.already_has_subscription',['name'=>$existSubscribe->subscribe->name]))->error()->important();
            if($existSubscribe->status->code == 'active' || $existSubscribe->status->code == 'trial_term' || $existSubscribe->status->code == 'terminating'  )
                return redirect('/dashboard/subscribes');
            else
                return  $this->main('dashboard/subscribe-preview',
                [
                    'userSubscribe' => $existSubscribe
                ]);
        }
            $promo_id = null;
            if($request->promo_code)
            {
                if($promo = Promo::where('code', $request->promo_code)->first()){
                    if($user->groups->pluck('id')->intersect($promo->groups->pluck('id'))->count()>0)
                    {
                        $promo_id = $promo->id;
                    }
                }
            }
            $options =  [
                'payment_system_id' => $request->payment_system_id,
                'promo_id' => $promo_id
            ];


            $userSubscribe = $user->createSubscription($subscribe, $options);
//            dd($userSubscribe->isTrial());
            if($userSubscribe->isTrial()){
                flash(trans('flash_messages.subscription_add_trial_successfully'))->success()->important();
                return redirect(url('/dashboard/my-subscribes'));
            }else{
                flash(trans('flash_messages.subscription_add_successfully'))->success()->important();
            }


        return  $this->main('dashboard/subscribe-preview',
            [
                'userSubscribe' => $userSubscribe
            ]);

    }
    public function createSubscription($id)
    {
       $subscribe=Subscribe::find($id);
        $user=Auth::user();
        $user->createSubscription($subscribe);
        return redirect(url('/dashboard/subscribes'));
    }
    public function prolongateSubscription($id)
    {
        return  ;
    }
}

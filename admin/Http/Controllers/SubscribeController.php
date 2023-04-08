<?php
namespace Admin\Http\Controllers;

use App\Language;
use App\Subscribe;
use App\UserHasSubscribe;
use SleepingOwl\Admin\Http\Controllers\AdminController;
use Snowfire\Beautymail\Beautymail;

class SubscribeController extends AdminController
{
//    public function getDashboard()
//    {
//        dd('tut');
//        $isSuperAdmin =\Auth::user()->isSuperAdmin();
//        if ($isSuperAdmin){
//            return $this->renderContent(
//                $this->admin->template()->view('dashboard'),
//                trans('sleeping_owl::lang.dashboard')
//            );
//        }else{
//            flash('YOU HAVENT PERMISSION')->important()->error();
//            return back();
//        }

//    }

    public function terminateUserSubscribe($id)
    {
        $user_subscribe= UserHasSubscribe::find($id);
        $user=$user_subscribe->user;

        if(! ($user->terminateSubscription($id))) return back();
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.beautymail_subscription_terminated_notification', ['user_subscription' => $user_subscribe, 'user' => $user], function ($message) use ($user) {
            $message
                ->from('no-reply@harmoniousbreathing.com')
                ->to($user->email)
                ->subject(__('emails.admin_notifications.subscription_terminated_subject'));
        });
        flash('Subscription terminated successfully!')->success()->important();
        return back();
    }

    public function forceTerminateUserSubscribe($id)
    {
        $user_subscribe= UserHasSubscribe::find($id);
        $user=$user_subscribe->user;

        if(! ($user->forceTerminateSubscription($id))) return back();
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('email.beautymail_subscription_terminated_notification', ['user_subscription' => $user_subscribe, 'user' => $user], function ($message) use ($user) {
            $message
                ->from('no-reply@harmoniousbreathing.com')
                ->to($user->email)
                ->subject(__('emails.admin_notifications.subscription_terminated_subject'));
        });
        flash('Subscription terminated successfully!')->success()->important();
        return back();
    }


    public function terminateAllUserSubscribeForSubscribe($id)
    {
        $subscribe= Subscribe::find($id);
        $error_count=0;$count=0;
        foreach($subscribe->not_terminated_user_subscribers as $user_subscribe){
            $count++;
//            $user_subscribe= UserHasSubscribe::find($id);
            $user=$user_subscribe->user;

            if(! ($user->terminateSubscription($user_subscribe->id))) {$error_count++; continue;}
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('email.beautymail_subscription_terminated_notification', ['user_subscription' => $user_subscribe, 'user' => $user], function ($message) use ($user) {
                $message
                    ->from('no-reply@harmoniousbreathing.com')
                    ->to($user->email)
                    ->subject(__('emails.admin_notifications.subscription_terminated_subject'));
            });
        }

        if ($error_count === 0)   {
            flash($count.' subscriptions terminated successfully!')->success()->important();
        }  else{
            flash($count.' subscriptions terminated with '.$error_count.' errors for aditional information see subscription_terminating.log !')->success()->important();
        }

        return back();
    }


    public function copySubscribe($id)
    {
        $subscribe = Subscribe::find($id);
        $translatable_fields=array();

        foreach (Language::all() as $language) {
            $translatable_fields[$language->code]=array(
                'name' => $subscribe->{'name:'.$language->code}.'copy',
                'description' => $subscribe->{'description:'.$language->code},
                'term_text' => $subscribe->{'term_text:'.$language->code}
            );
        }

        Subscribe::create([
            'code' => $subscribe->code.'copy',
            'type_id' => $subscribe->type_id,
            'discount_id' => $subscribe->discount_id,
            'price' => $subscribe->price,
            'visible' => false,
            'priority' => $subscribe->priority,
            'term' => $subscribe->term,
            'is_auto_prolangate' => $subscribe->is_auto_prolangate,
            'is_active' => false,
            'expires_for' => $subscribe->expires_for,
            'num_classes' => $subscribe->num_classes,
            'trial_term' => $subscribe->trial_term,
        ] + $translatable_fields);
        return back();

    }
}
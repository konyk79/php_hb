<?php

namespace App;

trait SubscriberLesson
{
use PrivateSubscriberLesson;
use RegularSubscriberLesson;
    private function subscriberClick($user)
    {
        try {
            return $this->{$this->type->code . 'SubscriberClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
            flash('Unknown type of lesson:' . $this->type->code)
                ->important()->error();
            }
            return back();
        }
    }
    private function userClick($user)
    {
        flash(trans('flash_messages.user_warning_text'))->important()->warning();
        return redirect(url('/dashboard/subscribes'));
    }
    private function corporateSubscriberClick($user)
    {
        return $this->regularSubscriberClick($user);
    }
//    private function corporateUserClick($user)
//    {
//        flash('flash_messages.user_warning_text')->important()->warning();
//        return redirect(url('/dashboard/subscribers'));
//    }

}
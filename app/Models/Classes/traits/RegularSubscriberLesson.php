<?php

namespace App;

trait RegularSubscriberLesson
{


//*******************************************************************************
//||||-----------------  RegularSubscriberClick status functions:
    private function completedRegularSubscriberClick($user)
    {
        flash(trans('flash_messages.error_lesson_time_expired'))
            ->important()->error();
        return back();
    }

    private function pendingRegularSubscriberClick($user)
    {
        if (config('app.lessons_check_enable')) {
            if (!$this->isLessonTimeRevalent()) {

                flash(trans('flash_messages.error_lesson_time_expired'))
                    ->important()->error();
                return back();
            }
        }
        if (!$this->canJoinLesson()) {
            flash('You havn\'t active subscriptions for current type lessons!')
                ->important()->error();
            return redirect(url('dashboard/subscribes'));
        }
        flash(trans('flash_messages.error_lesson_not_passing'))
            ->important()->error();
        return back();
    }

    private function passingRegularSubscriberClick($user)
    {
        $meetingId = $this->zoom->meeting_id;
        if (!$this->canJoinLesson()) {
            flash('You havn\'t active subscriptions for current type lessons!')
                ->important()->error();
            return redirect(url('dashboard/subscribes'));
        }
        if (config('app.lessons_check_enable')) {
            if (!$this->isLessonTimeRevalent()) {
                flash(trans('flash_messages.error_lesson_join_time_expired'))
                    ->important()->error();
                return back();
            }
        }
            $meetingZoom = $this->addRegistrans($user, $meetingId);
//            dd($meetingZoom);;
            if (is_null($meetingZoom)) {
                flash('We cant connect to zoom.us service  or error has occurred!')
                    ->important()->error();
                return back();
            }
        return $this->joinLesson($meetingZoom);

    }
    private function canceledRegularSubscriberClick($user){
        flash(trans('flash_messages.error_canceled_lesson'))
            ->important()->error();
        return back();
    }
    private function not_attendRegularSubscriberClick($user){
        return back();
    }
//-----------------  RegularSubscriberClick status functions END-------------|||
//*************************************************************************
    private function regularSubscriberClick($user)
    {
        try {
            return $this->{$this->status->code . 'RegularSubscriberClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

//        dump('subsc');

    }

}
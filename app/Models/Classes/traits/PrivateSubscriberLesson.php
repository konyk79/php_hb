<?php

namespace App;

use DateTime;
use Redirect;

trait PrivateSubscriberLesson
{

    public function isMyBooking($user)
    {
        return (boolean)(Booking::where('user_id', $user->id)->where('lesson_id', $this->id)->first());
    }
    public function getBookingUser()
    {
        return (Booking::where('lesson_id', $this->id)->get()->last())?
            (Booking::where('lesson_id', $this->id)->get()->last())->user_id: null;
    }

    //||||-----------------  PrivateSubscriberClick status functions:
    private function not_bookedPrivateSubscriberClick($user)
    {
        if (!$this->canJoinLesson()) {

            flash(trans('flash_messages.error_no_active_subscription'))
                ->important()->error();
            return redirect(url('dashboard/subscribes'));
        }
                flash(trans('flash_messages.error_lesson_time_expired'))
                    ->important()->error();
                return back();

    }
    private function pendingPrivateSubscriberClick($user)
    {
        if (!$this->canJoinLesson()) {

            flash(trans('flash_messages.error_no_active_subscription'))
                ->important()->error();
            return redirect(url('dashboard/subscribes'));
        }
        if (config('app.lessons_check_enable')) {
            if (!$this->isLessonTimeRevalent()) {

                flash(trans('flash_messages.error_lesson_time_expired'))
                    ->important()->error();
                return back();
            }
        }

        Booking::create([
            'user_id' => $user->id,
            'lesson_id' => $this->id
        ]);
        $this->setStatus('booked');

        flash(trans('flash_messages.success_booked' ))
            ->important()->success();
        return back();

    }

    private function approvedPrivateSubscriberClick($user){
        if (!$this->isMyBooking($user)) {
            flash(trans('flash_messages.error_another_sibscriber_booked_lesson'))
                ->important()->error();
            return back();
        }
                flash(trans('flash_messages.error_lesson_not_passing'))
                    ->important()->error();
                return back();
    }
    private function bookedPrivateSubscriberClick($user){
        if (!$this->isMyBooking($user)) {
            flash(trans('flash_messages.error_another_sibscriber_booked_lesson'))
                ->important()->error();
            return back();
        }

        flash(trans('flash_messages.error_lesson_not_approved'))
            ->important()->error();
        return back();
    }
    private function canceledPrivateSubscriberClick($user){

        flash(trans('flash_messages.error_canceled'))
            ->important()->error();
        return back();
    }

    private function passingPrivateSubscriberClick($user)
    {
        if (!$this->canJoinLesson()) {

            flash(trans('flash_messages.error_no_active_subscription'))
                ->important()->error();
            return redirect(url('dashboard/subscribes'));
        }
        if (config('app.lessons_check_enable')){
            if (!$this->isTimeToStart()) {  //teacher waiting student only after_start_timeout
                flash(trans('flash_messages.error_lesson_join_time_expired'))
                    ->important()->error();
                return back();
            }
        }
        if ($this->isMyBooking($user)){
            if (config('app.lessons_check_enable')) {
                if (! $this->isTimeToStart()) {
                    flash(trans('flash_messages.error_wrong_time_start_lesson'))
                        ->important()->error();
                    return back();
                }
            }
                $meetingId = $this->zoom->meeting_id;
                $meetingZoom = $this->getMeeting($meetingId);
                if (is_null($meetingZoom)) {
                    flash(trans('flash_messages.error_cant_connect_zoom'))
                        ->important()->error();
                    return back();
                }
                return Redirect::to($meetingZoom->join_url);
        }else{
            flash(trans('flash_messages.error_another_sibscriber_booked_lesson'))
                ->important()->error();
            return back();
        }
    }

    private function completedPrivateSubscriberClick($user){
        flash(trans('flash_messages.error_lesson_completed'))->important()->error();
        return back();
    }

    private function privateSubscriberClick($user)
    {

        try {
            return $this->{$this->status->code . 'PrivateSubscriberClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }


//-----------------  PrivateSubscriberClick status functions end ------------|||||
//*******************************************************************************


}
<?php

namespace App;

use Firebase\JWT\JWT;
use Redirect;

trait PrivateTeacherLesson
{






    private function privateTeacherClick($user){
//        dd($this->type->code . 'TeacherClick');
        try {
            return $this->{$this->status->code . 'privateTeacherClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Error or unknown status of lesson:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }
    }




   // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    //------------------Private statuses:--------------------------------------------
    private function pendingPrivateTeacherClick($user)
    {
        if (config('app.lessons_check_enable')) {
            if (!$this->isLessonTimeRevalent()) {
                $this->setStatus('not_booked');             //??????????????
                flash(trans('flash_messages.error_lesson_time_expired'))
                    ->important()->error();
                return back();
            }
        }
        flash(trans('flash_messages.error_lesson_not_booked'))
            ->important()->error();
        return back();
    }
    private function passingPrivateTeacherClick($user){
        $teacher = $user->teacher;
        if ($this->teacher->id == $teacher->id) {
            if(is_null(User::find($this->getBookingUser())))
            {
                flash('Error in close private lesson:Booking user dont exist, lesson #'.$this->id)
                    ->important()->error();
                return back();
            }
                    $this->closeLesson(array((object)(['email'=> User::find($this->getBookingUser())->email])));
                    $this->setStatus('completed');
                flash(trans(
                    'flash_messages.success_lesson_close'
                ))->success()->important();
                return back();
            } else
            flash(trans('flash_messages.error_not_your_lesson'))
                ->important()->error();
            return back();
    }
    private function completedPrivateTeacherClick($user){
        flash(trans('flash_messages.error_lesson_completed'))->important()->error();
        return back();
    }
    private function bookedPrivateTeacherClick($user){

        $teacher = $user->teacher;
        if ($this->teacher->id == $teacher->id) {
            if (config('app.lessons_check_enable')) {
                if (!$this->isLessonTimeRevalent()) {
                    $this->setStatus('not_attend');
                    flash(trans('flash_messages.error_lesson_time_expired').
                        trans('flash_messages.error_not_attend'))
                        ->important()->error();
                    return back();
                }
            }
            $this->setStatus('approved');                                       // TO approved
            flash(trans('flash_messages.success_approved_lesson'))->important()->success();
            return back();
        }else{
            flash(trans('flash_messages.error_not_your_lesson'))
                ->important()->error();
            return back();
        }
    }
    private function approvedPrivateTeacherClick($user){

        $teacher = $user->teacher;
        if ($this->teacher->id == $teacher->id) {
            if (config('app.lessons_check_enable')) {
                if (!$this->isLessonTimeRevalent()) {
                    $this->setStatus('not_attend');
                    flash(trans('flash_messages.error_lesson_time_expired').
                        trans('flash_messages.error_not_attend'))
                        ->important()->error();
                    return back();
                }
                if (!$this->isTimeToStart()) {
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
            $this->setStatus('passing');
//            return view("<script>window.open('".$meetingZoom->start_url."', '_blank')</script>");
            return Redirect::to($meetingZoom->start_url);
//                header( 'Location: '.$meetingZoom->start_url);
//                exit();

        } else {
            flash(trans('flash_messages.error_not_your_lesson'))
                ->important()->error();
            return back();
        }
    }
    private function canceledPrivateTeacherClick($user){
        $teacher = $user->teacher;
        if ($this->teacher->id == $teacher->id) {
            if (config('app.lessons_check_enable')) {
                if (!$this->isLessonTimeRevalent()) {
                    $this->setStatus('not_booked');
                    flash(trans('flash_messages.error_lesson_time_expired') .
                        trans('flash_messages.error_not_attend'))
                        ->important()->error();
                    return back();
                }
            }
            $this->setStatus('pending');
            flash(trans('flash_messages.success_restored_lesson'))
                ->important()->success();
            return back();
        }else {
            flash(trans('flash_messages.error_not_your_lesson'))
                ->important()->error();
            return back();
        }
    }
    private function not_attendPrivateTeacherClick($user){
            return back();
    }
    //----------------------------- end Private statuses -------------------------------------
}
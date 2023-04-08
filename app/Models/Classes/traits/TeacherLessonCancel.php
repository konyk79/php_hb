<?php

namespace App;

use Redirect;

trait TeacherLessonCancel
{

//    private function closeLesson($registrantsList)
//    {
//        foreach ($registrantsList as $registrant) {
//            $user = User::where('email', $registrant->email)->first();
//            $userSubscribe = $user->getActiveSubscribesForType($this->type->code);
//            LessonHistory::create([
//                'user_sub_history_id' => $userSubscribe->getLastActiveHistory()->id,
//                'lesson_id' => $this->id
//            ]);
//            $userSubscribe->checkAvailableClassesAndChangeStatusIfNot();
//        }
//
//    }



    private function teacherClickCancel($user)
    {

//        dd($this->type->code . 'TeacherClickCancel');
        try {
            return $this->{$this->type->code . 'TeacherClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown type of lesson:' . $this->type->code)
                    ->important()->error();
            }
            return back();
        }
    }

    private function corporateTeacherClickCancel($user){
//        return $this->regularTeacherClickCancel($user);
//        try {
//            return $this->{$this->status->code . 'CorporateTeacherClickCancel'}($user);
//        } catch (\Exception $e) {
//            flash('Unknown status of lesson:' . $this->status->code)
//                ->important()->error();
//            return back();
//        }
    }
    private function privateTeacherClickCancel($user){
//        dd($this->type->code . 'TeacherClickCancel');
        try {
            return $this->{$this->status->code . 'privateTeacherClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson canceled:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }
    }
    private function regularTeacherClickCancel($user){
        try {
            return $this->{$this->status->code . 'RegularTeacherClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson canceled:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }

    //------------------Regular statuses:--------------------------------------------
//    private function pendingRegularTeacherClickCancel($user)
//    {
////                dd($meetingZoom->start_url);
//        $this->setStatus('canceled');                                    // TO canceled
//        flash('Lesson has been successfully canceled!')
//            ->important()->error();
//        return back();
//    }
//    private function passingRegularTeacherClickCancel($user){
//
//    }
//    private function completedRegularTeacherClickCancel($user){
//
//    }
//    private function not_attendRegularTeacherClickCancel($user){
//
//    }
    //----------------------------- end regular statuses -------------------------------------

   // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    //------------------Private statuses:--------------------------------------------
    private function pendingPrivateTeacherClickCancel($user)
    {
        $this->setStatus('canceled');                                    // TO canceled
        $this->cancelBooking($user);
        flash(trans('flash_messages.success_unbooked'))
            ->important()->success();
        return back();
    }
//    private function passingPrivateTeacherClickCancel($user){
//
//    }
//    private function completedPrivateTeacherClickCancel($user){
//
//    }
    private function bookedPrivateTeacherClickCancel($user){
        if (config('app.lessons_check_enable')) {
            if (!$this->isCancalableTime()) {

                flash(trans('flash_messages.error_lesson_cancel_time_expired'))
                    ->important()->error();
                return back();
            }
        }
        $this->setStatus('canceled');                                    // TO canceled
        $this->cancelBooking($user);
        flash(trans('flash_messages.success_unbooked'))
            ->important()->success();
        return back();
    }
    private function approvedPrivateTeacherClickCancel($user){
        if (config('app.lessons_check_enable')) {
            if (!$this->isCancalableTime()) {

                flash(trans('flash_messages.error_lesson_cancel_time_expired'))
                    ->important()->error();
                return back();
            }
        }
                $this->setStatus('canceled');                                    // TO canceled
                $this->cancelBooking($user);
                flash(trans('flash_messages.success_unbooked'))
                    ->important()->success();
        return back();
    }
//    private function canceledPrivateTeacherClickCancel($user){
//
//    }
//    private function not_attendPrivateTeacherClickCancel($user){
//
//    }
    //----------------------------- end Private statuses -------------------------------------
}
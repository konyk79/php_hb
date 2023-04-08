<?php

namespace App;

trait SubscriberLessonCancel
{

    //||||-----------------  PrivateSubscriberClickCancel status functions:
//    private function pendingPrivateSubscriberClickCancel($user)
//    {
//
//    }
//
//    private function passingPrivateSubscriberClickCancel($user)
//    {
//    }

    private function bookedPrivateSubscriberClickCancel($user)
    {
//        dd('1');
        if (config('app.lessons_check_enable')) {
//            dd($this->isCancalableTime());
            if (!$this->isCancalableTime()) {

                flash(trans('flash_messages.error_lesson_cancel_time_expired'))
                    ->important()->error();
                return back();
            }
        }
        $this->setStatus('pending');                                    // TO canceled
        $this->cancelBooking($user);
        flash(trans('flash_messages.success_unbooked'))
            ->important()->success();
        return back();
    }
    private function approvedPrivateSubscriberClickCancel($user)
    {
        if (config('app.lessons_check_enable')) {
            if (!$this->isCancalableTime()) {

                flash(trans('flash_messages.error_lesson_cancel_time_expired'))
                    ->important()->error();
                return back();
            }
        }
        $this->setStatus('pending');                                    // TO canceled
        $this->cancelBooking($user);
        flash(trans('flash_messages.success_unbooked'))
            ->important()->success();
        return back();
    }
//    private function bookedCorporateSubscriberClickCancel($user)
//    {
////        dd('1');
//        $this->setStatus('pending');                                    // TO canceled
//        $this->cancelBooking($user);
//        flash('You have successfully unbooked this lesson!')
//            ->important()->success();
//        return back();
//    }
//    private function approvedCorporateSubscriberClickCancel($user)
//    {
//        $this->setStatus('pending');                                    // TO canceled
//        $this->cancelBooking($user);
//        flash('We cant connect to zoom.us service or error has occurred!')
//            ->important()->error();
//        return back();
//    }
////    private function privateSubscriberClickCancel($user)
//    {
//
//    }
//-----------------  PrivateSubscriberClickCancel status functions end ------------|||||
//*******************************************************************************
//||||-----------------  RegularSubscriberClickCancel status functions:
//    private function completedRegularSubscriberClickCancel($user)
//    {
//        flash('This lesson is expired!')
//            ->important()->error();
//        return back();
//    }
//
//    private function pendingRegularSubscriberClickCancel($user)
//    {
//        flash('This lesson has not started yet!')
//            ->important()->error();
//        return back();
//    }
//
//    private function passingRegularSubscriberClickCancel($user)
//    {
//
//    }
//-----------------  RegularSubscriberClickCancel status functions END-------------|||
//*************************************************************************
    private function regularSubscriberClickCancel($user)
    {
        try {
            return $this->{$this->status->code . 'RegularSubscriberClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson canceled:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }
    private function privateSubscriberClickCancel($user)
    {
        try {
            return $this->{$this->status->code . 'PrivateSubscriberClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson canceled:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }
    private function corporateSubscriberClickCancel($user)
    {
            return regularSubscriberClickCancel($user);
    }

    private function subscriberClickCancel($user)
    {
//        dd('2');
        try {
            return $this->{$this->type->code . 'SubscriberClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown type of lesson CancelClick:' . $this->type->code)
                    ->important()->error();
            }
            return back();
        }
    }



//
//    private function subscriberIsCancelButton()
//    {
//        try {
//            return $this->{$this->type->code . 'SubscriberIsCancelButton'}();
//        } catch (\Exception $e) {
////            flash('Unknown type of lesson isCancelButton:' . $this->type->code)
////                ->important()->error();
//            return false;
//        }
//
////        dump('subsc');
//
//    }
//
//    private function teacherIsCancelButton()
//    {
//
////        dd($this->type->code . 'TeacherClickCancel');
//        try {
//            return $this->{$this->type->code . 'TeacherClickCancel'}();
//        } catch (\Exception $e) {
////            flash('Unknown type of lesson ClickCancel:' . $this->type->code)
////                ->important()->error();
//            return false;
//        }
//    }
//    private function adminSubscriberIsCancelButton()
//    {
//
////        dd($this->type->code . 'TeacherClickCancel');
//        try {
//            return $this->{$this->type->code . 'TeacherClickCancel'}();
//        } catch (\Exception $e) {
////            flash('Unknown type of lesson ClickCancel:' . $this->type->code)
////                ->important()->error();
//            return false;
//        }
//    }
//
//
//
//
//    private function privateSubscriberIsCancelButton()
//    {
//        try {
//            return $this->{$this->status->code . 'SubscriberIsCancelButton'}();
//        } catch (\Exception $e) {
////            flash('Unknown status of lesson isCancelButton:' . $this->status->code)
////                ->important()->error();
//            return false;
//        }
//    }
//
//    private function regularSubscriberIsCancelButton()
//    {
//        try {
//            return $this->{$this->status->code . 'SubscriberIsCancelButton'}();
//        } catch (\Exception $e) {
////            flash('Unknown status of lesson isCancelButton:' . $this->status->code)
////                ->important()->error();
//            return false;
//        }
//    }
//    private function corporateSubscriberIsCancelButton()
//    {
//        try {
//            return $this->{$this->status->code . 'SubscriberIsCancelButton'}();
//        } catch (\Exception $e) {
////            flash('Unknown status of lesson isCancelButton:' . $this->status->code)
////                ->important()->error();
//            return false;
//        }
//    }
//
//











//    private function bokedPrivateSubscriberClickCancel($user)
//    {
//        $this->setStatus('canceled');                                    // TO canceled
//        flash('We cant connect to zoom.us service or error has occurred!')
//            ->important()->error();
//    }
//    private function approvedPrivateSubscriberClickCancel($user)
//    {
//        $this->setStatus('canceled');                                    // TO canceled
//        flash('We cant connect to zoom.us service or error has occurred!')
//            ->important()->error();
//    }
}
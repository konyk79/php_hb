<?php

namespace App;

use Redirect;

trait AdminLessonCancel
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



    private function adminClickCancel($user)
    {

//        dd($this->type->code . 'AdminClickCancel');
        try {
            return $this->{$this->type->code . 'AdminClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown type of lesson:' . $this->type->code)
                    ->important()->error();
            }
            return back();
        }
    }

    private function corporateAdminClickCancel($user){
//        return $this->regularAdminClickCancel($user);
        try {
            return $this->{$this->status->code . 'CorporateAdminClickCancel'}($user);
        } catch (\Exception $e) {
            flash('Unknown status of lesson:' . $this->status->code)
                ->important()->error();
            return back();
        }
    }
    private function privateAdminClickCancel($user){
//        dd($this->type->code . 'AdminClickCancel');
        try {
            return $this->{$this->status->code . 'privateAdminClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson canceled:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }
    }
    private function regularAdminClickCancel($user){
        try {
            return $this->{$this->status->code . 'RegularAdminClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson canceled:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }
//    private function corporateAdminClickCancel($user){
////        dd($this->type->code . 'AdminClickCancel');
//        try {
//            return $this->{$this->status->code . 'privateAdminClickCancel'}($user);
//        } catch (\Exception $e) {
//            if (config('APP_DEBUG')) {
//                flash('Unknown status of lesson canceled:' . $this->status->code)
//                    ->important()->error();
//            }
//            return back();
//        }
//    }
//    private function regularCorporateCancel($user){
//        try {
//            return $this->{$this->status->code . 'CorporateAdminClickCancel'}($user);
//        } catch (\Exception $e) {
//            if (config('APP_DEBUG')) {
//                flash('Unknown status of lesson canceled:' . $this->status->code)
//                    ->important()->error();
//            }
//            return back();
//        }
//    }
    //------------------Regular statuses:--------------------------------------------
    private function pendingRegularAdminClickCancel($user)
    {
//                dd($meetingZoom->start_url);
        $this->setStatus('canceled');                                    // TO canceled
        flash('Lesson has been successfully canceled!')
            ->important()->error();
        return back();
    }
    private function pendingCorporateAdminClickCancel($user)
    {
//                dd($meetingZoom->start_url);
        $this->setStatus('canceled');                                    // TO canceled
        flash('Lesson has been successfully canceled!')
            ->important()->error();
        return back();
    }
//    private function passingRegularAdminClickCancel($user){
//
//    }
//    private function completedRegularAdminClickCancel($user){
//
//    }
//    private function not_attendRegularAdminClickCancel($user){
//
//    }
    //----------------------------- end regular statuses -------------------------------------

   // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

    //------------------Private statuses:--------------------------------------------
//    private function pendingPrivateAdminClickCancel($user)
//    {
//    }
//    private function passingPrivateAdminClickCancel($user){
//
//    }
//    private function completedPrivateAdminClickCancel($user){
//
//    }
    private function bookedPrivateAdminClickCancel($user){
        $this->setStatus('canceled');                                    // TO canceled
        $this->cancelBooking($user);
        flash('Lesson has been successfully canceled!')
            ->important()->error();
        return back();
    }
    private function approvedPrivateAdminClickCancel($user){

//                dd($meetingZoom->start_url);
                $this->setStatus('canceled');                                    // TO canceled
                $this->cancelBooking($user);
                flash('Lesson has been successfully canceled!')
                    ->important()->error();
        return back();
    }
//    private function canceledPrivateAdminClickCancel($user){
//
//    }
//    private function not_attendPrivateAdminClickCancel($user){
//
//    }
    //----------------------------- end Private statuses -------------------------------------
}
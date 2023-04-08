<?php

namespace App;

use Redirect;


trait TeacherLesson
{
    use PrivateTeacherLesson;
    use RegularTeacherLesson;
    private function closeLesson($registrantsList)
    {
        foreach ($registrantsList as $registrant) {
            $user = User::where('email', $registrant->email)->first();
            if ($user ->isAdmin() || $user ->isTeacher()) continue;
            $userSubscribe = $user->getActiveSubscribesForType($this->type->code);
//            dd($userSubscribe);
            if (!is_null($userSubscribe)) {
                if (!(LessonHistory::where('user_sub_history_id' , $userSubscribe->getLastActiveHistory()->id)->
                where('lesson_id' , $this->id)->first())){
                    LessonHistory::create([
                        'user_sub_history_id' => $userSubscribe->getLastActiveHistory()->id,
                        'lesson_id' => $this->id
                    ]);
                //    $userSubscribe->checkAvailableClassesAndChangeStatusIfNot(); this function put in created callback function of LessonHistory class
                }
            }else{
                if($this->getStatus()!=='waiting_for_payment' ){
                    $this->setStatus('waiting_for_payment');
                    $this->is_active = false;
                    $this->is_terminated=false;
                    $this->save();
                }
            }
        }
        if ($this->type->code == 'private'){
            if($bookings =Booking::where('lesson_id',$this->id)->get())   {
                foreach($bookings as $booking){
                    $booking->delete();
                }

            }
        }
    }



    private function teacherClick($user)
    {

        try {
            return $this->{$this->type->code . 'TeacherClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown type of lesson:' . $this->type->code)
                    ->important()->error();
            }
            return back();
        }
    }

    private function corporateTeacherClick($user){
        return $this->regularTeacherClick($user);
//        try {
//            return $this->{$this->status->code . 'CorporateTeacherClick'}($user);
//        } catch (\Exception $e) {
//            flash('Unknown status of lesson:' . $this->status->code)
//                ->important()->error();
//            return back();
//        }
    }

}
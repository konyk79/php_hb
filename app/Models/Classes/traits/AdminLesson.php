<?php

namespace App;

use Redirect;


trait AdminLesson
{
//    use PrivateAdminLesson;
    use RegularAdminLesson;
//    private function closeLesson($registrantsList)
//    {
////        dump($registrantsList);
//        foreach ($registrantsList as $registrant) {
//            $user = User::where('email', $registrant->email)->first();
////            dd($user->getActiveSubscribesForType($this->type->code));
//            $userSubscribe = $user->getActiveSubscribesForType($this->type->code);
////            dd($userSubscribe);
//            if (!is_null($userSubscribe)) {
////                dd($userSubscribe);
//                if (!(LessonHistory::where('user_sub_history_id' , $userSubscribe->getLastActiveHistory()->id)->
//                where('lesson_id' , $this->id)->first())){
////                    dd('delete');
//                    LessonHistory::create([
//                        'user_sub_history_id' => $userSubscribe->getLastActiveHistory()->id,
//                        'lesson_id' => $this->id
//                    ]);
//                    $userSubscribe->checkAvailableClassesAndChangeStatusIfNot();
//                }
//            }
//        }
////        dump($this->type->code);
//        if ($this->type->code == 'private'){
////            dd('private');
//            if($bookings =Booking::where('lesson_id',$this->id)->get())   {
//                foreach($bookings as $booking){
//                    $booking->delete();
//                }
//
//            }
//        }
//    }



    private function adminClick($user)
    {

//        dd($this->type->code . 'AdminClick');
        try {
            return $this->{$this->type->code . 'AdminClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown type of lesson:' . $this->type->code)
                    ->important()->error();
            }
            return back();
        }
    }

    private function corporateAdminClick($user){
        return $this->regularAdminClick($user);
//        try {
//            return $this->{$this->status->code . 'CorporateAdminClick'}($user);
//        } catch (\Exception $e) {
//            flash('Unknown status of lesson:' . $this->status->code)
//                ->important()->error();
//            return back();
//        }
    }

}
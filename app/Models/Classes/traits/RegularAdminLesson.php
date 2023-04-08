<?php

namespace App;

use Redirect;


trait RegularAdminLesson
{

    private function corporateAdminClick($user){
        return $this->regularAdminClick($user);
    }

    private function regularAdminClick($user){
        try {
            return $this->{$this->status->code . 'RegularAdminClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }

    //------------------Regular statuses:--------------------------------------------
//    private function pendingRegularAdminClick($user)
//    {
//
////        dd('test1');
//        $teacher = $user->teacher;
////        dump($teacher);
////        dump($this );
//        if ($this->teacher->id == $teacher->id) {
//            if (config('app.lessons_check_enable')) {
//                if (!$this->isLessonTimeRevalent()) {
//                    $this->setStatus('not_attend');
//                    flash(trans('flash_messages.error_lesson_time_expired') .
//                        trans('flash_messages.error_not_attend'))
//                        ->important()->error();
//                    return back();
//                }
//                if (!$this->isTimeToStart()) {
//                    flash(trans('flash_messages.error_wrong_time_start_lesson') .
//                        trans('flash_messages.error_not_attend'))
//                        ->important()->error();
//                    return back();
//                }
//            }
//
////            dd($this->zoom);
//            $meetingId = $this->zoom->meeting_id;
//            $meetingZoom = $this->getMeeting($meetingId);
//            if (!is_null($meetingZoom)) {
////                dd($meetingZoom->start_url);
//                $this->setStatus('passing');
//                return Redirect::to($meetingZoom->start_url);
////                header( 'Location: '.$meetingZoom->start_url);
////                exit();
//            }
//            return back();
//        } else {
//            $meetingId = $this->zoom->meeting_id;
//            $meetingZoom = $this->addRegistrans($user, $meetingId);
//            if (is_null($meetingZoom)) {
//                flash(trans('flash_messages.error_cant_connect_zoom'))
//                    ->important()->error();
//                return back();
//            }
//            $meetingZoom = $this->getMeeting($meetingId);
////        dd($meetingZoom);
//            if (!is_null($meetingZoom)) {
//                return $this->joinLesson($meetingZoom);
//            }
//        }
//    }
//
    private function passingRegularAdminClick($user){

                if (config('app.lessons_check_enable')) {
                    if (!$this->isLessonTimeEnd()) {
                        flash(trans('flash_messages.error_lesson_join_time_expired'))
                            ->important()->error();
                        return back();
                    }
                }

                $meetingId = $this->zoom->meeting_id;
                $meetingZoom = $this->addRegistrans($user, $meetingId);
                if (is_null($meetingZoom)) {
                    flash(trans('flash_messages.error_cant_connect_zoom'))
                        ->important()->error();
                    return back();
                }
                    return Redirect::to($meetingZoom->join_url);
    }

    private function canceledRegularAdminClick($user){

            if (config('app.lessons_check_enable')) {
                if (!$this->isLessonTimeRevalent()) {
                    $this->setStatus('not_attend');
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

    }
//    private function completedRegularAdminClick($user){
//        flash(trans('flash_messages.error_lesson_completed'))->important()->error();
//        return back();
//    }
//    private function not_attendRegularAdminClick($user){
//        return back();
//    }
    //----------------------------- end regular statuses -------------------------------------

   // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

  }
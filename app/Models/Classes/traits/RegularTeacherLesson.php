<?php

namespace App;

use Redirect;


trait RegularTeacherLesson
{

    private function corporateTeacherClick($user){
        return $this->regularTeacherClick($user);
    }

    private function regularTeacherClick($user){
        try {
            return $this->{$this->status->code . 'RegularTeacherClick'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown status of lesson:' . $this->status->code)
                    ->important()->error();
            }
            return back();
        }

    }
    private function isUserInList($registrantsList){
//        dd($registrantsList->registrants);
        if(is_null($registrantsList))  return false;
        if(is_null($registrantsList->registrants))  return false;
        foreach ($registrantsList->registrants as $registrant){
//            dd($registrant);
            $user = User::where('email', $registrant->email)->first();
//            dd($user);
            if( $user->getMainRoleCode()=='subscriber') return true;
        }
        return false;

    }


    //------------------Regular statuses:--------------------------------------------
    private function pendingRegularTeacherClick($user)
    {
        $teacher = $user->teacher;
        if ($this->teacher->id == $teacher->id) {
            if (config('app.lessons_check_enable')) {
                if (!$this->isLessonTimeRevalent()) {
                    $this->setStatus('not_attend');
                    flash(trans('flash_messages.error_lesson_time_expired') .
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
            if (!is_null($meetingZoom)) {
                $this->setStatus('passing');
//                return view("<script>window.open('".$meetingZoom->start_url."', '_blank')</script>");
                return Redirect::to($meetingZoom->start_url);
//                header( 'Location: '.$meetingZoom->start_url);
//                exit();
            }
            return back();
        } else {
            flash(trans('flash_messages.error_not_your_lesson'))
                ->important()->error();
            return back();
        }
    }

    private function passingRegularTeacherClick($user){
        if ($this->isTimeToStart()) {
            return $this->pendingRegularTeacherClick($user);
        }
        $teacher = $user->teacher;
            if ($this->teacher->id == $teacher->id) {
                $meetingId = $this->zoom->meeting_id;
                $registrantsList = $this->getRegistrantsList($meetingId);
                if (!is_null($registrantsList)) {
//                    dd($registrantsList);
                    if ($this->isUserInList($registrantsList)) {
//                        dd('1');
                        $this->closeLesson($registrantsList->registrants);
//                        dd($registrantsList);
                        $this->setStatus('completed');

                    } else {
                        $this->setStatus('not_attend');
                    }

                    flash(trans('flash_messages.success_lesson_close'))->success()->important();
                    return back();
                } else
                    flash(trans('flash_messages.error_zoom_when_close_lesson'))
                        ->important()->error();
                return back();
            } else {                 //another teacher lessons than come in as client
                if (config('app.lessons_check_enable')) {
                    if (!$this->isLessonTimeRevalent()) {
                        flash(trans('flash_messages.error_lesson_join_time_expired'))
                            ->important()->error();
                        return back();
                    }
                }
                $meetingId = $this->zoom->meeting_id;
                $meetingZoom = $this->addRegistrans($teacher->user, $meetingId);
                if (is_null($meetingZoom)) {
                    flash(trans('flash_messages.error_cant_connect_zoom'))
                        ->important()->error();
                    return back();
                }
                    return Redirect::to($meetingZoom->join_url);
            }
    }
    private function canceledRegularTeacherClick($user){

        $teacher = $user->teacher;
        if ($this->teacher->id == $teacher->id) {
            if (config('app.lessons_check_enable')) {
                if (!$this->isLessonTimeRevalent()) {
                    $this->setStatus('not_attend');
                    flash(trans('flash_messages.error_lesson_time_expired') .
                        trans('flash_messages.error_not_attend'))
                        ->important()->error();
                    return back();
                }
            }
            //$this->setStatus('pending');
            flash(trans('flash_messages.admin_can_restore'))
                ->important()->warning();
            return back();
        }else{
            flash(trans('flash_messages.error_not_your_lesson'))
                ->important()->error();
            return back();
        }


    }
    private function completedRegularTeacherClick($user){
        flash(trans('flash_messages.error_lesson_completed'))->important()->error();
        return back();
    }
    private function not_attendRegularTeacherClick($user){
        return back();
    }
    //----------------------------- end regular statuses -------------------------------------

   // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

  }
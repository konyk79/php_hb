<?php

namespace App;

use DateTime;

trait Lessons
{


    //||||-----------------  PrivateSubscriberClick status functions:
    private function checkJoinAble()
    {
        if (!$this->canJoinLesson()) {

            flash(trans('error_no_active_subscription'))
                ->important()->error();
            return redirect(url('dashboard/subscribes'));
        }

        return back();

    }
}
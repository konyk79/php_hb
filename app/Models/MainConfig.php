<?php

namespace App;

use DateInterval;
use Illuminate\Database\Eloquent\Model;

class MainConfig extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'lesson_cancel_timeout',
        'lesson_before_start_timeout',
        'lesson_after_start_timeout',
        'slider_timeout',
        'user_subscribe_timeout'
    ];
    public function getUserSubscribeTimeout()
    {
      switch($this->user_subscribe_timeout[-1]){
          case 'D':
          case 'M':
          case 'W':
          case 'Y':
            return  new DateInterval('P' . $this->user_subscribe_timeout);
          break;
//          case 'S':
//          case 'H':
//          case 'M':
//            return  new DateInterval('PT' . $this->user_subscribe_timeout);
//         break;
      }

    }
    public function getLessonCancelTimeout()
    {
        return  new DateInterval('PT' . $this->lesson_cancel_timeout);
    }
    public function getLessonBeforeStartTimeout()
    {
//       dd(new DateInterval('PT' . $this->lesson_before_start_timeout));
       return new DateInterval('PT' . $this->lesson_before_start_timeout);
    }

    public function getLessonAfterStartTimeout()
    {
        return new DateInterval('PT' . $this->lesson_after_start_timeout);
    }

    public function getSliderTimeoutSec()
    {
            $di=  new DateInterval('PT' . $this->slider_timeout);
         return $di->h*3600+$di->i*60+$di->s;
    }
}

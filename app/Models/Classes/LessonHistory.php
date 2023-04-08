<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonHistory extends Model
{
    protected $fillable =[
        'user_sub_history_id',
        'lesson_id',
    ];
    public static function boot()
    {
        parent::boot();

        static::created(function($hlesson){
            $user_sub= $hlesson->user_sub_history->user_subscribe;
//            dd($user_sub);
            $user_sub->checkAvailableClassesAndChangeStatusIfNot();
        //dd($hlesson);
        });

    }

    public function user_sub_history(){
        return $this->belongsTo(UserSubHistory::class,'user_sub_history_id');
    }
}

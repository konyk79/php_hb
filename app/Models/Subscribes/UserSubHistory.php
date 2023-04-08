<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSubHistory extends Model
{
    protected $fillable =[
        'user_sub_id',
        'user_sub_status_id',
        'transaction_id',
        'created_at'
    ];
    public function status()
    {
        return $this->belongsTo(UserSubStatus::class);
    }
    public function classes_histories()
    {
        return $lastHistory= $this->hasMany(ClassesHistory::class);
    }
    public function lesson_histories()
    {
        return $this->hasMany(LessonHistory::class);
    }
    public function user_subscribe()
    {
        return $this->belongsTo(UserHasSubscribe::class, 'user_sub_id');
    }
}

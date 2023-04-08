<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassesHistory extends Model
{
    protected $fillable =[
        'user_sub_history_id',
        'class_id'
    ];
}

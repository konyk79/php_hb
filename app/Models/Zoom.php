<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
        protected $fillable = [
'lesson_id',
'meeting_id',
'user_id',
'status'            // active , deleted
        ];
}

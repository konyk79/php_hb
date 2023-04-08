<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupHasUsers extends Model
{
    protected $fillable = ['group_id', 'subscribe_id'];
}

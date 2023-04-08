<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserSubStatus extends Model
{
    use Translatable;
    public $translatedAttributes = ['name',];
    protected $fillable = ['code', 'name'
//        'is_active'
    ];

    public function user_has_subscribes()
    {
        return HasMany(UserHasSubscribe::class);
//        return $this->belongsToMany(UserHasSubscribe::class, 'user_sub_histories', 'user_sub_status_id','user_sub_id')
//            ->withPivot('id')->where('user_sub_histories.id',$this->belongsToMany(UserSubStatus::class, 'user_sub_histories', 'user_sub_id','user_sub_status_id')
//                ->withPivot('id')->max('user_sub_histories.id'));

    }
}
class UserSubStatusTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}





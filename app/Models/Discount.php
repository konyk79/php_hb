<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use Translatable;
    public $translatedAttributes = ['name', ];
    protected $fillable = ['code','name',
        'discount',
        'is_active'
    ];
    public  function subscribes(){
        return $this->hasMany(Subscribe::class);
    }


}

class DiscountTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}
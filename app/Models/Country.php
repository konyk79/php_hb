<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['name'];
    public  function  users(){
        return $this->hasMany(User::class);

    }
    public  function  reviews(){
        return $this->hasMany(Review::class);

    }
}
class CountryTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name',];
}
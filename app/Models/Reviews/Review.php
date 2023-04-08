<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use Translatable;

    public $translatedAttributes = ['body'];
    protected $fillable = ['body','name'];

    public function country(){
        return $this->belongsTo(Country::class);
    }
//    public function user(){
//        return $this->belongsTo(User::class);
//    }
}
class ReviewTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['body'];
}
<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Subitem extends Model
{
    use Translatable;

    public $translatedAttributes = ['title',];
    protected $fillable = ['name','title'];
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
class SubitemTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['title'];
}
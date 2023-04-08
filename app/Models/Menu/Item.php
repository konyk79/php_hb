<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use Translatable;

    public $translatedAttributes = ['title',];
    protected $fillable = ['name','title'];
    public function subitems(){
        return $this->hasMany(Subitem::class);
    }
    public function getSubitems(){
        return $this->subitems->where('visible','<>', 0)->sortBy('priority');
    }
    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
class ItemTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['title'];
}
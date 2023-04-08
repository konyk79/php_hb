<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use Translatable;
    public $translatedAttributes = ['name' ];
    protected $fillable = ['code',
        'name',
        'discount',
        'is_active'
    ];
    public function groups(){
        return $this->belongsToMany(Group::class, 'group_has_promos');
    }
}
class PromoTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}
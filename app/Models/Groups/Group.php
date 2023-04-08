<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Translatable;
    use HasSubscribe;
    use HasUser;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['name', 'description'];
    static  public function getRegistrationTypes(){
        return self::whereIn('code',['private','corporate'])->get();
    }

    public function promos()
    {
        return $this->belongsToMany(Promo::class,  'group_has_promos' );
    }


}
class GroupTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name', 'description'];
}
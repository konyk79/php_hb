<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Translatable;
    public $translatedAttributes = ['name',];
    protected $fillable = ['code', 'name'];
    public function not_ended_lessons(){
        return $this->hasMany(Lesson::class)->whereNotIn('class_status_id',[
            ClassStatus::where('code','completed')->first()->id,
            ClassStatus::where('code','not_attend')->first()->id
            ]);
    }
    public function active_subscribes(){
        return $this->hasMany(Subscribe::class)->where('is_active',true);
    }
}
class TypeTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}

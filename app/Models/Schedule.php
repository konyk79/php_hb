<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use Translatable;
    public $translatedAttributes = ['name',];
    protected $fillable = ['code', 'name'];
    static public  function getSelectOptions($id){
        $result[0]= ['name'=>'All', 'selected' => ($id==0)?'selected':''];
        foreach (self::all() as  $item){
            $result[$item->id]= ['name'=>$item->name, 'selected' => ($id==$item->id)?'selected':''];
        }
        return $result;
    }
    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
}
class ScheduleTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}
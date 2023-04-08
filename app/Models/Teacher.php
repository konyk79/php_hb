<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable=[
        'user_id',
        'zoom_id',
        'zoom_private_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    static public  function getSelectOptions($id){
       $result[0]= ['name'=>'All', 'selected' => ($id==0)?'selected':''];
        foreach (self::all() as  $item){
            $result[$item->id]= ['name'=>$item->user->name, 'selected' => ($id==$item->id)?'selected':''];
        }
        return $result;

    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }
    public function private_lessons(){
        return $this->hasMany(Lesson::class)->whereHas('type',function($q){
            $q->where('code','private');
        });
    }

}

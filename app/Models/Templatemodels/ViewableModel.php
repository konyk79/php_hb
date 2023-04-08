<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewableModel extends Model
{
    public function getViewName(){
        return $this->view->name;
    }
    public function getName(){
        return $this->name;
    }
    public function view(){
        return $this->belongsTo(View::class);
    }
    static public function getByName($name){
        return self::where('name',$name)->where('visible',true)->first();
    }

}

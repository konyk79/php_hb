<?php

namespace App;
use App\View;
use Illuminate\Database\Eloquent\Model;
//use App\ContentableModel;

class Header extends ContentableModel
{
    use Menuable; // ned menu_id field in model's table
//    public function contents(){
//        return $this->morphMany(Content::class,'contentable');
//    }
    static public function getByName($name){
        return self::where('name',$name)->first();
    }

//    public function getContentByName($name){
//        if ($this->contents){
//            return $this->contents->where('name',$name)->first();
//        }
//        return $this->contents->where('name',$name)->first();
//    }

    public function view(){
        return $this->belongsTo(View::class);
    }


    public function getViewName(){
        return $this->view->name;
    }

    public function pages(){
        return $this->belongsToMany(Page::class, 'page_has_headers');
    }
    public function layouts(){
        return $this->belongsToMany(Layout::class, 'layout_has_headers');
    }
}

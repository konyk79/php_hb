<?php

namespace App;
use App\ContentableModel;
use Illuminate\Database\Eloquent\Model;
class Footer extends ContentableModel
{
    use Menuable;  // ned menu_id field in model's table
    use Socialized;
    use FormableTrait;

    public function view(){
        return $this->belongsTo(View::class);
    }
    public function contents(){
        return $this->morphMany(Content::class,'contentable');
    }
    public function pages(){
        return $this->belongsToMany(Page::class, 'page_has_footers');
    }
    public function getViewName(){
        return $this->view->name;
    }
    static public function getByName($name){
        return self::where('name',$name)->first();
    }
     public function getContentByName($name){
        return $this->contents->where('name',$name)->first();
    }
    public function layouts(){
        return $this->belongsToMany(Layout::class, 'layout_has_footers');
    }
}

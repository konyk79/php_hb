<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    public function view(){
        return $this->belongsTo(View::class);
    }

    public function headers(){
        return $this->hasMany(Header::class);
    }
    public function footers(){
        return $this->hasMany(Footer::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }

    public function getViewName(){
        if($this->view)
            return $this->view->name;
        else
            return null;
    }




    public function getItems(){
        return $this->items->where('visible','<>', 0)->sortBy('priority');
    }
}

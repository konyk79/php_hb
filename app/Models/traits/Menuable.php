<?php
// ned menu_id field in model's table
namespace App;

trait Menuable
{
// ned menu_id field in model's table
    public function menu(){
        return $this->belongsTo(Menu::class)->where('visible',true);
    }
}
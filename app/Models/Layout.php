<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends ContentableModel
{
    protected $fillable = ['name'];

    public function footers(){
        return $this->belongsToMany(Footer::class, 'layout_has_footers')->where('visible',true);;
    }
    public function view(){
        return $this->belongsTo(View::class);
    }
    public function headers(){
        return $this->belongsToMany(Header::class, 'layout_has_headers')->where('visible',true);;
    }
    public function pages(){
        return $this->hasMany(Page::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public function footers(){
        return $this->hasMany(Footer::class);
    }
    public function headers(){
        return $this->hasMany(Header::class);
    }
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
    public function layouts()
    {
        return $this->hasMany(Layout::class);
    }
}

<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use Translatable;

    public $translatedAttributes = ['body','title','href_title'];
    protected $fillable = ['name','body', 'title','href_title'];

       public function render(){
           return $this->body;
       }
    public function contentable()
    {
        return $this->morphTo();
    }
}
class ContentTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['body','title','name','href_title'];
}
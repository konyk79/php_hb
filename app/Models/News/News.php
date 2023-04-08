<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use Translatable;

    public $translatedAttributes = ['body','title','description'];
    protected $fillable = ['body','title','description'];

}
class NewsTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['body','title','description'];
}
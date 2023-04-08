<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PageHasNews extends Model
{
    use Translatable;

    public $translatedAttributes = ['more_button_text'];
    protected $fillable = ['more_button_text'];
}
class PageHasNewsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['more_button_text'];
}
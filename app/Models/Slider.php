<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use Translatable;
    public $translatedAttributes = ['title', 'text','href_text'];
    protected $fillable = [
        'code',
        'title',
        'text',
        'href_text',
        'href'
    ];
}
class SliderTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['title', 'text','href_text'];
}
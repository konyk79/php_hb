<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use Translatable;

    public $translatedAttributes = ['question','answer'];
    protected $fillable = ['question','answer'];
}
class FaqTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['question','answer'];
}
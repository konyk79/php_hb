<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class PagConf extends Model
{
    use Translatable;

    public $translatedAttributes = ['previous', 'next'];
    protected $fillable = ['previous', 'next'];
}
class PagConfTranslation extends Model
{
    protected $fillable = ['previous', 'next'];
    public $timestamps = false;

}
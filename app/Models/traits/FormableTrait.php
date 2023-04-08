<?php
namespace App;

trait FormableTrait
{
    public function forms()
    {
        return $this->morphToMany('App\Form', 'formable')->where('visible',true);
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{

    public function socialized()
    {
        return $this->morphTo();
    }
}

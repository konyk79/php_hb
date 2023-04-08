<?php

namespace App;

trait Socialized
{

    public function social_links(){
        return $this->morphMany(SocialLink::class,'socialized')->where('visible',true);
    }

    public function getSocialLinkByName($name){
        if ($this->social_links){
            return $this->social_links->where('name',$name)->first();
        }
        return null;
    }
}
<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use Translatable;

    public $translatedAttributes = ['name','switcher_name'];
    protected $fillable = ['name','switcher_name'];

    static public function getCurrentLanguageForSwitcher(){
        $code = app()->getLocale();
        if (strpos($code, '_') !== false){
            list($code,$other)=explode('_',$code);
        }
        if ($config=self::where('code',$code)->first() ){
            return $config->switcher_name;
        }else {
            $code = 'en';
            if ($config=self::where('code',$code)->first() ){
                return $config->switcher_name;
            }else return false;
        }


    }

}
class LanguageTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name','switcher_name'];
}
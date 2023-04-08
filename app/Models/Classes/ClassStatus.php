<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ClassStatus extends Model
{
    use Translatable;
    public $translatedAttributes = ['name',];
    protected $fillable = ['code', 'name'
//        'is_active'
    ];

    public function lessons()
    {
        return $this->HasMany(Lesson::class);
    }


}
class ClassStatusTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}
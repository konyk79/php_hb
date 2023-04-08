<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Form extends ViewableModel
{

    use Translatable;

    public $translatedAttributes = ['body_text','title','error_text','submit_title','cancel_title','success_text'];
    protected $fillable = ['body_text','title','error_text','submit_title','cancel_title','success_text'];
    public function footers()
    {
        return $this->morphedByMany('App\Footer', 'formable');
    }
    public function pages()
    {
        return $this->morphedByMany('App\Page', 'formable');
    }

    public function fields(){
        return $this->hasMany(Field::class);
    }

    public function getFields(){
        if ($this->fields)
            return $this->fields->where('visible','<>', 0)->sortBy('priority');
        else
            return null;
    }
    public function getField($name){
        if ($this->fields)
            return $this->fields->where('name',$name)->first();
        else
            return null;
    }

    public function updateSchema()
    {
        $fields=$this->getFields();
        if ($fields!= null){
            $model=$this->model;
            if (is_null($model)) return false;
            $tableName = (new $model())->getTable();
//            Model::first()->getF
            $modelObject=(new $model())->first();
//           print_r($modelObject);
           foreach($fields as $field){
               if(!Schema::hasColumn($tableName, $field->name))  //check whether table has name column
               {
                   Schema::table($tableName, function(Blueprint $table) use ($field, &$fluent) {
                       if ($field->type == 'none') return;
//                       $model=$this->model;
////                       $modelObject=(new $model());
////                       //$tmpFillable=$modelObject->getFillable();
////                       $modelObject->setFillable( $field->name);
//                       dd($modelObject);
                       if($field->unique && $field->type= 'string' ) {
                           $table->{$field->type}($field->name, 64)->nullable($field->nullable)->unique($field->unique)->default($field->defaul_val);
                       }else{
                           $fluent = $table->{$field->type}($field->name )->nullable($field->nullable)->default($field->defaul_val);
                       }
                   });
//                   dd($fluent);
               }
           }
            return true;
        }
        return false;

    }

}
class FormTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['body_text','title','error_text','submit_title','cancel_title','success_text'];
}
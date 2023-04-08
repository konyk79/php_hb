<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Field extends Model
{
    use Translatable;

    public $translatedAttributes = ['label','placeholder'];
    protected $fillable = ['label','placeholder'];
    public function form(){
        return $this->belongsTo(Form::class);
    }
    public function isModelFieldExist(){
            $model=$this->form->model;
            if (is_null($model)) return false;
            $tableName = (new $model())->getTable();
//            dd($tableName);
            return Schema::hasColumn($tableName, $this->name); //check whether table has name column
    }
    public function getValue($id){
        $model=$this->form->model;
        if (is_null($model)) return null;
        $tableName = (new $model())->getTable();
//            dd($tableName);
        if(!Schema::hasColumn($tableName, $this->name)) return null;//check whether table has name column
        $modelEloquent=(new $model());
        //dd($modelEloquent::find($id));
        return $modelEloquent::find($id)->{$this->name};
    }
}
class FieldTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['label','placeholder'];
}
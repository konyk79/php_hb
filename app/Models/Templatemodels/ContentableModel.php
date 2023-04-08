<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ContentableModel extends ViewableModel
{

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            if (!isset(Input::get()['contents'])) return;
            $newContents = Input::get()['contents'];
            $oldContents = $model->contents;
            if (!is_null($oldContents)) {
                $oldContents = $oldContents->pluck('id')->toArray();
            }

            if (!is_null($newContents)) {
                foreach ($newContents as $n => $id) {
                    if (is_null($oldContents) || !in_array($id, $oldContents)) {
//                $tag=Tag::find($id);
                        dump($id);
                        $content = Content::find($id);
                        $content->contentable_id = $model->id;
                        $content->contentable_type = get_class($model);
                        $content->save();
                    }
                }
            }
            if (!is_null($oldContents)) {

                foreach ($oldContents as $n => $id) {
                    if (is_null($newContents) || !in_array($id, $newContents)) {
//                $tag=Tag::find($id);
                        //$model->contents()->detach($id);
                        $content = Content::find($id);
                        $content->contentable_id = 0;
                        $content->contentable_type = null;
                        $content->save();
                    }
                }
            }
        });

    }
    public function contents(){
        return $this->morphMany(Content::class,'contentable');
    }

    public function getContentByName($name){
        if ($this->contents){
            return $this->contents->where('name',$name)->first();
        }
        return null;
    }

}

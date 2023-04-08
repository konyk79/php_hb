<?php
namespace Admin\Http\Controllers;

use App\ClassStatus;
use App\Language;
use App\Lesson;
use SleepingOwl\Admin\Http\Controllers\AdminController;

class LessonController extends AdminController
{
//    public function getDashboard()
//    {
//        dd('tut');
//        $isSuperAdmin =\Auth::user()->isSuperAdmin();
//        if ($isSuperAdmin){
//            return $this->renderContent(
//                $this->admin->template()->view('dashboard'),
//                trans('sleeping_owl::lang.dashboard')
//            );
//        }else{
//            flash('YOU HAVENT PERMISSION')->important()->error();
//            return back();
//        }

//    }
    public function copyLesson($id)
    {
        $lesson = Lesson::find($id);
        $translatable_fields=array();

        foreach (Language::all() as $language) {
            $translatable_fields[$language->code]=array(
                'name' => $lesson->{'name:'.$language->code}.'copy',
                'description' => $lesson->{'description:'.$language->code},
                'term_text' => $lesson->{'term_text:'.$language->code}
            );
        }

        Lesson::create([
                'class_status_id' => ClassStatus::where('code','pending')->first()->id,
//                'time_out' => $lesson->code.'time_out',
                'visible' => false,
                'teacher_id' => $lesson->teacher_id,
                'schedule_id' => $lesson->schedule_id,
                'term' => $lesson->term,
                'start_time' => $lesson->start_time,
                'is_active' => false,
                'language_id' => $lesson->language_id,
                'class_level_id' => $lesson->class_level_id,
                'type_id' => $lesson->type_id,
                'color' =>$lesson->color,
        ] + $translatable_fields);
        return back();

    }
}
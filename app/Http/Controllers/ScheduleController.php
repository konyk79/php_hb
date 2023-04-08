<?php

namespace App\Http\Controllers;

use App\ClassStatus;
use App\Form;
use App\Lesson;
use App\Type;
use App\UserHasSubscribe;
use Auth;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Calendar;
use Session;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getCurrentWeekRange() {
        $dt =  (new DateTime())->format('D');
        $dt_min =  new DateTime("last saturday"); // Edit
        $dt_min->modify(($dt == 'Sun')?'-5 day':'+2 day'); // Edit
        $dt_min->modify('-'. Session::get('timezone_offset')/60 .' hour');
        $dt_max = clone($dt_min);
        $dt_max->modify('+7 days');
        $start_date =$dt_min->format('Y-m-d H:i:s');
        $end_date=$dt_max->format('Y-m-d H:i:s');
        return  array($start_date,$end_date);
    }

    public function prepareData($data)
    {
        if (is_null($data))
            return [];
        $result = array();
        foreach ($data as $key => $lesson){
//            dd($lesson->getStartTimeAsString());
           if (isset($result[$lesson->getStartTimeAsString()])){
             //  $result[$lesson->getStartTimeAsString()][] = $lesson;
           }else{
               $result[$lesson->getStartTimeAsString()] = [
                   trans('schedule.Mon')=> [],
                   trans('schedule.Tue')=> [],
                   trans('schedule.Wed')=> [],
                   trans('schedule.Thu')=> [],
                   trans('schedule.Fri')=> [],
                   trans('schedule.Sat')=> [],
                   trans('schedule.Sun')=> []
               ];
           }
            $result[$lesson->getStartTimeAsString()][trans('schedule.'.$lesson->getStartDayAsString())][] = $lesson;
//           dd($lesson->getStartDayAsString());
//            if ()
        }
        ksort($result);
//        dd($result);
       return $result;


    }




        public function show(Request $request, $type, $schedule_id, $teacher_id)
        {

            if (!Session::get('timezone')){
                flash(trans('flash_messages.time_zone_expired'))->important()->error();
                return redirect(url('/dashboard/profile'));
            }
            $user = Auth::user();
            $classes = [];
        if (!isset($type)) {
            $type_id = Type::where('code', 'regular')->first()->id;
        }else {

            if (is_null( $typeObj = Type::where('code', $type)->first()))
                $type_id= Type::where('code','regular')->first()->id;
            else
                $type_id =$typeObj->id;
        }
         if   (!(($user->hasRole('admin')||$user->hasRole('teacher')))){
             if ($user->type->code == 'private' &&( Type::find($type_id)->code == 'corporate')){
                 flash(trans('flash_messages.lesson_type_not_allowed'))->error()->important();
               return back();
             }
             if ($user->type->code == 'corporate' &&( Type::find($type_id)->code == 'regular' ||
                     Type::find($type_id)->code == 'private' )){
                 flash(trans('flash_messages.lesson_type_not_allowed'))->error()->important();
                 return back();
             }
         }

        list($startWeek, $endWeek) = $this->getCurrentWeekRange();
//        dump($endWeek);
//        dd($startWeek);

        $data = Lesson::where('type_id',$type_id)
            ->where('visible',true)
            ->where('start_time','>=',$startWeek )
            ->where('start_time','<',$endWeek );

        if ($schedule_id>0)
            $data ->where('schedule_id',$schedule_id);
        if ($teacher_id>0)
            $data ->where('teacher_id',$teacher_id);

            $data=$data->get();
//        dd($data);
//        if($data->count()){
            $schedule = $this->prepareData($data);
//            dd($schedule);
//        }
        return  $this->main('dashboard/schedule',
            [
                'schedule'=>$schedule,
                'schedule_id'=> $schedule_id,
                'teacher_id'=>$teacher_id,
                'type'=>$type
            ]);
    }

}

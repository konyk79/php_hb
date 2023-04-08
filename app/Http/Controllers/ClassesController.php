<?php

namespace App\Http\Controllers;

use App;
use App\ClassStatus;
use App\Form;
use App\Lesson;
use App\Type;
use Auth;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Calendar;
use Session;

class ClassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function click(Lesson $lesson)
    {
        $user=Auth::user();
        return $lesson->click($user);
    }
    public function clickCancel(Lesson $lesson)
    {
        $user=Auth::user();
        return $lesson->clickCancel($user);
    }
    public function index(Request $request)
    {
        $user=Auth::user();
//        dd($request->type);
        $classes = [];
        if(!isset($request->type))
            if($user->type->code == 'corporate'){
                $type_id= Type::where('code','corporate')->first()->id;
            }else
                $type_id= Type::where('code','regular')->first()->id;
        else {
            if (is_null( $type= Type::where('code', $request->type)->first()))
                if($user->type->code == 'corporate'){
                    $type_id= Type::where('code','corporate')->first()->id;
                }else
                    $type_id= Type::where('code','regular')->first()->id;
            else
                $type_id =$type->id;
        }

        $data = Lesson::where('type_id',$type_id)->where('visible',true)->get(); //regular
//        dd($data);
        if($data->count()){
//            dd(Session::get('timezone'));
            if (!Session::get('timezone')){
                flash(trans('flash_messages.time_zone_expired'))->important()->error();
                return redirect(url('/dashboard/profile'));
            }
            $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'), Session::get('timezone_offset')*60 , false))?$name:Session::get('timezone')/60;

//            dd( Session::get('timezone'));
//            ->setTimezone(new DateTimezone($timezoneName));
            foreach ($data as $key => $value) {
//                dd($value->start_time);
                $format = 'Y-m-d H:i:s';
                $startTime =DateTime::createFromFormat($format,($value->start_time));
//                print_r($startTime);
                $format1 = 'Y-m-d\TH:i:s';
                $term = new DateInterval('PT'.$value->term);
//                print_r($term);
                $endTime = clone $startTime;
                $endTime->add($term);
//                print_r($startTime);
//                $startTime=$startTime->format($format1);
//                $endTime=$endTime->format($format1);
                $cancel_btn=($value->isCancelButton())?'<a  id="event_cancel_a"  
                            class="fc-event close" aria-label="Close">
                        <span class="" id="event_cancel_btn" aria-hidden="true">×</span></a>':'';
                $classes[] = $class= Calendar::event(
                    $value->name, //."<span class='text-detail-small'>pending</span>",

                    false,

                    $startTime->setTimezone(new DateTimezone($timezoneName)),

                    $endTime->setTimezone(new DateTimezone($timezoneName)),

                    $value->id,
                    //options

                    [

                        'color' =>  $value->color,
                        'status' =>  "<span class='text-detail-small'>(".$value->getStatus().")</span>",
                        'teacher' => $value->teacher->user->name,
                        'term' => $value->term_text,
//                        'textEscape' => true,
                        'cancel_url' => url('/dashboard/classes/'.$value->id.'/cancel/click'),
                        'submit_url' => url('/dashboard/classes/'.$value->id.'/click'),
                        'cancel_btn' => $cancel_btn,
                    ]
                );
            }

        }

        $calendar = Calendar::addEvents($classes)->setCallbacks([
            'eventRender' => "function(event, element, view) {
               document.cookie = \"lastView=\" + view.name;
            if ((view.name=='agendaDay') ||(view.name=='agendaWeek') ){
                           document.cookie = \"lastDayView=\" + $('.fc').fullCalendar('getDate').format();
//                            console.log($('.fc').fullCalendar('getDate').format());
            }else{
               // document.cookie = \"lastDayView=\"=''; expires=\" + '-1';
            }
//               console.log(view);
                var separator = (view.name=='month')?'<br>':'<br>';
                event.title = event.title + separator + event.status;
                element.find('.fc-title').html(event.title);
                element.find('.fc-content').parent().html(event.cancel_btn + element.find('.fc-content').parent().html());
            }",
            'eventClick' => "function( calEvent,jsEvent, view) {
            if(jsEvent.target.id == 'event_cancel_btn'){
                    window.location.href = calEvent.cancel_url;
            }else{
            
//             window.open(calEvent.submit_url, '_blank');
                window.location.href = calEvent.submit_url;
            }

    }",
            'eventMouseover' => "function (data, event, view) {

//  console.log(data.start);
//   console.log(navigator.language || navigator.userLanguage);

//  console.log(event);
        tooltip = '<div class=\"tooltiptopicevent\" style=\"width:auto;height:auto;background:#efefef;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;\">' + 'title: ' + ': ' + data.title +data.status + '</br>'+
         \"<span class='text-detail-small'>(\"+data.teacher+\")</span>\"+ '</br>'+
         \"<span class='text-detail-small'>(\"+data.term+\")</span>\"+ '</br>'+
         'start: ' + ': ' +
         (new Date(Date.parse(data.start))).toLocaleString(navigator.language || navigator.userLanguage) + '</div>';


        $('body').append(tooltip);
        $(this).mouseover(function (e) {
            $(this).css('z-index', 10000);
            $('.tooltiptopicevent').fadeIn('500');
            $('.tooltiptopicevent').fadeTo('10', 1.9);
        }).mousemove(function (e) {
            $('.tooltiptopicevent').css('top', e.pageY + 10);
            $('.tooltiptopicevent').css('left', e.pageX + 20);
        });


    }",
            'eventMouseout' => " function (data, event, view) {
        $(this).css('z-index', 8);

        $('.tooltiptopicevent').remove();

    }"
        ])->setOptions([ //set fullcalendar options
            'firstDay' => 1,
            'locale'  => App::getLocale(),
//
//            'defaultView'=> ,
        ]);
//        dd(App::getLocale());
        return  $this->main('dashboard/my-classes',
            [
                'calendar'=>$calendar,
            ]);
    }

}

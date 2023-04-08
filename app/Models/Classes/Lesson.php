<?php

namespace App;

use Auth;
use DateTime;
use DateTimeZone;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Log;
use Session;
use App\LessonObserver;
use DateInterval;
use SleepingOwl\Admin\Form\Element\Date;

class Lesson extends Model
{
    use Translatable;
    use Zoomable;
    use SubscriberLesson;
    use TeacherLesson;
    use AdminLesson;
    // cancel clicks
    use SubscriberLessonCancel;
    use TeacherLessonCancel;
    use AdminLessonCancel;
//    protected $table = 'classes';
    public $translatedAttributes = ['name', 'description', 'term_text'];
    protected $fillable = [
        'class_status_id',
        'time_out',
        'visible',
        'teacher_id',
        'schedule_id',
        'name',
        'description',
        'term_text',
        'term',
        'start_time',
        'is_active',
        'language_id',
        'class_level_id',
        'type_id',
        'color'
    ];


    public static function boot()
    {
        parent::boot();

        static::created(function ($lesson) {
            $user_id = ($lesson->type->code == 'private') ? $lesson->teacher->zoom_private_id : $lesson->teacher->zoom_id;
            $zoom = Zoom::create([
                'lesson_id' => $lesson->id,
                'meeting_id' => '0',
                'status' => 'active',
                'user_id' => $user_id
            ]);
            $meeting = $lesson->addMeeting($user_id);
            if (is_null($meeting)) {
                $zoom->delete();
                $lesson->delete();
            }
            $zoom->meeting_id = $meeting->id;
            $zoom->save();
        });
        static::saved(function ($lesson) {
            $user_id = ($lesson->type->code == 'private') ? $lesson->teacher->zoom_private_id : $lesson->teacher->zoom_id;
            if($zoom=Zoom::where('lesson_id',$lesson->id)->first()){
                if ($zoom->user_id !== $user_id){
                    $zoom->user_id=$user_id;
                    $zoom->save();
                }
                return;
            }
            $zoom = Zoom::create([
                'lesson_id' => $lesson->id,
                'meeting_id' => '0',
                'status' => 'active',
                'user_id' => $user_id
            ]);
        });
        static::creating(function ($lesson) {
            if (!$lesson->class_status_id)
                $lesson->class_status_id =1;
            if (!$lesson->color )
                $lesson->color ='#ff5303';

        });


    }
    public function regularScheduleCloseLesson(){
        $meetingId = $this->zoom->meeting_id;
        $registrantsList = $this->getRegistrantsList($meetingId);
        if (!is_null($registrantsList)) {
//                    dd($registrantsList);
            if ($this->isUserInList($registrantsList)) {
                $this->closeLesson($registrantsList->registrants);
                $this->setStatus('completed');

            } else {
                $this->setStatus('not_attend');
            }

            Log::info(['success'=>'Lesson#'.$this->id.'close automatic success']);
            return ;
        }
        Log::info(['error'=>'Lesson#'.$this->id.'hav not been closed due error:no answer from Zoom Apifunc:getRegistrantsList($meetingId); ']);
        return ;
    }
    public function corporateScheduleCloseLesson(){
        return $this->regularScheduleCloseLesson();
    }

    public function privateScheduleCloseLesson(){
        $this->closeLesson(array((object)(['email'=> User::find($this->getBookingUser())->email])));
        $this->setStatus('completed');
        Log::info(['close lesson success' => 'Lesson#'.$this->id.'close automatic success']);
        return;
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function scheduleCloseLesson(){
//       print_r($this->type->code);
        try {

            return $this->{$this->type->code . 'ScheduleCloseLesson'}();
        } catch (\Exception $e) {
            Log::info(['error'=>'Lesson#'.$this->id.' close no function for type'.$this->type->code.'in  scheduleCloseLesson']);
            return ;
        }
    }

    public static function dailySchedule(array $options = [])
    {
        $dateNow = new DateTime('-1 hour');
        $from_date = (new DateTime('-1 day'))->setTime(0,0,00);
        print_r($dateNow->format('Y-m-d H:i:s'));
        $daily_lessons=self::all()->where('start_time','>', $from_date->format('Y-m-d H:i:s'))
            ->where('start_time','<', $dateNow->format('Y-m-d H:i:s'))
        ;
//        dump($daily_lessons);
        foreach($daily_lessons as $lesson){
//            dump($lesson->status->code);
           switch  ($lesson->status->code){
               case 'passing':
                   print_r('passing'.$lesson->id);
                    $lesson->scheduleCloseLesson();
                   break;
               case 'approved':
                   print_r('approved'.$lesson->id);
                   $lesson->setStatus('not_attend');
                   Log::info('For lesson#'.$lesson->id.'automaticly set status not_attend because of time expired');
                   break;
               default:
                   if(!($lesson->status->code == 'not_attend'
                       ||  $lesson->status->code == 'completed'
                       ||  $lesson->status->code == 'not_booked')){
                       switch  ($lesson->type->code){
                           case 'private':
                               $lesson->setStatus('not_booked');
                               Log::info('For lesson#'.$lesson->id.'automaticly set status not_booked because of time expired');
                               break;
                           case 'regular':
                           case 'corporate':
                               $lesson->setStatus('not_attend');
                               Log::info('For lesson#'.$lesson->id.'automaticly set status not_attend because of time expired');
                               break;
                       }
                   }


           }

        }
        print_r($daily_lessons->pluck('id'));
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

//    public function getTimeZones()
//    {
//        $zones = timezone_identifiers_list();
//
//        foreach ($zones as $zone) {
//            $zone = explode('/', $zone); // 0 => Continent, 1 => City
//
//            // Only use "friendly" continent names
//            if ($zone[0] == 'Africa' || $zone[0] == 'America' || $zone[0] == 'Antarctica' || $zone[0] == 'Arctic' || $zone[0] == 'Asia' || $zone[0] == 'Atlantic' || $zone[0] == 'Australia' || $zone[0] == 'Europe' || $zone[0] == 'Indian' || $zone[0] == 'Pacific') {
//                if (isset($zone[1]) != '') {
//                    $locations[$zone[0]][$zone[0] . '/' . $zone[1]] = str_replace('_', ' ', $zone[1]); // Creates array(DateTimeZone => 'Friendly name')
//                }
//            }
//        }
//        return $locations;
//    }


    private function canJoinLesson()
    {
        $user = Auth::user();
        $userSubscribe = $user->getActiveSubscribesForType($this->type->code);
//        dd($userSubscribe);
        if (is_null($userSubscribe)) {
            return false;
        } else {
//            $numUsedLessons = $userSubscribe->getLastActiveHistory()->lesson_histories->count();
//            if ()
            return true;
        }
    }

    private function isLessonTimeRevalent()
    {
        if (new DateTime() > $this->getLastJoinTime()) {
            return false;
        } else {
            return true;
        }
    }

    private function isLessonTimeEnd()
    {
        if (new DateTime() > $this->getEndTime()) {
            return false;
        } else {
            return true;
        }
    }

    private function isTimeToStart()
    {
        if (new DateTime() <= $this->getLastJoinTime() && new DateTime() >= $this->getFirstJoinTime()) {
            return true;
        } else {
            return false;
        }
    }

    public function isStarted()
    {
        if (config('app.lessons_check_enable')) {
            if ($this->getTimeUserTimeZone() > $this->getLastJoinTime()) return false;
        }
//        dump($this->getTimeUserTimeZone() >  $this->getLastJoinTime());
//        dd($this->getLastJoinTime());
        return $this->status->code == 'passing';
    }

    private function joinLesson($meetingZoom)
    {
        if (!$this->isStarted()) {
            flash('Lesson has not been starteed yet!')
                ->important()->error();
            return back();
        }
//                dump('1');
        return Redirect::to($meetingZoom->join_url);
    }


    public function click($user)
    {
        try {
            return $this->{$user->getMainRoleCode() . 'Click'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown Role of user in Lesson:' . $user->getMainRoleCode())
                    ->important()->error();
            }
            return back();
        }

    }

    public function clickCancel($user)
    {
//        $this->isCancelButton();
//        dd($this->isCancelButton());
        try {
            return $this->{$user->getMainRoleCode() . 'ClickCancel'}($user);
        } catch (\Exception $e) {
            if (config('APP_DEBUG')) {
                flash('Unknown Role of user in Lesson cancel:' . $user->getMainRoleCode())
                    ->important()->error();
            }
            return back();
        }

    }


    public function isCancelButton()
    {
        $user = Auth::user();
        $role = $user->getMainRoleCode();
        if ($role == 'subscriber' || $role == 'user') {
            if (!$this->isMyBooking($user)) return false;
        }
        try {
            return method_exists($this,
                $this->status->code . ucfirst($this->type->code) . ucfirst($user->getMainRoleCode()) . 'ClickCancel');
        } catch (\Exception $e) {
//            flash('Unknown Role of user in Lesson isCancelButton:' . $user->getMainRoleCode())
//                ->important()->error();
            return false;
        }

    }

    public function getStartTimeWitTimezone()
    {
//            $zones = timezone_identifiers_list();
        $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'),null,false))?$name:Session::get('timezone_offset')/60;
        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time))
            ->setTimezone(new DateTimeZone($timezoneName));
    }

    public function getTimeUserTimeZone()
    {
//            $zones = timezone_identifiers_list();
        $timezoneName = Session::get('timezone');
        return (new DateTime())
            ->setTimezone(new DateTimeZone($timezoneName));
    }

    public function getStartTime()
    {
        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time));
    }

    public function getEndTime()
    {
        return $this->getStartTime()->add(new DateInterval('PT' . $this->term));
    }

    public function getLastJoinTime()
    {
//            $zones = timezone_identifiers_list();
        //    $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'),null,false))?$name:Session::get('timezone_offset')/60;
        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time))
            ->add(MainConfig::first()->getLessonAfterStartTimeout());
    }

    public function getFirstJoinTime()
    {
//            $zones = timezone_identifiers_list();
        // $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'),null,false))?$name:Session::get('timezone_offset')/60;
        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time))->
        sub(MainConfig::first()->getLessonBeforeStartTimeout());
    }

    public function getLastCancelTime()
    {
//        dd(MainConfig::first()->getLessonCancelTimeout());
//            $zones = timezone_identifiers_list();
//        $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'),null,false))?$name:Session::get('timezone_offset')/60;
//        dump(Session::get('timezone'));dd( $timezoneName );
        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time))
            ->sub(MainConfig::first()->getLessonCancelTimeout());
    }

    public function isCancalableTime()
    {
//        dd($this->getLastCancelTime());
        return (boolean)(new DateTime() <= $this->getLastCancelTime());
    }
//    public function getFirstCancelTime()
//    {
////            $zones = timezone_identifiers_list();
//        $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'),null,false))?$name:Session::get('timezone_offset')/60;
////        dump(Session::get('timezone'));dd( $timezoneName );
//        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time))
//            ->setTimezone(new DateTimeZone($timezoneName))->diff(MainConfig::first()->getLessonCancelTimeout());
//    }


    public function getStartTimeAsString()
    {
//            $zones = timezone_identifiers_list();
        $timezoneName = Session::get('timezone');//($name = timezone_name_from_abbr(Session::get('timezone'),null,false))?$name:Session::get('timezone_offset')/60;
//        dump(Session::get('timezone'));dd( $timezoneName );
        return (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time))
            ->setTimezone(new DateTimeZone($timezoneName))
            ->format('H:i');
    }

    public function getStartDayAsString()
    {
        $timezoneName = Session::get('timezone');
//        $timezoneName = ($name = timezone_name_from_abbr(Session::get('timezone'), Session::get('timezone_offset')*60 , false))?$name:Session::get('timezone')/60;
//        DateTime::createFromFormat($format, $startedHistory->created_at)->setTimezone(new DateTimeZone('Europe/Kiev'));
        $date = (DateTime::createFromFormat('Y-m-d H:i:s', $this->start_time));
//        dd($date->setTimezone(new DateTimeZone('Europe/Kiev')));
//        dd($this->getTimeZones());
        return $date->setTimezone(new DateTimeZone($timezoneName))->format('D');
    }

    public function getStatus()
    {

        return ($status = $this->status) ? $status->name : null;
    }

    public function getType()
    {

        return ($type = $this->type) ? $type->name : null;
    }

    public function status()
    {

        return $this->belongsTo(ClassStatus::class, 'class_status_id');
    }

    public function isStatus($status)
    {
        if (is_string($status)) {
            return !!($this->status->code == $status);
        }

        return !!$status->intersect($this->status)->count();
    }

    public function cancelBooking($user)
    {
        if ($bookings = Booking::where('lesson_id', $this->id)->get()) {
            foreach ($bookings as $booking) {
                $booking->delete();
            }

        }
    }

    public function setStatus($status)
    {
        if (is_string($status)) {
            if ($status = $this->status->where('code', $status)->first()) {
                $this->class_status_id = $status->id;
                $this->save();
                return $status->id;
            }
        }
        $this->class_status_id = $status->id;
        $this->save();
        if ($status = 'active') {
            if (Auth::user()->isUser()) {
                $this->roles()->detach(Role::where('code', 'user')->first()->id);
                $this->roles()->attach(Role::where('code', 'subscriber')->first()->id);
            }
        }

        return $status->id;
    }
}

class LessonTranslation extends Model
{
//    protected $table = 'class_translations';
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'term_text'];
}
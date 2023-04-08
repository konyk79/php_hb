<?php

namespace App;

use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Model;
use Log;

class UserHasSubscribe extends Model
{

    protected $fillable =[
        'user_id',
        'payment_system_id',
        'payment_system_refid',
        'status_id',
        'subscribe_id',
        'promo_id',
        'price',
        'is_active',
        'is_terminated',
        'is_confirmed'
    ];
    public  function dailyScheduleRun(){
        print_r('UHS#'.$this->id);
        print_r(new DateTime());
        print_r($this->getEndDateWitTimeout());
        if ($this->subscribe->is_auto_prolangate && !$this->is_confirmed && $this->getStatus()==='active'){
            if( (new DateTime()) >  $this->getStartDateWitTimeout()) {
                $this->setStatus('waiting_for_payment');
                $this->is_active=false;
                $this->is_terminated=false;
                $this->save();
                print_r('User Subscribe change status by daily schedule (no notification). User Subscription #'. $this->id);
                Log::info(['User Subscribe change status by daily schedule.User Subscription not confirmed by payment system notification #' => $this->id]);
                return;
            }

        }

        if( (new DateTime()) >  $this->getEndDateWitTimeout()){
            switch ($this->getStatus()){
                case 'active':
                case 'trial_term':
                    $this->setStatus('waiting_for_payment');
                    $this->is_active=false;
                    $this->is_terminated=false;
                    break;
                case 'terminating':
                    $this->setStatus('terminated');
                    $this->is_active=false;
                    $this->is_terminated=true;
                    break;
            }
            $this->save();
            print_r('User Subscribe change status by daily schedule. User Subscription #'. $this->id);
            Log::info(['User Subscribe change status by daily schedule. User Subscription #' => $this->id]);
            return;
        }
        return;
    }

    public static function dailySchedule(){
        $active_user_subscribes=UserHasSubscribe::where('is_active', true)->get();
        foreach($active_user_subscribes as $usubscribe){
            $usubscribe->dailyScheduleRun();
        }
    }

    public function terminate(){
        if($this->subscribe->is_auto_prolangate && $this->is_terminated!=1 && $this->payment_system_refid ) {
            if (!app('App\Http\Controllers\PaymentController')->cancelRecurring($this->id)) {
//                $logFile = 'subscription_terminating.txt';
                Log::useDailyFiles(storage_path().'subscription_terminating.log');
                Log::info(['Error while terminating user subscription #'.$this->id.'payment system cant terminate subscription plane make it by hand!']);
                flash('Error due canceling subscription')->error()->important();
                return false;
            }
        }
            if($this->is_active){
                if($this->getStatus()!== 'terminating') {
                    $this->setStatus('terminating');
                }
                $this->save();
            }else{
                if($this->getStatus()!== 'terminated'){
                    $this->setStatus('terminated');
                    $this->is_active=false;
                    $this->is_terminated = true;
                    $this->save();
                }
            }
            return true;
    }

    public function forceTerminate(){
        if($this->subscribe->is_auto_prolangate && $this->is_terminated!=1 && $this->payment_system_refid ) {
            if (!app('App\Http\Controllers\PaymentController')->cancelRecurring($this->id)) {
//                $logFile = 'subscription_terminating.txt';
                Log::useDailyFiles(storage_path().'subscription_terminating.log');
                Log::info(['Force terminating for user subscription #'.$this->id.'payment system cant terminate subscription plane make it by hand!']);
            }
        }
        if($this->is_active){
            if($this->getStatus()!== 'terminating') {
                $this->setStatus('terminating');
            }
            $this->save();
        }else{
            if($this->getStatus()!== 'terminated'){
                $this->setStatus('terminated');
                $this->is_active=false;
                $this->is_terminated = true;
                $this->save();
            }
        }
        return true;
    }
//    public function createSubscribe(){
//        if($this->getStatus()!== 'active' && $this->getStatus()!== 'terminating'){
//            $this->setStatus('active');
//            $this->is_terminated = false;
//            $this->save();
//        }else {
//            if($this->getStatus()== 'terminating') $this->is_terminated = true;
//            if($this->getStatus()== 'active') $this->is_terminated = false;
//                $this->is_active=true;
//                $this->save();
//        }
//    }

    public function getStartDate()
    {
        $format = 'Y-m-d H:i:s';
        $startDate = new DateTime();
        $startedHistory=1;   // for global
        if(is_null($startedHistory=$this->histories->where('user_sub_status_id',2)->last())){   //active
            $startedHistory=$this->histories->where('user_sub_status_id',3)->last(); //trial
        }
        if(is_null($startedHistory))  return null;
        return DateTime::createFromFormat($format, $startedHistory->created_at);

    }
    public function getStartDateAsString($format='d/m/Y')
    {
        $startDate= $this->getStartDate();
        return ($startDate)?$startDate->format($format):'';
    }
    public function getEndDateWitTimeout()
    {
        return $this->getEndDate()->add(MainConfig::first()->getUserSubscribeTimeout());
    }
    public function getStartDateWitTimeout()
    {
        return $this->getStartDate()->add(MainConfig::first()->getUserSubscribeTimeout());
    }
    public function getEndDate()
    {
        $startDate = $this->getStartDate();

        if (is_null($startDate)) return '';
//       dump('ku:'); dd(dump($this->subscribe->term));
         $term =1;
        if($this->isTrial()){
//            dd(new DateInterval('P'.$this->subscribe->trial_term));
            $term = new DateInterval('P'.$this->subscribe->trial_term);
//            dd($term);
        }else{

            $term = new DateInterval('P'.$this->subscribe->term);
        }
//        dd($startDate);
        return $startDate->add($term);
    }
    public function getEndDateAsString($format='d/m/Y')
    {
        $endDate= $this->getEndDate();
        return ($endDate)?$endDate->format($format):'';
    }
    public function setStatus($code)
    {
        if( !is_null($statusObj=UserSubStatus::where('code',$code )->first())){
            if($code == $this->getStatus()) return;
            UserSubHistory::create([
                'user_sub_status_id' => $statusObj->id,
                'user_sub_id' => $this->id,
            ]);
            $this->status_id = $statusObj->id;
            $this->save();
        }
    }
    public function setTrialStatus()
    {
//        dd(UserSubStatus::where('code','trial_term' )->first());
       //     $this->setStatus('trial_term');
        if( !is_null($statusObj=UserSubStatus::where('code','trial_term' )->first())){
            UserSubHistory::create([
                'user_sub_status_id' => $statusObj->id,
                'user_sub_id' => $this->id,
            ]);
            $this->status_id = $statusObj->id;
        }
//            dump($this);
            $this->is_active=true;
            $this->is_terminated=false;
            $this->save();
//        dd($this);
    }
    public function checkAvailableClassesAndChangeStatusIfNot()
    {
        if ($this->subscribe->num_classes <= $this->getLastActiveHistory()->lesson_histories->count() ){
            if ($this->getStatus() != 'waiting_for_payment'){
                $this->setStatus('waiting_for_payment');
                $this->is_active = false;
                $this->is_terminated=false;
                $this->save();
            }
            return false;
        }
        return true;
    }


    public function getStatusName()
    {
        return $this->status->name;
    }
    public function getStatus()
    {
        return $this->status->code;
    }
    public function isTrial(){
        return (boolean)($this->getStatus()=='trial_term');
    }
    public function status()
    {
        return $this->belongsTo(UserSubStatus::class,'status_id');
//        return $this->belongsToMany(UserSubStatus::class, 'user_sub_histories', 'user_sub_id','user_sub_status_id')
//            ->withPivot('id')->where('user_sub_histories.id',$this->belongsToMany(UserSubStatus::class, 'user_sub_histories', 'user_sub_id','user_sub_status_id')
//                ->withPivot('id')->max('user_sub_histories.id'));

    }

    public function classesHistories()
    {
        return $this->hasMany(UserSubHistory::class,'user_sub_id')->where('id',$this->hasMany(UserSubHistory::class,'user_sub_id')
            ->whereIn('user_sub_status_id',UserSubStatus::whereIn('code',['active','trial_term'])->pluck('id'))->max('id'));

    }

    public function getLastActiveHistory()
    {
//        if ($this->getStatus()=='trial_term'){
//            dd($this->classesHistories);
//            return $this->classesHistories->where('user_sub_status_id', UserSubStatus::where('code','trial_term')->pluck('id')->first())->last();
//        }
//        dd($this->classesHistories->whereIn('user_sub_status_id', UserSubStatus::whereIn('code',['active','trial_term'])->pluck('id'))->pluck('id')->last());
        return $this->classesHistories->whereIn('user_sub_status_id', UserSubStatus::whereIn('code',['active','trial_term'])->pluck('id'))->last();

    }



    public function getUsedClasses()
    {
//        dd($this->getLastActiveHistory());
        if ($lastActiveInHistory=$this->getLastActiveHistory())
            return (!is_null($l_h=$this->getLastActiveHistory()->lesson_histories) )?$l_h->count():0;
        else
            return 'There is problem with your subscription please connect to administrator!';

    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function payment_system()
    {
        return $this->belongsTo(PaymentSystem::class, 'payment_system_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(UserSubHistory::class, 'user_sub_id');

    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function subscribe(){
        return $this->belongsTo(Subscribe::class);
    }
//********************* Notification functions*********************
    public function paidNotificationAction($dt_date,$dt_nextDate){
//        Log::useDailyFiles(storage_path().'/logs/user_subscriptions.log');
        Log::info(['Subscription '.$this->name.'user'.$this->user->email=>'payed']);
        if(!$this->subscribe->is_auto_prolangate) return;
        if($this->getStatus()=='active'){
//            dd($this->getStartDate()->add(MainConfig::first()->getUserSubscribeTimeout()));
            if($this->getStartDate()->add(MainConfig::first()->getUserSubscribeTimeout())< $dt_date){
//                $this->setStatus('waiting_for_payment');
                if( !is_null($statusObj=UserSubStatus::where('code','waiting_for_payment' )->first())) {
                    UserSubHistory::create([
                        'user_sub_status_id' => $statusObj->id,
                        'user_sub_id' => $this->id,
                    ]);
                    $this->is_active=false;
                    $this->is_terminated=false;
                };
                sleep(1);
                if( !is_null($statusObj=UserSubStatus::where('code','active' )->first())) {
                    UserSubHistory::create([
                        'user_sub_status_id' => $statusObj->id,
                        'user_sub_id' => $this->id,
                        'created_at' => $dt_date->format('Y-m-d H:i:s')
                    ]);
                };
//                $this->setStatus('active');
                Log::info(['paidNotificationAction waiting-> active']);
                $this->is_active=true;
                $this->is_terminated=false;
                $this->is_confirmed=true;
            }else {
                Log::info(['paidNotificationAction confirmed true']);
                $this->is_confirmed=true;           // first payment confirmation
            }
        }else if ($this->getStatus()=='waiting_for_payment') {
//            set active status with start time = payment time;
            if( !is_null($statusObj=UserSubStatus::where('code','active' )->first())){
                UserSubHistory::create([
                    'user_sub_status_id' => $statusObj->id,
                    'user_sub_id' => $this->id,
                    'created_at' => $dt_date->format('Y-m-d H:i:s')
                ]);
                $this->status_id = $statusObj->id;
                Log::info(['paidNotificationAction confirmed active']);
                $this->is_active=true;
                $this->is_terminated=false;
                $this->is_confirmed=true;
            }

        }
        $this->save();
    }
    public function canceledNotificationAction($dt_date,$dt_nextDate){
        Log::info(['Subscription '.$this->name.'user'.$this->user->email=>'canceled']);
        if(!$this->subscribe->is_auto_prolangate) return;
        if($this->getStatus()=='active' || $this->getStatus()=='trial_term' ){
            $this->setStatus('terminating');
            $this->is_terminated=false;
        }else if ($this->getStatus()!='terminating'  && $this->getStatus()!='terminated'){
            $this->setStatus('terminated');
            $this->is_terminated=true;
        }
        $this->save();

    }

    public function failedNotificationAction($dt_date,$dt_nextDate){
       // Log::useDailyFiles(storage_path().'/logs/user_subscriptions.log');
        Log::info(['Subscription '.$this->name.'user'.$this->user->email=>'failed']);
    }

//------------------------end-------------------------------------
    public function notificationAction($status, $date, $nextDate){
        $dt_date = new DateTime($date);
        $dt_nextDate = new DateTime($nextDate);
//        dd('$dt_date'.$dt_date->format('d/m/Y H:i:s').';$dt_next_date'.$nextDate->format('d/m/Y H:i:s').';$status'.$status);
        Log::info(['UserSubscriber Notification Action #'.$this->id  => '$dt_date: '.(($dt_date)?$dt_date->format('d/m/Y H:i:s'):'N/A').';$dt_next_date: '.(($nextDate)?$nextDate->format('d/m/Y H:i:s'):'N/A').';$status: '.$status]);

        try {
            return $this->{$status . 'NotificationAction'}($dt_date,$dt_nextDate);
        } catch (\Exception $e) {
            Log::info(['Error!!!  UserSubscriber Notification Action #'.$this->id  => '$dt_date'.(($dt_date)?$dt_date->format('d/m/Y H:i:s'):'N/A').';$dt_next_date'.(($nextDate)?$nextDate->format('d/m/Y H:i:s'):'N/A').';$status'.$status]);
        }
//            if (config('APP_DEBUG')) {
//                flash('Error  in '. $status.'NotificationAction :' )
//                    ->important()->error();
//            }
//            return back();
//        }
    }

    public function invoiceItems() {
        return $this->hasMany(InvoiceItem::class);
    }
}

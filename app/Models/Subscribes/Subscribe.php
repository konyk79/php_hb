<?php

namespace App;

use DateTime;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Log;

class Subscribe extends Model
{
    use Translatable;
    use HasGroup;

    public $translatedAttributes = ['name', 'term_text', 'description'];
    protected $fillable = [
        'code',
        'type_id',
        'name',
        'description',
        'term_text',
        'discount_id',
        'price',
        'visible',
        'priority',
        'term',
        'is_auto_prolangate',
        'is_active',
        'expires_for',
        'num_classes',
//'limit_classes',
//'limit_term',
        'trial_term'];


    public  function getExpiresDate(){
        if (!$this->expires_for) return false;
       return DateTime::createFromFormat('Y-m-d', $this->expires_for );

    }

    public  function dailyScheduleRun(){
        if (!($expiresDate=$this->getExpiresDate())) return;
        if( (new DateTime()) >  $expiresDate) {
            $this->is_active = false;
            $this->save();
            print_r('Subscribe change status by daily schedule . Subscription #'. $this->id);
            Log::info('Subscribe change status by daily schedule . Subscription # '. $this->id);
        }
    }

    public static function dailySchedule(){
        $active_subscribes=self::where('is_active', true)->get();
        foreach($active_subscribes as $usubscribe){
            $usubscribe->dailyScheduleRun();
        }
    }

    public function not_terminated_user_subscribers()
    {
        return $this->hasMany(UserHasSubscribe::class)
            ->whereNotIn('status_id',[UserSubStatus::where('code','terminating')->first()->id,UserSubStatus::where('code','terminated')->first()->id]);
    }


    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_has_subscribes');
    }

    public function group_with_promos()
    {
        $relation = $this->belongsToMany(Group::class, 'group_has_subscribes');
        $relation->getQuery()->has('promos');
        return $relation;
    }

    public function promos()
    {
        return $this->groups->promos;
    }

    public function promosName()
    {
//        $groups_wit_promos=$this->group_with_promos;
        $result = array();
        foreach ($this->groups as $group) {
            if ($group->promos) {
                foreach ($group->promos as $promo) {
                    if (!in_array($promo->name, $result)) $result[] = $promo->name;
                }

            }

        }
//        dd($result);
//        $result =$result->pluck('name')->toArray();
        return $result;
    }

}

class SubscribeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'term_text', 'description'];
}

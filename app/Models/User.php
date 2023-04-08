<?php

namespace App;

//use app\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use KodiComponents\Support\Upload;
use Illuminate\Http\UploadedFile;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasCustomFields;
    use HasGroup;
    use HasSubscribe;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_id',
        'last_name',
        'phone',
        'email_confirmation_code',
        'type_id',
        'about_me',
        'photo'
    ];


    public function usersubscribes()
    {
        return $this->HasMany(UserHasSubscribe::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /** Looking for active user subscribe for given type
     * @param $type   code field of types table
     * @return null or existing UserSubscribe
     */
    public function getActiveSubscribesForType($type)
    {
        $uSubscribes = $this->getNotTerminatedSubscribes();
        if (is_null($uSubscribes)) return null;
        foreach ($uSubscribes as $key => $uSubscribe) {

            if ($uSubscribe->subscribe->type->code == $type) {
                if ($uSubscribe->checkAvailableClassesAndChangeStatusIfNot()) {
                    return $uSubscribe;
                }
            }
        }
        return null;
    }

    public function getMainRoleCode()
    {
        if ($this->hasRole('teacher')) return 'teacher';
        if ($this->hasRole('admin')) return 'admin';
        if ($this->hasRole('subscriber')) return 'subscriber';
        if ($this->hasRole('user')) return 'user';
        return 'none';
    }

    public function getNotTerminatedSubscribes()
    {
        $uSubscribes = $this->usersubscribes;
        foreach ($uSubscribes as $key => $uSubscribe) {
            if ($uSubscribe->getStatus() == 'terminated') {
                $uSubscribes->pull($key);
            }
        }
        return $uSubscribes;
    }

    public function hasUserSubscribes($subscribe)
    {
        $uSubscribes = $this->getNotTerminatedSubscribes();

        if (is_string($subscribe)) {
            return $uSubscribes->where('subscribe_id', Subscribe::where('code', $subscribe)->pluck('id')->first())->first();
        }
//        dd($uSubscribes->where('subscribe_id', $subscribe->id)->pluck('id')->first());
        return (!is_null($uS = $uSubscribes->where('subscribe_id', $subscribe->id)->first())) ? $uS : false;

    }

    public function hasUserSubscribeReturnId($subscribe)
    {
        $uSubscribes = $this->getNotTerminatedSubscribes();

        if (is_string($subscribe)) {
            return $uSubscribes->where('subscribe_id', Subscribe::where('code', $subscribe)->pluck('id')->first())->pluck('id')->first();
        }
//        dd($uSubscribes->where('subscribe_id', $subscribe->id)->pluck('id')->first());
        return (!is_null($uS = $uSubscribes->where('subscribe_id', $subscribe->id)->pluck('id')->first())) ? $uS : false;

    }

    public function terminateSubscription($id)
    {
        $subscribe = $this->all_user_subscribes->where('id', $id)->first();
        if ($subscribe->getStatus() === 'terminating' || $subscribe->getStatus() === 'terminated') {
            flash('Already terminated!')->warning()->important();
            return true;
        }
        return $subscribe->terminate();
    }


    public function forceTerminateSubscription($id)
    {
        $subscribe = $this->all_user_subscribes->where('id', $id)->first();
        if ($subscribe->getStatus() === 'terminating' || $subscribe->getStatus() === 'terminated') {
            flash('Already terminated!')->warning()->important();
            return true;
        }
        return $subscribe->forceTerminate();
    }

    public function createSubscription($subscribe, $options)
    {
//        dd($subscribe);

        $realPrice = $subscribe->price;
        if ($subscribe->discount) {
            $realPrice = Helpers::formatFloat($subscribe->price * (1 + $subscribe->discount->discount));
        }
        if (isset($options['promo_id']) && !is_null($options['promo_id']))
            $realPrice = Helpers::formatFloat($realPrice + $realPrice * Promo::find($options['promo_id'])->discount);
//        $trial_term = (function() use ($subscribe){
//            if ($this->isUser() && $subscribe->trial_term)
//                return ['status_id' => UserSubStatus::where('code', 'waiting_for_payment')->first()->id];
//            else
//                return ['status_id' => UserSubStatus::where('code', 'waiting_for_payment')->first()->id];
//        })();

        $options = $options +  (function($subscribe){
//            dd($this->isUser() && $subscribe->trial_term != '0D');
                if ($this->isUser() && $subscribe->trial_term != '0D')
                    return ['status_id' => UserSubStatus::where('code', 'trial_term')->first()->id,
                            'is_confirmed' => true];
                else
                    return ['status_id' => UserSubStatus::where('code', 'waiting_for_payment')->first()->id];
            })($subscribe) +[
                'user_id' => $this->id,
                'subscribe_id' => $subscribe->id,
//            'promo_id' => 1,
                'price' => $realPrice,
                'is_active' => false,
                'is_terminated' => false,

            ];
//        dd($options);
        $userSubscribe = UserHasSubscribe::create(
            $options
        );
        if ($this->isUser() && $subscribe->trial_term!='0D') {
            $userSubscribe->setTrialStatus();
            $this->roles()->detach(Role::where('code', 'user')->first()->id);
            $this->roles()->attach(Role::where('code', 'subscriber')->first()->id);
        } else {
            $userSubscribe->setStatus('waiting_for_payment');
            if ($this->isUser()) {
                $this->roles()->detach(Role::where('code', 'user')->first()->id);
                $this->roles()->attach(Role::where('code', 'subscriber')->first()->id);
            }
        }
//        dd($userSubscribe);
        return $userSubscribe;
    }

    public function type()
    {
        return $this->belongsTo(Group::class, 'type_id');
    }
// all not terminated
    public function user_subscribes()
    {
        return $this->hasMany(UserHasSubscribe::class)->where('status_id', '<>', UserSubStatus::where('code', 'terminated')->first()->id);

    }
    // all include terminated
    public function all_user_subscribes()
    {
        return $this->hasMany(UserHasSubscribe::class);

    }

//    public function getUserSubscribes()
//    {
//        $subscribes = $this->user_subscribes;
//
//        foreach ($subscribes as $key=>$sub){
//            if($sub->getStatus()== 'terminated'){
//                $subscribes->pull($key);
//             }
//
//        }
////        dd($subscribes);
//        return $subscribes;
//    }

    public function getType()
    {
        return $this->type->code;
    }

    public function getAllowSubscribes($type = null)
    {

        $result = new Collection();
        foreach ($this->groups as $group) {

            $result = $result->union($group->subscribes);
        }
        if (is_null($type))
            return Subscribe::where('is_active', true)->where('visible', true)->orderBy('priority', 'desc');
        else
            return $result->where('type_id', Type::where('code', $type)->first()->id)->where('visible', true)->where('is_active', true)->sortBy('priority', 1, false);
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * @return bool
     */
    public function isTeacher()
    {
        return $this->hasRole('teacher');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isUser()
    {
        return $this->hasRole('user');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }


    /**
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

class UserHasRole extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'role_id'];
}
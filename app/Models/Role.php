<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['code'];

//    public function accesses()
//    {
//        return $this->hasMany(Access::class);
//    }
//
//    public function eventGroups()
//    {
//        return $this->belongsToMany(EventGroup::class, 'event_group_has_roles');
//    }

//    public function eventGroupsThroughAccesses()
//    {
//        $collection = new Collection();
//
//        foreach ($this->accesses as $access) {
//            if($access->accessed_type === ServiceDepartment::class) {
//
//                $collection = $collection->add( $access->accessed->eventGroup );
//            }
//        }
//        return $collection->unique();
//    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_has_roles');
    }

    public function assignTo(User $user)
    {
        $user->roles()->attach($this->id);
    }

//    public static function getRoleIdNameArrayAsString($eventGroupId) {
//        $result = '[';
//
//
//        foreach (Role::join('event_group_has_roles', 'roles.id', '=', 'event_group_has_roles.role_id')->where('event_group_has_roles.event_group_id', '=', $eventGroupId)->get() as $role) {
//            if ($result !== '[') {
//                $result .= ',';
//            }
//            $result .= '{id:\'' . $role->id . '\', name:\'' . $role->name . '\', code:\'' . $role->code . '\'}';
//        }
//
//        $result .= ']';
//
//        return $result;
//    }

//    public static function defaultRoles()
//    {
//        return [
//            config('admin') => [
//                'ru' => ['name' => 'Супер администратор'],
//                'en' => ['name' => 'Super administrator'],
//                'ua' => ['name' => 'Супер адміністратор']
//            ],
//        ];
//    }
}

class RoleTranslation extends Model {
    public $timestamps = false;
    protected $fillable = ['name'];
}
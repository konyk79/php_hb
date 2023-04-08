<?php

namespace App;

use App\Group;

trait HasSubscribe
{

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribes()
    {
        return $this->belongsToMany(Subscribe::class,  mb_substr($this->getTable(), 0, -1).'_has_subscribes');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignSubscribes($code)
    {
        return $this->subscribes()->save(
            Subscribes::where('code', $code)->firstOrFail()
        );
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasSubscribes($subscribe)
    {
        if (is_string($subscribe)) {
            return $this->subscribes->where('code', $subscribe)->pluck('id')->first();
        }
        return $this->subscribes->where('code', $subscribe->code)->pluck('id')->first();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return boolean
     */
//    public function hasPermission(Permission $permission)
//    {
//        return $this->hasRole($permission->roles);
//    }
}
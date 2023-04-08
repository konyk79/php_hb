<?php

namespace App;

use App\Group;

trait HasGroup
{

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_has_'.$this->getTable());
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignGroup($code)
    {
        return $this->groups()->save(
            Group::where('code', $code)->firstOrFail()
        );
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasGroup($code)
    {
        if (is_string($code)) {
            return $this->groups->contains('code', $code);
        }

//        return (bool) $role->intersect($this->roles)->count();
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
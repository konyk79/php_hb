<?php

namespace App;


trait HasUser
{

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, substr($this->getTable(), 0, -1).'_has_users');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     * @return mixed
     */
    public function assignUsers($code)
    {
        return $this->users()->save(
            Users::where('code', $code)->firstOrFail()
        );
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return boolean
     */
    public function hasUsers($code)
    {
        if (is_string($code)) {
            return $this->users->contains('code', $code);
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
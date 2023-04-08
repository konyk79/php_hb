<?php

namespace Admin\Policies;

use Admin\Http\Sections\MainConfigs;
use Admin\Http\Sections\Roles;
use App\MainConfig;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MainConfigsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function before(User $user, $ability, MainConfigs $section, MainConfig $item)
    {
        if ($user->isAdmin()) {
//            if ($ability != 'display' && $ability != 'create' && $item->id <= 2) {
//
//            }

            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function display(User $user, MainConfigs $section, MainConfig $item)
    {
       // return $user->isSuperAdmin();
        return true;
    }

    /**
     * @param User $user
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function edit(User $user, MainConfigs $section, MainConfig $item)
    {
        return true;
    }
    /**
     * @param User $user
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function create(User $user, MainConfigs $section, MainConfig $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function delete(User $user, MainConfigs $section, MainConfig $item)
    {
        return true; // $item->id > 2;
    }
}

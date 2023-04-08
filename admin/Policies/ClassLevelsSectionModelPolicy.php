<?php

namespace Admin\Policies;

use Admin\Http\Sections\ClassLevels;
use App\User;
use App\ClassLevel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassLevelsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param ClassLevels $section
     * @param ClassLevel $item
     *
     * @return bool
     */
    public function before(User $user, $ability, ClassLevels $section, ClassLevel $item)
    {
        if ($user->isSuperAdmin()) {
//            if ($ability != 'display' && $ability != 'create' && $item->id <= 2) {
//
//            }

            return true;
        }
        return false;
    }

    /**
     * @param User $user
     * @param ClassLevels $section
     * @param ClassLevel $item
     *
     * @return bool
     */
    public function display(User $user, ClassLevels $section, ClassLevel $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param ClassLevels $section
     * @param ClassLevel $item
     *
     * @return bool
     */
    public function edit(User $user, ClassLevels $section, ClassLevel $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param ClassLevels $section
     * @param ClassLevel $item
     *
     * @return bool
     */
    public function create(User $user, ClassLevels $section, ClassLevel $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param ClassLevels $section
     * @param ClassLevel $item
     *
     * @return bool
     */
    public function delete(User $user, ClassLevels $section, ClassLevel $item)
    {
        return true; // $item->id > 2;
    }
}

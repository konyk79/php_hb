<?php

namespace Admin\Policies;

use Admin\Http\Sections\Groups;
use App\User;
use App\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Groups $section
     * @param Group $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Groups $section, Group $item)
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
     * @param Groups $section
     * @param Group $item
     *
     * @return bool
     */
    public function display(User $user, Groups $section, Group $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Groups $section
     * @param Group $item
     *
     * @return bool
     */
    public function edit(User $user, Groups $section, Group $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Groups $section
     * @param Group $item
     *
     * @return bool
     */
    public function create(User $user, Groups $section, Group $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Groups $section
     * @param Group $item
     *
     * @return bool
     */
    public function delete(User $user, Groups $section, Group $item)
    {
        return true; // $item->id > 2;
    }
}

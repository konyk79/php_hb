<?php

namespace Admin\Policies;

use Admin\Http\Sections\Schedules;
use App\User;
use App\Schedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Schedules $section
     * @param Schedule $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Schedules $section, Schedule $item)
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
     * @param Schedules $section
     * @param Schedule $item
     *
     * @return bool
     */
    public function display(User $user, Schedules $section, Schedule $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Schedules $section
     * @param Schedule $item
     *
     * @return bool
     */
    public function edit(User $user, Schedules $section, Schedule $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Schedules $section
     * @param Schedule $item
     *
     * @return bool
     */
    public function create(User $user, Schedules $section, Schedule $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Schedules $section
     * @param Schedule $item
     *
     * @return bool
     */
    public function delete(User $user, Schedules $section, Schedule $item)
    {
        return true; // $item->id > 2;
    }
}

<?php

namespace Admin\Policies;

use Admin\Http\Sections\Lessons;
use Admin\Http\Sections\Roles;
use App\Lesson;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonsSectionModelPolicy
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
    public function before(User $user, $ability, Lessons $section, Lesson $item)
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
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function display(User $user, Lessons $section, Lesson $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Roles $section
     * @param Role $item
     *
     * @return bool
     */
    public function edit(User $user, Lessons $section, Lesson $item)
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
    public function create(User $user, Lessons $section, Lesson $item)
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
    public function delete(User $user, Lessons $section, Lesson $item)
    {
        return true; // $item->id > 2;
    }
}

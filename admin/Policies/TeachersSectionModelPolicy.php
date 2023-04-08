<?php

namespace Admin\Policies;

use Admin\Http\Sections\Teachers;
use App\User;
use App\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeachersSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Teachers $section
     * @param Teacher $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Teachers $section, Teacher $item)
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
     * @param Teachers $section
     * @param Teacher $item
     *
     * @return bool
     */
    public function display(User $user, Teachers $section, Teacher $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Teachers $section
     * @param Teacher $item
     *
     * @return bool
     */
    public function edit(User $user, Teachers $section, Teacher $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Teachers $section
     * @param Teacher $item
     *
     * @return bool
     */
    public function create(User $user, Teachers $section, Teacher $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Teachers $section
     * @param Teacher $item
     *
     * @return bool
     */
    public function delete(User $user, Teachers $section, Teacher $item)
    {
        return true; // $item->id > 2;
    }
}

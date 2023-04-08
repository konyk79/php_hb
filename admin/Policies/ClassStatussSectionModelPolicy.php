<?php

namespace Admin\Policies;

use Admin\Http\Sections\ClassStatuss;
use App\User;
use App\ClassStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassStatussSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param ClassStatuss $section
     * @param ClassStatus $item
     *
     * @return bool
     */
    public function before(User $user, $ability, ClassStatuss $section, ClassStatus $item)
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
     * @param ClassStatuss $section
     * @param ClassStatus $item
     *
     * @return bool
     */
    public function display(User $user, ClassStatuss $section, ClassStatus $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param ClassStatuss $section
     * @param ClassStatus $item
     *
     * @return bool
     */
    public function edit(User $user, ClassStatuss $section, ClassStatus $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param ClassStatuss $section
     * @param ClassStatus $item
     *
     * @return bool
     */
    public function create(User $user, ClassStatuss $section, ClassStatus $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param ClassStatuss $section
     * @param ClassStatus $item
     *
     * @return bool
     */
    public function delete(User $user, ClassStatuss $section, ClassStatus $item)
    {
        return true; // $item->id > 2;
    }
}

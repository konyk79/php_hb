<?php

namespace Admin\Policies;

use Admin\Http\Sections\Types;
use App\User;
use App\Type;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Types $section
     * @param Type $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Types $section, Type $item)
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
     * @param Types $section
     * @param Type $item
     *
     * @return bool
     */
    public function display(User $user, Types $section, Type $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Types $section
     * @param Type $item
     *
     * @return bool
     */
    public function edit(User $user, Types $section, Type $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Types $section
     * @param Type $item
     *
     * @return bool
     */
    public function create(User $user, Types $section, Type $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Types $section
     * @param Type $item
     *
     * @return bool
     */
    public function delete(User $user, Types $section, Type $item)
    {
        return true; // $item->id > 2;
    }
}

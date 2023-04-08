<?php

namespace Admin\Policies;

use Admin\Http\Sections\Countrys;
use App\User;
use App\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountrysSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Countrys $section
     * @param Country $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Countrys $section, Country $item)
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
     * @param Countrys $section
     * @param Country $item
     *
     * @return bool
     */
    public function display(User $user, Countrys $section, Country $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Countrys $section
     * @param Country $item
     *
     * @return bool
     */
    public function edit(User $user, Countrys $section, Country $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Countrys $section
     * @param Country $item
     *
     * @return bool
     */
    public function create(User $user, Countrys $section, Country $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Countrys $section
     * @param Country $item
     *
     * @return bool
     */
    public function delete(User $user, Countrys $section, Country $item)
    {
        return true; // $item->id > 2;
    }
}

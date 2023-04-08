<?php

namespace Admin\Policies;

use Admin\Http\Sections\Promos;
use App\User;
use App\Promo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromosSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Promos $section
     * @param Promo $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Promos $section, Promo $item)
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
     * @param Promos $section
     * @param Promo $item
     *
     * @return bool
     */
    public function display(User $user, Promos $section, Promo $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Promos $section
     * @param Promo $item
     *
     * @return bool
     */
    public function edit(User $user, Promos $section, Promo $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Promos $section
     * @param Promo $item
     *
     * @return bool
     */
    public function create(User $user, Promos $section, Promo $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Promos $section
     * @param Promo $item
     *
     * @return bool
     */
    public function delete(User $user, Promos $section, Promo $item)
    {
        return true; // $item->id > 2;
    }
}

<?php

namespace Admin\Policies;

use Admin\Http\Sections\Discounts;
use App\User;
use App\Discount;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiscountsSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Discounts $section
     * @param Discount $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Discounts $section, Discount $item)
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
     * @param Discounts $section
     * @param Discount $item
     *
     * @return bool
     */
    public function display(User $user, Discounts $section, Discount $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Discounts $section
     * @param Discount $item
     *
     * @return bool
     */
    public function edit(User $user, Discounts $section, Discount $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Discounts $section
     * @param Discount $item
     *
     * @return bool
     */
    public function create(User $user, Discounts $section, Discount $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Discounts $section
     * @param Discount $item
     *
     * @return bool
     */
    public function delete(User $user, Discounts $section, Discount $item)
    {
        return true; // $item->id > 2;
    }
}

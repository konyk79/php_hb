<?php

namespace Admin\Policies;

use Admin\Http\Sections\PaymentSystemConfigs;
use App\User;
use App\PaymentSystemConfig as Config;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentSystemConfigsSectionModelPolicy
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
    public function before(User $user, $ability, PaymentSystemConfigs $section, Config $item)
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
    public function display(User $user, PaymentSystemConfigs $section, Config $item)
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
    public function edit(User $user, PaymentSystemConfigs $section, Config $item)
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
    public function create(User $user, PaymentSystemConfigs $section, Config $item)
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
    public function delete(User $user, PaymentSystemConfigs $section, Config $item)
    {
        return true; // $item->id > 2;
    }
}

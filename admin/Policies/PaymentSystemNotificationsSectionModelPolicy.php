<?php

namespace Admin\Policies;

use Admin\Http\Sections\PaymentSystemNotifications;
use App\User;
use App\PaymentSystemNotification;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentSystemNotificationsSectionModelPolicy
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
    public function before(User $user, $ability, PaymentSystemNotifications $section, PaymentSystemNotification $item)
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
    public function display(User $user, PaymentSystemNotifications $section, PaymentSystemNotification $item)
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
    public function edit(User $user, PaymentSystemNotifications $section, PaymentSystemNotification $item)
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
    public function create(User $user, PaymentSystemNotifications $section, PaymentSystemNotification $item)
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
    public function delete(User $user, PaymentSystemNotifications $section, PaymentSystemNotification $item)
    {
        return true; // $item->id > 2;
    }
}

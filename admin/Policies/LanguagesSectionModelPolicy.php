<?php

namespace Admin\Policies;

use Admin\Http\Sections\Languages;
use App\User;
use App\Language;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagesSectionModelPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @param Languages $section
     * @param Language $item
     *
     * @return bool
     */
    public function before(User $user, $ability, Languages $section, Language $item)
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
     * @param Languages $section
     * @param Language $item
     *
     * @return bool
     */
    public function display(User $user, Languages $section, Language $item)
    {
        return $user->isSuperAdmin();
    }

    /**
     * @param User $user
     * @param Languages $section
     * @param Language $item
     *
     * @return bool
     */
    public function edit(User $user, Languages $section, Language $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Languages $section
     * @param Language $item
     *
     * @return bool
     */
    public function create(User $user, Languages $section, Language $item)
    {
        return $item->id > 2;
    }
    /**
     * @param User $user
     * @param Languages $section
     * @param Language $item
     *
     * @return bool
     */
    public function delete(User $user, Languages $section, Language $item)
    {
        return true; // $item->id > 2;
    }
}

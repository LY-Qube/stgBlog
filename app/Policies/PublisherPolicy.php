<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublisherPolicy
{
    use HandlesAuthorization;

    /**
     * Only admin can block and unblock publisher
     * @param User $user
     * @return bool
     */
    public function update(User $user,User $publisher):bool
    {
        return $user->is_admin && !$publisher->is_admin;
    }

    /**
     * Admin do not have post
     * @param User $user
     * @param User $publisher
     * @return bool
     */
    public function view(User $user, User $publisher):bool
    {
        return !$publisher->is_admin;
    }
}

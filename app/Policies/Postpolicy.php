<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Postpolicy
{
    use HandlesAuthorization;


    /**
     * Only creator or admin can published or unpublished post.
     *
     * @param  \App\Models\User $user
     * @param Post $post
     * @return bool
     */
    public function published(User $user,Post $post): bool
    {
        return $user->is_admin || ($post->creator->id == $user->id);
    }

    /**
     * Only admin can approve post
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function approve(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Only publisher can create post
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    /**
     * Only creator or admin can update post
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function update(User $user, Post $post): bool
    {
        return $user->is_admin || ($post->creator->id == $user->id);
    }

    /**
     * Only admin can restore post.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Only creator or admin can  delete post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return bool
     */
    public function delete(User $user,Post $post): bool
    {
        return $user->is_admin || ($post->creator->id == $user->id);
    }
}

<?php

namespace App\Policies;

use App\{User, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     * El constructor se puede eliminar
     */
    public function __construct()
    {
        //
    }

    public function updatePost(User $user, Post $post)
    {
        return $user->owns($post);
    }

    public function deletePost(User $user, Post $post)
    {
        return $user->owns($post) && !$post->isPublished();
    }
}

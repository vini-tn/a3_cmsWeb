<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    //This function is to check the user status. If the user is admin, they are allowed to modify the post. Otherwise, only the user of the post can modify the post.
    public function modify(User $user, Post $post):bool{
        if ($user->isAdmin) {
            return true;
        }
        return $user->id === $post->user_id;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CardPolicy
{
    use HandlesAuthorization;

    // REMOVE
    public function show(User $user, Post $post)
    {
      // Only a post owner can see it
      return $user->id == $post->user_id;
    }

    // REMOVE
    public function list(User $user)
    {
      // Any user can list its own posts
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new post
      return Auth::check();
    }

    public function delete(User $user, Post $post)
    {
      // Only a post owner can delete it
      return $user->id == $post->user_id;
    }
}

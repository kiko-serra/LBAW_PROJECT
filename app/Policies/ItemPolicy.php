<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use App\Models\Item;

use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Item $item)
    {
      // User can only create items in posts they own
      return $user->id == $item->post->user_id;
    }

    public function update(User $user, Item $item)
    {
      // User can only update items in posts they own
      return $user->id == $item->post->user_id;
    }

    public function delete(User $user, Item $item)
    {
      // User can only delete items in posts they own
      return $user->id == $item->post->user_id;
    }
}

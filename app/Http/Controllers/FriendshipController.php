<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Friendship;

class FriendshipController extends Controller
{
    public function relationships($id) {
        $friendships1 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account2_id')->where('friendship.account1_id', $id)->get();
        $friendships2 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account1_id')->where('friendship.account2_id', $id)->get();
        $friendships = $friendships1->merge($friendships2);
        return $friendships;
    }
}

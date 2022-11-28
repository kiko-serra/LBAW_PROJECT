<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

use \App\Models\Friendship;
use App\Models\FriendRequest;
//use \App\Models\Notification;


class UserDataController extends Controller
{
    public function getdata(Request $request) {

        $friends = Friendship::where('account1_id', '=', Auth::user()->id_account)->get();
        $friend_requests = FriendRequest::where('id_receiver', '=', Auth::user()->id_account)->get();
        //$notifications = Notification::where('account1_id', '=', Auth::user()->id_account)->get();

        return response()->json([
            'friends' => $friends,
            'friend_requests' => $friend_requests
        ]);
    }
}

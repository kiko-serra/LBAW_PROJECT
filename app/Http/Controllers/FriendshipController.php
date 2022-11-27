<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;

use \App\Models\Friendship;
use App\Models\FriendRequest;


class FriendshipController extends Controller
{
    public function relationships($id) {
        $friendships1 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account2_id')->where('friendship.account1_id', $id)->get();
        $friendships2 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account1_id')->where('friendship.account2_id', $id)->get();
        $friendships = $friendships1->merge($friendships2);
        return $friendships;
    }

    public function accept(Request $request) {

    }

    public function decline(Request $request) {

    }

    public function create(Request $request) {
        if (!Auth::check()) return response(null, 401);
        $validator = Validator::make($request->all(), [ 
            'id' => 'integer|required'
        ]);

        if ($validator->fails()) {
            return response()->json(null, 400);
        }

        $sender = Auth::user()->id_account;
        $target = $request['id'];

        // check if they are already friends

        $friendships1 = \App\Models\Friendship::where('account1_id', $sender)->where('account2_id', $target)->get();
        $friendships2 = \App\Models\Friendship::where('account2_id', $sender)->where('account1_id', $target)->get();
        $friendships_count = count($friendships1) + count($friendships2);

        if ($friendships_count) return response("Already linked", 400);
        
        // check if a request has already been sent
        
        $friend_requests1 = \App\Models\FriendRequest::where('id_sender', $sender)->where('id_receiver', $target)->get();
        $friend_requests2 = \App\Models\FriendRequest::where('id_sender', $target)->where('id_receiver', $sender)->get();
        $friend_requests_count = count($friend_requests1) + count($friend_requests2);
        
        if ($friend_requests_count) {
            if (count($friend_requests2)) {
                $newFriendship = new Friendship();
                $newFriendship->account1_id = $sender;
                $newFriendship->account2_id = $target;
                \App\Models\FriendRequest::where('id_sender', $target)->where('id_receiver', $sender)->delete();
                $newFriendship->save();
                return response("Link complete", 200);
            } else return response("Request already sent", 400);
        }

        $friend_request = new FriendRequest();
        $friend_request->id_sender = Auth::user()->id_account;
        $friend_request->id_receiver = $request['id'];

        $friend_request->save();

        return response("Request sent", 200);
    }

    public function delete(Request $request) {

    } 
}

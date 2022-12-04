<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Validator;

use App\Models\Post;
use App\Models\User;

use App\Http\Requests\EndRegisterRequest;
use App\Http\Requests\UpdateUserRequest;


class UserProfileController extends Controller
{


    public function redirect($id) {
      $user = User::find($id);
      if (!$user) return "No user found";
      return redirect()->route('profile.tag', ["account_tag" => $user->account_tag]);
    }

    /**
     * Shows all posts.
     *
     * @return Response
     */
    public function show($account_tag)
    {
      if (!Auth::check()) return redirect('/login');
      //$this->authorize('list', Post::class); //TODO: discover what this is
      $user = User::where('account_tag', '=', $account_tag)->first();
      if (!$user) return "No user found";
      $posts = $user->posts()->orderByDesc('publication_date')->get();

      $friendships1 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account2_id')->where('friendship.account1_id', $user->id_account)->get();
      $friendships2 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account1_id')->where('friendship.account2_id', $user->id_account)->get();
      $friendships = $friendships1->merge($friendships2);

      $strangerFriendIDs = [];
      foreach ($friendships as $friend) {
        if ($friend->id_account != Auth::user()->id_account)
          array_push($strangerFriendIDs, $friend->id_account);
      }

      $friendships3 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account2_id')->where('friendship.account1_id', Auth::user()->id_account)->get();
      $friendships4 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account1_id')->where('friendship.account2_id', Auth::user()->id_account)->get();
      $userFriendships = $friendships3->merge($friendships4);
      
      $userFriendIDs = [];
      foreach ($userFriendships as $friend) {
        array_push($userFriendIDs, $friend->id_account);
      }
      $commonFriendships = \App\Models\User::find(array_intersect($strangerFriendIDs, $userFriendIDs));

      $linkStatus = "unlinked";

      $isFriend = !($user->friendships()->find(Auth::user()->id_account) === null);

      if (!$isFriend) {
        $friendships1 = \App\Models\FriendRequest::where('id_sender', Auth::user()->id_account)->where('id_receiver', $user->id_account)->get();
        $friendships2 = \App\Models\FriendRequest::where('id_sender', $user->id_account)->where('id_receiver', Auth::user()->id_account)->get();
        if (count($friendships1)) {
          $linkStatus = "pending";
        } else if (count($friendships2)) {
          $linkStatus = "received";
        }
        
      } else {
        $linkStatus = "linked";
      }

      return view('pages.userProfile', ['posts' => $posts, 'user' => $user, 'friendships' => $friendships, 'commonFriendships' => $commonFriendships, 'linkStatus' => $linkStatus]);
    }

    public function endRegister(EndRegisterRequest $request) {

      $validated = $request->validated();

      if ($request['name'] != null) {
        Auth::user()->name = $request['name'];
      }
      Auth::user()->is_private = !($request['privacy'] == "public");
      if ($request['pronouns'] != null) {
        Auth::user()->pronouns = $request['pronouns'];
      }
      if ($request['location'] != null) {
        Auth::user()->location = $request['location'];
      }
      if ($request['description'] != null) {
        Auth::user()->description = $request['description'];
      }

      Auth::user()->save();

      return redirect('/timeline');
  }

  public function edit(UpdateUserRequest $request) {
    $validated = $request->validated();

    $user = Auth::user();

    $user->name = $request['name'];

    $user->is_private = $request['privacy'] == "private";

    $user->pronouns = $request['pronouns'];

    $user->description = $request['description'];

    $user->save();

    return redirect('/user/' . Auth::user()->id_account);
  }


  public function search(Request $request) {
    if (!Auth::check()) return response(null, 401);

    $validator = Validator::make($request->all(), [ 
        'id' => 'integer|required',
        'text' => 'string|nullable|regex:/^[a-zA-Z][a-zA-Z0-9-]*$/'
    ]);


    if ($validator->fails()) {
      return response()->json("Something wrong happened", 400);
    }

    $id = $request['id'];
    $text = $request['text'];

    $friendships3 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account2_id')->where('friendship.account1_id', $id)->where('account.account_tag', 'ilike', $text . '%')->get();
    $friendships4 = \App\Models\User::join('friendship', 'account.id_account', '=', 'friendship.account1_id')->where('friendship.account2_id', $id)->where('account.account_tag', 'ilike', $text . '%')->get();
    $userFriendships = $friendships3->merge($friendships4);

    $friendshipViews = [];

    foreach ($userFriendships as $friend) {
      $friendshipViews[] = view('partials.rightPanel.friend', ['user' => $friend])->render();
    }

    return response()->json([
        'results' => $friendshipViews,
    ]);
  }
}

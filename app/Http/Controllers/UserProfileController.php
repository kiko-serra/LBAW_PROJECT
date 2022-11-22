<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
      $posts = $user->posts()->orderBy('publication_date')->get();

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

      $isFriend = !($user->friendships()->find(Auth::user()->id_account) === null);

      return view('pages.userProfile', ['posts' => $posts, 'user' => $user, 'friendships' => $friendships, 'commonFriendships' => $commonFriendships, 'isFriend' => $isFriend]);
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
}

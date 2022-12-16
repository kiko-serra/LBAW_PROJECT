<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Community;
use App\Models\Relationship;
use App\Models\User;
use App\Models\Post;

use Validator;

class CommunityController extends Controller
{
    /**
     * Shows the post for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $community = Community::find($id);
      if (!$community) return redirect(route('timeline'));
      //$this->authorize('show', $post); //TODO: show only if authenticated
      $posts = Post::where('group_id', '=', $id)->get()->sortByDesc('edited_date');
      
      $admins = User::join('relationship', 'relationship.id_account', '=', 'account.id_account')
                      ->where('relationship.id_community', '=', $id)
                      ->where('relationship.status', '=', 'admin')
                      ->get();

      $members = User::join('relationship', 'relationship.id_account', '=', 'account.id_account')
                      ->where('relationship.id_community', '=', $id)
                      ->where('relationship.status', '=', 'member')
                      ->get();
      
      $status = "visitor";

      if (Auth::check()) {
        $status = Relationship::where('id_account', '=', Auth::user()->id_account)
                                ->where('id_community', '=', $id)
                                ->first();
  
        if (!$status) {
          $status = "visitor";
        } else {
          $status = $status->status;
        }

      }
      

      $members = $admins->merge($members);

      return view('pages.group', ['posts' => $posts, 'members' => $members, 'group' => $community, 'status' => $status]);
    }

    /**
     * Creates a group.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request) {
      
      $validator = Validator::make($request->all(), [ 
        'groupname' => 'string|required|min:2|max:32|regex:/^[a-zA-Z][a-zA-Z0-9- ]+[a-zA-Z0-9]*$/',
        'groupdesc' => 'string|max:255|nullable',
      ]);

      if (!Auth::check()) return response(null, 401);

      if ($validator->fails()) {
        return back();
        // return response()->json("Something wrong happened", 400);
      }

      $group = new Community();

      $group->name = $request['groupname'];
      $group->description = $request['groupdesc'];
      if ($request['groupprivate'] === "on") {
        $group->is_public = false;
      }

      $group->is_public = true;

      if ($group->save()) {
        $new_admin = new Relationship();
        $new_admin->id_community = $group->id_community;
        $new_admin->id_account = Auth::user()->id_account;
        $new_admin->status = 'admin';
        $new_admin->save();
        return redirect(route('group.show', ['id' => $group->id_community]));
      }

      return back();
    }

    /**
     * Gets an user's friends so he can invite them.
     *
     * @param  int  $offset
     * @return Response
     */
    public function friendSuggestions($group, $offset) {
      if (!Auth::check()) return response("Not logged in", 401);
      $user =  Auth::user();

      $limit = 10;
      
      $friendships1 = User::join('friendship', 'account.id_account', '=', 'friendship.account2_id')
                            ->where('friendship.account1_id', $user->id_account)
                            ->get();
      $friendships2 = User::join('friendship', 'account.id_account', '=', 'friendship.account1_id')
                            ->where('friendship.account2_id', $user->id_account)
                            ->get();
                            
      $friends = [];

      foreach($friendships1 as $friend) {
        $membershipCheck = User::join('relationship', 'relationship.id_account', 'account.id_account')
                            ->where('relationship.id_community', '=', $group)
                            ->where('account.id_account', '=', $friend->id_account)
                            ->exists();
        if (!$membershipCheck)
          array_push($friends, $friend);
      }

      foreach($friendships2 as $friend) {
        $membershipCheck = User::join('relationship', 'relationship.id_account', 'account.id_account')
                            ->where('relationship.id_community', '=', $group)
                            ->where('account.id_account', '=', $friend->id_account)
                            ->exists();
        if (!$membershipCheck)
          array_push($friends, $friend);
      }

      $friends = array_splice($friends, $offset, $limit);
      $friendsViews = [];



      foreach ($friends as $friend) {
          $friendsViews[] = view('partials.inviteUser')->render();
      }
      

      return response()->json([
        'results' => $friendsViews,
      ]);
    }


    public function leave(Request $request) {
      return $request;
    }
}

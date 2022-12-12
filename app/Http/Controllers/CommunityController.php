<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Community;
use App\Models\Relationship;

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
      $post = Community::find($id);
      //$this->authorize('show', $post); //TODO: show only if authenticated
      return view('pages.group', ['posts' => []]);
    }

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
}

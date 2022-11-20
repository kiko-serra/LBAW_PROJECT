<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;

use App\Http\Requests\EndRegisterRequest;

class UserProfileController extends Controller
{
    /**
     * Shows all posts.
     *
     * @return Response
     */
    public function show($id)
    {
      if (!Auth::check()) return redirect('/login');
      //$this->authorize('list', Post::class); //TODO: discover what this is
      $user = User::find($id);
      $posts = $user->posts()->orderBy('edited_date')->get();
      return view('pages.userProfile', ['posts' => $posts, 'user' => $user]);
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
}

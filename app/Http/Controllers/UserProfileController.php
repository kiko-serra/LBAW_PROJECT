<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;

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
}

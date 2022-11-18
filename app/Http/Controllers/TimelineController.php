<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;

class TimelineController extends Controller
{
    /**
     * Shows all posts.
     *
     * @return Response
     */
    public function list()
    {
      if (!Auth::check()) return redirect('/login');
      $this->authorize('list', Post::class);
      $posts = Post::all()->sortBy('edited_date'); //TODO: Show interesting posts
      return view('pages.timeline', ['posts' => $posts]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Relationship;


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
      $posts = User::join('post', 'account.id_account', '=', 'post.owner_id')->get(['post.*', 'account.name', 'account.account_tag'])->sortByDesc('edited_date'); //TODO: Show interesting posts

      $groups = Relationship::join('community', 'community.id_community', '=', 'relationship.id_community')
                              ->where('id_account', '=', Auth::user()->id_account)
                              ->get();


      return view('pages.timeline', ['posts' => $posts, 'groups' => $groups]);
    }
}

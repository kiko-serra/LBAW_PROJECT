<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\User;

use App\Http\Requests\EndRegisterRequest;

class SearchController extends Controller
{
    public function show_user(Request $search_string)
    {
      /*

      $posts = $user->posts()->orderBy('edited_date')->join('account', 'account.id_account', '=', 'post.owner_id')->get();
      return view('pages.userProfile', ['posts' => $posts, 'user' => $user]);
      */
      if (!Auth::check()) return redirect('/login');
      $stag = $search_string['account_tag'];
      if(strlen($stag) !=0) {
        $accounts = User::where('account_tag', 'ILIKE', '%'.$stag.'%')->get();
        return view('pages.search', ['accounts' => $accounts]);
      } 
      else return view('pages.search', ['accounts' => []]);
    }
}

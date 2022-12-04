<?php
/*
| Web Routes - web routes for your app
*/
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// ----------------Home--------------------
Route::get('/home',  function(){
    return view('pages.home');
})->name('home');

Route::get('/', function() {
    return redirect()->route('home');
});

// ----------------Timeline--------------------
Route::get('/timeline', 'TimelineController@list')->name('timeline');

// ----------------User Profile--------------------
Route::get('/user/{id}', 'UserProfileController@redirect')->where('id', '[0-9]+')->name('profile');
Route::get('/user/{account_tag}', 'UserProfileController@show')->name('profile.tag');
Route::post('endregistration', 'UserProfileController@endRegister')->name('endregister');
Route::post('/user/{id}', 'UserProfileController@edit')->name('profile.edit');
Route::post('api/user/search', 'UserProfileController@search')->name('profile.search');

// Search  
Route::get('/user_search', 'SearchController@show_user');
Route::get('/post_content_search', 'SearchController@show_posts');

// Posts
Route::get('posts', 'PostController@list');
Route::get('posts/{post_id}', 'PostController@show');
Route::post('post/new', 'PostController@create')->name('newpost');

// API
Route::put('posts', 'PostController@create');
Route::delete('posts/{post_id}', 'PostController@delete');

// -- Friendships
Route::get('friendships/{user_id}', 'FriendshipController@relationships');
Route::post('api/friendship', 'FriendshipController@create')->name('friendship.new');
Route::put('api/friendship', 'FriendshipController@cancel')->name('friendship.cancel');
Route::delete('api/friendship', 'FriendshipController@delete')->name('friendship.remove');
Route::put('api/friendship/request', 'FriendshipController@accept')->name('friendship.accept');
Route::delete('api/friendship/request', 'FriendshipController@decline')->name('friendship.decline');

// -- Notifications
Route::post('api/notification', 'UserDataController@readNotification')->name('notification.read');
Route::delete('api/notification', 'UserDataController@deleteNotification')->name('notification.delete');


// -- Leftpanel
Route::get('api/leftpanel', 'UserDataController@getData')->name('leftpanel.get');
Route::get('api/leftpanel/notifications/{offset}', 'UserDataController@getMoreNotifications')->name('leftpanel.notifications');
Route::get('api/leftpanel/friendship-request/{offset}', 'UserDataController@getMoreLinkRequests')->name('leftpanel.link-requests');

// ----------------Authentication--------------------
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('endregistration', function() {
    return view('pages.registerExtra');
})->name('endregister.show');

//User
//Route::get('user/{accountTag}', 'User\UserController')->name('userPage');

//------------------Admin-------------------
Route::middleware('admin')->group(function () {
    Route::get('/users', 'AdminController@index')->name('admin.show');
    Route::get('/users/create', 'AdminController@create')->name('admin.create');
    Route::get('users/{id}', 'AdminController@edit')->name('admin.edit');
});



/**
 * 
 * DEBUG ROUTES, should be deleted afterwards.
 * 
*/


Route::get('debug/users', function() {
    foreach (\App\Models\User::all() as $user) {
        echo $user->id . " " . $user->name . "<br>";
    }
    dump(\App\Models\User::get());
});

Route::get('debug/posts', function() {
    foreach (\App\Models\Post::all() as $post) {
        echo $post->id_post . " " . $post->description . "<br>";
    }
    dump(\App\Models\Post::get());
});

/** A user's posts */
Route::get('debug/user/{id}/posts', function($id) {
    foreach (\App\Models\User::find($id)->posts()->get() as $post) {
        echo $post->id_post . " " . $post->description . "<br>";
    }
    dump(\App\Models\User::find($id)->posts()->get());
});

/** A user's specific post */
Route::get('debug/user/{user_id}/posts/{post_id}', function($user_id, $post_id) {
    $post = \App\Models\User::find($user_id)->posts()->find($post_id);
    echo $post->id_post . " " . $post->description . "<br>";
    dump($post);
});

Route::get('debug/friendships/{id}', function($id) {
    return \App\Models\Friendship::where('account1_id', $id)->orWhere('account2_id', $id)->get();
});

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
Route::get('posts/{post_id}', 'PostController@show')->where('post_id', '[0-9]+');
Route::post('post/new', 'PostController@create')->name('newpost');

// Groups

Route::get('group/{id}', 'CommunityController@show')->where('id', '[0-9]+')->name('group.show');
Route::post('group', 'CommunityController@create')->name('group.create');
Route::delete('api/group', 'CommunityController@kick')->name('group.kick');
Route::post('group/edit', 'CommunityController@edit')->name('group.edit');
Route::post('group/leave', 'CommunityController@leave')->name('group.leave');
Route::post('api/group/invite', 'CommunityController@invite')->name('group.invite');
Route::put('api/group/invite', 'CommunityController@accept')->name('group.accept');
Route::delete('api/group/invite', 'CommunityController@decline')->name('group.decline');
Route::post('api/group/friends/search/', 'CommunityController@friendSuggestions')->name('group.friendSuggestions');
Route::post('api/group/members/search/', 'CommunityController@searchMember')->name('group.searchMember');

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
Route::post('api/leftpanel/links', 'UserDataController@searchLinks')->name('leftpanel.search-links');
Route::get('api/leftpanel/friendship-request/{offset}', 'UserDataController@getMoreLinkRequests')->name('leftpanel.link-requests');
Route::get('api/leftpanel/groups/{offset}', 'UserDataController@getMoreGroups')->name('leftpanel.groups');

// ----------------Authentication--------------------
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('recover', 'Auth\LoginController@recoveryShow')->name('recovery');
Route::post('recover', 'Auth\LoginController@recovery');
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
    Route::get('users/block/{id_user}', 'AdminController@block')->name('admin.block');
    Route::get('users/unblock/{id_user}', 'AdminController@unblock')->name('admin.unblock');
});



/**
 * 
 * DEBUG ROUTES, should be deleted afterwards.
 * 
*/


Route::get('debug/users', function() {
    $mailData = [
        'account_tag' => 'User Name',
        'recovery_code' => 'code1324131',
        'email' => 'up202006767@g.uporto.pt', // Change to your email for testing.
    ];

    Mail::to($mailData['email'])->send(new App\Mail\PasswordRecovery($mailData));

    return $mailData;
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

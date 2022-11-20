<?php
/*
| Web Routes - web routes for your app
*/

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
Route::get('/user/{id}', 'UserProfileController@show')->name('profile');
Route::post('endregistration', 'UserProfileController@endRegister');


// Posts
Route::get('posts', 'PostController@list');
Route::get('posts/{id}', 'PostController@show');
Route::post('post/new', 'PostController@create')->name('newpost');

// API
Route::put('api/posts', 'PostController@create');
Route::delete('api/posts/{card_id}', 'PostController@delete');
Route::put('api/posts/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// ----------------Authentication--------------------
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::get('endregistration', function() {
    return view('pages.registerExtra');
})->name('endregister');

//User
//Route::get('user/{accountTag}', 'User\UserController')->name('userPage');


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
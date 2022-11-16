<?php

/*
|--------------------------------------------------------------------------
| Web Routes - web routes for your app
|--------------------------------------------------------------------------
*/

// Home
Route::get('/home',  function(){
    return view('home.home');
})->name('home');

Route::get('/', function() {
    return redirect()->route('home');
});

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

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
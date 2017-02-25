<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthenticateController;

Route::get('/', function () {
    $name = 'Toshko';
    return view('welcome', compact('name'));
});

//Route::get('login', function() {
//    return 'MADAFAKAAA';
//});



Route::group(['prefix' => 'api'], function() {
    //Authenticate User
    Route::post('auth', 'AuthenticateController@authenticate');
    Route::post('posts', 'PostController@store')->middleware('jwt.auth'); //jwt.refresh
    Route::get('posts', 'PostController@index');
    Route::resource('users', 'UserController');
    //Route::resource('posts', 'PostController');
});
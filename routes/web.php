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


Route::group(['prefix' => 'api'], function() {
    //Register User
    Route::post('user', 'UserController@store');
    //Authenticate User
    Route::post('auth', 'AuthenticateController@authenticate');
    //Create Post
    Route::post('posts', 'PostController@store')->middleware('jwt.auth'); //jwt.refresh
    //List Posts
    Route::get('posts', 'PostController@index');
    //Create Comment
    Route::post('posts/{postId}/comments', 'CommentController@store')->middleware('jwt.auth');

});
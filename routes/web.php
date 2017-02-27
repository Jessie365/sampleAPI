<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'api'], function() {
    //Register User
    Route::post('users', 'UserController@store');
    //Authenticate User
    Route::post('auth', 'AuthenticateController@authenticate');
    //Create Post
    Route::post('posts', 'PostController@store')->middleware('jwt.auth'); //jwt.refresh
    //List Posts
    Route::get('posts', 'PostController@index');
    //Create Comment
    Route::post('posts/{postId}/comments', 'CommentController@store')->middleware('jwt.auth');

});
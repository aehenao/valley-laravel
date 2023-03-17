<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Post
Route::post('/post/create', 'ApiController@createPost');
Route::get('/post/all', 'ApiController@getPosts');

//Comment
Route::post('/comment/create', 'ApiController@createComment');
Route::post('/comment/delete', 'ApiController@deleteComment');

//User
Route::get('/user/{user_id}', 'ApiController@getUserData');

Route::middleware('auth:api')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});



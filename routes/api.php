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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//接口路径
Route::group(['namespace' => 'Api'], function () {
    Route::post('login_test', 'UserController@login');
    Route::post('files/upload', 'FileController@upload');
});


// TODO auth:api  暂时去掉auth
Route::middleware('api')->get('/topics', 'TopicsController@index');

//问题是否被关注 将当前用户用api处理
Route::middleware('auth:api')->post('/question/follower', 'QuestionFollowController@follower');
//用户关注问题
Route::middleware('auth:api')->post('/question/follow', 'QuestionFollowController@followThisQuestion');

//用户关注关系
Route::post('user/followers', 'FollowersController@index')->middleware('auth:api');
Route::post('user/follow', 'FollowersController@follow')->middleware('auth:api');
Route::post('user/followers_count', 'FollowersController@followersCount');


//用户的点赞
Route::post('answer/{id}/votes/users', 'VotesController@users')->middleware('auth:api');
Route::post('answer/vote', 'VotesController@vote')->middleware('auth:api');

//用户私信
Route::post('letter/store', 'LettersController@store')->middleware('auth:api');

//用户评论关系
Route::get('answer/{id}/comments', 'CommentsController@answer')->middleware('auth:api');
Route::get('question/{id}/comments', 'CommentsController@question')->middleware('auth:api');

Route::post('comment', 'CommentsController@store')->middleware('auth:api');
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


// 问题是否被关注 将当前用户用api处理
//Route::post('/question/follower', function (Request $request) {
//    $user = Auth::guard('api')->user(); //api校验用户对象信息
////    $followed = App\Model\UserQuestion::where('question_id', $request->get('question'))
////        ->where('user_id', $request->get('user'))
////        ->count();
//    if ($followed) {
//        return response()->json(['followed' => true]);
//    }
//    return response()->json(['followed' => false]);
//
//})->middleware('auth:api');
//
//
////用户关注问题  TODO 待优化
//Route::post('/question/follow', function (Request $request) {
//    $user = Auth::guard('api')->user(); //api校验用户信息
//
//    $followed = App\Model\UserQuestion::where('question_id', $request->get('question'))
//        ->where('user_id', $request->get('user'))
//        ->first();
//    if ($followed !== null) {
//        $followed->delete();
//        return response()->json(['followed' => false]);
//    }
//    App\Model\UserQuestion::create([
//        'question_id' => $request->get('question'),
//        'user_id' => $request->get('user'),
//    ]);
//
//    return response()->json(['followed' => true]);
//})->middleware('auth:api');

//用户关注关系
Route::post('user/followers', 'FollowersController@index')->middleware('auth:api');
Route::post('user/follow', 'FollowersController@follow')->middleware('auth:api');
Route::post('user/followers_count', 'FollowersController@followersCount');


//用户的点赞
Route::post('answer/{id}/votes/users', 'VotesController@users')->middleware('auth:api');
Route::post('answer/vote', 'VotesController@vote')->middleware('auth:api');
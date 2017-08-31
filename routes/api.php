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

Route::group(['namespace' => 'Api'], function () {
    Route::post('/login_test', 'UserController@login');
});



// TODO auth:api  暂时去掉auth
Route::middleware('api')->get('/topics', 'TopicsController@index');

//Route::middleware('auth:api')->post('/question/follower', 'QuestionFollowController@follower');
//Route::middleware('auth:api')->post('/question/follow', 'QuestionFollowController@followThisQuestion');

Route::post('/question/follower', function (Request $request) {
    $followed = \App\UserQuestion::where('question_id', $request->get('question'))
        ->where('user_id', $request->get('user'))
        ->count();

    if ($followed) {
        return response()->json(['followed' => true]);
    }

    return response()->json(['followed' => false]);

})->middleware('api');


Route::post('/question/follow', function (Request $request) {
    $followed = \App\UserQuestion::where('question_id', $request->get('question'))
        ->where('user_id', $request->get('user'))
        ->first();

    if ($followed !== null) {
        $followed->delete();
        return response()->json(['followed' => false]);
    }

    \App\UserQuestion::create([
        'question_id' => $request->get('question'),
        'user_id' => $request->get('user'),
    ]);

    return response()->json(['followed' => true]);

})->middleware('api');


Route::get('user/followers/{id}','FollowController@index');
Route::post('user/follow','FollowController@follow');
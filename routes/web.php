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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'QuestionsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('email/verify/{token}', ['as' => 'email.verify', 'uses' => 'EmailController@verify']);

Route::post('questions/page_ajax', 'QuestionsController@pageAjax');//分页
Route::resource('questions', 'QuestionsController', ['names' => [
    'create' => 'question.create',
    'show' => 'question.show'
]]);

Route::post('questions/{question_id}/answer', 'AnswersController@store');


//日志管理
Route::get('log_bug', 'LogController@logBug'); //BUG 更新日志记录
Route::get('log_logic', 'LogController@logBusinessLogic'); //业务逻辑 更新日志记录
Route::get('log_ex_dev', 'LogController@logExtensionDevelopment'); //扩展开发 更新日志记录

//留言板操作
Route::get('messages', 'MessagesController@index');
Route::resource('messages', 'MessagesController', ['names' => [
    'create' => 'messages.create',
    'show' => 'messages.show'
]]);




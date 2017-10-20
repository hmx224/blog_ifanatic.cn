<?php

/*
|--------------------------------------------------------------------------
| Web Routes 前端路由
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'QuestionsController@index');
//Route::get('/captcha/{random}', 'CaptchaController@captcha');

//第三方登录 githubLogin
Route::get('github/login', 'ExtendLoginController@github');
Route::get('githubLogin', 'ExtendLoginController@githubLogin');
//验证码
Route::get('/captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {
    return $captcha->create($config);
});

Auth::routes();

//邮件发送
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
//用户信息
Route::get('users/info', 'UserController@info');
Route::get('users/change_avatar_form', ['as' => 'users.change_avatar_form', 'uses' => 'UserController@changeAvatarForm']);
Route::get('users/change_password_form', ['as' => 'users.change_password_form', 'uses' => 'UserController@changePasswordForm']);

Route::post('users/{user_id}', 'UserController@update');
Route::post('users/change_avatar/{id}', 'UserController@changeAvatar');
Route::resource('users', 'UserController');

//消息管理
Route::get('notifications', 'NotificationsController@index');

require_once(__DIR__ . '/admin.php');



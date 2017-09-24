<?php
/*
|--------------------------------------------------------------------------
| Admin Routes 后端路由
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    //用户管理
    Route::get('/', 'AdminController@index');
    Route::get('login', ['as' => 'login.form', 'uses' => 'AdminController@loginForm']);
    Route::post('login', 'AdminController@login');
    Route::get('/captcha/{config?}', function (\Mews\Captcha\Captcha $captcha, $config = 'default') {
        return $captcha->create($config);
    });

    //文章管理
    Route::get('questions/index', 'QuestionsController@index');
    Route::get('questions/list', 'QuestionsController@list');
    Route::resource('questions', 'QuestionsController');
});
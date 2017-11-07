<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test',"BaseController@isLogin");

// 用户路由
Route::group(['prefix' => 'api/user'], function () {
    Route::get('signup',"UserController@signup");
    Route::get('login',"UserController@login");
    Route::get('logout',"UserController@logout");
    // 个人详情路由
    Route::get('detail/home',"UserController@detailHome");
    Route::get('detail/activity',"UserController@detailActivity");

    // 修改个人信息操作
    Route::get('modify/message',"UserController@modifyMessage");
    Route::get('modify/password',"UserController@modifyPassword");



});

// 管理员路由 （未完成）
Route::group(['prefix' => 'api/admin'], function () {
    Route::get('login',"AdminController@login");
    Route::get('logout',"AdminController@logout");
    Route::get('check',"AdminController@check");
});

// 活动路由
Route::group(['prefix' => 'api/activity'], function () {
    Route::get('add',"ActivityController@add");
    Route::get('update',"ActivityController@update");
    Route::get('read',"ActivityController@read");
    Route::get('remove',"ActivityController@remove");
});
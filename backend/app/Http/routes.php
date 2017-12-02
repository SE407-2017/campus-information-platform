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

Route::get('api/isLogin',"BaseController@isLogin");

// 用户路由
Route::group(['prefix' => 'api/user'], function () {
    Route::post('signup',"UserController@signup");
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
    Route::get('singup',"AdminController@signup");
    Route::get('login',"AdminController@login");
    Route::get('logout',"AdminController@logout");
    Route::get('hide',"AdminController@hide");
    Route::get('modifypassword',"AdminController@modifyPassword");
});

// 活动路由
Route::group(['prefix' => 'api/activity'], function () {
    Route::post('add',"ActivityController@add");
    Route::get('update',"ActivityController@update");
    Route::get('read',"ActivityController@read");
    Route::get('remove',"ActivityController@remove");
});

// 评论路由
Route::group(['prefix' => 'api/comment'], function () {
    Route::get('add',"CommentController@add");
    Route::get('read',"CommentController@read");
});

// 报名路由
Route::group(['prefix' => 'api/apply'], function () {
    Route::get('add',"ApplyController@add");
    Route::get('cancel',"ApplyController@cancel");
    // 查询状态
    Route::get('inquire',"ApplyController@inquire");
});

Route::get('send/email', function(){

     $name = '学院君';
     $flag = Mail::send('emails.reminder',['name'=>"tang"],function($message){
            $to = '1074461480@qq.com';
            $message ->to($to)->subject('测试邮件');
        });
        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
});

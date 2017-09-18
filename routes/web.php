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

Route::get('/', function () {
    return view('welcome');
});
//                       后台管理系统
//登录->验证码->逻辑处理->首页->管理员->添加管理员->管理员列表->修改密码->验证密码->退出登录->修改
Route::get('admin/login','Admin\LoginController@login');
Route::get('admin/captcha','Admin\LoginController@captcha');
Route::post('admin/dologin','Admin\LoginController@doLogin');
//中间件
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'Login'],function(){
    Route::get('index','IndexController@index');
    Route::get('amend','IndexController@amend');
    Route::post('doamend','IndexController@doAmend');
    Route::get('logout','IndexController@logout');
    //资源
    Route::resource('admin','AdminController');




});



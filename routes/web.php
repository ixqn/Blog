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
//后台登录
Route::get('admin/login','Admin\LoginController@login');
//验证码
Route::get('admin/captcha','Admin\LoginController@captcha');
//登录验证路由
Route::post('admin/dologin','Admin\LoginController@doLogin');
//中间件
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'login'],function(){
//后台首页
    Route::get('index','IndexController@index');
});

//密码
Route::get('crypt','Admin\LoginController@crypt');
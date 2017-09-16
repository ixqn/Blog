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




Route::get('/sign_in', 'home\signController@signIn');
Route::get('/sign_up', 'home\signController@signUp');
// 通过手机找回密码
Route::get('/mobile_reset', 'home\signController@mobile_reset');
// 通过邮箱找回密码
Route::get('/email_reset', 'home\signController@email_reset');
Route::post('/doSignIn', 'home\signController@doSignIn');
Route::post('/doSignUp', 'home\signController@doSignUp');


// 获取图片验证码
Route::get('/code', 'home\verifyController@code');
// 发送短信
// Route::get('/send_tel_code', 'home\verifyController@send_tel_code');
Route::post('/send_tel_code', 'home\verifyController@send_tel_code');

// 验证手机是否已经注册过
// Route::get('/is_telReg', 'home\verifyController@is_telReg');
Route::post('/is_telReg', 'home\verifyController@is_telReg');
// 查询验证码(图片和手机验证码)是否正确
Route::post('/is_codeRight', 'home\verifyController@is_codeRight');

// signController的测试路由
Route::get('/test', 'home\signController@test');


// 验证邮箱是否存在或激活
Route::get('/is_emailActive', 'home\sendMailController@is_emailActive');



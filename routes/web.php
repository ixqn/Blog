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
Route::get('/code', 'home\signController@code');
Route::post('/doSignIn', 'home\signController@doSignIn');
Route::post('/doSignUp', 'home\signController@doSignUp');

// 发送短信
// Route::get('/sms', 'home\signController@sms');
Route::post('/sms', 'home\signController@sms');
// 通过手机找回密码
Route::get('/mobile_reset', 'home\signController@mobile_reset');
// 通过邮箱找回密码
Route::get('/email_reset', 'home\signController@email_reset');
Route::get('/tel', 'home\signController@existTel');
Route::post('/tel', 'home\signController@existTel');



Route::get('/mailVerify', 'home\sendMailController@mailVerify');



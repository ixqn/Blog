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
//
//});

//前台
//Route::get('/home/content' , function(){
//    return view('home/content');
//});

//文章内容
Route::get('home/content/{id}' , 'Home\ContentController@content');

//文章收藏
Route::get('home/conllect' , 'Home\ConllectController@conllect');
Route::get('home/conllect/insert/{id}' , 'Home\ConllectController@insert');
Route::get('home/conllect/delete/{id}' , 'Home\ConllectController@delete');
//Route::get('home/userarticle/{id}' , 'Home\UserarticleController@userarticle');


//关注
Route::get('home/attention' , 'Home\AttentionController@attention');
Route::get('home/attention/insert/{id}' , 'Home\AttentionController@insert');
Route::get('home/attention/delete/{id}' , 'Home\AttentionController@delete');
Route::get('home/userarticle/{id}' , 'Home\UserarticleController@userarticle');

//站内信息管理
Route::get('home/messages' , 'Home\MessagesController@messages');
//Route::get('home/messages', 'Home\MessagesController@delete');

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

// 显示主页.
 Route::get('/', 'Home\IndexController@index');

// 前台文章模块.
// 文章添加.
Route::get('/writer', 'Home\ArticleController@writer');
// 文件上传.
Route::post('/home/upload', 'Home\UploadController@upload');
// 执行添加.
Route::post('/home/article/dowriter', 'Home\ArticleController@dowriter');
// 文章删除.
Route::post('/home/article/delete/{id}', 'Home\ArticleController@delete');
// 编辑更新.
Route::post('/home/article/doedit/{id}', 'Home\ArticleController@doedit');
// 文章发布.
Route::post('/home/article/print/{id}', 'Home\ArticleController@print');
// 取消发布.
Route::post('/home/article/noprint/{id}', 'Home\ArticleController@noprint');

// 文章详情.
Route::get('/p/{id}', 'Home\ArtlistController@index');

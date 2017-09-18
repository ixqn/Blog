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
//});

//文章列表
Route::get('admin/article','Admin\ArticleController@index');
//文章内容单页
Route::get('admin/article/cont/{id}','Admin\ArticleController@cont');
//显示文章
Route::post('admin/article/show/{id}','Admin\ArticleController@show');
//删除文章




//分类管理模块
Route::resource('admin/category','Admin\CategoryController');
//分类排序字段
Route::post('admin/category/changeorder','Admin\CategoryController@changeOrder');



//举报文章
Route::get('admin/inf/article','Admin\InfController@index');
//举报文章处理
Route::post('admin/inf/dis/{id}','Admin\InfController@dis');




//举报评论
Route::get('admin/inf/comment','Admin\InfController@show');
Route::post('admin/inf/discom/{id}','Admin\InfController@discom');





























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



// 主页.
Route::get('/', function () {
    return view('welcome');
});



// xqn
Route::get('/sign_in', 'home\signController@signIn');
Route::get('/sign_up', 'home\signController@signUp');
// 通过手机找回密码
Route::get('/mobile_reset', 'home\signController@mobile_reset');
// 通过邮箱找回密码
Route::get('/email_reset', 'home\signController@email_reset');
Route::post('/doSignIn', 'home\signController@doSignIn');
Route::post('/doSignUp', 'home\signController@doSignUp');
// 测试
// Route::get('/doSignUp', 'home\signController@doSignUp');
// 获取图片验证码
Route::get('/code', 'home\verifyController@code');
// 注册,发送手机验证码
Route::post('/sendRegCode', 'home\verifyController@sendRegCode');
// 重置密码,发送手机验证码
Route::post('/sendResetPasswordCode', 'home\verifyController@sendResetPasswordCode');
// 验证手机是否已经注册过
Route::get('/is_telReg', 'home\verifyController@is_telReg');
// Route::get('/test', 'home\verifyController@test');
Route::post('/is_telReg', 'home\verifyController@is_telReg');
// 查询验证码(图片和手机验证码)是否正确
Route::post('/is_codeRight', 'home\verifyController@is_codeRight');
// signController的测试路由
// Route::get('/test', 'home\signController@test');
// 验证邮箱是否存在或激活
// Route::get('/is_emailActive', 'home\verifyController@is_emailActive');
Route::post('/is_emailActive', 'home\verifyController@is_emailActive');

























// hy

//前台
//Route::get('/home/content' , function(){
//    return view('home/content');
//});


//文章收藏
Route::get('home/collect' , 'Home\ConllectController@collect');
Route::get('home/collect/insert/{id}' , 'Home\ConllectController@insert');
Route::get('home/collect/delete/{id}' , 'Home\ConllectController@delete');
//Route::get('home/userarticle/{id}' , 'Home\UserarticleController@userarticle');


//关注
Route::get('home/attention' , 'Home\AttentionController@attention');
Route::get('home/attention/insert/{id}' , 'Home\AttentionController@insert');
Route::get('home/attention/delete/{id}' , 'Home\AttentionController@delete');
Route::get('home/userarticle/{id}' , 'Home\UserarticleController@userarticle');

//站内信息管理
Route::get('home/messages' , 'Home\MessagesController@messages');
//Route::get('home/messages', 'Home\MessagesController@delete');







// wsy
// 后台管理系统
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
    Route::resource('users','UsersController');



// zhangyu
//文章列表
    Route::get('article','ArticleController@index');
//文章内容单页
    Route::get('article/cont/{id}','ArticleController@cont');
//显示文章
    Route::post('article/show/{id}','ArticleController@show');
//删除文章

//分类管理模块
    Route::resource('category','CategoryController');
//分类排序字段
    Route::post('category/changeorder','CategoryController@changeOrder');

//举报文章
    Route::get('inf/article','InfController@index');
//举报文章处理
    Route::post('inf/dis/{id}','InfController@dis');

//举报评论
    Route::get('inf/comment','InfController@show');
    Route::post('inf/discom/{id}','InfController@discom');


});







// hyt
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





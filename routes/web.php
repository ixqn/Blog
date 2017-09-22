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
// Route::get('/', function () {
//     return view('welcome');
// });



// xqn
// 注册页面
Route::get('/sign_in', 'Home\signController@signIn');
// 登录页面
Route::get('/sign_up', 'Home\signController@signUp');
Route::get('/sign_out', 'Home\signController@signOut');
// 通过手机找回密码
Route::get('/mobile_reset', 'Home\signController@mobile_reset');
// 通过邮箱找回密码
Route::get('/email_reset', 'Home\signController@email_reset');

Route::post('/doSignIn', 'Home\signController@doSignIn');
Route::post('/doSignUp', 'Home\signController@doSignUp');

Route::post('/resetPasswordByTel', 'Home\resetPasswordController@resetPasswordByTel');
Route::post('/resetPasswordByEmail', 'Home\resetPasswordController@resetPasswordByEmail');

// 

// 点击邮件链接修改密码的页码
Route::get('/password/{key}/{value}','Home\resetPasswordController@doRestpasswordByEmailView');
Route::post('/doRestpasswordByEmail','Home\resetPasswordController@doRestpasswordByEmail');
// 获取图片验证码
Route::get('/code', 'Home\verifyController@code');
// 注册,发送手机验证码
Route::post('/sendRegCode', 'Home\verifyController@sendRegCode');
// 重置密码,发送手机验证码
Route::post('/sendResetPasswordCode', 'Home\verifyController@sendResetPasswordCode');
// 验证手机是否已经注册过
Route::post('/is_telReg', 'Home\verifyController@is_telReg');
// 查询验证码(图片和手机验证码)是否正确
Route::post('/is_codeRight', 'Home\verifyController@is_codeRight');
// 验证邮箱是否存在或激活
Route::post('/is_emailActive', 'Home\verifyController@is_emailActive');



// 个人资料页面
//中间件
Route::group(['middleware'=>'HomeLogin'],function(){
    Route::get('/settings/profile', 'Home\userSettingController@index');
    // 保存个人资料
    Route::post('/save/profile', 'Home\userSettingController@save');
    // Route::get('/settings/test', 'Home\userSettingController@test');
});


// 发送激活邮箱的邮件
Route::post('/active/email', 'Home\activeEmailController@activeEmail');
// 测试
// Route::get('/active/email', 'Home\activeEmailController@activeEmail');
// 激活邮箱
Route::get('/active_email/{user_id}/{email}/{rand}/{value}', 'Home\activeEmailController@doActiveEmail');
Route::get('/test', 'Home\activeEmailController@test');






// hy

//前台
//Route::get('/Home/content' , function(){
//    return view('Home/content');
//});


//文章收藏


Route::get('home/collect' , 'Home\CollectController@collect');
Route::get('home/collect/insert/{id}' , 'Home\CollectController@insert');
Route::get('home/collect/delete/{id}' , 'Home\CollectController@delete');
//Route::get('home/userarticle/{id}' , 'Home\UserarticleController@userarticle');


//关注
Route::get('home/attention' , 'Home\AttentionController@attention');
Route::get('home/attention/insert/{id}' , 'Home\AttentionController@insert');
Route::get('home/attention/delete/{id}' , 'Home\AttentionController@delete');
Route::get('home/userarticle/{id}' , 'Home\UserarticleController@userarticle');

//站内信息管理
Route::get('home/messages' , 'Home\MessagesController@messages');
//Route::get('Home/messages', 'Home\MessagesController@delete');







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

    //zhangyu
    Route::get('article','ArticleController@index');
//文章内容单页
    Route::get('article/cont/{id}','ArticleController@cont');
//状态显示文章(删除)
    Route::post('article/show/{id}','ArticleController@show');


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





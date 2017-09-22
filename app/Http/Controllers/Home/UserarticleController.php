<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserarticleController extends Controller
{
    //关注作者文章显示页面
    public function userarticle($user_id)
    {



       //从数据库拿到作者的资料并显示在页面上
        $data = \DB::table('users_info')->where('user_id' , $user_id)->get();

        $res = \DB::table('article_users')->where('user_id' , $user_id)->get();

        return view ('home.userarticle' , ['data' => $data , 'res'=>$res , 'title'=>'用户主页']);

    }
}

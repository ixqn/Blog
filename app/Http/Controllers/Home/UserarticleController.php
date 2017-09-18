<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserarticleController extends Controller
{
    //关注作者文章显示页面
    public function userarticle(Request $request,$user_id)
    {


       //从数据库拿到作者的资料并显示在页面上
        $data = \DB::table('users_info')->where('user_id' , $user_id)->first();

           $str = $data -> user_id;
        $res = \DB::table('article_users')->where('user_id' , $str)->get();

//        $data = \DB::table('article_users')->where('user_id' , 1)->get();
//        dd($data);
        return view ('home.userarticle' , ['data' => $data , 'res'=>$res]);

    }
}

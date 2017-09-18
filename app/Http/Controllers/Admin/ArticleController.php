<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    //
//    文章列表页
    public function index()
    {

        $users = \DB::table('article_users')
            ->join('article_category', 'article_users.category_id', '=', 'article_category.cate_id')
            ->join('users_info', 'article_users.user_id', '=', 'users_info.id')
            ->orderBy('article_id','desc')
            ->get();

//        dd($users);
        return view('admin.article.article',['title'=>'文章列表','users'=>$users]);
    }

    //点击名称显示文章内容页面
    public function cont($id)
    {

        $datas = \DB::table('article_users')->where('article_id',$id)->get();
//        dd($datas);
        return view('admin.article.cont',['datas'=>$datas]);
    }


    //显示文章
    public function show($id)
    {
        $data = \DB::table('article_users')->where('article_id',$id)->get();
        foreach($data as $item)
        {
            if($item->article_status == 1)
            {

                $re = $data->update(['article_status'=>1]);

            }elseif($item->article_status == 2)
            {

                $re = $data->update(['article_status'=>2]);

            }

        }

    }


}

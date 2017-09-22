<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ArticleController extends Controller
{
    //
//    文章列表页
    public function index(Request $request)
    {

        $users = \DB::table('article_users')
            ->join('article_category', 'article_users.category_id', '=', 'article_category.cate_id')
            ->join('users_info', 'article_users.user_id', '=', 'users_info.id')
            ->where('article_name','like','%'.$request->input('keywords').'%')
            ->orderBy('article_id','desc')
            ->paginate(10);

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
            //发布
            if($item->article_status == 1)
            {

                $re = \DB::table('article_users')->where('article_id',$id)->update(['article_status'=>2]);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '发布成功'
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '发布失败'
                    ];
                }
                return $data;
//          //等待发布
            }elseif($item->article_status == 2)
            {

                $re = \DB::table('article_users')->where('article_id',$id)->update(['article_status'=>1]);
                if($re){
                    $data = [
                        'status' => 0,
                        'msg' => '取消成功'
                    ];
                }else{
                    $data = [
                        'status' => 1,
                        'msg' => '取消失败'
                    ];
                }
                return $data;
            }

        }

    }


}

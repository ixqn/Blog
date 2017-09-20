<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class collectController extends Controller
{
    //插入  inset数据
    public function insert(Request $request, $article_id)
    {

        //从数据库提取数据；

        $data = \DB::table('article_users')->where('article_id', $article_id)->first();

//                  dd($data);
        $articles_id = $data->article_id;
        $article_name = $data->article_name;
        $article_cont = $data->article_cont;
        $article_author = $data->article_author;
        $category_id = $data->category_id;
        $article_status = $data->article_status;
        $user_id = $data->user_id;

        $conl['article_id'] = $articles_id;
        $conl['article_name'] = $article_name;
        $conl['article_cont'] = $article_cont;
        $conl['article_author'] = $article_author;
        $conl['category_id'] = $category_id;
        $conl['article_status'] = $article_status;
        $conl['user_id'] = $user_id;
//        dd($conl);

        $res = \DB::table('article_collect')->where('article_id', $conl['article_id'])->first();

        if($res)
        {
            die('这片文章你已经收藏过了,再去看看其他的把');
        }else{
            $str = \DB::table('article_collect')->insert($conl);
            if ($str) {
                return redirect('/home/collect')->with(['info' => '添加收藏成功']);
            } else {
                return back()->with(['info' => '添加收藏失败']);
            }
        }
    }



    //collect显示在页面
    public
    function collect(Request $request)
    {

        $str = \DB::table('article_collect')->get();

        return view('home.collect', ['str' => $str , 'title'=>'文章收藏']);




    }

//取消收藏

    public function delete($article_id)
    {

        $res = \DB::table('article_users')->where('article_user' , $article_id)->delete();
        if($res){
            $data = [
                'msg'=>'取消收藏成功'
            ];
        }else{
            $data = [
                'msg'=>'取消收藏失败 '
            ];
        }
        return $data;
    }



}


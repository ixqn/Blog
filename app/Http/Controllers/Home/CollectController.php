<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class collectController extends Controller
{


    //插入  inset数据
    public function insert(Request $request,$article_id)
    {
      dd($Rquest);
        //从数据库提取数据；

        $data = \DB::table('article_users')->where('article_id', $article_id)->first();

        $articles_id = $data->article_id;
        $article_name = $data->article_name;
        $article_cont = $data->article_cont;
        $article_author = $data->article_author;
        $category_id = $data->category_id;
        $article_status = $data->article_status;
        $user_id = $data->user_id;
        $src = \DB::table('users_info')->where('user_id' , $user_id)->first();
        if($src)
        {
            $user_pic = $src->pic;

            $conl['article_id'] = $articles_id;
            $conl['article_name'] = $article_name;
            $conl['article_cont'] = $article_cont;
            $conl['article_author'] = $article_author;
            $conl['category_id'] = $category_id;
            $conl['article_status'] = $article_status;
            $conl['collect_user_id'] = $user_id;
            $conl['user_id'] = 1;
            $conl['user_pic'] = $user_pic;
        }else{
            $conl['article_id'] = $articles_id;
            $conl['article_name'] = $article_name;
            $conl['article_cont'] = $article_cont;
            $conl['article_author'] = $article_author;
            $conl['category_id'] = $category_id;
            $conl['article_status'] = $article_status;
            $conl['collect_user_id'] = $user_id;
            $conl['user_id'] = 1;
            $conl['user_pic'] = 'uploads/users/4.jpg';
        }

        $str = \DB::table('article_collect')->where('article_id', $conl['article_id'])->first();
        if ($str) {
            $data = [
                'state' => 2,
                'msg' => '你应经收藏过这篇文章了'
            ];
        } else {
            $res = \DB::table('article_collect')->insert($conl);
            if ($res) {
                $data = [
                    'state' => 0,
                    'msg' => '添加成收藏功'
                ];
            } else {
                $data = [
                    'state' => 1,
                    'msg' => '添加收藏失败'
                ];
            }
            return $data;
        }
    }

        //collect显示在页面
        public function collect(Request $request)
        {
            $str = \DB::table('article_collect')->where('user_id' , 1)->get();

//            $ptn = "/.*<img[^>]*src[=\s\"\']+([^\"\']*)[\"\'].*/";
//            foreach($str as $k => $v) {
//                $cont = $v->article_cont;
//                foreach ($v as $m => $n) {
//                    if (strstr($cont, 'uploads/articles')) {
//                        $str->article_img = preg_replace($ptn, "$1", $cont);
//                    } else {
//                        $str->article_img = 'images/home/nopic.png';
//                    }
//                }
//            }
               return view('home.collect', ['str' => $str , 'title'=>'文章收藏']);
        }



        //取消收藏
        public function delete($article_id)
        {
            $res = \DB::table('article_collect')->where('article_id' , $article_id)->delete();
            if($res){
                $data = [
                    'state'=>0,
                    'msg'=>'取消收藏成功'
                ];
            }else{
                $data = [
                    'state'=>1,
                    'msg'=>'取消收藏失败 '
                ];
            }
            return $data;
        }



}


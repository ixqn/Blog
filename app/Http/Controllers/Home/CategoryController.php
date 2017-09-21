<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //更多分类
    public function index()
    {
        //获取分类数据
        $cates = Cate::get();


        return view('home.cate',['title'=>'更多分类','cates'=>$cates]);
    }

// 人性化时间显示
    public function formatTime($time)
    {
        $rtime = date("m-d H:i",$time);
        $htime = date("H:i",$time);
        $time = time() - $time;
        if ($time < 60){
            $str = '刚刚';
        }elseif($time < 60 * 60){
            $min = floor($time/60);
            $str = $min.'分钟前';
        }elseif($time < 60 * 60 * 24){
            $h = floor($time/(60*60));
            $str = $h.'小时前 ';
        }elseif($time < 60 * 60 * 24 * 3){
            $d = floor($time/(60*60*24));
            if($d==1){
                $str = '昨天 '.$rtime;
            }else{
                $str = '前天 '.$rtime;
            }
        }else{
            $str = $rtime;
        }
        return $str;
    }

    //分类详情
    public function cateils($id)
    {
        //获取这条分类的信息
        $cate = Cate::find($id);
//        dd($cate);

        //获取这条分类下面的所有文章
        $datas = \DB::table('article_category')
                ->join('article_users','article_category.cate_id', '=', 'article_users.category_id')
                ->join('users_info','article_users.user_id','=', 'users_info.id')
                ->where('category_id',$id)
                ->get()
                ->toArray();
        $ptn = "/.*<img[^>]*src[=\s\"\']+([^\"\']*)[\"\'].*/";
        foreach($datas as $k => $v) {
            $cont = $v->article_cont;
            foreach($v as $m => $n){
                if(strstr($cont, 'uploads/articles')){
                    $v->article_img = preg_replace ( $ptn, "$1", $cont );
                }else{
                    $v->article_img = 'images/home/nopic.png';
                }
            }
            // 转换时间.
            $v->date = $this->formatTime(strtotime($v->article_at));
            // 去除html标签.
            $v->article_cont = strip_tags($v->article_cont);
            // 截取前50字符.
            $v->article_str = mb_substr($v->article_cont, 0, 100, 'utf-8').'...';

        }
//        dd($datas);

        return view('home.cateils',['title'=>'分类详情','cate'=>$cate,'datas'=>$datas]);
    }



}

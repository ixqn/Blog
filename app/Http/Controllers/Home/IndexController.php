<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Article;

class IndexController extends Controller
{
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

    // 显示主页
    public function index()
    {
        // 文章列表.
        $articles = Article::orderby('article_at', 'desc')->paginate(5);

        // 获取第一张图片作为封面.
        $ptn = "/.*<img[^>]*src[=\s\"\']+([^\"\']*)[\"\'].*/";
        foreach($articles as $k => $v) {
            foreach($v as $m => $n){
                $cont = $v['article_cont'];
                if(strstr($cont, 'uploads\articles')){
                    $articles[$k]['article_img'] = preg_replace ( $ptn, "$1", $cont );
                }else{
                    $articles[$k]['article_img'] = 'images/home/nopic.png';
                }
            }
            // 转换时间
            $articles[$k]['date'] = $this->formatTime(strtotime($v['article_at']));
            // 设置默认封面.
            $articles[$k]['article_cont'] = strip_tags($v['article_cont']);
            // 截取前50字符.
            $articles[$k]['article_str'] = mb_substr($v['article_cont'], 0, 100, 'utf-8').'...';
        }

        $title = '简单你的创作';
        return view('Home.index',compact('title', 'articles'));
    }

}
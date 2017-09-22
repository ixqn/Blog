@extends('home.layout')

@section('content')



<div class="container collection">
    <div class="row">
        <div class="col-xs-24 col-sm-16 main">
            <!-- 专题头部模块 -->
            <div class="main-top">
                <a class="avatar-collection" href="/c/8fQvXW">
                    <img src="{{ url('/uploads/category').'/'.$cate->cate_pic }}" alt="240" />
                </a>
                <div class="follow-button" props-data-following="false" props-data-collection-id="53">

                </div>
                <div class="title">
                    <a class="name" href="/c/8fQvXW">{{ $cate->cate_name }}</a>
                </div>
                <div class="info">
                    收录了27389篇文章
                </div>
            </div>
            <ul class="trigger-menu" data-pjax-container="#list-container">
                <li class="active">
                    <a href="#">
                        <i class="iconfont ic-articles">

                        </i> 最新收录
                    </a>
            </ul>
            <div id="list-container">
                <!-- 文章列表模块 -->
                <ul class="note-list" infinite-scroll-url="/c/8fQvXW?order_by=added_at">

                    @foreach($datas as $item)
                        <li id="note-17328135" data-note-id="17328135" class="have-img">
                            <a class="wrap-img" href="/p/7ac5f5b8e473" target="_blank">
                                <img data-echo="//upload-images.jianshu.io/upload_images/7929531-17d16ee03ecaab0b.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset( $item->article_img ) }}" alt="120" />
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="/u/6d171f5a123b">
                                        <img src="{{ asset($item->pic) }}" alt="64" />
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="/u/6d171f5a123b">{{ $item->article_author }}</a>
                                        <span class="time" data-shared-at="2017-09-20T20:02:36+08:00">{{ $item->date }}</span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="/p/7ac5f5b8e473">{{ $item->article_name }}</a>
                                <p class="abstract">
                                    {{ $item->article_str }}
                                </p>
                                <div class="meta">
                                    <a target="_blank" href="/p/7ac5f5b8e473">
                                        <i class="iconfont ic-list-read"></i> 44
                                    </a>        <a target="_blank" href="/p/7ac5f5b8e473#comments">
                                        <i class="iconfont ic-list-comments"></i> 1
                                    </a>      <span><i class="iconfont ic-list-like"></i> 2</span>
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </div>
        </div>
        <div class="col-xs-24 col-sm-7 col-sm-offset-1 aside">
            <p class="title">专题公告</p>
            <div class="description js-description">
                <p>{{ $cate->cate_title }}</p>

                <p>{{ $cate->cate_description }}</p>

                <p>历史须知：
                    <br />1、一部中国史,神秘而悠久；
                    <br />2、若从传说中的"盘古"."女娲"等神话时代算起,约有五千年；
                    <br />3、若从传说中的三皇(都城河南淮阳) 五帝 (都城河南新郑) 算起,
                    约有四千六百年.要从有史书记载的夏朝算起,约有四千二百多年; 要从中国
                    首次统一的中央集权制的秦朝算起,已经两千三百多年了...
                </p>

            </div>

            <div class="side-list"></div>
        </div>
    </div>
</div>


@stop


@section('js')

    <script>
        layui.use(['util'], function(){
            var util = layui.util,
                $ = layui.jquery;

            //固定块
            util.fixbar({
                css: {right: 50, bottom: 100}
                ,bgcolor: '#393D49'
                ,click: function(type){
                    if(type === 'bar1'){
                        layer.msg('icon是可以随便换的')
                    } else if(type === 'bar2') {
                        layer.msg('两个bar都可以设定是否开启')
                    }
                }
            });

        });
    </script>

@stop

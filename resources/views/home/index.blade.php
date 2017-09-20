@extends('home.layout')

@section('content')

    <div class="container index">
        <div class="row">

            <div class="layui-carousel" id="Carousel">
                <div carousel-item="">
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/1.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/2.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/3.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/4.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/5.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/6.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/7.png"></a></div>
                </div>
            </div>

            <div class="col-xs-16 main">
                <!--分类-->
                <div class="recommend-collection">
                    <a class="collection" target="_blank" href="/c/b3734232a706?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/1.png') }}" alt="64" />
                        <div class="name">微小说</div>
                    </a>            <a class="collection" target="_blank" href="/c/GQ5FAs?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/66ba9fdegw1e61syw6tk6j20bj0go0wo.jpg') }}" alt="64" />
                        <div class="name">谈谈情，说说爱</div>
                    </a>            <a class="collection" target="_blank" href="/c/074e475b2f45?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/vcg41678819337.jpg') }}" alt="64" />
                        <div class="name">成长励志</div>
                    </a>            <a class="collection" target="_blank" href="/c/f6b4ca4bb891?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/enhanced-buzz-wide-16461-1372163238-8.jpg') }}" alt="64" />
                        <div class="name">生活家</div>
                    </a>            <a class="collection" target="_blank" href="/c/Df7njb?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/2005503_162125081_2.jpg') }}" alt="64" />
                        <div class="name">谈写作</div>
                    </a>            <a class="collection" target="_blank" href="/c/bc2986022c08?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/0714.jpg') }}" alt="64" />
                        <div class="name">时差党</div>
                    </a>            <a class="collection" target="_blank" href="/c/8c92f845cd4d?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/漫画专题.jpg') }}" alt="64" />
                        <div class="name">漫画·手绘</div>
                    </a>
                    <a class="more-hot-collection" target="_blank" href="/recommendations/collections?utm_medium=index-collections&amp;utm_source=desktop">
                        更多热门专题 <i class="iconfont ic-link"></i>
                    </a>
                </div>
                <!--分类-->
                <div class="split-line"></div>
                <div id="list-container">
                    <!-- 文章列表模块 -->
                    <ul class="note-list" infinite-scroll-url="/">
                        @foreach($articles as $k=>$v)
                        <li id="note-17196189" data-note-id="17196189" class="have-img">
                            <a class="wrap-img" href="{{url('p')}}/{{$v->article_id}}" target="_blank">
                                <img class="img-blur-done" src="{{ asset($v->article_img) }}" alt="120">
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="{{url('u')}}/{{$v->user_id}}">
                                        <img src="//upload.jianshu.io/users/upload_avatars/2929044/aa13193f2600.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/64/h/64" alt="64">
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="{{url('u')}}/{{$v->user_id}}">{{ $v->article_author }}</a>
                                        <span class="time" data-shared-at="{{ $v->article_at }}">{{ $v->date }}</span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="{{url('p')}}/{{$v->article_id}}">{{ $v->article_name }}</a>
                                <p class="abstract">
                                    {{  $v->article_str }}
                                </p>
                                <div class="meta">
                                    <a class="collection-tag" target="_blank" href="{{url('c')}}/{{$v->category_id}}">{{ $v->article_cate }}</a>
                                    <a target="_blank" href="{{url('p')}}/{{$v->article_id}}">
                                        <i class="iconfont ic-list-read"></i> {{$v->article_view}}
                                    </a>        <a target="_blank" href="{{url('p')}}/{{$v->article_id}}#comments">
                                        <i class="iconfont ic-list-comments"></i> 21
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!-- 文章列表模块 -->
                </div>
                <div class="page_list">
                    {!! $articles->links() !!}
                </div>
            </div>
            <div class="col-xs-7 col-xs-offset-1 aside">
                <div class="board">
                    <a target="_blank" href="/recommendations/notes?category_id=56&amp;utm_medium=index-banner-s&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/banner-s-1-b8ff9ec59f72ea88ecc8c42956f41f78.png') }}" alt="Banner s 1" />
                    </a>        <a target="_blank" href="/trending/weekly?utm_medium=index-banner-s&amp;utm_source=desktop"><img src="{{ asset('home/images/picture/banner-s-3-7123fd94750759acf7eca05b871e9d17.png') }}" alt="Banner s 3" /></a>
                    <a target="_blank" href="/trending/monthly?utm_medium=index-banner-s&amp;utm_source=desktop"><img src="{{ asset('home/images/picture/banner-s-4-b70da70d679593510ac93a172dfbaeaa.png') }}" alt="Banner s 4" /></a>
                    <a utm_medium="index-banner-s" target="_blank" href="/publications"><img src="{{ asset('home/images/picture/banner-s-5-291e00e9156f30791fe24e3de9c39171.png') }}" alt="Banner s 5" /></a>
                    <a target="_blank" href="/c/e048f1a72e3d?utm_medium=index-banner-s&amp;utm_source=desktop"><img src="{{ asset('home/images/picture/banner-s-6-c4d6335bfd688f2ca1115b42b04c28a7.png') }}" alt="Banner s 6" /></a>
                </div>

                <!-- 推荐作者 -->
                <div class="recommended-authors">
                    <div class="title"><span>推荐作者</span>
                        <a class="page-change"><i class="iconfont ic-search-change" style="transform: rotate(0deg);"></i>
                            换一批
                        </a>
                    </div>
                    <ul class="list">
                        <li>
                            <a href="/u/78f970537a5e?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/7663825/7c28763e-002b-4e89-8dea-5b8da210ef2c.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/78f970537a5e?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">名贵的考拉熊</a>
                            <p>写了44.2k字 · 2.1k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/3aa040bf0610?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/1835826/fcfb7cdd47bd.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/3aa040bf0610?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">简书播客</a>
                            <p>写了73.1k字 · 4.6k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/c5580cc1c3f4?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/3627484/eb973bb9-37ba-4d07-acec-850c0a66d1bb.png?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/c5580cc1c3f4?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">简书大学堂</a>
                            <p>写了49.6k字 · 2.7k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/5SqsuF?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/6287/06c537002583.png?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/5SqsuF?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">刘淼</a>
                            <p>写了323.8k字 · 19.5k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/8f5b45499715?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/52841/b76eb3e77507.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/8f5b45499715?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">闫泽华</a>
                            <p>写了123.2k字 · 1k喜欢</p>
                        </li>
                    </ul>
                    <a href="/recommendations/users?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="find-more">
                        查看全部<i class="iconfont ic-link"></i></a></div>
            </div>
        </div>
    </div>

@stop


@section('js')

<script>
    layui.use(['util','carousel'], function(){
        var carousel = layui.carousel,
            util = layui.util,
            $ = layui.jquery;

        //图片轮播
        carousel.render({
            elem: '#Carousel'
            ,width: '99%'
            ,interval: 5000
        });

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

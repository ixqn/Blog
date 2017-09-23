@extends('home.layout')

@section('content')

    <div class="container index">
        <div class="row">

            <div class="layui-carousel" id="Carousel">
                <div carousel-item="">
                    @foreach($articles as $k=>$v)
                        <div><a title="{{ $v->article_name }}" target="_blank" href="{{url('p')}}/{{$v->article_id}}"><img style="width: 100%;height: 100%;" src="{{ asset($v->article_img) }}"></a></div>
                    @endforeach
                </div>
            </div>

            <div class="col-xs-16 main">
                <!--分类-->
                <div class="recommend-collection">

                    @foreach($cates as $item)
                    <a class="collection" target="_blank" href="{{url('c')}}/{{$item->cate_id}}">
                        <img src="{{ url('/uploads/category').'/'.$item->cate_pic  }}" alt="64" />
                        <div class="name">{{ $item->cate_name }}</div>
                    </a>
                    @endforeach
                    <a class="more-hot-collection" target="_blank" href="{{ url('category') }}">
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
                                        <img src="{{ asset($v->pic) }}" alt="64">
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
                                        <i class="iconfont ic-list-comments"></i> {{$v->comm}}
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
                <!-- 推荐作者 -->
                <div class="recommended-authors">
                    <div class="title"><span>新用户Top10</span>
                    </div>
                    <ul class="list">
                        @foreach($users as $k=>$v)
                        <li>
                            <a href="{{ url($v['user_id']) }}" target="_blank" class="avatar">
                                <img src="{{ asset($v['pic']) }}">
                            </a>
                            <a class="follow" state="0" onclick="insert({{ $v['user_id'] }})"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="{{ url($v['user_id']) }}" target="_blank" class="name">{{ $v['nickname'] }}</a>
                            <p>注册时间: {{$v['created_at']}}</p>
                            <b>个人描述: {{$v['desc']}}</b>
                        </li>
                            <br>
                        @endforeach
                    </ul>
                </div>
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
                    layer.msg('icon可以随便点击')
                } else if(type === 'bar2') {
                    layer.msg('两个bar都可以设定是否开启')
                }
            }
        });

        //添加关注
        window.insert = function(user_id)
        {
            layer.confirm('是否确定添加关注?', {
                btn: ['对对', '不行']
            }, function () {
                $.post('{{url('/home/attention/insert/')}}/' + user_id, {
                    '_token': '{{csrf_token()}}'
                }, function (data) {
                    if (data.state == 0) {
                        layer.msg(data.msg, {icon: 6});
                    } else if(data.state == 2){
                        layer.msg(data.msg, {icon: 0});
                    } else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            });

        }
    });
</script>

@stop
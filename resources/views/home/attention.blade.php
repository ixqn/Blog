@extends('home.layout')

@section('content')

       <style>
           .wang
           {
               width:470px;
               height:80px;
           }
       </style>

    <div class="container subscription">
        <div class="row"><div class="aside">
                <a data-toggle="dropdown" class="change-type">全部关注123<i class="iconfont ic-filter"></i></a>
                <ul class="dropdown-menu arrow-top"><li><a>全部关注</a></ul>
                <a href="#/recommendation" class="add-people"><i class="iconfont ic-addpeople"></i><span>添加关注</span></a>
                <ul class="js-subscription-list">
                    @foreach($data as $k=>$v)
                        <div>
                        <li class="wang" >
                            <a href="{{ url('/u') }}/{{ $v->attension_user_id }}" class="wrap">
                                <div class="avatar-collection">
                                    <img src="{{ asset($v->pic) }}">
                                </div>

                                <div class="name">{{ $v->nickname }}</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <span class="count">{{ $v->id }}</span>
                            </a>
                            {{--<a href="javascript:;" onclick="delHome({{$v->attension_user_id}})">取消关注</a></br></br>--}}
                            <div class="content">
                            <div class="meta">
                                <div>
                                <a class="cancel" style="color:#ccc;font-size:5px;" href="javascript:;" onclick="delHome({{ $v->attension_user_id }})">取消关注</a>
                                </div>
                                 {{--<a class="cancel" href="{{ url('/home/attention/delete') }}/{{ $v->attension_user_id }}">取消收藏</a>--}}
                            </div>
                            </div>
                        </li>
                        </div>
                    @endforeach
                    <li class=""></li>
                </ul>
            </div>
            <div class="col-xs-16 col-xs-offset-8 main"><div><ul class="note-list">

    @foreach($wz as $k=>$v)
        <li id="note-17196189" data-note-id="17196189" class="have-img">
            <a class="wrap-img" href="{{url('p')}}/{{$v->article_id}}" target="_blank">
            <img class="img-blur-done" src="{{$v->article_img}}" alt="120">
            </a>
            <div class="content">
                <div class="author">
                    <a class="avatar" target="_blank" href="">
                        <img src="{{ asset('./uploads/users/1.jpg') }}" alt="64">
                    </a>
                    <div class="name">
                        <a class="blue-link" target="_blank" href="{{ url('/u') }}/{{ $v->user_id }}">{{ $v->article_author }}</a>
                        {{--<span class="time" data-shared-at="{{ $v->article_at }}">{{ $v->article_at }}</span>--}}
                    </div>
                </div>
                <a class="title" target="_blank" href="{{ url('/p') }}/{{ $v->article_id }}"> {{ $v->article_name }}</a>
                <p class="abstract">
                    {{ strip_tags(mb_substr($v->article_cont, 0, 50, 'utf-8').'......') }}
                </p>
                <div class="meta">
                    <a class="collection-tag" target="_blank" href="/c/20f7f4031550">社会热点</a>
                    <a target="_blank" href="">
                        <i class="iconfont ic-list-read"></i> 1003
                    </a>        <a target="_blank" href="">
                        <i class="iconfont ic-list-comments"></i> 21
                    </a>      <span><i class="iconfont ic-list-like"></i> 29</span>
                </div>
            </div>
        </li>
    @endforeach

<link rel="stylesheet" media="all" href="{{ asset('./home/css/web-1520e0147b6838647211.css') }}">
<link rel="stylesheet" media="all" href="{{ asset('./home/css/entry-b8b6c8d0b3aed7579000.css') }}">

@stop


@section('js')

            <script>
                //取消收藏
                layui.use(['layer'], function() {
                    var layer = layui.layer,
                        $ = layui.jquery;
                    window.delHome = function (attension_user_id)
                    {
                        layer.confirm('是否确定取消关注?', {
                            btn: ['对对', '不行']
                        }, function () {
                            $.post('{{url('/home/attention/delete/')}}/' + attension_user_id, {
                                '_token': '{{csrf_token()}}'
                            }, function (data) {
                                if (data.state == 0) {
                                    layer.msg(data.msg, {icon: 6});
                                    location.href = location.href;

                                } else {
                                    layer.msg(data.msg, {icon: 5});
                                }
                            });
                        }, function () {});

                    }

                    // 取消导航选中状态.
                    var active = $('.nav .active');
                    active.next().attr('class', 'active');
                    active.attr('class', '');
                });
            </script>

@stop




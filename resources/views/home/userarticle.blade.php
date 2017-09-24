

@extends('home.layout')

@section('content')

<div class="container person">
    <div class="row">
        <div class="col-xs-16 main">
            @foreach($data as $k=>$v)
            <div class="main-top">
                <a class="avatar" href="/u/d6fc8a033b98">
                    <img src="{{ asset($v->pic) }}" alt="240" />
                </a>

                <div class="title">
                    <a class="name" href="/u/d6fc8a033b98"> {{ $v->nickname }}</a>
                    <i class="iconfont ic-man">{{ $v->sex }}</i>
                    <a class="btn btn-success follow" href="javascript:;" onclick="gz({{ $v->user_id }})"><i class="iconfont ic-follow"></i><span>关注</span></a>
                </div>
                <div class="info">

                </div>
            </div>
            @endforeach

            <ul class="trigger-menu" data-pjax-container="#list-container">
                <li class="active">
                    <a href="/u/d6fc8a033b98?order_by=shared_at"><i class="iconfont ic-articles"></i> 文章</a>
                </li>
            </ul>

            <div id="list-container">
                <!-- 文章列表模块 -->

                @foreach($res as $k=>$v)
                <ul class="note-list" infinite-scroll-url="/u/b60bba75cfa0?order_by=shared_at">

                    <li id="note-17016757" data-note-id="17016757" class="have-img">

                        <a class="wrap-img" href="http://www.jianshu.com/p/e5ba1fe312dc" target="_blank">
                            <img class="img-blur-done" src="{{$v->article_img}}" alt="120">
                        </a>


                        <div class="content">
                            <div class="author">
                                <a class="avatar" target="_blank" href="#">
                                    <img src="{{ asset('./uploads/users/2.jpg') }}" alt="64">
                                </a>      <div class="name">
                                    <a class="blue-link" target="_blank" href="#">{{ $v->article_author }}</a>
                                    <span class="time" data-shared-at="2017-09-13T08:58:37+08:00">{{ $v->article_at }}</span>
                                </div>
                            </div>


                                <a class="title" target="_blank" href="{{ url('/p') }}/{{ $v->article_id }}">
                                    {{ $v->article_name }}
                                </a>
                            <br>
                        </div>
                    </li>
                </ul>
                @endforeach


            </div>

        </div>

        <div class="col-xs-7 col-xs-offset-1 aside">
            <div class="title">个人介绍</div>
            <a class="function-btn" data-action="start-edit-intro" href="javascript:void(0)"><i class="iconfont ic-edit-s"></i>编辑</a>
            <form class="profile-edit js-intro-form" data-type="json" id="edit_user_7685793" action="/users/d6fc8a033b98" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="_method" value="patch" />
                <textarea name="user[intro]" id="user_intro">
走在码农的路上~</textarea>
                <input type="submit" name="commit" value="保存" class="btn btn-hollow" data-action="save-edit-intro" data-disable-with="保存" />
                <a data-action="cancel-edit-intro" href="javascript:void(null);">取消</a>
            </form>  <div class="description">
                <div class="js-intro">走在码农的路上~</div>
                <a class="social-icon-sprite social-icon-weibo" target="_blank" href="http://weibo.com/u/1927222012"></a>

            </div>
            <div class="publication-list"></div>
            <ul class="list user-dynamic">
                <li>
                    <a href="/users/d6fc8a033b98/subscriptions">
                        <i class="iconfont ic-collection"></i> <span>我关注的专题/文集</span>
                    </a>    </li>
                <li>
                    <a href="/users/d6fc8a033b98/liked_notes">
                        <i class="iconfont ic-like"></i> <span>我喜欢的文章</span>
                    </a>    </li>
            </ul>
            <!-- 专题和文集 -->
            <div class="js-collection-and-notebook-container"></div>
        </div>

    </div>
</div>
<div data-vcomp="side-tool"></div>
<link rel="stylesheet" media="all" href="{{ asset('./home/css/web-e7e403d2843dd1edd8db.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('./home/css/entry-11d7cd25712f81bc2af3.css') }}" />
<script type="application/json" data-name="page-data">{"user_signed_in":true,"locale":"zh-CN","os":"other","read_mode":"day","read_font":"font2","current_user":{"id":7685793,"nickname":"UnaH","slug":"d6fc8a033b98","avatar":"http://upload.jianshu.io/users/upload_avatars/7685793/72f15e83-7f50-45ab-af3a-d031fb4e8934.jpg","unread_counts":{"chats":0,"total":0}},"user":{"slug":"d6fc8a033b98","gender":1},"has_collections":true}</script>


@stop
@section('js')

<script>
    layui.use(['util','layer'], function(){
        var util = layui.util,
            layer = layui.layer,
            $ = layui.jquery;
        //添加关注
        window.gz = function(user_id)
        {
            layer.confirm('是否确定添加关注?', {
                btn: ['对对', '不行']
            }, function () {
                $.post('{{url('/home/attention/insert/')}}/' + user_id, {
                    '_token': '{{csrf_token()}}'
                }, function (data) {
                    if (data.state == 0) {
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    } else if(data.state == 2){
                        layer.msg('已经关注过了');
                    } else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            }, function () {});

        }
    });


</script>
@stop

</body>
</html>

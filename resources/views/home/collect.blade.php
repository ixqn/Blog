@extends('Home.layout')

@section('content')


<div class="container bookmarks" id="js-page-top">
    <div class="row">
        <div class="col-xs-18 col-xs-offset-3 main">
            <img class="tag-banner" src="{{ asset('./home/images/picture/collect-note-955d8c71641a360924390da9da4b0151.png') }}" alt="Collect note" />
            <!-- 文章列表模块 -->

            <ul class="note-list">
                @foreach($str as $v)

                    <li id="note-16956517" data-note-id="16956517" class="have-img">
                        <a class="wrap-img" href="/p/af4ff46a94c6" target="_blank">
                            <img data-echo="//upload-images.jianshu.io/upload_images/6264704-0d3d471b1c86eb78.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('./home/images/picture/6249340_194140034135_2.jpg') }}" alt="120" />
                        </a>
                        <div class="content">
                            <div class="author">
                                <a class="avatar" target="_blank" href="/u/752d989d077d">
                                    <img src="{{ asset($v->user_pic) }}" alt="64" />
                                </a>      <div class="name">
                                    <a class="blue-link" target="_blank" href="{{ url('/u') }}/{{ $v->collect_user_id }}">
                                        {{ $v->article_author }}
                                    </a>
                                    <span class="time" data-shared-at="2017-09-11T23:29:13+08:00"></span>
                                </div>
                            </div>
                            <a class="title" target="_blank" href="{{ url('/p') }}/{{ $v->article_id }}">
                                {{ $v->article_name }}
                            </a>
                            <p class="abstract">
                                {{ mb_substr($v->article_cont, 0, 50, 'utf-8').'......' }}
                            </p>
                            <div class="meta">
                                <a class="cancel" href="javascript:;" onclick="del({{ $v->article_id }})">取消收藏</a>
                            </div>

                        </div>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
    <div>
        <ul class="pagination"></ul>
    </div>
    <div data-vcomp="side-tool"></div>
</div>

@stop



@section('js')

    <script>
    layui.use(['layer'], function(){
        var layer = layui.layer,
            $ = layui.jquery;
        window.del = function(article_id)
        {
            layer.confirm('是否确定取消收藏?',{
                btn:['确定','取消']
            },function() {
                $.post("{{url('/home/collect/delete')}}/" + article_id, {
                    '_token': '{{csrf_token()}}'
                }, function (data) {
                    if (data.state == 0) {
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
            },function(){});

        }
    });
    </script>
@stop
</body>
</html>
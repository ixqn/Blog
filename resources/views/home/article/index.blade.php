@extends('home.layout')

@section('content')

    <div class="note">
        <div class="post">
            <div class="article">
                <h1 class="title">{{ $article['article_name'] }}</h1>

                <!-- 作者区域 -->
                <div class="author">
                    <a class="avatar" href="{{url('u')}}/{{$article['user_id']}}">
                        <img src="{{ asset($article['user']['pic']) }}" alt="96">
                    </a>          <div class="info">
                        <span class="tag">签约作者</span>
                        <span class="name"><a href="{{url('u')}}/{{$article['user_id']}}">{{ $article['article_author'] }}</a></span>

                        <div class="meta">
                            <!-- 如果文章更新时间大于发布时间，那么使用 tooltip 显示更新时间 -->
                            <span class="publish-time" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="最后编辑于 {{ $article['article_up'] }}">{{ $article['article_at'] }}</span>
                            <span class="wordage">字数 {{ $article['length'] }}</span>
                            <span class="views-count">阅读 {{ $article['article_view'] }}</span><span class="comments-count">评论 {{ $article['comm'] }}</span></div>
                    </div>
                    <!-- 如果是当前作者，加入编辑按钮 -->
                </div>
                <!-- -->

                <!-- 文章内容 -->
                <div data-note-content="" class="show-content">

                            {!! $article['article_cont'] !!}

                <div class="show-foot">
                    <a class="notebook" href="/nb/7168960">
                        <i class="iconfont ic-search-notebook"></i> <span>{{ $article['article_cate'] }}</span>
                    </a>          <div class="copyright" data-toggle="tooltip" data-html="true" data-original-title="转载请联系作者获得授权，并标注“竹文作者”。">
                        © 著作权归作者所有
                    </div>
                {{--是否是自己的文章--}}
{{--                @if($article['user_id'] != session('user')['user_id'])--}}
                    <div class="modal-wrap" data-report-note="">
                        <a id="report-modal" onclick="report({{$article['user_id']}})">举报文章</a>
                    </div>
                {{--@endif--}}
                </div>
            </div>

            <!-- 文章底部作者信息 -->
            <div class="follow-detail">
                <div class="info">
                    <a class="avatar" href="{{url('u')}}/{{$article['user_id']}}">
                        <img src="{{ asset($article['user']['pic']) }}" alt="96">
                    </a>          <a class="btn btn-success follow"><i class="iconfont ic-follow"></i><span>关注</span></a>
                    <a class="title" href="{{url('u')}}/{{$article['user_id']}}">{{ $article['article_author'] }}</a>
                    <i class="iconfont @if ($article['user']['sex'] == 'm') ic-man @elseif($article['user']['sex'] == 'w') ic-woman @else @endif "></i>
                    <p>写了 {{ $article['number'] }} 篇文章，被 42301 人关注</p></div>
                <div class="signature">{{ $article['user']['desc'] }}</div>
            </div>

            <div>
                <div id="comment-list" class="comment-list">
                    {{--判断是否登录--}}
                    @if(!session('user'))
                    <div>
                        <form class="new-comment">
                            <a class="avatar">
                                <img src="{{ asset('/home/images/avatar_default-78d4d1f68984cd6d4379508dd94b4210.png') }}">
                            </a>
                            <div class="sign-container">
                                <a href="{{ url('/sign_in') }}" class="btn btn-sign">登录</a>
                                <span>后发表评论</span>
                            </div>
                        </form>
                    </div>
                        @if(!count($comment))
                    <div id="normal-comment-list" class="normal-comment-list">
                        <div>
                            <div>
                                <div class="top">
                                    <span>评论</span>
                                    <a class="close-btn" style="display: none;">关闭评论</a>
                                </div>

                                <div class="no-comment"></div>
                                <div class="text">
                                        智慧如你，不想<a href="{{ url('/sign_in') }}">发表一点想法</a>咩~
                                </div>

                            </div>
                        </div>
                    </div>
                        @endif
                    @else
                    <div>
                        <form id="newxinxi" class="new-comment">
                            <a class="avatar">
                                <img src="{{ asset(session('user')['pic']) }}">
                            </a>
                            <textarea name="comment" placeholder="写下你的评论...(最多255字!)"></textarea>
                            <div class="write-function-block" id="cd" style="display: none;">
                                <div class="hint">Ctrl+Return 发表</div>
                                <a  class="btn btn-send" onclick="send({{ $article['article_id'] }})">发送</a>
                                <a class="cancel" id="qx">取消</a>
                            </div>
                        </form>
                    </div>
                    @endif
                    <div id="normal-comment-list" class="normal-comment-list">
                        <div>
                            <div>
                                <div class="top">
                                    <span>评论</span>
                                    <a class="close-btn" style="display: none;">关闭评论</a>
                                </div>
                                @if(!count($comment))
                                <div class="no-comment"></div>
                                <div class="text">
                                        智慧如你，不想<a>发表一点想法</a>咩~
                                </div>
                                @endif
                            </div>
                            @if(count($comment))
                            @foreach($comment as $k => $v)
                                @if($v['parent_id'] == 0)
                                <div id="comment{{$v['comm_id']}}" class="comment">
                                    <div>
                                        <div class="author">
                                            <a href="{{url('u')}}/{{$v['user_id']}}" target="_blank" class="avatar">
                                                <img src="{{asset($v['user']['pic'])}}">
                                            </a>
                                            <div class="info">
                                                <a href="{{url('u')}}/{{$v['user_id']}}" target="_blank" class="name">{{$v['user']['nickname']}}</a>
                                                <div class="meta">
                                                    <span>{{$v['comm_floor']}}楼 · {{$v['comm_at']}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-wrap">
                                            <p>{{$v['comm_cont']}}</p>
                                            <div class="tool-group">
                                                <a class="">
                                                    <i class="iconfont ic-comment"></i>
                                                    <span onclick="hf({{ $v['comm_id'] }})">回复</span>
                                                </a>
                                                {{--是否是自己的评论--}}
                                                @if($v['user_id'] == session('user')['user_id'])
                                                <a class="comment-delete">
                                                    <span onclick="dl({{ $v['comm_id'] }})">删除</span>
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sub-comment-list">
                                    @foreach($comment as $kk => $vv)
                                        @if($vv['parent_id'] == $v['comm_id'])
                                            <div id="comment-{{$vv['comm_id']}}" class="sub-comment">
                                                <p>
                                                    <a href="{{url('u')}}/{{$vv['user_id']}}" target="_blank">{{$vv['user']['nickname']}}</a>：
                                                    <span>{{$vv['comm_cont']}}</span>
                                                </p>
                                                <div class="sub-tool-group">
                                                    <span>{{$vv['comm_at']}}</span>
                                                    @if($vv['user_id'] == session('user')['user_id'])
                                                    <a class="subcomment-delete">
                                                        <span onclick="dl({{ $vv['comm_id'] }})">删除</span>
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


            {{--评论模版--}}
            <div id="comment" class="comment" style="display: none;">
                <div>
                    <div class="author">
                        <a href="" target="_blank" class="avatar">
                            <img src="">
                        </a>
                        <div class="info">
                            <a href="" target="_blank" class="name"></a>
                            <div class="meta">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="comment-wrap">
                        <p></p>
                        <div class="tool-group">
                            <a class="">
                                <i class="iconfont ic-comment"></i>
                                <span>回复</span>
                            </a>
                            <a class="comment-delete">
                                <span>删除</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="sub-comment-list hide">

                </div>
            </div>
            {{--回复编辑模版--}}
            <div id="bianji" style="display: none;">
                <form class="new-comment">
                    <textarea placeholder="写下你的评论...(最多255字!)"></textarea>
                    <div class="write-function-block">
                        {{--<div class="hint">Ctrl+Return 发表</div>--}}
                        <a class="btn btn-send">发送</a>
                        <a class="cancel">取消</a>
                    </div>
                </form>
            </div>
            {{--回复模版--}}
            <div id="comment-0" class="sub-comment" style="display: none;">
                <p>
                    <a href="/u/d6fc8a033b98" target="_blank">UnaH</a>：<span></span>
                </p>
                <div class="sub-tool-group">
                    <span></span>
                    <a class="subcomment-delete">
                        <span>删除</span>
                    </a>
                </div>
            </div>

@stop

@section('js')

<script>
    layui.use(['util','layer'], function()
    {
        var util = layui.util,
            layer = layui.layer,
            $ = layui.jquery;
        // ajax 请求头.
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //固定块
        util.fixbar({
            bar1: '&#xe600;'
            ,bar2: '&#xe641;'
            ,css: {right: 50, bottom: 100}
            ,bgcolor: '#393D49'
            ,click: function(type){
                if(type === 'bar1'){
                    layer.msg('icon是可以随便换的')
                } else if(type === 'bar2') {
                    layer.msg('两个bar都可以设定是否开启')
                }
            }
        });
        // 取消导航选中状态.
        $('.nav .active').attr('class', '');
        // 显示发送评论.
        $('textarea[name="comment"]').focus(function(){
            $(this).next().show();
        });
        // 取消发送评论.
        $('#qx').on('click', function()
        {
            $(this).parent().hide();
        });
        // 评论.
        window.send = function(id)
        {
            var comm_cont = $('[name="comment"]').val();
            if(comm_cont.length<=0){
                layer.open({
                    title: '提示',
                    icon: 5,
                    content: '评论还是空的呢.',
                });
                return false;
            }
            if(comm_cont.length>255){
                layer.open({
                    title: '提示',
                    icon: 5,
                    content: '评论不能大于255个字符.',
                });
                return false;
            }
            $.ajax({
                type:"POST",
                url:'{{url('/comment/new/')}}/'+id,
                data:{
                    comm_cont:comm_cont
                },
                success:function(data)
                {
                    var comment = $('#comment').clone();
                    // 模版ID.
                    comment.attr('id', 'comment'+data.comm_id);
                    // 回帖用户链接,头像.
                    comment.find('.avatar').attr('href', "{{url('u')}}/"+data.user_id);
                    comment.find('.avatar img').attr('src', "{{asset('/')}}"+data.user.pic);
                    // 回帖用户链接,用户名.
                    comment.find('.info .name').attr('href', "{{url('u')}}/"+data.user_id);
                    comment.find('.info .name').html(data.user.nickname);
                    // 楼层,时间.
                    comment.find('.meta span').html(data.comm_floor+'楼 · '+ data.comm_at);
                    // 内容.
                    comment.find('.comment-wrap p').html(data.comm_cont);
                    // 回复按钮.
                    comment.find('.iconfont').next().attr('onclick', 'hf('+data.comm_id+')');
                    // 删除按钮.
                    comment.find('.comment-delete').find('span').attr('onclick', 'dl('+data.comm_id+')');
                    $('.no-comment').remove();
                    $('.text').remove();
                    // 显示.
                    comment.show();
                    // 输出元素到页面.
                    $('.top').parent().after(comment);
                    // 清空输入框.
                    $('textarea[name="comment"]').val('');
                },
                error: function(errors)
                {
                    if($(errors.responseJSON).attr('errors')){
                        var msg = '';
                        $.each($(errors.responseJSON).attr('errors'), function(i, n){
                            $.each(n ,function(ii, nn){
                                msg += nn + '<br>';
                            });
                        });
                        layer.open({
                            title: '提示',
                            icon: 0,
                            content: msg
                        });
                    }else{
                        layer.open({
                            title: '提示',
                            icon: 2,
                            content: '数据异常'
                        });
                    }
                },
                dataType:'json'
            });
        }
        // 按Ctrl+Enter发送.
        $(function(){
            $('textarea[name="comment"]').keyup(function(event){
                if (event.ctrlKey && event.keyCode === 13){
                    send({{ $article['article_id'] }});
                }
            });

        });
        // 二级回复.
        var flag = 1;
        window.hf = function(id)
        {
            if(flag == 1){
                // 获取弹出模板.
                var bianji = $('#bianji').clone();
                // 更改id.
                bianji.attr('id', 'bianji'+id);
                // 添加发送事件.
                bianji.find('.btn').attr('onclick','gohf('+id+')');
                // 取消按钮.
                bianji.find('.cancel').attr('onclick','hfqx('+id+')');
                // 显示.
                bianji.show();
                // 获取评论元素, 输出元素到页面.
                var pinglun = $('#comment'+id).find('.sub-comment-list').append(bianji);
                pinglun.removeClass('hide');
                flag = 0;
            }else{
                if($('#comment'+id).find('.sub-comment-list').find('div').length == 0){
                    $('#comment'+id).find('.sub-comment-list').addClass('hide');
                    $('#bianji'+id).remove();
                }else{
                    $('#bianji'+id).remove();
                }
                flag = 1;
            }
        }
        // 取消回复.
        window.hfqx = function(id)
        {
            if($('#comment'+id).find('.sub-comment-list').find('div').length == 0){
                $('#comment'+id).find('.sub-comment-list').addClass('hide');
                $('#bianji'+id).remove();
            }else{
                $('#bianji'+id).remove();
            }
        }
        // 执行回复.
        window.gohf = function(id)
        {
            var comm_cont = $('#comment'+id).find('textarea').val();
            if(comm_cont.length<=0){
                layer.open({
                    title: '提示',
                    icon: 5,
                    content: '评论还是空的呢.',
                });
                return false;
            }
            if(comm_cont.length>255){
                layer.open({
                    title: '提示',
                    icon: 5,
                    content: '评论不能大于255个字符.',
                });
                return false;
            }
            $.ajax({
                type:"POST",
                url:'{{url('/comment/hf/')}}/'+id,
                data:{
                    comm_cont:comm_cont
                },
                success:function(data)
                {
                    var comment = $('#comment-0').clone();
                    // 模版ID.
                    comment.attr('id', 'comment'+data.comm_id);
                    // 回帖用户链接,用户名.
                    comment.find('p a').attr('href', "{{url('u')}}/"+data.user_id);
                    comment.find('p a').html(data.user.nickname);
                    // 时间.
                    comment.find('.sub-tool-group').children('span').html(data.comm_at);
                    // 内容.
                    comment.find('p span').html(data.comm_cont);
                    //  删除按钮.
                    comment.find('.subcomment-delete').find('span').attr('onclick', 'dl('+data.comm_id+')');
                    {{--// 回复按钮.--}}
                    {{--comment.find('.iconfont').next().attr('onclick', 'hf('+data.comm_id+')');--}}
                    {{--$('.no-comment').remove();--}}
                    {{--$('.text').remove();--}}
                    // 显示.
                    comment.show();
                    // 输出元素到页面.
                    $('#bianji'+id).before(comment);
                    // 清空输入框.
                    $('#comment'+id).find('textarea').val('');
                },
                error: function(errors)
                {
                    if($(errors.responseJSON).attr('errors')){
                        var msg = '';
                        $.each($(errors.responseJSON).attr('errors'), function(i, n){
                            $.each(n ,function(ii, nn){
                                msg += nn + '<br>';
                            });
                        });
                        layer.open({
                            title: '提示',
                            icon: 0,
                            content: msg
                        });
                    }else{
                        layer.open({
                            title: '提示',
                            icon: 2,
                            content: '数据异常'
                        });
                    }
                },
                dataType:'json'
            });
        }

        // 删除评论.
        window.dl = function(id)
        {
            //询问框
            layer.confirm('是否确认删除？(如果有子评论会一起删除!!!)', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.ajax({
                    type:"POST",
                    url:'{{url('/comment/dl/')}}/'+id,
                    success:function(data)
                    {
                        if(data.state == 0){
                            layer.msg(data.msg, {icon: 5});
                        }else if(data.state == 1){
                            if($('#comment'+id).length){
                                // 删除的一级评论.
                                $('#comment'+id).remove();
                            }else{
                                // 删除二级评论.
                                $('#comment-'+id).remove();
                            }
                            layer.msg(data.msg, {icon: 6});
                        } else{
                            layer.msg(data.msg, {icon: 2});
                        }
                    },
                    error: function(errors)
                    {
                        console.log(errors);
                        if($(errors.responseJSON).attr('errors')){
                            var msg = '';
                            $.each($(errors.responseJSON).attr('errors'), function(i, n){
                                $.each(n ,function(ii, nn){
                                    msg += nn + '<br>';
                                });
                            });
                            layer.open({
                                title: '提示',
                                icon: 0,
                                content: msg
                            });
                        }else{
                            layer.open({
                                title: '提示',
                                icon: 2,
                                content: '数据异常'
                            });
                        }
                    },
                    dataType:'json'
                });
            });
        }

        // 举报文章.
        window.report = function(id)
        {
            layer.open({
                type: 1,
                title: false,
                closeBtn: 0,
                shadeClose: true,
                skin: 'yourclass',
                area: ['420px', '155px'],
                content: '<div class="modal-content" style="height: 155px;">\n' +
                '            <div class="modal-body">\n' +
                '                <form style="margin:0px;">\n' +
                '                    <input type="radio" name="report" value="ad">\n' +
                '                    <span>广告及垃圾信息</span>\n' +
                '                    <input type="radio" name="report" value="plagiarism">\n' +
                '                    <span>抄袭或未授权转载</span>\n' +
                '                    <input type="radio" name="report" value="other">\n' +
                '                    <span>其它</span>\n' +
                '                    <textarea placeholder="写下举报的详情情况（选填）" style="height: 80px;" class="form-control"></textarea>\n' +
                '                </form>\n' +
                '            </div>\n' +
                '            <div class="modal-footer" style="padding: 10px;">\n' +
                '                <div class="action">\n' +
                '                    <input type="submit" onclick="goreport('+id+')" class="btn btn-hollow" value="提交"></div>\n' +
                '            </div>\n' +
                '        </div>'
            });
        }

        // 去举报.
        window.goreport = function(id)
        {
            console.log(id);
            $('.layui-layer-shade').remove();
            $('.layui-layer-page').remove();
        }


    });
</script>

@stop
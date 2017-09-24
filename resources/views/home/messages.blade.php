@extends('home.layout')

@section('content')

<div class="container notification">
    <div class="row">
        <div class="aside">
            <ul>

                <li class="router-link-exact-active active">
                    <a href="/notifications/#/chats">
                        <i class="iconfont ic-chats"></i>
                        <span>简信</span> <!---->
                    </a>
                </li>

                <li class="">
                    <a href="/home/attention">
                        <i class="iconfont ic-follows"></i>
                        <span>关注</span> <!---->
                    </a>
                </li>

            </ul>
        </div>
        <div class="col-xs-16 col-xs-offset-8 main">
            <div>
                <div class="menu">全部简信</div>
                @foreach($data as $k=>$v)
                <ul class="jianxin-list">
                    <li>
                        <div class="pull-right">
                            <span class="time">09.17 14:12</span>
                            <div><a data-toggle="dropdown" href="javascript:void(0);">
                                    <i class="iconfont ic-show"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a><i class="iconfont ic-delete"></i>删除会话</a>
                                    </li>
                                    <li><a><i class="iconfont ic-block"></i>加入黑名单</a></li>
                                    <li><a class="report"><span><i class="iconfont ic-report"></i>举报用户</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <a href="/u/b52ff888fd17" target="_blank" class="avatar">
                            <img src="{{ asset($v->messages_user_pic) }}"> <!---->
                        </a>
                        <a href="/u/b52ff888fd17" target="_blank" class="name">{{ $v->nickname }}</a>
                        <a href="/notifications/#/chats/271453277" class="wrap"><p>{{ mb_substr($v->messages_cont, 0, 25, 'utf-8').'......' }}</p></a>
                    </li>
                    @endforeach
                    <div class="jianxin-placeholder" style="display: none;">
                        <div class="avatar"></div>
                        <div class="wrap">
                            <div class="time"></div>
                            <div class="name"></div>
                            <div class="text"></div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>



@stop

@section('js')


<script>
    //取消收藏
    layui.use(['layer'], function() {
        var layer = layui.layer,
            $ = layui.jquery;


        // 取消导航选中状态.
        var active = $('.nav .active');
        active.next().next().attr('class', 'active');
        active.attr('class', '');
    });
</script>


@stop

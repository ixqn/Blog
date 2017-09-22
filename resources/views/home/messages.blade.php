@extends('Home.layout')

@section('content')

<div class="container notification">
    <div class="row">
        <div class="aside">
            <ul>
                <li class="">
                    <a href="/notifications/#/comments">
                        <i class="iconfont ic-comments"></i>
                        <span>评论</span> <!---->
                    </a>
                </li>
                <li class="router-link-exact-active active">
                    <a href="/notifications/#/chats">
                        <i class="iconfont ic-chats"></i>
                        <span>简信</span> <!---->
                    </a>
                </li>
                <li class="">
                    <a href="/notifications/#/requests">
                        <i class="iconfont ic-requests"></i>
                        <span>投稿请求</span> <!---->
                    </a>
                </li>
                <li class="">
                    <a href="/notifications/#/likes">
                        <i class="iconfont ic-likes"></i>
                        <span>喜欢和赞</span> <!---->
                    </a>
                </li>
                <li class="">
                    <a href="/notifications/#/follows">
                        <i class="iconfont ic-follows"></i>
                        <span>关注</span> <!---->
                    </a>
                </li>
                <li class="">
                    <a href="/notifications/#/money">
                        <i class="iconfont ic-money"></i>
                        <span>赞赏</span> <!---->
                    </a>
                </li>
                <li class="">
                    <a href="/notifications/#/others">
                        <i class="iconfont ic-others"></i>
                        <span>其他消息</span> <!---->
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
                </ul> <!----> <!----> <!---->
            </div>
        </div>
    </div>
</div>



@stop

@section('js')

<link rel="stylesheet" media="all" href="{{ asset('./home/css/web-e7e403d2843dd1edd8db.css') }}" />
<link rel="stylesheet" media="all" href="{{ asset('./home/css/entry-266e0d4b3ebe57d6dd80.css') }}" />


<script type = 'text/javascript' id ='1qa2ws' charset='utf-8' src='{{ asset('./js/base.js') }}'></script>

@stop

</body>
</html>

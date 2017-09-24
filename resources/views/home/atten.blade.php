@extends('home.layout')

@section('content')

    <div class="container subscription">
        <div class="row"><div class="aside">
                <a data-toggle="dropdown" class="change-type">全部关注123<i class="iconfont ic-filter"></i></a>
                <ul class="dropdown-menu arrow-top"><li><a>全部关注</a></ul>
                <a href="#/recommendation" class="add-people"><i class="iconfont ic-addpeople"></i><span>添加关注</span></a>
                <ul class="js-subscription-list"> <li class=""><div class="avatar-collection"></div>
                        <div class="name">
                            @foreach($data as $k=>$v)
                                <td>{{ $v->id }}</td>
                                <td><a href="#" id="attention" onclick="Attention({{ $v->user_id }})">{{ $v->nickname }}</a></br></td>
                                <td>{{ $v->email }}</td></br>
                                <a href="{{ url('/home/attention/delete') }}/{{ $v->attension_user_id }}">取消关注</a></br></br>

                            @endforeach
                        </div> <!----></a></li><li class=""></li></ul> <!----> <!----></div> <div class="col-xs-16 col-xs-offset-8 main"><div><ul class="note-list">


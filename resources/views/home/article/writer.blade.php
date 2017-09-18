<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} - {{ $title }}</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/home/logo_ico_16X16.ico') }}" media="screen">
  <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
  <style>
    #back {
        width: 95%;
        margin: 10px;
    }
    #time {
        position: absolute;
        right: 50%;
        top: 50%;
        width: 128px;
    }
    #time img {
        width: 100%;
    }
    .layui-form-label {
        text-align: left;
    }
    .layui-form-select {
        width: 30%;
    }
    .layui-edge {
        left: 94%;
    }
    .grid-demo{
        overflow-x:hidden;
    }
    #data{
        border: 1px solid #e6e6e6;
        width: 97%;
        height: 20%;
        overflow:hidden;
        margin-bottom:5px;
        padding-right:5px;
    }
    #data img{
        height:30px;
    }
    .bianji{
         top: 2px;
     }
    .btn{
        height: 25px;
        line-height: 25px;
        font-size: 12px;
    }
    .layui-text a {
        color: #fff;
    }
    .layui-timeline {
        height: 100%;
    }
    .layui-timeline-item{
        height:80%;
    }
    .layui-timeline-content{
        padding-left: 16px;
    }
    .pagination>.active>span{
        z-index: 2;
        color: #fff;
        cursor: default;
        border-color: #337ab7;
        background-color: #009688;
    }
    .pagination {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }
    .pagination>li {
        display: inline;
    }
    .pagination>li>a, .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #333;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    .pagination>li:first-child>span {
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .pagination>.disabled>span{
        color: #777;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
    }
  </style>
</head>
<body>
<!-- 你的HTML代码 -->
<div class="layui-row">
    <div class="layui-col-md3 liebiao">
        <div class="grid-demo">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend>文章列表</legend>
            </fieldset>
            <div id="back">
                <a class="layui-btn layui-btn-radius layui-btn-warm"  href="{{ url('') }}">返回首页</a>
                <a class="layui-btn layui-btn-radius layui-btn-warm"  href="{{ url('/writer') }}">新增文章</a>
            </div>
            @foreach($data as $k=>$v)
            <div id="data">
                <ul class="layui-timeline">
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                            <h4 class="layui-timeline-title">{{ $v->article_up }}</h4>
                            <p>
                                <b name="old_category_name">《{{ $v->article_name }}》</b>
                                <br>
                                <em name="old_category_cont">“{!!  $v->article_cont !!}”</em>
                                <br>
                            </p>
                            <div class="layui-btn-group layui-layout-right bianji layui-icon">
                                <a class="layui-btn btn" title="编辑" href="javascript:;" onclick="editArt({{$v}})">&#xe642;</a>
                                <a class="layui-btn btn" title="删除" href="javascript:;" onclick="delArt({{$v->article_id}})">&#xe640;</a>
                                @if($v->article_status == 1)
                                <a class="layui-btn btn" title="发布" href="javascript:;" onclick="printArt({{$v->article_id}})">&#xe609;</a>
                                @else
                                <a class="layui-btn btn" title="取消发布" href="javascript:;" onclick="noprintArt({{$v->article_id}})">&#x1006;</a>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            @endforeach

            <div class="page_list">
                {!! $data->links() !!}
            </div>

        </div>
    </div>
    <div class="layui-col-md9">
        <div class="grid-demo layui-form grid-demo-bg1">
            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                <legend id="leg">新增文章</legend>
            </fieldset>
                <input type="hidden" id="article_id" value="">
            <div class="layui-form-item">
                <input type="text" id="article_name" name="article_name" lay-verify="title" value="" autocomplete="off" placeholder="请输入文章标题" class="layui-input">
            </div>
            <div class="layui-form-item">
                <select id="category_id" name="category_id" lay-filter="fenlei">
                    <option value="">请选择分类</option>
                    @foreach($cates as $item)
                    <option id="f{{ $item->cate_id }}" value="{{ $item->cate_id }}">{{ $item->cate_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否公开</label>
                <input type="radio" name="article_open" value="1" title="公开" checked="">
                <input type="radio" name="article_open" value="2" title="私密">
            </div>
            <div id="time"></div>
            <textarea name="content" class="layui-textarea" id="article_cont" style="display: none;"></textarea>
            <div class="site-demo-button" style="margin-top: 20px;">
                <a id="btn" class="layui-btn site-demo-layedit" data-type="content" href="javascript:;" onclick="save()">保存</a>
            </div>
        </div>
    </div>
</div>
{{--<script src="{{ asset('bootstrap/js/jquery.min.js') }}"></script>--}}
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('layui/layui.all.js') }}"></script>
<script>

    layui.use(['form','layer','layedit','upload'], function() { 
        var layedit = layui.layedit,
            layer = layui.layer,
            form = layui.form,
            $ = layui.jquery;
        // ajax 请求头.
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // 图片上传.
        layedit.set({
            uploadImage: {
                url: '{{ url("/home/upload") }}',
                type: 'POST'
            }
        });
        // 高度
        var px = $(window).height();
        $(".liebiao").css({paddingRight:'15px'});
        $('.grid-demo').css({height:px});
        if(px<=370){
            px = 450;
        }
        // 实例化编辑器, 设置编辑器高度.
        var index = layedit.build('article_cont', {
            height: px -370
        });
        // 执行保存.
        window.save = function()
        {
            var category_id = $('.layui-this').attr('lay-value');
            var article_name = $('#article_name').val();
            var article_cont = layedit.getContent(index);
            var article_open = $("input[name='article_open']:checked").val();

            $.ajax('{{ url("/home/article/dowriter") }}', {
                type:'POST',
                data:{
                    category_id:category_id,
                    user_id:1,
                    article_author:'李四',
                    article_name:article_name,
                    article_cont:article_cont,
                    article_open:article_open
                },
                complete:function()
                {
                    $("#time").fadeOut(1000);
                },
                beforeSend:function()
                {
                    var img = $("<img src='{{ asset('/images/home/loading.gif') }}'>");
                    $("#time").append(img);
                },
                success:function(data)
                {
                    if(data == '0'){
                        layer.open({
                            title: '提示',
                            icon: 6,
                            content: '保存成功',
                        });
                        location.href = location.href;
                    } else {
                        layer.open({
                            title: '提示',
                            icon: 0,
                            content: '未修改内容'
                        });
                        location.href = location.href;
                    }
                },
                error:function(errors)
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
        // 删除事件.
        window.delArt = function(id)
        {
            //询问框
            layer.confirm('是否确认删除？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post('{{url('/home/article/delete/')}}/'+id,function(data){
                    if(data.state == 0){
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    }else{
                        layer.msg(data.msg, {icon: 5});
                        location.href = location.href;
                    }
                })
            });
        }
        // 编辑事件.
        var index2;
        window.editArt = function(wz)
        {
            // 大标题 按钮.
            $('#leg').text('编辑文章');
            $('#btn').text('更新');
            $('#btn').attr('onclick', 'doeditArt()');
            // 文章ID.
            $('#article_id').val(wz.article_id);
            // 默认标题.
            $('#article_name').val(wz.article_name);
            // 分类.
            $('option').each(function(i, n){
                if($(n).val() == wz.category_id){
                    $(n).attr('selected','ture');
                }
            });
            // 公开.
            $("input[name='article_open']").each(function(i, n){
                if($(n).val() == wz.article_open){
                    $(n).attr('checked','ture');
                }
            });
            // 内容.
            $("#article_cont").text(wz.article_cont);
            // layui刷新渲染.
            index2 = layedit.build('article_cont', {
                height: px -370
            });
            form.render();
        }
        // 执行更新.
        window.doeditArt = function()
        {
            var article_id = $('#article_id').val();

            var category_id = $('.layui-this').attr('lay-value');
            var article_name = $('#article_name').val();
            var article_cont = layedit.getContent(index2);
            var article_open = $("input[name='article_open']:checked").val();

            $.ajax('{{ url("/home/article/doedit") }}/'+article_id, {
                // async:false,
                type:'POST',
                data:{
                    category_id:category_id,
                    article_name:article_name,
                    article_cont:article_cont,
                    article_open:article_open
                },
                complete:function()
                {
                    $("#time").fadeOut(1000);
                },
                beforeSend:function()
                {
                    var img = $("<img src='{{ asset('/images/home/loading.gif') }}'>");
                    $("#time").append(img);
                },
                success:function(data)
                {
                    if(data == '0'){
                        layer.open({
                            title: '提示',
                            icon: 6,
                            content: '更新成功',
                        });
                        location.href = location.href;
                    } else {
                        layer.open({
                            title: '提示',
                            icon: 0,
                            content: '未修改内容'
                        });
                        location.href = location.href;
                    }
                },
                error:function(errors)
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
                // timeout:5000// 只能用于异步。对同步不生效。
            });
        }
        // 发布事件.
        window.printArt = function(id)
        {
            //询问框
            layer.confirm('已经准备好发布了吗？', {
                btn: ['是的','取消'] //按钮
            }, function(){
                $.post('{{url('/home/article/print/')}}/'+id,function(data){
                    if(data.state == 0){
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    }else{
                        layer.msg(data.msg, {icon: 5});
                        location.href = location.href;
                    }
                })
            });
        }
        // 取消布事件.
        window.noprintArt = function(id)
        {
            //询问框
            layer.confirm('要取消发布吗？', {
                btn: ['是的','取消'] //按钮
            }, function(){
                $.post('{{url('/home/article/noprint/')}}/'+id,function(data){
                    if(data.state == 0){
                        layer.msg(data.msg, {icon: 6});
                        location.href = location.href;
                    }else{
                        layer.msg(data.msg, {icon: 5});
                        location.href = location.href;
                    }
                })
            });
        }
    });

</script>
</body>
</html>
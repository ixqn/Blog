<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/home/logo_ico_16X16.ico') }}" media="screen">
    <title>{{ config('app.name') }} - 用户资料</title>

    <style type="text/css">
        .table th, .table td { 
        /*text-align: center;*/
        vertical-align: middle!important;
        }
    </style>
</head>
<body>

<div class="container-fluid" style="margin-top: 100px ">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                </div>

                <div class="col-md-4">

                    <table  class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <div>
                                        <img src="{{url($user['pic'])}}" style="width: 100px; height: auto;">
                                    </div>
                                </td> 
                                <td>
                                    <span>没时间更改头像了</span>
                                </td>
                            </tr>
                            <tr>
                                <td>昵称</td> 
                                <td><input type="text" name="nickname" value="{{$user['nickname']}}"></td>
                            </tr>
                            <tr>
                                <td>手机号</td> 
                                <td><span>{{$user['tel']}}</span></td>
                            </tr>
                            <tr>
                                <td>性别</td> 
                                <td>
                                    <input type="radio" name="sex" @if($user['sex'] == "w") checked @endif value="w">女
                                    <input type="radio" name="sex" @if($user['sex'] == "m") checked @endif value="m">男
                                    <input type="radio" name="sex" @if($user['sex'] == "x") checked @endif value="x">未知
                                </td>
                            </tr>

                            <tr>
                                <td>生日</td> 
                                <td><input type="date" name="birthday" value="{{$user['birthday']}}"></td>
                            </tr>

                            <tr>
                                <td>邮箱地址</td> 

                                @if($user['email_active'])
                                    <td>
                                        <span>{{$user['email']}}</span>
                                        <span>已验证</span>
                                    </td>
                                @elseif($user['email'])
                                    <td>
                                        <!-- <form> -->
                                            <input type="email" name="email" value="{{ $user['email'] }}">
                                            <input type="button" value="激活邮箱" onclick="activeEmail()"  class="btn"> 
                                        <!-- </form> -->
                                    </td>
                                @else
                                    <td>
                                        <input type="email" name="email" placeholder="输入邮箱地址">
                                    </td>
                                @endif
                            </tr>

                            <tr>
                                <td>描述</td> 
                                <td><textarea name="desc">{{$user['desc']}}</textarea></td>
                            </tr>

                        </tbody>
                    </table> 
                    <p>
                        <div class="alert alert-danger" style="display: none;">
                            <ul id="alert"></ul>
                        </div>
                    </p>
                    <input type="submit" class="btn btn-success" onclick="save()" value="保存">
                    <a href="{{url('/')}}" class="btn btn-success">竹文首页</a>
                </div>

                <div class="col-md-4">
 
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
// 设置TOKEN值
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// ----------------------------------------------------------------------------------------------------------
// 消息提示
var alert = $('#alert');
var msg
function errorMsg()
{
    alert.empty();
    alert.append(msg);
    alert.parent().show();
    alert.parent().fadeOut(5000);
}

// ----------------------------------------------------------------------------------------------------------
// 激活邮箱
function activeEmail()
{
    $.ajax({
        url:"/active/email", // 激活邮箱地址
        type:"post",
        dataType:"json",
        async:false,
        success:function(data){
            msg = data['msg'];
            errorMsg();
        }
    });

}






// ----------------------------------------------------------------------------------------------------------

var nickname,sex,birthday,email,desc;
function save(){
    get();
    $.ajax({
        url:"/save/profile", // 保存资料
        type:"post",
        data:{
            "nickname":nickname,
            "sex":sex,
            "birthday":birthday,
            "email":email,
            "desc":desc
        },
        dataType:"json",
        async:false,
        success:function(data){
            msg = data['msg'];
            errorMsg();
        }
    });

}

// 获取输入的资料
function get()
{
    nickname = $("input[name = 'nickname']").val();
    sex = $("input:checked").val();
    birthday= $("input[name = birthday").val();
    email = $("input[name = 'email']").val();
    desc = $("textarea[name = 'desc']").val();

}



</script>


</body>
</html>
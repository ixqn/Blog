<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/home/logo_ico_16X16.ico') }}" media="screen">
    <title>{{ config('app.name') }} - 通过邮件重置密码</title>
</head>
<body>

<div class="container" style="margin-top: 100px ">

    <div class="row">
        <div class="col-md-offset-2 col-md-6">

            <ul class="nav nav-tabs">
                <li><a href="{{url('/sign_in')}}">登录</a></li>
                <li><a href="{{url('/sign_up')}}">注册</a></li>
                <li><a href="{{url('/mobile_reset')}}">用手机重置密码</a></li>
                <li class="active"><a href="{{url('/email_reset')}}">用邮箱重置密码</a></li>
            </ul>

            <p>
                <form action="/resetPasswordByEmail" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">邮箱地址</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" placeholder="请输入邮箱地址" aria-describedby="email-addon" name="email" value="{{ old('tel') }}" />
                                <span class="input-group-addon" id=email-addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="code" class="col-sm-4 control-label">验证码</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" class="form-control" id="code" placeholder="请输入验证码" aria-describedby="code_addon" name="code" />
                                <span class="input-group-addon" id="code_addon" style="padding: 0;">
                                    <img src="/code" onclick="this.src='/code?'+Math.random()" style="height: 30px;" />
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8"">
                            <button type="button" id="submit" class="btn btn-danger btn-group-justified">发送邮件</button>
                        </div>
                    </div>
                </form>
            </p>
            <p>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                        @if(is_object($errors))
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @else
                            <li>{{ $errors }}</li>
                        @endif
                        </ul>
                    </div>
                @endif
            </p>

            <p>
                <div class="alert alert-danger" style="display: none;">
                    <ul id="alert"></ul>
                </div>
            </p>

        </div>
        <div class="col-md-4">
        </div>

    </div>

</div>
<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>

<script>

$(function(){
    // 将后台回馈的信息淡出
    $('#feedback').fadeOut(5000);
});

// 设置TOKEN值
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var alert = $('#alert');
var ok = $('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
var remove = $('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');


var email_cur = false; // 是否在当前输入框
var email_hasGo = false;  // 是否进入过输入框
var email_flag = false;   // 验证的结果


var code_cur = false;
var code_hasGo = false;
var code_flag = false;



// ----------------------------------------------------------------------------------------------------------

$('#email').on({
    focus:function(){
        email_cur = true;
        email_hasGo = true;
        email_flag = false;
    },
    // keyup:function(){ email_func(); },
    // change:function(){ email_func(); },
    blur:function(){
        email_cur = false;
        email_func();
        errorMsg(); 
       
    },
});

// email的验证函数
function email_func(){
    var emailReg = /^[a-zA-Z0-9\-_\.]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/;
    var email = $('#email').val();
    email_flag = emailReg.test(email);
    // console.log(email,email_flag);
    if(email_flag){
        $.ajax({
            url:"/is_emailActive",
            type:"POST",
            data:{email:email},
            dataType:"json",
            async:false,
            // 必须是激活过的邮箱才可重置密码
            success:function(data){ 
                email_flag = data['status'];
                email_error = $('<li>'+data['msg']+'</li>');

            } 
           
        });
    }
    
}





// ----------------------------------------------------------------------------------------------------------

$('#code').on({

    focus:function(){
        code_cur = true;
        code_hasGo = true;
        code_flag = false;
    },

    // keyup:function(){ code_func(); },
    // change:function(){ code_func(); },
    blur:function(){
        code_cur = false;
        code_func();
        errorMsg(); 
    }

});


// 判断验证吗是否正确
function code_func(){
    var code = $('#code').val();
    $.ajax({
        url:"/is_codeRight",
        type:"POST",
        data:{"code":code},
        dataType:"json",
        async:false,
        success:function(is_codeRight){
            code_flag = is_codeRight;

        }

    });
}

// ----------------------------------------------------------------------------------------------------------

var email_error = $('<li>邮箱有误</li>');
var code_error = $('<li>验证码有误</li>');

function errorMsg()
{
    alert.parent().hide();
    alert.empty();

    if(email_hasGo){
        if(!email_cur){
            if(!email_flag){
                alert.append(email_error);
            }
        }
    }


    if(code_hasGo){
        if(!code_cur){
            if(!code_flag){
                alert.append(code_error);
            }
        }
    }


    if(alert.children().length){alert.parent().show();}
    
}


// ----------------------------------------------------------------------------------------------------------
$(document).on({

    keyup:function(){ submit_css(); },
    mousemove:function(){ submit_css(); }
});
// 提交按钮的样式
function submit_css()
{
    if(email_flag && code_flag){
        $('#submit').removeClass('disabled').attr('type','submit');
    } else {
        $('#submit').addClass('disabled').attr('type','button');
    }
}


</script>
</body>
</html>
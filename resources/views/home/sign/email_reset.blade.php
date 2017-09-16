<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
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
                <form action="/doSignUp" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="tel" class="col-sm-4 control-label">邮箱地址</label>
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

        </div>
        <div class="col-md-4">
        </div>

    </div>

</div>
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
   $(document).mousemove(function(){
        if(tel_flag){
             $('#password').removeAttr('disabled');
        } else {
            $('#password').val('').attr('disabled','disabled');
            $('#password_R').val('').attr('disabled','disabled');
            $('#code').val('').attr('disabled','disabled');
            $('#btn').addClass('disabled');
            $('#submit').addClass('disabled');
        }

        if(password_flag){
            $('#password_r').removeAttr('disabled');
        } else {
            $('#password_r').val('').attr('disabled','disabled');
        }

        if(password_r_flag){
            $('#code').removeAttr('disabled');
            $('#btn').removeClass('disabled');
            $('#submit').removeClass('disabled');
        } else {
            $('#code').val('').attr('disabled','disabled');
            $('#btn').addClass('disabled');
            $('#submit').addClass('disabled');

        }

    });


</script>
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


var email_cur = false;    // 是否在当前输入框
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
    keyup:function(){ email_func(); },
    change:function(){ email_func(); },
    blur:function(){
        tel_cur = false;
        email_func();
        errorMsg();
    },
});

// email的验证函数
function email_func(){
    var emailReg = /^[a-zA-Z0-9][a-zA-Z0-9.]+@[a-zA-Z0-9]+\.[a-zA-Z]+$/;
    var email = $('#tel').val();
    email_flag = emailReg.test(email);
    console.log(email_flag);
    if(email_flag){
        $.ajax({
            url:"/is_emailActive",
            type:"POST",
            data:{email:email},
            dataType:"json",
            async:false,
            success:function(is_emailActive){ email_flag = is_emailActive; } // 必须是激活过的邮箱才可重置密码
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

    keyup:function(){ code_func();errorMsg(); },
    change:function(){ code_func();errorMsg(); },
    blur:function(){
        code_cur = false;
        code_func();
        errorMsg();
    }

});



function code_func(){
    var code = $('#code').val();
    $.ajax({
        url:"/is_codeRight",
        type:"POST",
        data:{code:code},
        dataType:"json",
        async:false,
        success:function(is_codeRight){ code_flag = is_codeRight; }
    });
}



function errorMsg()
{
    alert.parent().hide();
    alert.html('');

    var email_rror = $('<li>邮箱有误</li>');
    if(tel_hasGo && !tel_cur && !tel_flag){alert.append(email_rror);}
    if(alert.children().length){alert.parent().show();}
    
}







$(document).on({
    keyup:function(){ icon_addon();get_code_css();submit_css(); },
    mousemove:function(){ icon_addon();get_code_css();submit_css(); }
});

// 改变输入框后边的图标
function icon_addon(){
    if(tel_flag){
        $('#tel_addon').html(ok);
    } else {
        $('#tel_addon').html(remove);
    }


}



// 提交按钮的样式
function submit_css()
{
    if(tel_flag && password_flag && password_r_flag && code_flag){
        $('#submit').removeClass('disabled').attr('type','submit');
    } else {
        $('#submit').addClass('disabled').attr('type','button');
    }
}





</script>
</body>
</html>
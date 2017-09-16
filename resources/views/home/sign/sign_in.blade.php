<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<div class="container" style="margin-top: 100px;">
    <div class="row">

        <div class="col-md-offset-2 col-md-6">

            <ul class="nav nav-tabs ">
                <li class="active"><a href="{{url('/sign_in')}}">登录</a></li>
                <li><a href="{{url('/sign_up')}}">注册</a></li>
                <li><a href="{{url('/mobile_reset')}}">用手机重置密码</a></li>
                <li><a href="{{url('/email_reset')}}">用邮箱重置密码</a></li>
            </ul>

            <p>
                <form action="/doSignIn" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="tel" class="col-sm-4 control-label">手机号</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="tel" class="form-control" id="tel" placeholder="请输入11位手机号码" aria-describedby="tel_addon" name="tel" value="{{ old('tel') }}" />
                                <span class="input-group-addon" id="tel_addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">密码</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="请输入密码" aria-describedby="password_addon" name="password" value="{{ old('password') }}" />
                                <span class="input-group-addon" id="password_addon">
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
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="button" id="submit" class="btn btn-primary btn-group-justified disabled">登录</button>
                        </div>
                    </div>
                </form>
            </p>

            <p>
            
                @if (count($errors) > 0)
                    <div id="feedback" class="alert alert-danger">
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
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
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
// console.log(alert);
// console.log(alert.children().length);
var ok = $('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
var remove = $('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');


var tel_cur = false;    // 是否在当前输入框
var tel_hasGo = false;  // 是否进入过输入框
var tel_flag = false;   // 验证的结果

var password_cur = false;
var password_hasGo = false
var password_flag = false;

var code_cur = false;
var code_hasGo = false;
var code_flag = false;




// ----------------------------------------------------------------------------------------------------------
$('#tel').on({
    focus:function(){
        tel_cur = true;
        tel_hasGo = true;
        tel_flag = false;
    },
    keyup:function(){ tel_func(); },
    change:function(){ tel_func(); },
    blur:function(){
        tel_cur = false;
        tel_func();
        errorMsg();
    },
});

// tel的验证函数
function tel_func(){
    var telReg = /^1[34578]\d{9}$/;
    var tel = $('#tel').val();
    tel_flag = telReg.test(tel);
    if(tel_flag){
        $.ajax({
            url:"/is_telReg",
            type:"POST",
            data:{tel:tel},
            dataType:"json",
            async:false,
            success:function(is_telReg){ tel_flag = is_telReg; } // 必须存在的手机号才可登录
        });
    }
}



// ----------------------------------------------------------------------------------------------------------

$('#password').on({
    focus:function(){
        password_cur = true;
        password_hasGo = true;
        password_flag = false;
        $(this).val(''); // 清空输入框的内容

    },

    keyup:function(){ password_func();errorMsg(); },
    change:function(){ password_func();errorMsg(); },
    blur:function(){
        password_cur = false;
        password_func();
        errorMsg();
    }

});


function password_func()
{
    var reg = /^\w{8,20}$/;
    var password = $('#password').val();
    password_flag = reg.test(password);
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

// ----------------------------------------------------------------------------------------------------------


function errorMsg()
{
    alert.parent().hide();
    alert.html('');

    var tele_rror = $('<li>号码有误或未注册的号码</li>');
    var password_error = $('<li>密码不符合要求</li>');
    var code_error = $('<li>验证码有误</li>');

    if(tel_hasGo && !tel_cur && !tel_flag){alert.append(tele_rror);}
    if(password_hasGo && !password_cur && !password_flag){alert.append(password_error);}
    if(code_hasGo && !code_cur && !code_flag){alert.append(code_error);}

    if(alert.children().length){alert.parent().show();}
    
}






// ----------------------------------------------------------------------------------------------------------
$(document).on({
    keyup:function(){ icon_addon();submit_css(); },
    mousemove:function(){ icon_addon();submit_css(); }
});

// 改变输入框后边的图标
function icon_addon(){
    if(tel_flag){
            $('#tel_addon').html(ok);
        } else {
            $('#tel_addon').html(remove);
        }
        
    if(password_flag){
        $('#password_addon').html(ok);
    } else {
        $('#password_addon').html(remove);
    }
}

// 提交按钮的样式
function submit_css()
{
    if(tel_flag && password_flag && code_flag){
        $('#submit').removeClass('disabled').attr('type','submit');
    } else {
        $('#submit').addClass('disabled').attr('type','button');
    }
}





</script>
</body>
</html>
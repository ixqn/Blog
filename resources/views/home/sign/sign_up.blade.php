<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/home/logo_ico_16X16.ico') }}" media="screen">
    <title>{{ config('app.name') }} - 注册</title>
</head>
<body>

<div class="container" style="margin-top: 100px ">

    <div class="row">
        <div class="col-md-offset-2 col-md-6">

            <ul class="nav nav-tabs">
                <li><a href="{{url('/sign_in')}}">登录</a></li>
                <li class="active"><a href="{{url('/sign_up')}}">注册</a></li>
                <li><a href="{{url('/mobile_reset')}}">用手机重置密码</a></li>
                <li><a href="{{url('/email_reset')}}">用邮箱重置密码</a></li>
            </ul>

            <p>
                <form action="/doSignUp" method="POST" class="form-horizontal" role="form">
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
                        <label for="code" class="col-sm-4 control-label">验证码</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" class="form-control" disabled="disabled" id="code" placeholder="请输入验证码" name="code" />
                                <span class="input-group-btn">
                                    <button id="send_tel_code" class="btn btn-info" type="button">发送验证码</button>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">密码</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" placeholder="字母、数字和下划线 , 8至20个字符" aria-describedby="password_addon" name="password" />
                                <span class="input-group-addon" id="password_addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true" ></span>
                                </span>
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        <label for="password_r" class="col-sm-4 control-label">确认密码</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_r" placeholder="请重新输入一遍密码" name="password_r" aria-describedby="password_r_addon" />
                                <span class="input-group-addon" id="password_r_addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                                </span>
                            </div>
                        </div>
                    </div>





                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8"">
                            <button type="button" id="submit" class="btn btn-success btn-group-justified disabled">注册</button>
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

var tel; // 手机号码,发送验证码时要用到
var tel_cur = false;    // 是否在当前输入框
var tel_hasGo = false;  // 是否进入过输入框
var tel_flag = false;   // 验证的结果

var password_cur = false;
var password_hasGo = false
var password_flag = false;


var password_r_cur = false;
var password_r_hasGo = false
var password_r_flag = false;



var code_cur = false;
var code_hasGo = false;
var code_flag = false;

var canSendCode = false; // 是否可发手机验证码


// ----------------------------------------------------------------------------------------------------------

$('#tel').on({
    focus:function(){
        tel_cur = true;
        tel_hasGo = true;
        tel_flag = false;
    },
    // keyup:function(){ tel_func(); },
    // change:function(){ tel_func(); },
    blur:function(){
        tel_cur = false;
        tel_func();
        errorMsg();
        tel_addon();
    },
});

// 判断手机号是否已经注册
function tel_func(){
    var telReg = /^1[34578]\d{9}$/;
    tel = $('#tel').val();
    tel_flag = telReg.test(tel);
    if(tel_flag){
        $.ajax({
            url:"/is_telReg",
            type:"POST",
            data:{tel:tel},
            dataType:"json",
            async:false,
            success:function(is_telReg){ tel_flag = !is_telReg; } // 未注册的手机号才可以注册
        });
    }
}


// ----------------------------------------------------------------------------------------------------------


var times=60;
var timer=null;
var canClick = true;
var send_tel_code_status = false; // 发送验证码状态
// var hits = 0; // 点击次数
var hadClick = false

$('#send_tel_code').on({
    click:function(event){
        event.preventDefault();
        
        if(tel_flag){
            hadClick = true;
            if(canClick){
                send_tel_code();
                timeCount();
            }
        }
    }
});



function send_tel_code(){
    if(!send_tel_code_status){
        $.ajax({
            url:"/sendRegCode", // 注册时,发送的验证码
            type:"POST",
            data:{"tel":tel},
            dataType:"json",
            async:false,
            success:function(data){ 
                send_tel_code_status = data['status'];
                msg = data['msg'];
            }

        });
    }

}



function timeCount(){
    canClick = false;
    timer=setInterval(function(){
        times--;
        if(times<=0){
            $('#send_tel_code').html('发送验证码');
            clearInterval(timer);
            times=60;
            canClick = true;
            $('#send_tel_code').removeClass('disabled');
        }else{
            $('#send_tel_code').html(times+'秒后重试');
            $('#send_tel_code').addClass('disabled');
        }
        // console.log(times);
    },1000);
}

// 获取手机验证码的按钮样式
// function send_tel_code_css(){

//     var status = tel_flag && password_flag && password_r_flag;
//     if(status){
//         canSendCode = true;
//         $('#send_tel_code').removeClass('disabled');
//     } else {
//         canSendCode = false;
//         $('#send_tel_code').addClass('disabled');
//     }
// }



// window.onload=function(){
//    var send=document.getElementById('send_tel_code');
//        times=60;
//        timer=null;
//    send_tel_code.onclick=function(){

//      // 计时开始 
//         timer=setInterval(function(){
//             times--;
//             if(times<=0){
//                 send_tel_code.value='发送验证码';
//                 clearInterval(timer);
//                 times=60;
//                 send_tel_code.disabled=false;    //是否可点击
//             }else{
//                 send_tel_code.value=times+'秒后重试';
//                 send_tel_code.disabled=true;
//             }
//             console.log(times);
//         },1000);
//    } 
// }



// ----------------------------------------------------------------------------------------------------------



$('#code').on({

    focus:function(){
        code_cur = true;
        code_hasGo = true;
        code_flag = false;
    },

    // keyup:function(){ code_func();},
    // change:function(){ code_func();},
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
        data:{code:code},
        dataType:"json",
        async:false,
        success:function(is_codeRight){ code_flag = is_codeRight; }
    });
}



// ----------------------------------------------------------------------------------------------------------


$('#password').on({
    focus:function(){
        password_cur = true;
        password_hasGo = true;
        password_flag = false;
        $(this).val(''); // 清空输入框的内容

    },

    // keyup:function(){ password_func(); },
    // change:function(){ password_func(); },
    blur:function(){
        password_cur = false;
        password_func();
        errorMsg();
        password_addon();
    }

});


function password_func()
{
    var reg = /^\w{8,20}$/;
    var password = $('#password').val();
    password_flag = reg.test(password);
}



// ----------------------------------------------------------------------------------------------------------



$('#password_r').on({
    focus:function(){
        password_r_cur = true;
        password_r_hasGo = true;
        password_r_flag = false;
        $(this).val(''); // 清空输入框的内容

    },

    // keyup:function(){ password_r_func(); },
    // change:function(){ password_r_func(); },
    blur:function(){
        password_r_cur = false;
        password_r_func();
        errorMsg();
        password_r_addon();
    }

});


function password_r_func()
{
    var password= $('#password').val();
    var password_r = $('#password_r').val();
    password_r_flag = (password_r == password) ? true : false;
}



// ----------------------------------------------------------------------------------------------------------


// ----------------------------------------------------------------------------------------------------------

var tele_error = $('<li>号码有误或已注册</li>');
var password_error = $('<li>密码不符合要求</li>');
var password_r_error = $('<li>密码不一致</li>');
var code_error = $('<li>验证码有误</li>');

function errorMsg()
{
    alert.parent().hide();
    alert.empty();
    if(tel_hasGo){
        if(!tel_cur){
            if(!tel_flag){
                alert.append(tele_error);
            }
        }
    }

    if(password_hasGo){
        if(!password_cur){
            if(!password_flag){
                alert.append(password_error);
            }
        }
    }

    if(password_r_hasGo){
        if(!password_r_cur){
            if(!password_r_flag){
                alert.append(password_r_error);
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
// 改变输入框后边的图标
// 设置tel-addon的图标
function tel_addon(){
    if(tel_flag){
        $('#tel_addon').html(ok);
    } else {
        $('#tel_addon').html(remove);
    }
}

// 设置password_addon的图标
function password_addon(){
    if(password_flag){
        $('#password_addon').html(ok);
    } else {
        $('#password_addon').html(remove);
    }
}


// 设置password_r_addon的图标
function password_r_addon(){
    if(password_r_flag){
        $('#password_r_addon').html(ok);
    } else {
        $('#password_r_addon').html(remove);
    }
}


// ----------------------------------------------------------------------------------------------------------

$(document).on({
    keyup:function(){ code_css();submit_css(); },
    mousemove:function(){ code_css();submit_css(); }
});

// 验证码输入框样式
function code_css(){
    if(hadClick){
        $('#code').removeAttr('disabled')
    }
}


// 提交按钮的样式
function submit_css()
{
    var status = tel_flag && code_flag && password_flag && password_r_flag
    if(status){
        $('#submit').removeClass('disabled').attr('type','submit');
    } else {
        $('#submit').addClass('disabled').attr('type','button');
    }
}


// ----------------------------------------------------------------------------------------------------------






// ----------------------------------------------------------------------------------------------------------




</script>
</body>
</html>
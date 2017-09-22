<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/home/logo_ico_16X16.ico') }}" media="screen">
    <title>{{ config('app.name') }} - 重置密码结果</title>
</head>
<body>

<div class="container" style="margin-top: 100px ">

    <div class="row">
        <div class="col-md-offset-2 col-md-6">

            <p>
                <div class="alert alert-info">
                    <ul>你正在重置密码</ul>
                </div>
            </p>
            <p>
                <form action="/doRestpasswordByEmail" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}

                    <input type="hidden" name="key" value="{{$key}}">
                    <input type="hidden" name="value" value="{{$value}}">

                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">新的密码</label>
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
                        <label for="password_r" class="col-sm-4 control-label">再次输入</label>
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
                            <button type="button" id="submit" class="btn btn-success btn-group-justified disabled">重置密码</button>
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

var password_cur = false;
var password_hasGo = false
var password_flag = false;


var password_r_cur = false;
var password_r_hasGo = false
var password_r_flag = false;



// ----------------------------------------------------------------------------------------------------


$('#password').on({
    focus:function(){
        password_cur = true;
        password_hasGo = true;
        password_flag = false;
        $(this).val(''); // 清空输入框的内容

    },

    keyup:function(){ password_func(); },
    change:function(){ password_func(); },
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

    keyup:function(){ password_r_func(); },
    change:function(){ password_r_func(); },
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

var password_error = $('<li>密码不符合要求</li>');
var password_r_error = $('<li>密码不一致</li>');

function errorMsg()
{


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


    if(alert.children().length){alert.parent().show();}
    
}

// ----------------------------------------------------------------------------------------------------------
// 改变输入框后边的图标
// 设置tel-addon的图标

// 设置password_r_addon的图标
function password_r_addon(){
    if(password_r_flag){
        $('#password_r_addon').html(ok);
    } else {
        $('#password_r_addon').html(remove);
    }
}

function password_addon(){
    if(password_flag){
        $('#password_addon').html(ok);
    } else {
        $('#password_addon').html(remove);
    }
}

// ----------------------------------------------------------------------------------------------------------

$(document).on({
    keyup:function(){ submit_css(); },
    mousemove:function(){ submit_css(); }
});




// 提交按钮的样式
function submit_css()
{
    var status = password_flag && password_r_flag
    if(status){
        $('#submit').removeClass('disabled').attr('type','submit');
    } else {
        $('#submit').addClass('disabled').attr('type','button');
    }
}

</script>
</body>
</html>
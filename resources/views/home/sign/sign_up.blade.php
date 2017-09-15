<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<div class="container" style="margin-top: 100px ">

    <div class="row">
        <div class="col-md-offset-2 col-md-6">

            <ul class="nav nav-tabs">
                <li><a href="{{url('/sign_in')}}">登录</a></li>
                <li class="active"><a href="{{url('/sign_up')}}">注册</a></li>
                <li><a href="{{url('/mobile_reset')}}">重置密码</a></li>
            </ul>

            <p>
                <form action="/doSignUp" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="tel" class="col-sm-4 control-label">手机号</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="tel" class="form-control" id="tel" aria-describedby="tel_addon" name="tel" value="{{ old('tel') }}" />
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
                                <input type="password" class="form-control" id="password" aria-describedby="password_addon" name="password" />
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
                                <input type="password" class="form-control" id="password_r" name="password_r" aria-describedby="password_r_addon" />
                                <span class="input-group-addon" id="password_r_addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                                </span>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="code" class="col-sm-4 control-label">验证码</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="code" name="code" />
                                <span class="input-group-btn">
                                    <button id="btn" class="btn btn-info disabled" type="button">点击获取手机验证码</button>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8"">
                            <button type="submit" class="btn btn-success btn-group-justified">注册</button>
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

    var ok = $('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
    var remove = $('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
    var asterisk = $('<span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>');

    var tel;
    var tel_flag = false;
    var password;
    var password_flag = false;
    var password_r;
    var password_r_flag = false;

    $('#tel').on({
        focus:function(){
            tel_flag = false;
            // password_flag = false;
            // password_r_flag = false;
            $('#tel_addon').html(asterisk);
        },
        blur:function(){
            var telReg = /^\d{11}$/;
            tel = $(this).val();
            tel_flag = telReg.test(tel);
            if( tel_flag ){
                $('#tel_addon').html(ok);
            } else {
                $('#tel_addon').html(remove);
            }


            $.ajax({
                url:"/tel",
                type:"POST",
                data:tel,
                dataType:"json",
                success:function(msg){
                    alert('YES');
                },
                error:function(){

                },
                beforeSend:function(){
                    
                }


            });
        }

    });


    $('#password').on({
        focus:function(){
            password_flag = false;
            password_r_flag = false;
            $(this).val('');
            $('#password_addon').html(asterisk);
        },

        blur:function(){
            var reg = /^\w{2,8}$/;
            password = $(this).val();
            password_flag = reg.test(password);
            if( password_flag ){
                $('#password_addon').html(ok);
            } else {
                $('#password_addon').html(remove);
            }
        }
    });

    $('#password_r').on({
        focus:function(){
            password_r_flag = false;
            $(this).val('');
            $('#password_r_addon').html(asterisk);
        },

        blur:function(){
            password_r = $(this).val();
            if( password_r && (password_r == password) ){
                $('#password_r_addon').html(ok);
                password_r_flag = true;
            } else {
                $('#password_r_addon').html(remove);
                password_r_flag = false;
            }
        }
    });

    $(document).mousemove(function(){
        if( tel_flag && password_flag && password_r_flag ){
            $('#btn').removeClass('disabled')
            // console.log('aa');
        } else {
            $('#btn').addClass('disabled');
            // console.log('bb');
        }
    });

    // $('#btn').mousemove(function(){
    //     if( tel_flag && password_flag && password_r_flag ){
    //         $(this).removeClass('disabled')
    //         console.log(111);
    //     } else {
    //         $(this).addClass('disabled');
    //         console.log(222);
    //     }
    // })



</script>
</body>
</html>
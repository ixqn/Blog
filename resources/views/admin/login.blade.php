<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>后台登录</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="{{asset('admin/assets/css/reset.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/supersized.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="page-container">
            <h1>超级管理员登录中心</h1>

            @if (count($errors) > 0)
                <div id="alertError" class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">错误!!</button>
                    <ul>
                        @if(is_object($errors))
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        @else
                            <li  style="color: red">{{ $errors }}</li>
                        @endif
                    </ul>
                </div><span></span>
            @endif

            <form action="{{url('admin/dologin')}}" method="post">
                {{csrf_field()}}
                <input type="text" name="nickname" class="nickname" placeholder="请输入你的用户名!" value="{{old('nickname')}}">
                <input type="password" name="password" class="password" placeholder="请输入你的密码!">
                <span>
                    <input type="captcha" style="width: 160px;"  name="captcha" class="captcha" placeholder="请输入验证码!">
                    <img src="{{url('admin/captcha')}}" onclick="this.src='{{url('admin/captcha')}}?'+Math.random()"alt="">
                </span>

                <button type="submit">登录</button>
            <div class="connect">

            </div>
        </div>
        <div align="center"></div>



        <!-- Javascript -->
        <script src="{{asset('admin/assets/js/jquery-1.8.2.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/supersized.3.2.7.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/supersized-init.js')}}"></script>
        <script src="{{asset('admin/assets/js/scripts.js')}}"></script>
        <script type="text/javascript">
                $('#alertError').fadeOut(3000);
            </script>

    </body>

</html>


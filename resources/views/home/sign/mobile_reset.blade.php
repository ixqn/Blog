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
                <li><a href="{{url('/sign_up')}}">注册</a></li>
                <li class="active"><a href="{{url('/mobile_reset')}}">重置密码</a></li>
            </ul>

            <p>
                <form action="/doSignUp" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="tel" class="col-sm-4 control-label">手机号</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="tel" class="form-control" id="tel" aria-describedby="tel-addon" name="tel" value="{{ old('tel') }}" />
                                <span class="input-group-addon" id="tel-addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">密码</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="password-addon" />
                                <span class="input-group-addon" id="password-addon">
                                    <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_r" class="col-sm-4 control-label">确认密码</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_r" name="password_r" aria-describedby="password_r-addon" />
                                <span class="input-group-addon" id="password_r-addon">
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
                                    <button class="btn btn-info disabled" type="button">点击获取手机验证码</button>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8"">
                            <button type="submit" class="btn btn-danger btn-group-justified">重置密码</button>
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
</body>
</html>
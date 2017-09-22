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
                <a class="btn btn-info" href="{{config('app.url')}}" role="button">点击去竹文首页</a>
            </p>

        </div>
        <div class="col-md-4">
        </div>

    </div>

</div>
<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
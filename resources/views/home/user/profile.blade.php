<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">

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
                                        <img src="xxx.jpg">
                                    </div>
                                </td> 
                                <td>
                                    <a>
                                        <input unselectable="on" type="file" class="hide">更改头像
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>昵称</td> 
                                <td><input type="text" placeholder="{{$user_info->sex}}"></td>
                            </tr>
                            <tr>
                                <td>性别</td> 
                                <td>
                                    <input type="radio" name="sex" @if($user_info->sex == 'w') echo 'checked'; @endif value="w">女
                                    <input type="radio" name="sex" @if($user_info->sex == 'm') echo 'checked'; @endif value="m">男
                                    <input type="radio" name="sex" @if($user_info->sex == 'x') echo 'checked'; @endif value="x">未知
                                </td>
                            </tr>

                            <tr>
                                <td>生日</td> 
                                <td><input type="text" placeholder="{{$user_info->birthday}}"></td>
                            </tr>

                            <tr>
                                <td>邮箱地址</td> 

                                <td class="setted">
                                    <span>{{$user_info->email}}</span>
                                    <span>已验证</span>
                                </td>

                                <!-- 
                                    <td>
                                        <form>
                                            <input type="email" placeholder="请输入你的常用邮箱">
                                            <input type="button" value="发送" class="btn pull-right"> 
                                        </form>
                                    </td>
                                -->
                            </tr>
                        </tbody>
                    </table> 

                    <input type="submit" class="btn btn-success setting-save" value="保存"> 
                </div>

                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>

</body>
</html>
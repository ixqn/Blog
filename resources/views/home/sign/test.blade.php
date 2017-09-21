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
<form method="post" action="/save/profile">

{{csrf_field()}}
nickname<input type="text" name="nickname">

sex
<input type="radio" name="sex" value="m">m
<input type="radio" name="sex" value="w">w
<input type="radio" name="sex" value="x">x

birthday<input type="date" name="birthday" value="2017-01-01">
email<input type="email" name="email">
<textarea name="desc"></textarea>
<input type="submit" value="提交">

</form>


<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
// 设置TOKEN值
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var nickname,
    sex,
    birthday,
    email,
    desc;

function save(){
    get();
    $.ajax({
        url:"/save/profile",
        type:"post",
        data:{
            "nickname":nickname,
            "sex":sex,
            "birthday":birthday,
            "email":email,
            "desc":desc
        },
        dataType:"json",
        // async:false,
        success:function(flag){ console.log(flag); } // 必须存在的手机号才可登录
    });

}

function get()
{
    nickname = $("input[name = 'nickname']").val();
    sex = $("input[name = sex").val();
    birthday= $("input[name = birthday").val();
    email = $("input[name = 'email']").val();
    desc = $("textarea[name = 'desc']").val();

}

</script>


</body>
</html>
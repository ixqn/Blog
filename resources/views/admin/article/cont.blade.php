<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #cont{

            border:1px solid transparency;
            position:relative;
            background:url('{{ url('/uploads/bg/1.jpg') }}') no-repeat;

            /*opacity:0.5;*/
            margin:0px;
            padding: 0px;
        }
        .box{
            color:red;
            width:800px;
            height:650px;
            border:1px solid transparency;
            position:absolute;
            left:300px;

        }
        .box1{
            width:300px;
            height:250px;
            border:1px solid transparency;
            position:absolute;
            left:500px;
            top:400px;
        }
        .box2{
            width:100px;
            height:100px;
            text-align:center;
            line-height:50px;
            border:1px solid transparency;
            background-color:cyan;
            position:absolute;
            left:1200px;
            top:500px;
            opacity:0.5;

        }


    </style>
</head>
<body id="cont">


            <div class="box">
                @foreach($datas as $item)
                <p>
                    {!! $item->article_cont !!}

                </p>
                <div class="box1">
                    <img src="{{ asset($item->article_img) }}" />
                </div>
               
                @endforeach

            </div>


            <div class="box2">

                <h4>
                    <a href="{{ url('admin/article') }}">返回</a>

                </h4>


            </div>



</body>
</html>
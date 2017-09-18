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
            width:1333px;
            height:800px;
            border:1px solid transparency;
            position:relative;
            background:url('{{ url('/uploads/bg/1.jpg') }}');
            margin:0px;
            padding: 0px;
        }
        .box{
            width:800px;
            height:800px;
            border:1px solid transparency;
            position:absolute;
            left:300px;

        }



    </style>
</head>
<body>
    <div id="cont">
        @foreach($datas as $item)
            <div class="box">

                <p>
                    {!! $item->article_cont !!}
                </p>


            </div>
        @endforeach

    </div>



</body>
</html>
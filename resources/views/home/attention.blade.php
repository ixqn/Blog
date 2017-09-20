@extends('Home.layout1')

@section('content')

    @foreach($wz as $k=>$v)
        <li id="note-17196189" data-note-id="17196189" class="have-img">
            {{--<a class="wrap-img" href="{{url('p')}}/{{$v->article_id}}" target="_blank">--}}
            {{--<img class="img-blur-done" src="{{ asset($v->article_img) }}" alt="120">--}}
            {{--</a>--}}
            <div class="content">
                <div class="author">
                    <a class="avatar" target="_blank" href="">
                        <img src="//upload.jianshu.io/users/upload_avatars/2929044/aa13193f2600.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/64/h/64" alt="64">
                    </a>
                    <div class="name">
                        <a class="blue-link" target="_blank" href="{{ url('/home/userarticle') }}/{{ $v->user_id }}">{{ $v->article_author }}</a>
                        <span class="time" data-shared-at="{{ $v->article_at }}">{{ $v->article_at }}</span>
                    </div>
                </div>
                <a class="title" target="_blank" href="{{ url('/p') }}/{{ $v->article_id }}"> {{ $v->article_name }}</a>
                <p class="abstract">
                    {{ $v->article_cont }}
                </p>
                <div class="meta">
                    <a class="collection-tag" target="_blank" href="/c/20f7f4031550">社会热点</a>
                    <a target="_blank" href="">
                        <i class="iconfont ic-list-read"></i> 1003
                    </a>        <a target="_blank" href="">
                        <i class="iconfont ic-list-comments"></i> 21
                    </a>      <span><i class="iconfont ic-list-like"></i> 29</span>
                </div>
            </div>
        </li>
    @endforeach

<link rel="stylesheet" media="all" href="{{ asset('./css/web-1520e0147b6838647211.css') }}">

<link rel="stylesheet" media="all" href="{{ asset('./css/entry-b8b6c8d0b3aed7579000.css') }}">

@stop



@section('js')

    {{--<script>--}}


        {{--function wzh(attension_user_id)--}}
        {{--{--}}
            {{--console.log(attension_user_id);--}}


            {{--$.post('{{ url('home/attention/index') }}/' + attension_user_id , {--}}
               {{--'_token':'{{csrf_token()}}'--}}
            {{--},function (data) {--}}

            {{--});--}}
        {{--}--}}
{{--   </script>--}}



@stop



<!---->
</body>
</html>




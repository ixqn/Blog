@extends('Home.layout')

@section('content')



    <div class="container bookmarks" id="js-page-top">
    <div class="row">
        <div class="col-xs-18 col-xs-offset-3 main">
            <img class="tag-banner" src="{{ asset('./image/collect-note-955d8c71641a360924390da9da4b0151.png') }}" alt="Collect note" />
            <!-- 文章列表模块 -->
            <ul class="note-list">
                @foreach($str as $k=>$v)

                <li id="note-16956517" data-note-id="16956517" class="have-img">
                    <a class="wrap-img" href="/p/af4ff46a94c6" target="_blank">
                        <img data-echo="//upload-images.jianshu.io/upload_images/6264704-0d3d471b1c86eb78.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('./image/6264704-0d3d471b1c86eb78.jpg') }}" alt="120" />
                    </a>
                    <div class="content">
                        <div class="author">
                            <a class="avatar" target="_blank" href="/u/752d989d077d">
                                <img src="{{ asset('./image/a6b2dab2-2d2c-4739-adc0-b688e6b795a5.jpg') }}" alt="64" />
                            </a>      <div class="name">
                                <a class="blue-link" target="_blank" href="{{ url('home/userarticle') }}/{{ $v->user_id }}">
                                    {{ $v->article_author }}
                                </a>
                                <span class="time" data-shared-at="2017-09-11T23:29:13+08:00"></span>
                            </div>
                        </div>
                        <a class="title" target="_blank" href="{{ url('/p') }}/{{ $v->article_id }}">
                            {{ $v->article_name }}
                        </a>
                        <p class="abstract">
                            {{ $v->article_cont }}
                        </p>

                            {{--<a class="cancel" href="{{ url('/home/collect/delete') }}/{{ $item->article_id }}">取消收藏</a>--}}
                            <a class="cancel" href="javascript:;" onclick="del({{ $v->article_id }})">取消收藏</a>



                    </div>
                </li>
                @endforeach


            </ul>
        </div>
    </div>
    <div>
        <ul class="pagination"></ul>
    </div>
    <div data-vcomp="side-tool"></div>
</div>


@stop



@section('js')
<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<script>
function del(article_id)
     {
         layer.cofirm('你是否要取消收藏?' , {
             btn:['是的,我要取消' , '不行,我不取消']
         } , function()
         {
             $.post = ('{{ url('/home/collect/delete') }}/'+article_id , {
                 '_token':{{ csrf_token() }}
             } , function(data){
                 if (data.state == 0) {
                     layer.msg(data.msg, {icon: 6});
                     location.href = location.href;
                 } else {
                     layer.msg(data.msg, {icon: 5});
                 }

             });
         } , function(){});
     }
</script>
@stop


<!---->
</body>
</html>

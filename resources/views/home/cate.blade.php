@extends('home.layout')

@section('content')

<div class="container recommend">
    <img class="recommend-banner" src="{{asset('home/images/picture/recommend-collection-58f8968955ecbeb8f8f3b4cd95ec76be.png')}}" alt="Recommend collection" />
      <ul class="trigger-menu" data-pjax-container="#list-container">
          <li class="active">
              <a data-order-by="recommend" href="/recommendations/collections?order_by=recommend">
                  <i class="iconfont ic-recommend"></i> 推荐</a>
          </li>


      </ul>

    <div class="row" id="list-container">


        @foreach($cates as $item)
        <div class="col-xs-8">
            <div class="collection-wrap">
                <a target="_blank" href="{{url('c')}}/{{$item->cate_id}}">
                    <img class="avatar-collection" src="{{ url('/uploads/category').'/'. $item->cate_pic  }}" alt="180" />
                    <h4 class="name">{{ $item->cate_name }}</h4>
                    <p class="collection-description">
                        {{ $item->cate_description }}
                    </p>
                </a>    <a class="follow-btn" props-data-following="false" props-data-collection-id="4"></a>
                <hr>
                <div class="count"><a target="_blank" href="/c/yD9GAd">124366篇文章</a></div>
            </div>
        </div>
        @endforeach





    </div>


</div>


@stop


@section('js')

    <script>
        layui.use(['util'], function(){
            var util = layui.util,
                $ = layui.jquery;

            //固定块
            util.fixbar({
                css: {right: 50, bottom: 100}
                ,bgcolor: '#393D49'
                ,click: function(type){
                    if(type === 'bar1'){
                        layer.msg('icon是可以随便换的')
                    } else if(type === 'bar2') {
                        layer.msg('两个bar都可以设定是否开启')
                    }
                }
            });

        });
    </script>

@stop
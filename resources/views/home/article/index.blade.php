@extends('home.layout')

@section('content')

    <div class="note">
        <div class="post">
            <div class="article">
                <h1 class="title">{{ $article['article_name'] }}</h1>

                <!-- 作者区域 -->
                <div class="author">
                    <a class="avatar" href="{{url('u')}}/{{$article['user_id']}}">
                        <img src="{{ asset($article['user']['pic']) }}" alt="96">
                    </a>          <div class="info">
                        {{--<span class="tag">签约作者</span>--}}
                        <span class="name"><a href="{{url('u')}}/{{$article['user_id']}}">{{ $article['article_author'] }}</a></span>
                        <!-- 关注用户按钮 -->
                        {{--<a class="btn btn-success follow"><i class="iconfont ic-follow"></i><span>关注</span></a>--}}
                        <!-- 文章数据信息 -->
                        <div class="meta">
                            <!-- 如果文章更新时间大于发布时间，那么使用 tooltip 显示更新时间 -->
                            <span class="publish-time" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="最后编辑于 {{ $article['article_up'] }}">{{ $article['article_at'] }}</span>
                            <span class="wordage">字数 {{ $article['length'] }}</span>
                            <span class="views-count">阅读 {{ $article['article_view'] }}</span><span class="comments-count">评论 100</span></div>
                    </div>
                    <!-- 如果是当前作者，加入编辑按钮 -->
                </div>
                <!-- -->

                <!-- 文章内容 -->
                <div data-note-content="" class="show-content">
                        {{--<div class="RichContent-inner">很喜欢，美国一位摄影师的一句话：“我常想，如果我拍了足够多的照片，我就不会再失去任何人。”</div>--}}
                        {{--<div class="image-package">--}}
                            {{--<img src="//upload-images.jianshu.io/upload_images/3459828-e1daf1a93191db9c.jpg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240" style="cursor: zoom-in;">--}}
                            {{--<br>--}}
                            {{--<div class="image-caption">图片发自竹文App</div>--}}
                        {{--</div>--}}
                            {!! $article['article_cont'] !!}
                <!--  -->

                <div class="show-foot">
                    <a class="notebook" href="/nb/7168960">
                        <i class="iconfont ic-search-notebook"></i> <span>{{ $article['article_cate'] }}</span>
                    </a>          <div class="copyright" data-toggle="tooltip" data-html="true" data-original-title="转载请联系作者获得授权，并标注“竹文作者”。">
                        © 著作权归作者所有
                    </div>
                    <div class="modal-wrap" data-report-note="">
                        <a id="report-modal">举报文章</a>
                    </div>
                </div>
            </div>

            <!-- 文章底部作者信息 -->
            <div class="follow-detail">
                <div class="info">
                    <a class="avatar" href="{{url('u')}}/{{$article['user_id']}}">
                        <img src="{{ asset($article['user']['pic']) }}" alt="96">
                    </a>          <a class="btn btn-success follow"><i class="iconfont ic-follow"></i><span>关注</span></a>
                    <a class="title" href="{{url('u')}}/{{$article['user_id']}}">{{ $article['article_author'] }}</a>
                    <i class="iconfont @if ($article['user']['sex'] == 'm') ic-man @elseif($article['user']['sex'] == 'w') ic-woman @else @endif "></i>
                    <p>写了 {{ $article['number'] }} 篇文章，被 42301 人关注</p></div>
                <div class="signature">{{ $article['user']['desc'] }}</div>
            </div>

            <div class="meta-bottom">
                <div class="share-group">
                    <a class="share-circle" data-action="weixin-share" data-toggle="tooltip" data-original-title="分享到微信">
                        <i class="iconfont ic-wechat"></i>
                    </a>
                    <a class="share-circle" data-action="weibo-share" data-toggle="tooltip" href="javascript:void((function(s,d,e,r,l,p,t,z,c){var%20f='http://v.t.sina.com.cn/share/share.php?appkey=1881139527',u=z||d.location,p=['&amp;url=',e(u),'&amp;title=',e(t||d.title),'&amp;source=',e(r),'&amp;sourceUrl=',e(l),'&amp;content=',c||'gb2312','&amp;pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=440,height=430,left=',(s.width-440)/2,',top=',(s.height-430)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','http://cwb.assets.jianshu.io/notes/images/17215403/weibo/image_64891375e033.jpg', '推荐 @大萌摄影哇 的文章《我拍了100张一眼忘不掉的陌生人（3）》（ 分享自 @竹文 ）','http://www.jianshu.com/p/568146cddd74?utm_campaign=maleskine&amp;utm_content=note&amp;utm_medium=reader_share&amp;utm_source=weibo','页面编码gb2312|utf-8默认gb2312'));" data-original-title="分享到微博">
                        <i class="iconfont ic-weibo"></i>
                    </a>
                    <a class="share-circle" data-toggle="tooltip" href="http://cwb.assets.jianshu.io/notes/images/17215403/weibo/image_64891375e033.jpg" target="_blank" data-original-title="下载长微博图片">
                        <i class="iconfont ic-picture"></i>
                    </a>
                    <a class="share-circle more-share" tabindex="0" data-toggle="popover" data-placement="top" data-html="true" data-trigger="focus" href="javascript:void(0);" data-content="
          <ul class=&quot;share-list&quot;>
            <li><a href=&quot;javascript:void(function(){var d=document,e=encodeURIComponent,r='http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+e('http://www.jianshu.com/p/568146cddd74?utm_campaign=maleskine&amp;utm_content=note&amp;utm_medium=reader_share&amp;utm_source=qzone')+'&amp;title='+e('推荐 有备而来的路人甲 的文章《我拍了100张一眼忘不掉的陌生人（3）》'),x=function(){if(!window.open(r,'qzone','toolbar=0,resizable=1,scrollbars=yes,status=1,width=600,height=600'))location.href=r};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})();&quot;><i class=&quot;social-icon-sprite social-icon-zone&quot;></i><span>分享到QQ空间</span></a></li>
            <li><a href=&quot;javascript:void(function(){var d=document,e=encodeURIComponent,r='https://twitter.com/share?url='+e('http://www.jianshu.com/p/568146cddd74?utm_campaign=maleskine&amp;utm_content=note&amp;utm_medium=reader_share&amp;utm_source=twitter')+'&amp;text='+e('推荐 有备而来的路人甲 的文章《我拍了100张一眼忘不掉的陌生人（3）》（ 分享自 @jianshucom ）')+'&amp;related='+e('jianshucom'),x=function(){if(!window.open(r,'twitter','toolbar=0,resizable=1,scrollbars=yes,status=1,width=600,height=600'))location.href=r};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})();&quot;><i class=&quot;social-icon-sprite social-icon-twitter&quot;></i><span>分享到Twitter</span></a></li>
            <li><a href=&quot;javascript:void(function(){var d=document,e=encodeURIComponent,r='https://www.facebook.com/dialog/share?app_id=483126645039390&amp;display=popup&amp;href=http://www.jianshu.com/p/568146cddd74?utm_campaign=maleskine&amp;utm_content=note&amp;utm_medium=reader_share&amp;utm_source=facebook',x=function(){if(!window.open(r,'facebook','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})();&quot;><i class=&quot;social-icon-sprite social-icon-facebook&quot;></i><span>分享到Facebook</span></a></li>
            <li><a href=&quot;javascript:void(function(){var d=document,e=encodeURIComponent,r='https://plus.google.com/share?url='+e('http://www.jianshu.com/p/568146cddd74?utm_campaign=maleskine&amp;utm_content=note&amp;utm_medium=reader_share&amp;utm_source=google_plus'),x=function(){if(!window.open(r,'google_plus','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})();&quot;><i class=&quot;social-icon-sprite social-icon-google&quot;></i><span>分享到Google+</span></a></li>
            <li><a href=&quot;javascript:void(function(){var d=document,e=encodeURIComponent,s1=window.getSelection,s2=d.getSelection,s3=d.selection,s=s1?s1():s2?s2():s3?s3.createRange().text:'',r='http://www.douban.com/recommend/?url='+e('http://www.jianshu.com/p/568146cddd74?utm_campaign=maleskine&amp;utm_content=note&amp;utm_medium=reader_share&amp;utm_source=douban')+'&amp;title='+e('我拍了100张一眼忘不掉的陌生人（3）')+'&amp;sel='+e(s)+'&amp;v=1',x=function(){if(!window.open(r,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330'))location.href=r+'&amp;r=1'};if(/Firefox/.test(navigator.userAgent)){setTimeout(x,0)}else{x()}})()&quot;><i class=&quot;social-icon-sprite social-icon-douban&quot;></i><span>分享到豆瓣</span></a></li>
          </ul>
        " data-original-title="" title="">更多分享</a>
                </div>
            </div>
            <div id="comment-list" class="comment-list">
                <div>
                    <form class="new-comment">
                        <a class="avatar">
                            <img src="//upload.jianshu.io/users/upload_avatars/7685793/72f15e83-7f50-45ab-af3a-d031fb4e8934.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/114/h/114">
                        </a>
                        <textarea placeholder="写下你的评论..."></textarea>
                    </form>
                </div>
                <div id="normal-comment-list" class="normal-comment-list">
                    <div>
                        <div>
                            <div class="top">
                                <span>2条评论</span>
                            </div>
                        </div>
                        <div id="comment-15281044" class="comment">
                            <div><div class="author">
                                    <a href="/u/a3ea268aeb60" target="_blank" class="avatar">
                                        <img src="//upload.jianshu.io/users/upload_avatars/4976516/6bd1501b-6cf2-42d8-b1d0-d77086f22f3d.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/114/h/114">
                                    </a>
                                    <div class="info">
                                        <a href="/u/a3ea268aeb60" target="_blank" class="name">东风冷雪</a>
                                        <div class="meta">
                                            <span>2楼 · 2017.09.18 14:29</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-wrap">
                                    <p>你是不是数据有误🙄？<br>还是竹文写文的为了吸人眼球，或者太年轻，差评的有<br>琅琊榜，人民的名义，大秦帝国，活着。<br>。。。 <br>写文的都是喷子嘛</p>
                                    <div class="tool-group">
                                        <a class="">
                                            <i class="iconfont ic-comment"></i>
                                            <span>回复</span>
                                        </a>
                                        <a class="report">
                                            <span>举报</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-comment-list">
                                <div id="comment-15281312" class="sub-comment">
                                    <p>
                                        <a href="/u/6d0fa98e3d84" target="_blank">hirainchen</a>：
                                        <span>
                                            <a href="/users/a3ea268aeb60" class="maleskine-author" target="_blank" data-user-slug="a3ea268aeb60">
                                                @东风冷雪
                                            </a>
                                            有几种原因，一个是提取的评论句子是负面剧情内容，二是模型预测错误（因为训练数据不够），三是如你说的，有作者标新立异。
                                        </span>
                                    </p>
                                    <div class="sub-tool-group"><span>2017.09.18 14:38</span>
                                        <a class="">
                                            <i class="iconfont ic-comment">

                                            </i>
                                            <span>回复</span>
                                        </a>
                                        <a class="report">
                                            <span>举报</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="sub-comment more-comment">
                                    <a class="add-comment-btn"
                                    <i class="iconfont ic-subcomment"></i>
                                    <span>添加新评论</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>

                </div>
            </div>

        </div>

    </div>

@stop

@section('js')

<script>
    layui.use(['util','layer'], function(){
        var util = layui.util,
            layer = layui.layer,
            $ = layui.jquery;
    
        //固定块
        util.fixbar({
            bar1: '&#xe600;'
            ,bar2: '&#xe641;'
            ,css: {right: 50, bottom: 100}
            ,bgcolor: '#393D49'
            ,click: function(type){
                if(type === 'bar1'){
                    layer.msg('icon是可以随便换的')
                } else if(type === 'bar2') {
                    layer.msg('两个bar都可以设定是否开启')
                }
            }
        });

        // 取消导航选中状态.
        $('.nav .active').attr('class', '');
    });
</script>

@stop
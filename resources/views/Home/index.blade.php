@extends('Home.layout')

@section('content')

    <div class="container index">
        <div class="row">

            <div class="layui-carousel" id="Carousel">
                <div carousel-item="">
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/1.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/2.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/3.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/4.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/5.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/6.png"></a></div>
                    <div><a target="_blank" href=""><img src="//res.layui.com/images/layui/demo/7.png"></a></div>
                </div>
            </div>

            <div class="col-xs-16 main">
                <!--分类-->
                <div class="recommend-collection">
                    <a class="collection" target="_blank" href="/c/b3734232a706?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/1.png') }}" alt="64" />
                        <div class="name">微小说</div>
                    </a>            <a class="collection" target="_blank" href="/c/GQ5FAs?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/66ba9fdegw1e61syw6tk6j20bj0go0wo.jpg') }}" alt="64" />
                        <div class="name">谈谈情，说说爱</div>
                    </a>            <a class="collection" target="_blank" href="/c/074e475b2f45?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/vcg41678819337.jpg') }}" alt="64" />
                        <div class="name">成长励志</div>
                    </a>            <a class="collection" target="_blank" href="/c/f6b4ca4bb891?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/enhanced-buzz-wide-16461-1372163238-8.jpg') }}" alt="64" />
                        <div class="name">生活家</div>
                    </a>            <a class="collection" target="_blank" href="/c/Df7njb?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/2005503_162125081_2.jpg') }}" alt="64" />
                        <div class="name">谈写作</div>
                    </a>            <a class="collection" target="_blank" href="/c/bc2986022c08?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/0714.jpg') }}" alt="64" />
                        <div class="name">时差党</div>
                    </a>            <a class="collection" target="_blank" href="/c/8c92f845cd4d?utm_medium=index-collections&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/漫画专题.jpg') }}" alt="64" />
                        <div class="name">漫画·手绘</div>
                    </a>
                    <a class="more-hot-collection" target="_blank" href="/recommendations/collections?utm_medium=index-collections&amp;utm_source=desktop">
                        更多热门专题 <i class="iconfont ic-link"></i>
                    </a>
                </div>
                <!--分类-->
                <div class="split-line"></div>
                <div id="list-container">
                    <!-- 文章列表模块 -->
                    <ul class="note-list" infinite-scroll-url="/">

                        <li id="note-16955910" data-note-id="16955910" class="have-img">
                            <a class="wrap-img" href="/p/db108ecdc5a9" target="_blank">
                                <img data-echo="//upload-images.jianshu.io/upload_images/7422492-045606f11f4f513a.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('home/images/picture/7422492-045606f11f4f513a.jpg') }}" alt="120" />
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="/u/546f95e0a658">
                                        <img src="{{ asset('home/images/picture/359a9250-bf6f-4cf9-ab26-8bd0cb9d3cfd.jpg') }}" alt="64" />
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="/u/546f95e0a658">米那</a>
                                        <span class="time" data-shared-at="2017-09-11T20:09:17+08:00"></span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="/p/db108ecdc5a9">在简书学写作，我学会了撩汉子</a>
                                <p class="abstract">
                                    世间最好的爱情莫过于，我就喜欢你本来的样子。在男神面前，我也还得是我。 2017年9月11日  星期一   晴 01 去年的5月20日，我吃完最后一块生日蛋糕，然后腆着圆鼓鼓...
                                </p>
                                <div class="meta">
                                    <a class="collection-tag" target="_blank" href="/c/71a87e510a58">今夜日记</a>
                                    <a target="_blank" href="/p/db108ecdc5a9">
                                        <i class="iconfont ic-list-read"></i> 5131
                                    </a>        <a target="_blank" href="/p/db108ecdc5a9#comments">
                                        <i class="iconfont ic-list-comments"></i> 319
                                    </a>      <span><i class="iconfont ic-list-like"></i> 379</span>
                                    <span><i class="iconfont ic-list-money"></i> 8</span>
                                </div>
                            </div>
                        </li>

                        <li id="note-17057503" data-note-id="17057503" class="have-img">
                            <a class="wrap-img" href="/p/09f4c707e95c" target="_blank">
                                <img data-echo="//upload-images.jianshu.io/upload_images/2998364-eb591f528bcc5305.png?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('home/images/picture/2998364-eb591f528bcc5305.png') }}" alt="120" />
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="/u/92eb338437ee">
                                        <img src="{{ asset('home/images/picture/9f8351c3734b.jpg') }}" alt="64" />
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="/u/92eb338437ee">道长是名思维贩子</a>
                                        <span class="time" data-shared-at="2017-09-14T09:25:30+08:00"></span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="/p/09f4c707e95c">如何把一件事讲得言简意赅，语出惊人，少即是多</a>
                                <p class="abstract">
                                    01 你知道吗？一年时间，你会说出一千万句话。 但是为什么？你却很难拥有“讲清楚一件事”这项技能。 你经常发现，对一件事描述了半天。别人却满脸懵逼：你到底在说什么？ 无印良品...
                                </p>
                                <div class="meta">
                                    <a class="collection-tag" target="_blank" href="/c/8fQvXW">心理</a>
                                    <a target="_blank" href="/p/09f4c707e95c">
                                        <i class="iconfont ic-list-read"></i> 8067
                                    </a>        <a target="_blank" href="/p/09f4c707e95c#comments">
                                        <i class="iconfont ic-list-comments"></i> 119
                                    </a>      <span><i class="iconfont ic-list-like"></i> 626</span>
                                    <span><i class="iconfont ic-list-money"></i> 3</span>
                                </div>
                            </div>
                        </li>

                        <li id="note-17114483" data-note-id="17114483" class="have-img">
                            <a class="wrap-img" href="/p/f0c63844cb54" target="_blank">
                                <img data-echo="//upload-images.jianshu.io/upload_images/6539412-503c358a5919e5d5.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('home/images/picture/6539412-503c358a5919e5d5.jpg') }}" alt="120" />
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="/u/62fc150bab96">
                                        <img src="{{ asset('home/images/picture/ce52dd2abe974f83b4f28f2a0938d0b0.gif') }}" alt="64" />
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="/u/62fc150bab96">琪官Kafka</a>
                                        <span class="time" data-shared-at="2017-09-15T14:47:37+08:00"></span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="/p/f0c63844cb54">我将在这个周末死去（19）从黑暗的衣柜里脱身而出</a>
                                <p class="abstract">
                                    Chapter19 从黑暗的衣柜里脱身而出 心电监护仪依旧发出均匀的“嘀——嘀——”声，花田还没有回来，病床上老妇人的左手依然紧紧地拽住我的手，向我传递着某种摩尔斯电码，尽管...
                                </p>
                                <div class="meta">
                                    <a class="collection-tag" target="_blank" href="/c/318ae1a9e036">简书出版</a>
                                    <a target="_blank" href="/p/f0c63844cb54">
                                        <i class="iconfont ic-list-read"></i> 326
                                    </a>        <a target="_blank" href="/p/f0c63844cb54#comments">
                                        <i class="iconfont ic-list-comments"></i> 4
                                    </a>      <span><i class="iconfont ic-list-like"></i> 6</span>
                                </div>
                            </div>
                        </li>

                        <li id="note-17067703" data-note-id="17067703" class="have-img">
                            <a class="wrap-img" href="/p/e48a35c97240" target="_blank">
                                <img data-echo="//upload-images.jianshu.io/upload_images/4287007-86f73dbb2c37d460.png?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('home/images/picture/4287007-86f73dbb2c37d460.png') }}" alt="120" />
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="/u/f666aefcc318">
                                        <img src="{{ asset('home/images/picture/b7b9c810-069e-4385-aec7-1823e94ee43d.jpg') }}" alt="64" />
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="/u/f666aefcc318">晖宗聊绘画</a>
                                        <span class="time" data-shared-at="2017-09-14T12:06:50+08:00"></span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="/p/e48a35c97240">一位李老头的“麻烦”之作</a>
                                <p class="abstract">
                                    文/晖宗 赏绘画，读故事，晖宗聊绘画又和大家见面了。话说五代到北宋之间有一位画家，他的名字叫做李成，此人的绘画在当时就很名贵，后来他去世后，留存于世的画作十分稀少，于是很多人...
                                </p>
                                <div class="meta">
                                    <a class="collection-tag" target="_blank" href="/c/e7d2d4045b36">历史</a>
                                    <a target="_blank" href="/p/e48a35c97240">
                                        <i class="iconfont ic-list-read"></i> 1228
                                    </a>        <a target="_blank" href="/p/e48a35c97240#comments">
                                        <i class="iconfont ic-list-comments"></i> 6
                                    </a>      <span><i class="iconfont ic-list-like"></i> 13</span>
                                </div>
                            </div>
                        </li>

                        <li id="note-17064481" data-note-id="17064481" class="have-img">
                            <a class="wrap-img" href="/p/a1e7d5999122" target="_blank">
                                <img data-echo="//upload-images.jianshu.io/upload_images/7663825-1235c66ee07f9fe9.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/300/h/240" class="img-blur" src="{{ asset('home/images/picture/7663825-1235c66ee07f9fe9.jpg') }}" alt="120" />
                            </a>
                            <div class="content">
                                <div class="author">
                                    <a class="avatar" target="_blank" href="/u/78f970537a5e">
                                        <img src="{{ asset('home/images/picture/7c28763e-002b-4e89-8dea-5b8da210ef2c.jpg') }}" alt="64" />
                                    </a>      <div class="name">
                                        <a class="blue-link" target="_blank" href="/u/78f970537a5e">名贵的考拉熊</a>
                                        <span class="time" data-shared-at="2017-09-14T11:04:49+08:00"></span>
                                    </div>
                                </div>
                                <a class="title" target="_blank" href="/p/a1e7d5999122">北京偏北</a>
                                <p class="abstract">
                                    我不会忘记那个没有月亮的夜晚，李渡笃定地告诉我，我们是害虫。 怎么讲？ 从很久很久以前开始，人们就和害虫不共戴天，踩它，碾它，希冀着老死不相往来。可是害虫永远坚守着，伺机抢夺...
                                </p>
                                <div class="meta">
                                    <a class="collection-tag" target="_blank" href="/c/dqfRwQ">短篇小说</a>
                                    <a target="_blank" href="/p/a1e7d5999122">
                                        <i class="iconfont ic-list-read"></i> 4121
                                    </a>        <a target="_blank" href="/p/a1e7d5999122#comments">
                                        <i class="iconfont ic-list-comments"></i> 96
                                    </a>      <span><i class="iconfont ic-list-like"></i> 157</span>
                                    <span><i class="iconfont ic-list-money"></i> 3</span>
                                </div>
                            </div>
                        </li>

                    </ul>
                    <!-- 文章列表模块 -->
                </div>
            </div>
            <div class="col-xs-7 col-xs-offset-1 aside">
                <div class="board">
                    <a target="_blank" href="/recommendations/notes?category_id=56&amp;utm_medium=index-banner-s&amp;utm_source=desktop">
                        <img src="{{ asset('home/images/picture/banner-s-1-b8ff9ec59f72ea88ecc8c42956f41f78.png') }}" alt="Banner s 1" />
                    </a>        <a target="_blank" href="/trending/weekly?utm_medium=index-banner-s&amp;utm_source=desktop"><img src="{{ asset('home/images/picture/banner-s-3-7123fd94750759acf7eca05b871e9d17.png') }}" alt="Banner s 3" /></a>
                    <a target="_blank" href="/trending/monthly?utm_medium=index-banner-s&amp;utm_source=desktop"><img src="{{ asset('home/images/picture/banner-s-4-b70da70d679593510ac93a172dfbaeaa.png') }}" alt="Banner s 4" /></a>
                    <a utm_medium="index-banner-s" target="_blank" href="/publications"><img src="{{ asset('home/images/picture/banner-s-5-291e00e9156f30791fe24e3de9c39171.png') }}" alt="Banner s 5" /></a>
                    <a target="_blank" href="/c/e048f1a72e3d?utm_medium=index-banner-s&amp;utm_source=desktop"><img src="{{ asset('home/images/picture/banner-s-6-c4d6335bfd688f2ca1115b42b04c28a7.png') }}" alt="Banner s 6" /></a>
                </div>

                <!-- 推荐作者 -->
                <div class="recommended-authors">
                    <div class="title"><span>推荐作者</span>
                        <a class="page-change"><i class="iconfont ic-search-change" style="transform: rotate(0deg);"></i>
                            换一批
                        </a>
                    </div>
                    <ul class="list">
                        <li>
                            <a href="/u/78f970537a5e?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/7663825/7c28763e-002b-4e89-8dea-5b8da210ef2c.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/78f970537a5e?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">名贵的考拉熊</a>
                            <p>写了44.2k字 · 2.1k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/3aa040bf0610?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/1835826/fcfb7cdd47bd.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/3aa040bf0610?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">简书播客</a>
                            <p>写了73.1k字 · 4.6k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/c5580cc1c3f4?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/3627484/eb973bb9-37ba-4d07-acec-850c0a66d1bb.png?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/c5580cc1c3f4?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">简书大学堂</a>
                            <p>写了49.6k字 · 2.7k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/5SqsuF?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/6287/06c537002583.png?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96"
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/5SqsuF?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">刘淼</a>
                            <p>写了323.8k字 · 19.5k喜欢</p>
                        </li>
                        <li>
                            <a href="/u/8f5b45499715?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="avatar">
                                <img src="//upload.jianshu.io/users/upload_avatars/52841/b76eb3e77507.jpg?imageMogr2/auto-orient/strip|imageView2/1/w/96/h/96">
                            </a>
                            <a class="follow" state="0"><i class="iconfont ic-follow"></i>关注</a>
                            <a href="/u/8f5b45499715?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="name">闫泽华</a>
                            <p>写了123.2k字 · 1k喜欢</p>
                        </li>
                    </ul>
                    <a href="/recommendations/users?utm_source=desktop&amp;utm_medium=index-users" target="_blank" class="find-more">
                        查看全部<i class="iconfont ic-link"></i></a></div>
            </div>
        </div>
    </div>

@stop


@section('js')

    <script>
        layui.use(['carousel'], function(){
            var carousel = layui.carousel,
                $ = layui.jquery;

            //图片轮播
            carousel.render({
                elem: '#Carousel'
                ,width: '99%'
                ,interval: 5000
            });

        });
    </script>

@stop

@extends('Home.layout')

@section('content')


<div id="notifications" class="content"></div>


@stop



@section('js')

<script type="application/json" data-name="page-data">{"user_signed_in":true,"locale":"zh-CN","os":"other","read_mode":"day","read_font":"font2","current_user":{"id":7685793,"nickname":"UnaH","slug":"d6fc8a033b98","avatar":"http://upload.jianshu.io/users/upload_avatars/7685793/72f15e83-7f50-45ab-af3a-d031fb4e8934.jpg","unread_counts":{"chats":0,"total":0}}}</script>

<script src="{{ asset('./js/babel-polyfill-8053f0c4c81c27b7aff2.js') }}"></script>
<script src="{{ asset('./js/web-base-b320bf388d58589cee5a.js')}}"></script>
<script src="{{ asset('./js/web-2e3a2c956af037d7f010.js') }}"></script>

<script src="{{ asset('./js/entry-6bddace74b7f6a8490a6.js') }}"></script>

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

<script type = 'text/javascript' id ='1qa2ws' charset='utf-8' src='{{ asset('./js/base.js') }}'></script>

@stop

</body>
</html>

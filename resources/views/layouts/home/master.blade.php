<html>
<head>
    <title>Sunday</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

    <script src="/js/bootstrap.min.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
@section('sidebar')
    <div class="banner">
        {{--<img src="/images/1.jpg" style="width:100%;height: 80%;">--}}
    </div>
    <div class="nav" id="nav">
        <div class="logo">
            <img src="/image/logo.png" id ="logo" style="width: 150px;height: 80px;display: block;">
            <img src="/image/logo2.png" id ="logo2" style="width: 150px;height: 80px;display: none;">
        </div>
        <div class="menu">
            <ul>
                <li>&nbsp;首页&nbsp;</li>
                <li>&nbsp;分享&nbsp;</li>
                <li>&nbsp;随心&nbsp;</li>
                <li>&nbsp;闲谈&nbsp;</li>
                <li>&nbsp;关于&nbsp;</li>
                <li><input type="text" class="search" id="search"/></li>
                <li><i class="glyphicon glyphicon-search"></i></li>
            </ul>
        </div>
    </div>
    {{--<nav class="navbar navbar-default  navbar-fixed-top" role="navigation">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="navbar-header">--}}
                {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">--}}
                    {{--<span class="sr-only">Toggle navigation</span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                    {{--<span class="icon-bar"></span>--}}
                {{--</button>--}}
                {{--<a class="navbar-brand" href="/">Sunday</a>--}}
            {{--</div>--}}
            {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}
                {{--<ul class="nav navbar-nav navbar-right">--}}
                    {{--@if(Auth::guest())--}}
                        {{--<li><a href="/login">登录</a></li>--}}
                        {{--<li><a href="/register">注册</a></li>--}}
                    {{--@else--}}
                        {{--<li><a href="/order">写文章 <span class="fa fa-briefcase"></span></a></li>--}}
                        {{--<li><a href="/order">我的订单 <span class="fa fa-briefcase"></span></a></li>--}}
                        {{--<li><a href="/cart">购物车 <span class="fa fa-shopping-cart"></span></a></li>--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                            {{--</a>--}}

                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--<li>--}}
                                    {{--<a href="{{ url('/logout') }}"--}}
                                       {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                                        {{--退出--}}
                                    {{--</a>--}}

                                    {{--<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">--}}
                                        {{--{{ csrf_field() }}--}}
                                    {{--</form>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
            {{--</div><!-- /.navbar-collapse -->--}}
        {{--</div><!-- /.container-fluid -->--}}
    {{--</nav>--}}
@show

<div class="container">
    @yield('content')
</div>
</body>
<script>
    $(document).scroll(function(){
        var nav = document.getElementById('nav');
        var logo = document.getElementById('logo');
        var logo2 = document.getElementById('logo2');
        var search = document.getElementById('search');
        if($(document).scrollTop() == 0)
        {
            nav.style.color = 'white';
            nav.style.backgroundColor = '';
            logo.style.display = 'block';
            logo2.style.display = 'none';
            search.style.backgroundColor = '';
            search.style.border = '1px solid white';
        }
        else
        {
            nav.style.color = 'black';
            nav.style.backgroundColor = 'white';
            logo.style.display = 'none';
            logo2.style.display = 'block';
            search.style.backgroundColor = 'white';
            search.style.border = '1px solid black';
        }
    });
</script>
<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '{{$signPackage['appId']}}', // 必填，公众号的唯一标识
        timestamp: '{{$signPackage['timestamp']}}', // 必填，生成签名的时间戳
        nonceStr: '{{$signPackage['nonceStr']}}', // 必填，生成签名的随机串
        signature: '{{$signPackage['signature']}}',// 必填，签名，见附录1
        jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','getLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function(){
        wx.onMenuShareTimeline({    //分享到朋友圈
            title: 'Sunday', // 分享标题
            link: 'http://www.wunan.online', // 分享链接
            imgUrl: 'http://www.wunan.online/images/1.jpg', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        wx.onMenuShareAppMessage({  //分享给朋友
            title: 'Sunday', // 分享标题
            desc: '我是吴楠,每天记得做两件事:微笑和努力。', // 分享描述
            link: 'http://wunan.online', // 分享链接
            imgUrl: 'http://www.wunan.online/images/1.jpg', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        wx.onMenuShareQQ({   //分享到QQ
            title: 'Sunday', // 分享标题
            desc: '我是吴楠,每天记得做两件事:微笑和努力。', // 分享描述
            link: 'http://www.wunan.online', // 分享链接
            imgUrl: 'http://www.wunan.online/images/1.jpg', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
            }
        });
    });


</script>
</html>


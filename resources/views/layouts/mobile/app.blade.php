<html>
<head>
    <title>Sunday</title>

    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <link rel="stylesheet" href="/css/mobile.css">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="/js/jquery-1.9.1.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <meta name="viewport" content="user-scalable=no" />
</head>
<body>
    @yield('content')
</body>
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
            title: 'Sunday 【每天要记得做两件事:微笑和努力。——吴楠】', // 分享标题
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
            desc: '每天要记得做两件事:微笑和努力。——吴楠', // 分享描述
            link: 'http://www.wunan.online', // 分享链接
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
            desc: '每天要记得做两件事:微笑和努力。——吴楠', // 分享描述
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
<script>
    $(function(){
        $('.button').click(function(){
            $('.menu').css({
                'display': 'block'
            });
            $('.button1').css({
                'display': 'block'
            });
            $('.button').css({
                'display': 'none'
            })
        });
        $('.button1').click(function(){
            $('.button').css({
                'display': 'block'
            });
            $('.button1').css({
                'display': 'none'
            });
            $('.menu').css({
                'display': 'none'
            })
        });
    });
</script>
</html>


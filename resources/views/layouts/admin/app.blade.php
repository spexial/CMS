<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sunday') }}</title>

    <!-- Styles -->
    <link href="/css/admin.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/bootstrap-fileinput.css" rel="stylesheet">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="/js/jquery-3.2.1.min.js"></script>
    {{--<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>--}}

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.uploadify.js"></script>
    <script src="/js/bootstrap-fileinput.js"></script>
    <script src="/js-cookie/src/js.cookie.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/ajax.js"></script>
    <!-- 配置文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script>
        $(function(){
            $(' button').hover(function(){
                $(this).css({
                    'color':'white'
                });
            });
        });
    </script>
</head>
<body style="font-family: Raleway,Segoe UI,Lucida Grande,Helvetica,Arial,Microsoft YaHei,FreeSans,Arimo,Droid Sans,wenquanyi micro hei,Hiragino Sans GB,Hiragino Sans GB W3,sans-serif;">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="width:100%;margin-bottom: 40px;margin-left:190px;background-color: whitesmoke;color:black;z-index:0;height:40px;">
            <div class="container">
                {{--<div class="navbar-header" style="margin-left: 60px;">--}}
                    {{--<a class="navbar-brand"><i class="glyphicon glyphicon-list"></i></a>--}}
                {{--</div>--}}
                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <ul class="nav navbar-nav navbar-right" >
                        <li class="time"></li>
                            <li class="dropdown" style="left:20em;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:black;padding-top: 5px;padding-bottom: 0;">
                                    <img src="/image/avator.jpg" />{{ auth('admin')->user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/admin/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-off"></i>&nbsp;退出登录
                                        </a>

                                        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
        @section('menu')
            @include('layouts.admin.menu')
        @show
        @yield('content')
    </div>
    <div class="footer">
       2017 © CMS
    </div>
</body>
<script>
    $(function(){
        setInterval(function(){
            var now = new Date().toLocaleString();
            $('.time').html(now);
        },1);
    });
</script>
</html>

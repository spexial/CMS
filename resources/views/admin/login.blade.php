<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js-cookie/src/js.cookie.js"></script>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        .circle
        {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            /* 宽度和高度需要相等 */
            text-align: center;
            line-height: 50px;
            border: 1px inset skyblue;
            float: left;
            margin-right: 85px;
        }
        .btn-default
        {
            height:50px;
        }
        .default
        {
            margin-top: 20%;
        }
        body
        {

            background:url(/image/bg2.jpg)no-repeat scroll center center / 100% auto;height: 100vh;top:0;left:0;;
            opacity:1;
        }
        .glyphicon
        {
            margin-left: 80%;
            margin-top: 0.7em;
            position: absolute;
        }
    </style>
</head>
<body>
<div class="col-md-4"></div>
<div class=" col-md-4 default">
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label"></label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" autocomplete="off" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label"></label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" autocomplete="off" name="password"  placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            登录
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"><strong>记住我</strong>
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="col-md-4"></div>
</body>
<script>
    $(function () {
        if (Cookies.get('message')) {
            Cookies.remove('message');
        }
    });
</script>
</html>

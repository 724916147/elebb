

<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title>Fullscreen Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel="stylesheet" href="./assets/css/reset.css">
        <link rel="stylesheet" href="./assets/css/supersized.css">
        <link rel="stylesheet" href="./assets/css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>
    <div class="page-container">
        <br class="page-container">
            <h1>后台管理系统</h1>
        @foreach(['success','info','warning','danger'] as $status)
            @if(session()->has($status))
                <div class="alert alert-{{$status}}  alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>{{session($status)}}
                </div>
            @endif
        @endforeach
            <form action="{{route('login')}}"  method="post">
                <input type="text" name="name" class="username" placeholder="账号">
                <input type="password" name="password" class="password" placeholder="密码">
                <input id="captcha" class="form-control" name="captcha"  style="width: 150px" placeholder="验证码">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div style="margin-top: 10px;">
                   <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
                </div>

                {{ csrf_field() }}
                <input type="submit" value="登  录" class="button">
                <a href="{{ route('Shops.create') }}"><input type="button" value="注  册" class="button"></a>

                <div class="error"><span>+</span></div>
            </form>

            </br></br></br></br>
        </div>
        <div align="center"><a href="index.php" title="主页面" style="text-decoration: none;">返回前台</a></div>
        <!-- Javascript -->
        <script src="./assets/js/jquery-1.8.2.min.js"></script>
        <script src="./assets/js/supersized.3.2.7.min.js"></script>
        <script src="./assets/js/supersized-init.js"></script>
        <script src="./assets/js/scripts.js"></script>

    </body>

</html>


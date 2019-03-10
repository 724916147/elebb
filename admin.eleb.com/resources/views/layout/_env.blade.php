<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php  echo  \App\Http\Controllers\NavController::nav();    ?>
            </ul>
            <form class="navbar-form navbar-left" action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="keyword" placeholder="输入商品名字">
                </div>
                {{csrf_field()}}
                {{method_field('get')}}
                <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name??''}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">用户列表</a></li>
                        <li><a href="">个人信息</a></li>
                        <li><a href="#"></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('logout')}}">退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
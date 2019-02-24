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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商户 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('Shops.index')}}">商户列表</a></li>
                        <li><a href="{{route('Shops.create')}}">添加商户</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('Users.index')}}">商户账号管理</a></li>
                        <li><a href="">添加商品分类</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="">会员列表</a></li>
                        <li><a href="">添加会员</a></li>
                        <li><a href="">充值记录</a></li>
                        <li role="separator" class="divider"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商户分类 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('ShopCategories.index')}}">商户分类列表</a></li>
                        <li><a href="{{route('ShopCategories.create')}}">添加商户分类</a></li>
                        <li role="separator" class="divider"></li>
                    </ul>
                </li>
                <li><a href="">商品</a></li>

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
                <li><a href="{{route('Admins.create')}}">添加管理员</a></li>
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
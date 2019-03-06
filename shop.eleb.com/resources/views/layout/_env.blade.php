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
            <a class="navbar-brand" href="{{route('Shops.index')}}">首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('MenuCategories.index')}}">菜品分类列表</a></li>
                        <li><a href="{{route('MenuCategories.create')}}">添加菜品分类</a></li>
                        <li role="separator" class="ividerd"></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商品 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('Menus.index')}}">商品列表</a></li>
                        <li><a href="{{route('Menus.create')}}">添加商品</a></li>
                        <li role="separator" class="divider"></li>
                    </ul>

                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">平台活动 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('Activities.index')}}">活动列表</a></li>
                    {{--<li><a href="{{route('Activities.create')}}">添加活动</a></li>--}}
                    <li role="separator" class="divider"></li>
                </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('order.list')}}">订单列表</a></li>
                        <li><a href="{{route('order.count')}}">订单量统计</a></li>
                        <li><a href="{{route('order.goods')}}">商品销售统计</a></li>
                        {{--<li><a href="{{route('Activities.create')}}">添加活动</a></li>--}}
                        <li role="separator" class="divider"></li>
                    </ul>
                </li>
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
                <li><a href="{{route('Users.create')}}">注册商户</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('Users.show',[auth()->user()])}}">个人信息</a></li>
                        <li><a href="{{route('password.edit')}}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('logout')}}">退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
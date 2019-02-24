@extends('layout/app')
@section('contents')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('Users.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">登录账号</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="账号" value="{{old('name')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">邮箱</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="邮箱" value="{{old('email')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">密码</label>
                <input name="password" type="password" class="form-control" id="exampleInputEmail1" placeholder="密码" value="{{old('password')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-3">
                <label for="exampleInputEmail1">验证码</label>
                <input id="captcha" class="form-control" name="captcha"  >
            </div>
        </div>
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop
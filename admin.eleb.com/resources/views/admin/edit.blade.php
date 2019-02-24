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

    <form method="post" action="{{route('users.update',[$user])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">姓名</label>
            <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="{{$user->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputFile">选择商品图品</label>
            <input type="file" id="exampleInputFile" name="img">
            <img src="{{ $user->image() }}" width="30px">
            <p class="help-block">图片不能为空</p>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">验证码</label>
            <input id="captcha" class="form-control" name="captcha"  style="width: 200px">
        </div>
        <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop
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

    <form method="post" action="{{route('MenuCategories.update',[$MenuCategory])}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="名称" value="{{$MenuCategory->name}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">菜品编号</label>
                <input name="type_accumulation" type="text" class="form-control" id="exampleInputEmail1" placeholder="菜品编号" value="{{$MenuCategory->type_accumulation}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">描述</label>
                <input name="description" type="text" class="form-control" id="exampleInputEmail1" placeholder="描述" value="{{$MenuCategory->description}}">
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
        {{method_field('patch')}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
    {{--主体结束--}}
@stop
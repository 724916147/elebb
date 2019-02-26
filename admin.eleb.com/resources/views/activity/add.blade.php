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

    <form method="post" action="{{route('Activities.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">名称</label>
                <input name="title" type="text" class="form-control" id="exampleInputEmail1" placeholder="名称" value="{{old('title')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">描述</label>
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>

                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain" >{{old('content')}}</script>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-3">
                <label for="exampleInputEmail1">开始时间</label>
                <input id="captcha" class="form-control" name="start_time"  type="date">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-3">
                <label for="exampleInputEmail1">结束时间</label>
                <input id="captcha" class="form-control" name="end_time"  type="date">
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
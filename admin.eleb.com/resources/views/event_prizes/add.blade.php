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

    <form method="post" action="{{route('event_prizes.store')}}" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">活动</label>
                <select class="form-control " name="events_id">
                    @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">奖品名称</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" placeholder="奖品名称" value="{{old('name')}}">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="exampleInputEmail1">奖品详情</label>
                <script type="text/javascript">
                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>

                <!-- 编辑器容器 -->
                <script id="container" name="description" type="text/plain" >{{old('description')}}</script>
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
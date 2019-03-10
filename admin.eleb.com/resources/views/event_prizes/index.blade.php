@extends('layout/app')
@section('contents')
{{--主体部分--}}
@foreach(['success','info','warning','danger'] as $status)
@if(session()->has($status))
<div class="alert alert-{{$status}}  alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>{{session($status)}}
</div>
@endif
@endforeach
<form action="{{route('event_prizes.index')}}" method="get">
    <div class="form-group row">
        <div class="col-xs-3">
            <select class="form-control " name="time">
                <option value="">所有活动</option>
                <option value="1">未开始</option>
                <option value="2">进行中</option>
                <option value="3">已结束</option>
            </select>
        </div>
        <div class="col-xs-3">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>
<table class="table table-hover">
    <tr>
        <th>序号</th>
        <th>活动名称</th>
        <th>奖品名称</th>
        <th>中将商户</th>
        <th>操作</th>
    </tr>
    @foreach($event_prizes as $event_prize)
    <tr>
        <td>{{$event_prize->id}}</td>
        <td>{{$event_prize->event->title}}</td>
        <td>{!! $event_prize->description !!}</td>
        <td>@if(!$event_prize->member_id) 未开奖
        @endif
        </td>
        <td>
            <a href="{{route('event_prizes.show',[$event_prize])}}" class="btn btn-info" >查看</a>
            {{--<a href="{{route('event_prizes.edit',[$event_prize])}}" class="btn btn-warning" >修改</a>--}}
            {{--<form action="{{route('event_prizes.destroy',[$event_prize])}}" method="post" style="display: inline">--}}
                {{--{{csrf_field()}}--}}
                {{--{{method_field('delete')}}--}}
                {{--<button  type="submit" class="btn btn-danger" >删除</button>--}}
            {{--</form>--}}
        </td>
    </tr>
    @endforeach
</table>
{{--主体结束--}}
@stop


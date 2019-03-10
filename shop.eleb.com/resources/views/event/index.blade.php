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
<form action="{{route('event.index')}}" method="get">
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
        <th>名称</th>
        <th>活动描述</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>开奖日期</th>
        <th>操作</th>
    </tr>
    @foreach($events as $event)
    <tr>
        <td>{{$event->id}}</td>
        <td>{{$event->title}}</td>
        <td>{!! $event->content !!}</td>
        <td>{{date("Y-m-d",$event->signup_start) }}</td>
        <td>{{date("Y-m-d",$event->signup_end)}} </td>
        <td>{{$event->prize_date}} </td>
        <td>
            <a href="{{route('event.show',[$event])}}" class="btn btn-info" >查看</a>
        </td>
    </tr>
    @endforeach
</table>
{{--主体结束--}}
@stop


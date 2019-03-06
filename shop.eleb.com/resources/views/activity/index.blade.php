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
<form action="{{route('Activities.index')}}" method="get">
    <div class="form-group row">
        <div class="col-xs-3">
            <select class="form-control " name="time">
                <option value="">所有活动</option>
                <option value="1">未开始</option>
                <option value="2">进行中</option>
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
    </tr>
    @foreach($activities as $activity)
    <tr>
        <td>{{$activity->id}}</td>
        <td>{{$activity->title}}</td>
        <td>{!!  $activity->content  !!}</td>
        <td>{{$activity->start_time}}</td>
        <td>{{$activity->end_time}} </td>
        {{--<td>--}}
            {{--<a href="{{route('Activities.show',[$activity])}}" class="btn btn-info" >查看</a>--}}
            {{--<a href="{{route('Activities.edit',[$activity])}}" class="btn btn-warning" >修改</a>--}}
            {{--<form action="{{route('Activities.destroy',[$activity])}}" method="post" style="display: inline">--}}
                {{--{{csrf_field()}}--}}
                {{--{{method_field('delete')}}--}}
                {{--<button  type="submit" class="btn btn-danger" >删除</button>--}}
            {{--</form>--}}
        {{--</td>--}}
    </tr>
    @endforeach
</table>
{{--主体结束--}}
@stop


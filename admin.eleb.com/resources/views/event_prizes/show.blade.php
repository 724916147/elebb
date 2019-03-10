@extends('layout/app')
@section('contents')
    {{--主体部分--}}
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>描述</th>
            <th>开始时间</th>
            <th>结束时间</th>
        </tr>
        <tr>
            <td>{{$Activity->id}}</td>
            <td>{{$Activity->title}}</td>
            <td>{!! $Activity->content !!}</td>
            <td>{{$Activity->start_time}}</td>
            <td>{{$Activity->end_time}}</td>
        </tr>
    </table>
    {{--主体结束--}}
@stop
@extends('layout/app')
@section('contents')
    {{--主体部分--}}
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>头像</th>
        </tr>
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td><img src="{{$user->image()}}" width="50"></td>
        </tr>
    </table>
    {{--主体结束--}}
@stop
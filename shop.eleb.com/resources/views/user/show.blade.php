@extends('layout/app')
@section('contents')
    {{--主体部分--}}
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>账号</th>
            <th>邮箱</th>
        </tr>
        <tr>
            <td>{{auth()->user()->id}}</td>
            <td>{{auth()->user()->name}}</td>
            <td>{{auth()->user()->email}}</td>

        </tr>
    </table>
    {{--主体结束--}}
@stop
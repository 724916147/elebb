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
<table class="table table-hover">
    <tr>
        <th>序号</th>
        <th>名称</th>
        <th>头像</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td><img src="{{$user->image()}}" width="40px"> </td>
        <td>
            <a href="{{route('users.show',[$user])}}" class="btn btn-info" >查看</a>

            <form action="{{route('users.edit',[$user])}}" method="get" style="display: inline">
                {{csrf_field()}}
                <button  type="submit" class="btn btn-warning" >修改</button>
            </form>
            <form action="{{route('users.destroy',[$user])}}" method="post" style="display: inline">
                {{csrf_field()}}
                {{method_field('delete')}}
                <button  type="submit" class="btn btn-danger" >删除</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{--主体结束--}}
@stop


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
        <th>账号</th>
        <th>email</th>
    </tr>
    @foreach($admins as $admin)
    <tr>
        <td>{{$admin->id}}</td>
        <td>{{$admin->name}}</td>
        <td>{{$admin->email}} </td>
        <td>
            <a href="{{route('Admins.edit',[$admin])}}" class="btn btn-info" >修改权限</a>
            <form action="{{route('Admins.destroy',[$admin])}}" method="post" style="display: inline">
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


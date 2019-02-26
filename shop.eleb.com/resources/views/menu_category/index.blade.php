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
        <th>默认状态</th>
        <th>描述</th>
        <th>操作</th>
    </tr>
    @foreach($menu_categories as $menu_category)
    <tr>
        <td>{{$menu_category->id}}</td>
        <td>{{$menu_category->name}}</td>
        <td>{{$menu_category->is_selected?'是':'否'}} </td>
        <td>{{$menu_category->description}} </td>
        <td>
            @if(!$menu_category->is_selected)
            <a href="{{route('MenuCategories.default',[$menu_category])}}" class="btn btn-info" >设为默认</a>
            @else
                <a class="btn btn-info"  disabled="disabled">默认</a>
                @endif

            <a href="{{route('MenuCategories.edit',[$menu_category])}}" class="btn btn-warning" >修改</a>
            <form action="{{route('MenuCategories.destroy',[$menu_category])}}" method="post" style="display: inline">
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


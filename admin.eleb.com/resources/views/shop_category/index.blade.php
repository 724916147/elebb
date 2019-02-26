@extends('layout.app');
@section('contents')
    @foreach(['success','info','warning','danger'] as $status)
        @if(session()->has($status))
            <div class="alert alert-{{$status}}  alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>{{session($status)}}
            </div>
        @endif
    @endforeach
    {{--主体部分--}}
    <h1 class="" style="color: cornflowerblue">商家分类列表</h1>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>分类名称</th>
            <th>分类图片</th>
            <th>显示状态</th>
            <th>操作</th>
        </tr>
        @foreach($ShopCategories as $ShopCategory)
            <tr>
                <td>{{$ShopCategory->id}}</td>
                <td>{{ $ShopCategory->name }}</td>
                <td><img src="{{ $ShopCategory->img}}" width="30px"></td>
                <td>{{$ShopCategory->status? '显示': '隐藏'}}</td>
                <td>
                    <a href="{{route('ShopCategories.edit',[$ShopCategory]) }}" class="btn btn-warning"> 修改</a>
                    <form action="{{route('ShopCategories.destroy',[$ShopCategory]) }}" method="post" style="display: inline">
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
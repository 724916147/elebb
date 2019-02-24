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
    <h1 class="" style="color: cornflowerblue">商家信息</h1>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>商家名称</th>
            <th>店铺分类</th>
            <th>店铺图片</th>
            <th>店铺状态</th>
            <th>操作</th>
            <th>审核管理</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{ $shop->shop_name }}</td>
                <td>{{ $shop->ShopCategory->name}}</td>
                <td><img src="{{ $shop->shop_img }}" width="40px"> </td>
                <td>@if($shop->status==1)正常
                    @elseif($shop->status==0)待审核
                    @elseif($shop->status==-1)禁用
                    @endif
                </td>
                <td>
                    <a href="{{route('Shops.show',[$shop])}}" class="btn btn-info"> 查看</a>
                    <a href="{{route('Shops.edit',[$shop])}}" class="btn btn-warning"> 修改</a>
                    <form action="{{route('Shops.destroy',[$shop])}}" method="post" style="display: inline">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button  type="submit" class="btn btn-danger" >删除</button>
                    </form>
                </td>
                <td>
                    <a href="{{route('Shops.up',[$shop])}}" class="btn btn-info"> 启用</a>
                    <a href="{{route('Shops.stop',[$shop])}}" class="btn btn-danger"> 停用</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{--主体结束--}}
@stop
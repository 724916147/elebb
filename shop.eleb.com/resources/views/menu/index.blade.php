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
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            分类查看
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach($menu_categories as $menu_category)
            <li><a href="{{route('Menus.index')}}">{{$menu_category->name}}</a></li>
            @endforeach
        </ul>
    </div>
<form method="get" action="{{route('Menus.index')}}">
    <div class="form-group row">
        <div class="col-xs-3">
            <select class="form-control " name="category_id">
                <option value="">所有分类</option>
                @foreach($menu_categories as $menu_category)
                    <option value="{{$menu_category->id}}">{{$menu_category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-2">
            <input name="good_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="菜品名字" >
        </div>
        <div class="col-xs-2">
            <input name="low" type="text" class="form-control" id="exampleInputEmail1" placeholder="价格" >到
            <input name="high" type="text" class="form-control" id="exampleInputEmail1" placeholder="价格" >
        </div>

        <div class="col-xs-1">

            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>
<table class="table table-hover">
    <tr>
        <th>序号</th>
        <th>名称</th>
        <th>所属分类</th>
        <th>图片</th>
        <th>价格</th>
        <th>操作</th>
    </tr>
    @foreach($Menus as $Menu)
    <tr>
        <td>{{$Menu->id}}</td>
        <td>{{$Menu->goods_name}}</td>
        <td>{{$Menu->category->name}} </td>
        <td><a href="{{$Menu->goods_img}}"><img src="{{$Menu->goods_img}}" width="40px"> </a></td>
        <td>{{$Menu->goods_price}} </td>
        <td>
            <a href="{{route('Menus.show',[$Menu])}}" class="btn btn-info" >查看</a>
            <a href="{{route('Menus.edit',[$Menu])}}" class="btn btn-warning" >修改</a>
            <form action="{{route('Menus.destroy',[$Menu])}}" method="post" style="display: inline">
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


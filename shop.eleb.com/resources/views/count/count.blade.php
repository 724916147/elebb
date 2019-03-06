@extends('layout/app')
@section('contents')
{{--主体部分--}}
<h1>订单列表</h1>
@foreach(['success','info','warning','danger'] as $status)
@if(session()->has($status))
<div class="alert alert-{{$status}}  alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>{{session($status)}}
</div>
@endif
@endforeach
<form action="{{route('order.count')}}"  method="get">
    <div class="form-group row">
        <div class="col-xs-3">
            <label for="exampleInputEmail1">查看最近订单</label>
            <select class="form-control " name="count">
                <option value="day">近一周</option>
                <option value="month">近三月</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-default">提交</button>
</form>

<p></p>
<p></p>
<table class="table table-hover">
    <tr>
        <th>日期</th>
        @foreach($orders as $a=>$b)
        <td>{{$a}}</td>
        @endforeach
    </tr>
    <tr>
        <td>订单数</td>
        @foreach($orders as $order)
            <td>{{$order}}</td>
        @endforeach
    </tr>

</table>

<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="main" style="width: 1000px;height:400px;"></div>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    // 指定图表的配置项和数据
    var option = {
        title: {
            text: '订单图'
        },
        tooltip: {},
        legend: {
            data:['订单量']
        },
        xAxis: {
            data: {!! json_encode(array_keys($orders)) !!}
        },
        yAxis: {},
        series: [{
            name: '订单量',
            type: 'line',
            data:  {!! json_encode(array_values($orders)) !!}
        }]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
</script>
{{--主体结束--}}
@stop


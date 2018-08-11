@extends('shop.layouts.default')
@section('title','订单列表首页')
@section('content')

    <div class="warp" style="height: 400px">
        <div  style="float: left">
        <a href="{{route('order.day')}}" class="btn btn-success ">日订单总量</a>
        <a href="{{route('order.month')}}" class="btn btn-warning ">月订单总量</a>
        <a href="{{route('order.show')}}" class="btn"style="background:orchid">总订单总量</a>
        </div>
        <div  style="float: right">
            <a href="{{route('order.day1')}}" class="btn" style="background: turquoise">menu日订单总量</a>
            <a href="{{route('order.month1')}}" class="btn"style="background: pink">menu月订单总量</a>
            <a href="{{route('order.show1')}}" class="btn"style="background: darksalmon">menu总订单总量</a>
        </div>
    <table class="table table-hover table-bordered text-center" style="font-size: 10px">
        <tr style="background:orange">
            <th class="text-center">订单id</th>
            <th class="text-center">订单用户</th>
            <th class="text-center">订单商家</th>
            <th class="text-center">订单编号</th>
            <th class="text-center">订单者电话</th>
            <th class="text-center">订单者名字</th>
            <th class="text-center">省</th>
            <th class="text-center">市</th>
            <th class="text-center">区</th>
            <th class="text-center">具体地址</th>
            <th class="text-center">订单总金额</th>
            <th class="text-center">订单状态</th>
            <th >操作</th>
        </tr>
        @foreach($orders as $order)
        <tr style="background: #f0c674">
            <td>{{$order->id}}</td>
            <td>{{$order->order->username}}</td>
            <td>{{$order->shop->shop_name}}</td>
            <td>{{$order->sn}}</td>
            <td>{{$order->tel}}</td>
            <td>{{$order->name}}</td>
            <td>
                {{$order->province}}
            </td>
            <td>{{$order->city}}</td>
            <td >{{$order->county}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->total}}</td>

            <td>
                    @if($order->status==-1) 已取消
                    @elseif($order->status==0)代支付
                    @elseif($order->status==1)待发货
                    @elseif($order->status==2)待确认
                    @endif

            </td>

            <td >
                <a href="{{route('order.info',$order->id)}}" class="btn btn-primary ">详情</a>
                <a href="{{route('order.off',$order->id)}}" class="btn btn-info ">取消订单</a>
                <a href="{{route('order.send',$order->id)}}" class="btn btn-success">发货</a>

            </td>
        </tr>
            @endforeach
    </table>

    {{$orders->links()}}

    </div>
@stop

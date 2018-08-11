@extends('shop.layouts.default')
@section('title','订单列表首页')
@section('content')

    <div class="warp" style="height: 400px">
        <a href="{{route('order.index')}}" class="btn btn-primary ">返回</a>
    <table class="table table-hover table-bordered text-center" style="font-size: 12px">
        <tr style="background:orange">
            <th class="text-center">订单id</th>
            <th class="text-center">菜品id</th>
            <th class="text-center">数量</th>
            <th class="text-center">菜品名字</th>
            <th class="text-center">菜品图片</th>
            <th class="text-center">菜品价格</th>
        </tr>
        @foreach($goods as $good)
        <tr style="background: #f0c674">
            <td>{{$good->order_id}}</td>
            <td>{{$good->goods_id}}</td>
            <td>{{$good->amount}}</td>
            <td>{{$good->goods_name}}</td>
            <td><img src="{{$good->goods_img}}" style="width: 80px"></td>
            <td>{{$good->goods_price}}</td>


        </tr>
        @endforeach
    </table>


    </div>
@stop

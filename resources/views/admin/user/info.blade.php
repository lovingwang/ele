@extends('admin.layouts.default')
@section("title","首页")
@section("content")
    <div  style="float: left;margin-top: 100px">
    <a href="{{route('order.everyday')}}" class="btn btn-success ">日订单总量</a>
    <a href="{{route('order.everymonth')}}" class="btn btn-warning ">月订单总量</a>
    <a href="{{route('order.total')}}" class="btn"style="background:orchid">总订单总量</a>
    </div>
    <div style="float: right;margin-top: 100px">
        <a href="{{route('order.everyday1')}}" class="btn btn-success ">日菜品总量</a>
        <a href="{{route('order.everymonth1')}}" class="btn btn-warning ">月菜品总量</a>
        <a href="{{route('order.total1')}}" class="btn"style="background:orchid">菜品总量</a>
    </div>

@stop


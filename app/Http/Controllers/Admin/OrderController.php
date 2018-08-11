<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function  total(Request $request){
        $shops=Shop::all();

        $query= Order::where('status', '!=', -1)->where('status', '!=', 0)
            ->Select(DB::raw(" SUM(total) AS money,count(*) AS count "));
//            判断下拉菜单有没有值传过来
        $id=$request->post('id');
     if($id!==null){
    $query->where('shop_id',$request->post('id'));

}
//判断日期
  $start = $request->input('start');
        $end = $request->input('end');
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }

        $orders = $query->get();

        return view('admin/order/total', compact('shops','id','orders'));
    }
    public function  day(Request $request){
        $shops=Shop::all();
//
        $query= Order::where('status', '!=', -1)->where('status', '!=', 0)
            ->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as day, SUM(total) AS money,count(*) AS count "))->groupBy("day")->orderBy("day", 'desc')->limit(10);
////            判断下拉菜单有没有值传过来
        $id=$request->post('id');
        if($id!==null){
            $query->where('shop_id',$request->post('id'));

        }
////判断日期
        $start = $request->input('start');
        $end = $request->input('end');
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }

        $orders = $query->get();

        return view('admin/order/everyday',compact('orders','shops','id'));
    }
    public function  month(Request $request){
        $shops=Shop::all();
//
        $query= Order::where('status', '!=', -1)->where('status', '!=', 0)
            ->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total) AS money,count(*) AS count "))->groupBy("month")->orderBy("month", 'desc')->limit(10);
////            判断下拉菜单有没有值传过来
        $id=$request->post('id');
        if($id!==null){
            $query->where('shop_id',$request->post('id'));

        }
////判断日期
        $start = $request->input('start');
        $end = $request->input('end');
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }

        $orders = $query->get();

        return view('admin/order/everymonth',compact('orders','shops','id'));
    }

//    菜品总销量
public  function total1(Request $request){
    $shops=Shop::all();
    $id=$request->post('id');
//dd($id);
//    找到各个用户订单
//    构造orders的条件
    $orders= Order::where('status', '!=', -1)->where('status', '!=', 0);
    if(!$id==null){
        $orders->where('shop_id',$id);
    }
    $orders=$orders->get();
//    得到所有的订单。排除取消的订单之类
    foreach ( $orders as $order){
        $dd[]=$order->id;
    }
    $query=OrderGoods::whereIn('order_id',$dd) ->Select(DB::raw("goods_id,goods_name,SUM(goods_price)as money,SUM(amount) as count"))->groupBy('goods_id')->orderBy('count','desc')->limit(10);


////判断日期
    $start = $request->input('start');
    $end = $request->input('end');
    if ($start !== null) {
        $query->whereDate("created_at", ">=", $start);
    }
    if ($end !== null) {
        $query->whereDate("created_at", "<=", $end);
    }

    $ordergoods=$query->get();
    return view('admin/order/total1',compact('ordergoods','shops','id'));
}
//月销量
    public  function month1(Request $request){
        $shops=Shop::all();
        $id=$request->post('id');
//dd($id);
//    找到各个用户订单
//    构造orders的条件
        $orders= Order::where('status', '!=', -1)->where('status', '!=', 0);
        if(!$id==null){
            $orders->where('shop_id',$id);
        }
        $orders=$orders->get();
//    得到所有的订单。排除取消的订单之类
        foreach ( $orders as $order){
            $dd[]=$order->id;
        }
        $query=OrderGoods::whereIn('order_id',$dd) ->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS date,goods_name,SUM(goods_price)as money,SUM(amount) as count"))->groupBy('date')->orderBy('date','desc')->limit(10);


////判断日期
        $start = $request->input('start');
        $end = $request->input('end');
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }

        $ordergoods=$query->get();
        return view('admin/order/everymonth1',compact('ordergoods','shops','id'));
    }
    //日销量
    public  function day1(Request $request){
        $shops=Shop::all();
        $id=$request->post('id');
//dd($id);
//    找到各个用户订单
//    构造orders的条件
        $orders= Order::where('status', '!=', -1)->where('status', '!=', 0);
        if(!$id==null){
            $orders->where('shop_id',$id);
        }
        $orders=$orders->get();
//    得到所有的订单。排除取消的订单之类
        foreach ( $orders as $order){
            $dd[]=$order->id;
        }
        $query=OrderGoods::whereIn('order_id',$dd) ->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date,goods_name,SUM(goods_price)as money,SUM(amount) as count"))->groupBy('date')->orderBy('date','desc')->limit(10);


////判断日期
        $start = $request->input('start');
        $end = $request->input('end');
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }

        $ordergoods=$query->get();
        return view('admin/order/everyday1',compact('ordergoods','shops','id'));
    }
}

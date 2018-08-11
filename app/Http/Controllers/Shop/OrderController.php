<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        if (Auth::user() == null) {
            //提示
            $request->session()->flash('danger', "对不起！你还没有登录");
//           跳转
            return redirect()->route('user.login');
        }
//        dd(Auth::user());
        $shop_id = Auth::user()->shop_id;


        $orders = Order::where('shop_id', $shop_id)->paginate(3);

//    $ordergoods=OrderGoods::where('order_id',)
//        显示网页
        return view('shop/order/index', compact('orders'));
    }

    public function info(Request $request, $id)
    {
        $goods = OrderGoods::where('order_id', $id)->paginate(3);

        return view('shop/order/info', compact('goods'));
    }

//    取消订单
    public function off(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order->status == -1 || $order->status == 1 || $order->status == 2) {

            $request->session()->flash('info', "不能取消此订单");
//        跳转
            return redirect()->route('order.index');
        }
        if ($order->status == 0) {
            $order->status = -1;
            $order->save();
            $request->session()->flash('danger', "已取消此订单");
            return redirect()->route('order.index');
        }

    }

//发送
    public function send(Request $request, $id)
    {
        $order = Order::find($id);

        if ($order->status !== 1) {
            $request->session()->flash('danger', "不能发送此订单");
            return redirect()->route('order.index');
        }

        $order->status = 2;
        $order->save();
        $request->session()->flash('success', "成功发送此订单");
        return redirect()->route('order.index');
    }

//    商家订单统计量
    public function show(Request $request)
    {

        $shop_id = Auth::user()->shop_id;
        $query = Order::where('shop_id', $shop_id)->where('status', '!=', -1)->where('status', '!=', 0)
            ->Select(DB::raw(" SUM(total) AS money,count(*) AS count "));
////执行sql数据
        $orders = $query->get();
//dd($orders);

        return view('shop/order/show', compact('orders'));
    }

    public function day(Request $request)
    {
//得到当前商家
        $shop_id = Auth::user()->shop_id;
        $query = Order::where('shop_id', $shop_id)->where('status', '!=', -1)->where('status', '!=', 0)
            ->Select(DB::raw(" DATE_FORMAT(created_at, '%Y-%m-%d') as day,SUM(total) AS money,count(*) AS count "))->groupBy("day")->orderBy("day", 'desc')->limit(10);
         //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
//        dd($end);
        // var_dump($start,$end);
        //如果有起始时间
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }
        //得到每日统计数据
        $orders = $query->get();
        //dd($orders->toArray());
//        dd($orders);
        //显示视图
        return view('shop.order.day', compact('orders'));
    }
//月销售
    public function month(Request $request)
    {
//得到当前商家
        $shop_id = Auth::user()->shop_id;
        $query = Order::where('shop_id', $shop_id)->where('status', '!=', -1)->where('status', '!=', 0)
            ->Select(DB::raw(" DATE_FORMAT(created_at, '%Y-%m') as month,SUM(total) AS money,count(*) AS count "))->groupBy("month")->orderBy("month", 'desc')->limit(5);
        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
//        dd($end);
        // var_dump($start,$end);
        //如果有起始时间
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }

        //得到每日统计数据
        $orders = $query->get();
//        dd($orders);
        //显示视图
        return view('shop.order.month', compact('orders'));
    }

//   商家菜品总销量
public function show1(Request $request){
        //得到当前商家
    $shop_id = Auth::user()->shop_id;
//    通过shop_id  找到id
 $orders= Order::where('shop_id',$shop_id)->where('status', '!=', -1)->where('status', '!=', 0)->get();
// dd($orders);
 foreach ( $orders as $order){

     $id[]=$order->id;
 }

 $query=OrderGoods::whereIn('order_id',$id) ->Select(DB::raw("goods_id,goods_name,SUM(goods_price)as money,SUM(amount) as count"))->groupBy('goods_id')->orderBy('count','desc')->limit(5);

 $ordergoods=$query->get();
    return view('shop.order.show1', compact('ordergoods'));

}
    public function day1(Request $request)
    {
        //得到当前商家
        $shop_id = Auth::user()->shop_id;
//    通过shop_id  找到id
        $orders= Order::where('shop_id',$shop_id)->where('status', '!=', -1)->where('status', '!=', 0)->get();
// dd($orders);
        foreach ( $orders as $order){

            $id[]=$order->id;
        }
//        dd($id);
        $query=OrderGoods::whereIn('order_id',$id) ->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') AS date,SUM(goods_price)as money,goods_id,goods_name,SUM(amount) as count"))->groupBy("goods_id","date")->orderBy('date','desc')->limit(10);


//dd($ordergoods);

        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
//        dd($end);
        // var_dump($start,$end);
        //如果有起始时间
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }
        $ordergoods=$query->get();
//        //得到每日统计数据

        //显示视图
        return view('shop.order.day1', compact('ordergoods'));
    }
    public function month1(Request $request)
    {
        //得到当前商家
        $shop_id = Auth::user()->shop_id;
//    通过shop_id  找到id
        $orders= Order::where('shop_id',$shop_id)->where('status', '!=', -1)->where('status', '!=', 0)->get();
// dd($orders);
        foreach ( $orders as $order){

            $id[]=$order->id;
        }
//        dd($id);
        $query=OrderGoods::whereIn('order_id',$id) ->Select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') AS date,SUM(goods_price)as money,goods_id,goods_name,SUM(amount) as count"))->groupBy("goods_id","date")->orderBy('date','desc')->limit(10);


//dd($ordergoods);

        //接收参数
        $start = $request->input('start');
        $end = $request->input('end');
//        dd($end);
        // var_dump($start,$end);
        //如果有起始时间
        if ($start !== null) {
            $query->whereDate("created_at", ">=", $start);
        }
        if ($end !== null) {
            $query->whereDate("created_at", "<=", $end);
        }
        $ordergoods=$query->get();
//        //得到每日统计数据

        //显示视图
        return view('shop.order.day1', compact('ordergoods'));
    }

}

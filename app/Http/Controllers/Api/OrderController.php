<?php

namespace App\Http\Controllers\Api;


use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use App\Models\Address;
use App\Models\Cate;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mrgoon\AliSms\AliSms;

class OrderController extends Controller
{

    public function adds(Request $request)
    {

//        没有做事务就用return
//       找到地址是不是正确
        $address = Address::find($request->input('address_id'));

//得到rder数据表中需要的
        $data['user_id'] = $request->input('user_id');
//继续到shop_id
        $cates = Cate::where('user_id', $request->input('user_id'))->get();
// 随便得到在此的goods_id
        $goods_id = $cates[0]->goods_id;
//然后通过menu中的id找到shop——id
        $shop_id = Menu::where('id', $goods_id)->first()->shop_id;
        $data['shop_id'] = $shop_id;
//     得到订单号
        $data['sn'] = date("ymdHis") . rand(1000, 9999);
//       然后的到数据表中的省。市。县等信息
        $data['province'] = $address->provence;
        $data['city'] = $address->city;
        $data['county'] = $address->area;
        $data['address'] = $address->detail_address;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
//       得到goods_price
        $data['total'] = 0;
        foreach ($cates as $key => $value) {
//           循环menu中的价格
            $price = Menu::where('id', $value->goods_id)->first()->goods_price;
            $amount = $value->amount;
            $data['total'] = $price * $amount + $data['total'];
        }
        $data['status'] = 0;
//   dd($data);
//       写入数据库
        $order = Order::create($data);

//       循环订单中的信息

        foreach ($cates as $k => $v) {
//           由于没有那个数量，就不用去减去
            $menu1 = Menu::where('id', $v->goods_id)->first();
            //      直接构造数据,
            $dataGoods['order_id'] = $order->id;
            $dataGoods['goods_id'] = $v->goods_id;
            $dataGoods['amount'] = $v->amount;
            $dataGoods['goods_name'] = $menu1->goods_name;
            $dataGoods['goods_img'] = $menu1->goods_img;
            $dataGoods['goods_price'] = $menu1->goods_price;
            OrderGoods::create($dataGoods);
        }
//订单已经生成删除购物车
        Cate::where('user_id',$request->input('user_id'))->delete();
//返回
        return [
            'status' => 'true',
            'message' => '生成订单成功',
            'order_id' => $order->id,
        ];

    }

    public function info(Request $request)
    {
//     dd( $request->all()) ;

        $data['id'] = $request->post('id');
//dd($data['id']);
//得到id对应的时刻
        $order = Order::find($request->input('id'));
        $data['order_code'] = $order->sn;
        $data['order_birth_time'] = (string)$order->created_at;
//dd($order->created_at);
//        self::odd();
        $data['order_status'] = $order->order_status;
        $data['shop_id'] = $order->shop_id;
//    通过shop_id找到shop——name。img
        $id = $order->shop_id;

        $shop = Shop::find($id);
        $data['shop_name'] = $shop->shop_name;
//dd($data['shop_name']);
        $data['shop_img'] = $shop->shop_img;
//定义一个空数组用来存goods-list
    $goodsList=[];
     $ordergoods = OrderGoods::where('order_id', $request->input('id'))->get();

//        foreach ($ordergoods as $ordergood) {
//
//            $goodslist['goods_id'] = $ordergood->goods_id;
//            $goodslist['goods_name'] = $ordergood->goods_name;
//            $goodslist['goods_img'] = $ordergood->goods_img;
//            $goodslist['amount'] = $ordergood->amount;
//            $goodslist['goods_price'] = $ordergood->goods_price;
//            $goodsList[] = $goodslist;
//        }

//     $data['goods_list'] = $goodsList;
        $data['goods_list'] =$ordergoods;

        $data['order_price'] = $order->total;
        $data['order_address'] = $order->province . $order->city . $order->county . $order->address;
//dd($data);
        return
            $data;

    }

    public function pay(Request $request)
    {
//得到此订单的所有金钱
        $order = Order::find($request->input('id'));
        $money = $order->total;
        $user_id = $order->user_id;
//  dd($money);
        $member = Member::find($user_id);

        if ($member->money < $money) {
            return [
                'status' => 'false',
                "message" => "余额不足"];

        } else {
            $member->money = $member->money - $money;
            if ($member->save()) {
                //      并改变里面的状态
                $order->status = 1;
                $order->save();
//支付成功并生成短信通知
                $code=$order->sn;
//            dd($code);
//                得到订单者的电话

                $tel=$order->tel;
//                dd($tel);
                $config = [
      'access_key' => 'LTAIRa6RADNzNbVI',
      'access_secret' => 'XoF7WTW48TO8kWgAHl4tCiGjEYy1iD',
       'sign_name' => '王波',
  ];

    $aliSms = new AliSms();
    $response = $aliSms->sendSms($tel, 'SMS_141595908', ['code'=> $code], $config);
//  dd($response);
//    if($response->Message=='OK'){
//        return [
//            "status"=>"true",
//            "message"=> "获取订单号成功".$code
//        ];
//    }else{
//        return [
//            "status"=>"flase",
//            "message"=>"获取订单号失败"
//        ];
//    }

                return [
                    'status' => 'true',
                    "message" => "支付成功"
                ];
            };
        }

    }
public  function  odlist(Request $request){
//        得到当前账号下所有的订单
$orders=Order::where('user_id',$request->input('user_id'))->get();
foreach ($orders as $order){

//创造接口需要的数据
    $data['id']=(string)$order->id;
    $data['order_code']=$order->sn;
    $data['order_birth_time']=(string)$order->created_at;
    $data['order_status']=$order->order_status;
//    dd($order->order_status);
    $data['shop_id']=(string)$order->shop_id;
    $shop=Shop::find($order->shop_id);
    $data['shop_name']=$shop->shop_name;
    $data['shop_img']=$shop->shop_img;


    $ordergoods = OrderGoods::where('order_id', $order->id)->get();
    $data['goods_list']=$ordergoods;
//    foreach ($ordergoods as $ordergood) {
//
//        $goodslist['goods_id'] = $ordergood->goods_id;
//        $goodslist['goods_name'] = $ordergood->goods_name;
//        $goodslist['goods_img'] = $ordergood->goods_img;
//        $goodslist['amount'] = $ordergood->amount;
//        $goodslist['goods_price'] = $ordergood->goods_price;
//        $goodsList[] = $goodslist;
//
//    }
    $data['order_price']=$order->total;
    $data['order_address'] = $order->province . $order->city . $order->county . $order->address;

$del[]=$data;
//$del[]=$del;

}
//    dd($del);
    return $del;

}

//微信支付二维码
public function wxPay(Request $request){
//        dd(config('wechat'));
//得到当前id订单
    $order=Order::find($request->input('id'));
//    dd($order);
//得到当前的操作的微信对象
    $app=new  Application(config('wechat'));
//    dd($app);
//    得到支付对象
    $payment = $app->payment;
//    dd($payment);
//    得到微信订单
    $attributes = [
        'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
        'body'             => '点餐平台',
        'detail'           => '点餐',
        'out_trade_no'     => time(),
        'total_fee'        => 1, // 单位：分
        'notify_url'       =>'http://adc.zhilipeng.com/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
//        'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
        // ...
    ];
    $payOrder = new \EasyWeChat\Payment\Order($attributes);
//    dd($payOrder);
//    统一下单
    $result = $payment->prepare($payOrder);
//     dd($result);
    if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
        //取出预支付链接
        $payUrl=  $result->code_url;

        $qrCode = new QrCode("$payUrl");
        $qrCode->setSize(200);
// Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(10);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);
        $qrCode->setLabel('微信支付', 16, public_path().'/assets/noto_sans.otf', LabelAlignment::CENTER);
        $qrCode->setLogoPath(public_path().'/assets/1.png');
        $qrCode->setLogoWidth(50);
        $qrCode->setValidateResult(false);

// Directly output the QR code
                header('Content-Type: '.$qrCode->getContentType());
        echo $qrCode->writeString();
exit();
    }

}
public function ok(){
    //微信异步通知方法

        //1.创建操作微信的对象
        $app = new Application(config('wechat'));
        //2.处理微信通知信息
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            //  $order = 查询订单($notify->out_trade_no);
            $order=Order::where("sn",$notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status!==0) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;//更新订单状态

                dd('111');
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;


}

public function status(Request $request){
//        dd($request->input('id'));
        return [
            'status'=>Order::find($request->input('id'))->status
        ];
}

}

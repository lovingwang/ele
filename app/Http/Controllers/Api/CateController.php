<?php

namespace App\Http\Controllers\Api;

use App\Models\Cate;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //结算接口

    public function addc(Request $request){
        $data=$request->all();

//    var_dump($data['goodsCount']);
        Cate::where('user_id',$request->post('user_id'))->delete();

        foreach ($data['goodsList']  as $key=>$value){


             $data1=[
                 "user_id"=>$data['user_id'],
                 'goods_id'=>$value,
                 "amount"=>$data['goodsCount'][$key]
             ];
          Cate::create($data1);

        }

        return['status'=>"true",
            'message'=>"添加成功"];
//
    }
//订单列表
    public function cart(Request $request){
$cates=Cate::where('user_id',$request->post('user_id'))->get();
//dd($cates);
       $data=[];
       $data["totalCost"]=0;
foreach ($cates as $cate){
//    根据接口得出menu的信息
    $good=Menu::where('id',$cate['goods_id'])->first();

    $data['goods_list'][]=[
            'goods_id'=>$cate['goods_id'],
            'goods_name'=>$good['goods_name'],
            'goods_img'=>$good['goods_img'],
            'amount'=>$cate['amount'],
            'goods_price'=>$good['goods_price'],
    ];
    $data["totalCost"]=$cate['amount']*$good['goods_price']+ $data["totalCost"];

}
return [
    "goods_list"=>$data['goods_list'],
    'totalCost'=>$data["totalCost"]
];

//dd($cates);
    }


}

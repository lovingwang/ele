<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Mrgoon\AliSms\AliSms;

class ShopController extends Controller
{
    public  function list(Request $request){
        if($request->input('keyword')===null){
            $shops=Shop::where('status',1)->get();
        }else{
            $key=$request->input('keyword');
          $shops=Shop::search("$key")->where('status',1)->get();
//            $shops=Shop::where('status',1)->where('shop_name','like',"%$key%")->get();
        }


      foreach ($shops as $shop){
          $shop->distance= rand(1000,2000);
          $shop->estimate_time=$shop->distance / 100;
      }
//        dd($shop)
        return $shops;
    }
    public  function  index(Request $request){

//    dd(11);
//        得到id
      $id=$request->input('id');
        //        将它存在redis中
        //判断redis中有没有缓存
        $data=Redis::get("shop:".$id);
        if ($data){
            return $data;
        }
//      得到该条id信息
        $shop=Shop::findOrFail($id);
        $shop->distance= rand(1000,2000);
        $shop->estimate_time=$shop->distance / 100;
//        追加评论进去
   $shop->evaluate=[
        ["user_id"=>12344,
                "username"=>"w******k",
                "user_img"=>"http://www.homework.com/images/slider-pic4.jpeg",
                "time"=>"2017-2-22",
                "evaluate_code"=>1,
                "send_time"=>30,
                "evaluate_details"=>"不怎么好吃"],

            ["user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 4.5,
                "send_time"=> 30,
                "evaluate_details"=> "很好吃" ]
   ];
//得到分类
        $menu_categorys=MenuCategory::where('shop_id',$id)->get();
        foreach ($menu_categorys as $menu_category){
            $menu_category->goods_list=Menu::where('category_id',$menu_category->id)->get();
        }
//        再把这个追加到shop
        $shop->commodity=$menu_categorys;
        Redis::SETEX("shop:".$id,60*60*24*5,$shop);
return $shop;
    }
}

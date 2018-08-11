<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//}
//商家列表和商家具体商品展示
Route::any('shop/list','Api\ShopController@list');
Route::any('shop/index','Api\ShopController@index');
//会员注册
Route::any('member/sms','Api\MemberController@sms');
Route::any('member/reg','Api\MemberController@reg');
Route::any('member/login','Api\MemberController@login');
//重置密码
Route::post('member/reset','Api\MemberController@reset');
//修改密码
Route::any('member/change','Api\MemberController@change');
//积分和金钱
Route::any('member/detail','Api\MemberController@detail');
//收货地址
Route::any('address/add','Api\AddressController@add');
//收货地址列表
Route::any('address/list','Api\AddressController@list');

//修改地址
Route::any('address/show','Api\AddressController@show');
Route::any('address/edit','Api\AddressController@edit');

//添加订单
Route::any('cate/addc','Api\CateController@addc');
Route::any('cate/cart','Api\CateController@cart');
//添加订单接口
Route::any('order/adds','Api\OrderController@adds');
Route::any('order/info','Api\OrderController@info');
//支付接口
Route::any('order/pay','Api\OrderController@pay');
Route::any('order/odlist','Api\OrderController@odlist');
//微信支付
Route::any("order/wxPay","Api\OrderController@wxPay");
Route::get("order/status","Api\OrderController@status");
Route::any("order/ok","Api\OrderController@ok");

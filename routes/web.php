<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', function () {
    return view('index');
});

//清理未支付账单

Route::get('/order/clear',function (){
//找到当前所有未支付并且时间在设置时间以外的订单
//设置30分钟过期时间    30*60
//创建时间+过期时间>现在时间
    while (true){
        \App\Models\Order::where('status',0)->where("created_at",'<',date('Y-m-d H:i:s',(time()-30*60)))->update(['status'=>-1]);
 sleep(9);
    }

});
//配置点餐系统后平台路由
Route::domain('admin.eleb.com')->namespace('Admin')->group(function () {
//region 商家分类管理
    Route::get('shopCategory/index',"ShopCategoryController@index")->name('shopCategory.index');
    Route::any('shopCategory/add',"ShopCategoryController@add")->name('shopCategory.add');
    Route::any('shopCategory/edit/{id}',"ShopCategoryController@edit")->name('shopCategory.edit');
    Route::any('shopCategory/del/{id}',"ShopCategoryController@del")->name('shopCategory.del');
//endregion
//region 商家信息管理
    Route::get('shop/index',"ShopController@index")->name('shop.index');
    Route::any('shop/add',"ShopController@add")->name('shop.add');
    Route::any('shop/edit/{id}',"ShopController@edit")->name('shop.edit');
    Route::any('shop/del/{id}',"ShopController@del")->name('shop.del');
    Route::any('shop/check/{id}',"ShopController@check")->name('shop.check');
//endregion
//region 管理员的注册管理
    Route::any('admin/logout',"AdminController@logout")->name('admin.logout');
    Route::any('admin/login',"AdminController@login")->name('admin.login');
    Route::get('admin/index',"AdminController@index")->name('admin.index');
    Route::any('admin/add',"AdminController@add")->name('admin.add');
    Route::any('admin/edit/{id}',"AdminController@edit")->name('admin.edit');
    Route::any('admin/del/{id}',"AdminController@del")->name('admin.del');
    Route::get('admin/index0',"AdminController@index0")->name('admin.index0');
//endregion
//region 商家个人信息管理
    Route::get('user/index',"UserController@index")->name('user.index');
    Route::any('user/edit/{id}',"UserController@edit")->name('user.edit');
    Route::any('user/del/{id}',"UserController@del")->name('user.del');
    Route::any('user/reset/{id}',"UserController@reset")->name('user.reset');
    Route::any('user/info',"UserController@info")->name('user.info');
    Route::any('user/open/{id}',"UserController@open")->name('user.open');
    Route::any('user/close/{id}',"UserController@close")->name('user.close');
//endregion
//region 平台 活动管理
    Route::any('article/index',"ArticleController@index")->name('article.index');
    Route::any('article/add',"ArticleController@add")->name('article.add');
    Route::any('article/edit/{id}',"ArticleController@edit")->name('article.edit');
    Route::any('article/del/{id}',"ArticleController@del")->name('article.del');
//endregion
//region 会员的管理
    Route::any('member/index',"MemberController@index")->name('member.index');
    Route::any('member/add',"MemberController@add")->name('member.add');
    Route::any('member/edit/{id}',"MemberController@edit")->name('member.edit');
    Route::any('member/del/{id}',"MemberController@del")->name('member.del');
    Route::any('member/change/{id}',"MemberController@change")->name('member.change');
    Route::any('member/open/{id}',"MemberController@open")->name('member.open');
    Route::any('member/fill/{id}',"MemberController@fill")->name('member.fill');
//endregion
//region 订单量和菜单量
    Route::any('order/total',"OrderController@total")->name('order.total');
    Route::any('order/everyday',"OrderController@day")->name('order.everyday');
    Route::any('order/everymonth',"OrderController@month")->name('order.everymonth');

    Route::any('order/total1',"OrderController@total1")->name('order.total1');
    Route::any('order/everyday1',"OrderController@day1")->name('order.everyday1');
    Route::any('order/everymonth1',"OrderController@month1")->name('order.everymonth1');
//endregion
//region 平台权限分配RBAC
    Route::any('per/index',"PermissionController@index")->name('per.index');
    Route::any('per/add',"PermissionController@add")->name('per.add');
    Route::any('per/edit/{id}',"PermissionController@edit")->name('per.edit');
    Route::any('per/del/{id}',"PermissionController@del")->name('per.del');
//endregion
//region 权限角色
    Route::any('role/index',"RoleController@index")->name('role.index');
    Route::any('role/add',"RoleController@add")->name('role.add');
    Route::any('role/edit/{id}',"RoleController@edit")->name('role.edit');
    Route::any('role/del/{id}',"RoleController@del")->name('role.del');
//endregion
//region nav导航条菜单管理
    Route::any('nav/add',"NavController@add")->name('nav.add');
    Route::any('nav/index',"NavController@index")->name('nav.index');
    Route::any('nav/edit/{id}',"NavController@edit")->name('nav.edit');
    Route::any('nav/del/{id}',"NavController@del")->name('nav.del');
//endregion
//region 抽奖活动管理
    Route::any('event/index',"EventController@index")->name('event.index');
    Route::any('event/add',"EventController@add")->name('event.add');
    Route::any('event/edit/{id}',"EventController@edit")->name('event.edit');
    Route::any('event/del/{id}',"EventController@del")->name('event.del');
    Route::any('event/bonus/{id}',"EventController@bonus")->name('event.bonus');
//endregion
//region   报名列表
    Route::any('event/list/{id}',"EventController@list")->name('event.list');
    Route::any('event/prizeList/{id}',"EventController@prizeList")->name('event.prizeList');
//endregion
//region   抽奖奖品
    Route::any('eventPrize/index',"EventPrizeController@index")->name('eventPrize.index');
    Route::any('eventPrize/add',"EventPrizeController@add")->name('eventPrize.add');
    Route::any('eventPrize/edit/{id}',"EventPrizeController@edit")->name('eventPrize.edit');
    Route::any('eventPrize/del/{id}',"EventPrizeController@del")->name('eventPrize.del');
    Route::any('eventPrize/winner/{id}',"EventPrizeController@winner")->name('eventPrize.winner');

//endregion
});


Route::domain('shop.eleb.com')->namespace('Shop')->group(function () {
//region 商家注册管理
    Route::any('user/logout',"UserController@logout")->name('user.logout');
    Route::any('user/login',"UserController@login")->name('user.login');
    Route::any('user/reg',"UserController@reg")->name('user.reg');
    Route::any('user/change',"UserController@change")->name('user.change');
    Route::any('user/index0',"UserController@index0")->name('user.index0');
    Route::any('user/index1',"UserController@index1")->name('user.index1');
    Route::any('user/index2',"UserController@index2")->name('user.index2');
    Route::any('user/index3',"UserController@index3")->name('user.index3');
//endregion
//region 菜品分类管理
    Route::any('menu_categories/index',"MenuCategoryController@index")->name('menu_categories.index');
    Route::any('menu_categories/add',"MenuCategoryController@add")->name('menu_categories.add');
    Route::any('menu_categories/edit/{id}',"MenuCategoryController@edit")->name('menu_categories.edit');
    Route::any('menu_categories/del/{id}',"MenuCategoryController@del")->name('menu_categories.del');

//endregion
//region 菜品表
    Route::any('menu/index',"MenuController@index")->name('menu.index');
    Route::any('menu/add',"MenuController@add")->name('menu.add');
    Route::any('menu/edit/{id}',"MenuController@edit")->name('menu.edit');
    Route::any('menu/del/{id}',"MenuController@del")->name('menu.del');
//endregion
//region 订单列表
    Route::any('order/index',"OrderController@index")->name('order.index');
    Route::any('order/info/{id}',"OrderController@info")->name('order.info');
    Route::any('order/send/{id}',"OrderController@send")->name('order.send');
    Route::any('order/off/{id}',"OrderController@off")->name('order.off');
//endregion
//region 本商家的订单统计量
    Route::any('order/show',"OrderController@show")->name('order.show');
    Route::any('order/month',"OrderController@month")->name('order.month');
    Route::any('order/day',"OrderController@day")->name('order.day');
//endregion
 //region 本商家的菜品统计量
    Route::any('order/show1',"OrderController@show1")->name('order.show1');
    Route::any('order/month1',"OrderController@month1")->name('order.month1');
    Route::any('order/day1',"OrderController@day1")->name('order.day1');
//endregion
//region 抽奖活动列表
    Route::any('prize/index',"EventController@index")->name('prize.index');
    Route::any('prize/join/{id}',"EventController@join")->name('prize.join');
    Route::any('prize/show',"EventController@show")->name('prize.show');
    Route::any('prize/info/{id}',"EventController@info")->name('prize.info');
//endregion

});

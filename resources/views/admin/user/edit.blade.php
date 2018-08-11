@extends('admin.layouts.default')
@section("title","商家账号编辑")
@section("content")

    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">商家名称</label>
            <input type="text"   class="form-control"  value="{{$shop->shop_name}}" name="shop_name" style="width: 400px" id="exampleInputEmail1" placeholder="请输入商家名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">商家分类</label>
        </div>
        <select  class="form-control" style="width: 35%"name="shop_category_id">
            @foreach($shopCategorys as $shopCategory)
                <option value="{{$shopCategory->id}}"@if($shopCategory->id==$shop->shop_category_id) selected @endif >{{$shopCategory->name}}</option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="exampleInputEmail1">商家评分</label>
            <input type="text"   class="form-control" name="shop_rating"   value="{{$shop->shop_rating}}" style="width: 400px" id="exampleInputEmail1" placeholder="请输入商家评分">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">起送费</label>
            <input type="text"   class="form-control" name="start_send"  value="{{$shop->start_send}}" style="width: 400px" id="exampleInputEmail1" placeholder="请输入起送费">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">配送费</label>
            <input type="text"   class="form-control" name="send_cost"   value="{{$shop->send_cost}}"style="width: 400px" id="exampleInputEmail1" placeholder="请输入配送费">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">店内公告</label>
            <input type="text"   class="form-control" name="notice"   value="{{$shop->notice}}"style="width: 400px" id="exampleInputEmail1" placeholder="请输入公告">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">店内优惠</label>
            <input type="text"   class="form-control" name="discount"   value="{{$shop->discount}}"style="width: 400px" id="exampleInputEmail1" placeholder="请输入优惠">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">是否品牌</label>
            <input type="radio"   name="brand" value="1" {{$shop->brand?"checked":''}}>是
            <input type="radio"   name="brand" value="0" {{$shop->brand?"":'checked'}}>否
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">是否准时</label>
            <input type="radio"   name="on_time" value="1"  {{$shop->on_time?"checked":''}}>是
            <input type="radio"   name="on_time" value="0"{{$shop->on_time?"":'checked'}}>否
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">是否蜂鸟</label>
            <input type="radio"   name="fengniao" value="1"  {{$shop->fengniao?"checked":''}}>是
            <input type="radio"   name="fengniao" value="0" {{$shop->fengniao?"":'checked'}}>否
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">是否保</label>
            <input type="radio"   name="bao" value="1" {{$shop->bao?"checked":''}}>是
            <input type="radio"   name="bao" value="0"{{$shop->bao?"":'checked'}}>否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否票</label>
            <input type="radio"   name="piao" value="1" {{$shop->piao?"checked":''}}>是
            <input type="radio"   name="piao" value="0"{{$shop->piao?"":'checked'}}>否
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">是否准标记</label>
            <input type="radio"   name="zhun" value="1" {{$shop->zhun?"checked":''}}>是
            <input type="radio"   name="zhun" value="0"{{$shop->zhun?"":'checked'}}>否
        </div>
        {{--<div class="form-group">--}}
        {{--<label for="exampleInputEmail1">是否审核</label>--}}
        {{--<input type="radio"   name="status" value="1">是--}}
        {{--<input type="radio"   name="status" value="0">否--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="exampleInputEmail1">商家图片</label>
        </div> <input type="file"  name="shop_img"  >
         <img src="{{$shop->shop_img}}" style="width: 100px">
        <div class="form-group">

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> 确认商家名字</label>
            <input type="text" class="form-control"name="name" value="{{$user->name}}"  id="exampleInputEmail1" placeholder="name">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">注册邮箱</label>
            <input type="email" class="form-control"name="email" value="{{$user->email}}" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">设置密码</label>
            <input type="password" class="form-control" name="password" value="{{$user->password}}"id="exampleInputPassword1" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-warning">确认修改</button>

    </form>
@stop

    @extends('admin.layouts.default')
    @section("title","商家管理信息添加")
    @section('content')

<h2 style="color: red" >商家管理</h2>


<form    action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">商家名称</label>
        <input type="text"   class="form-control" name="shop_name" style="width: 400px" id="exampleInputEmail1" placeholder="请输入商家名称">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">商家分类</label>
    </div>
    <select  class="form-control" style="width: 36%"name="shop_category_id">
        @foreach($shopCategorys as $shopCategory)
            <option value="{{$shopCategory->id}}" >{{$shopCategory->name}}</option>
        @endforeach
    </select>
    <div class="form-group">
        <label for="exampleInputEmail1">商家评分</label>
        <input type="text"   class="form-control" name="shop_rating" style="width: 400px" id="exampleInputEmail1" placeholder="请输入商家名称">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">起送费</label>
        <input type="text"   class="form-control" name="start_send" style="width: 400px" id="exampleInputEmail1" placeholder="请输入起送费">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">配送费</label>
        <input type="text"   class="form-control" name="send_cost" style="width: 400px" id="exampleInputEmail1" placeholder="请输入配送费">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">店内公告</label>
        <input type="text"   class="form-control" name="notice" style="width: 400px" id="exampleInputEmail1" placeholder="请输入公告">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">店内优惠</label>
        <input type="text"   class="form-control" name="discount" style="width: 400px" id="exampleInputEmail1" placeholder="请输入优惠">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">是否品牌</label>
        <input type="radio"   name="brand" value="1">是
        <input type="radio"   name="brand" value="0">否
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">是否准时</label>
        <input type="radio"   name="on_time" value="1">是
        <input type="radio"   name="on_time" value="0">否
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">是否蜂鸟</label>
        <input type="radio"   name="fengniao" value="1">是
        <input type="radio"   name="fengniao" value="0">否
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">是否保</label>
        <input type="radio"   name="bao" value="1">是
        <input type="radio"   name="bao" value="0">否
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">是否票</label>
        <input type="radio"   name="piao" value="1">是
        <input type="radio"   name="piao" value="0">否
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">是否准标记</label>
        <input type="radio"   name="zhun" value="1">是
        <input type="radio"   name="zhun" value="0">否
    </div>
    {{--<div class="form-group">--}}
        {{--<label for="exampleInputEmail1">是否审核</label>--}}
        {{--<input type="radio"   name="status" value="1">是--}}
        {{--<input type="radio"   name="status" value="0">否--}}
    {{--</div>--}}
    <div class="form-group">
        <label for="exampleInputEmail1">商家图片</label>
    </div> <input type="file"  name="shop_img"  >
    <div class="form-group">

        <div class="form-group">

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> 确认注册名称</label>
            <input type="text" class="form-control"name="name" style="width: 37%" id="exampleInputEmail1" placeholder="name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">注册邮箱</label>
            <input type="email" class="form-control"name="email"  style="width: 37%" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">设置密码</label>
            <input type="password" class="form-control" name="password" style="width: 37%" id="exampleInputPassword1" placeholder="Password">
        </div>




    </div> <button type="submit" class="btn btn-warning">确认添加</button>

</form>

    @endsection

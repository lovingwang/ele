@extends('shop.layouts.default')
@section('title','菜品编辑')
@section('content')

    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品名称</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" name="goods_name" value="{{$menu->goods_name}}" id="inputEmail3" placeholder="请输入名称" value="{{old('goods_name')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品类别</label>
            <div class="col-sm-3">
            <select class="form-control" name="category_id">
                @foreach($menu_categories as $menu_category)
                    <option value="<?=$menu_category->id?>"><?=$menu_category->name?></option>
                @endforeach
            </select>
            </div>
            </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-3">
                <select class="form-control" name="shop_id">
                    @foreach($shops as $shop)
                        <option value="<?=$shop->id?>"><?=$shop->shop_name?></option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">菜品图片</label>
            <div class="col-sm-3">
                <input type="file" class="form-control" name="goods_img" >
                <img src="{{$menu->goods_img}}" style="height: 50px" alt="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">是否上架</label>
            <div class="col-sm-3">
                <label>
                    <input type="radio" name="status"    value="1" {{$menu->status?'checked':""}}  >是
                    <input type="radio" name="status"  value="0" {{$menu->status?'':"checked"}} >否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">售卖价格</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" value="{{old('goods_price',$menu->goods_price)}}" name="goods_price">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">提示</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" value="{{old('tips',$menu->tips)}}" name="tips">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">菜品描述</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" value="{{old('description',$menu->description)}}" name="description">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-3">
                <input type="submit" class="btn btn-success" value="编辑">
            </div>
        </div>
    </form>

@stop

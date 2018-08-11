@extends('shop.layouts.default')
@section("title","菜品分类编辑")
@section("content")
    <h1 class="text-center">菜品分类编辑</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1"> 菜品分类名称</label>
            <input type="text" class="form-control"name="name" value="{{$menucategory->name}}" id="exampleInputEmail1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> 菜品编号</label>
            <input type="text" class="form-control"name="type_accumulation" value="{{$menucategory->type_accumulation}}" id="exampleInputEmail1" placeholder="编号">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1"> 所属商家</label>
        <select  name="shop_id"class="form-control">
            @foreach($shops as $shop)
            <option value="{{$shop->id}}">{{$shop->shop_name}} </option>
                @endforeach
        </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">菜品描述</label>
            <input type="text" class="form-control" name="description"value="{{$menucategory->description}}"id="exampleInputPassword1" placeholder="描述">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">是否默认类</label>
            <input type="radio"  value="1" name="is_selected"  @if($menucategory->is_selected=='1')checked @endif id="exampleInputPassword1" >是
            <input type="radio" value="0" name="is_selected" @if($menucategory->is_selected==="0")checked @endif id="exampleInputPassword1" >否
        </div>

      <button type="submit" class="btn btn-warning">确认修改</button>

    </form>
@stop

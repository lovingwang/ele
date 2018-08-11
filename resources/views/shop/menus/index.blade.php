@extends('shop.layouts.default')
@section('title','菜单列表首页')
@section('content')
    <div class="container-fluid " style="margin-right:22px">
<?php

        $shop_id = \Illuminate\Support\Facades\Auth::user()->shop_id;

        if(\App\Models\Shop::where('id',$shop_id)->first()->status==0){

       echo  "对不起，你的菜单还在审核中。。。";
        }else
          {


        ?>
    <a href="{{route('menu.add')}}" class="btn btn-primary">添加</a>

        <form class="form-inline navbar-right">
            {{csrf_field()}}
            <div class="form-group">
                <div class="form-group">
                    按类 <select name="category_id">
                        <option value="">菜品类</option>
                        @foreach($menu_categories as $menu_category)
                            <option  size="4" value="{{$menu_category->id}}" @if($menu_category->id=="$kind") selected @endif>{{$menu_category->name}}</option>
                        @endforeach
                    </select>
                </div>
                按价格区间：<input type="text" size="4" name="min_price" value="{{request()->input('min_price')}}">元 ---<input type="text" name="max_price"   size="4" value="{{request()->input('max_price')}}">元
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="search" value="{{request()->input('search')}}" placeholder="请输入搜索内容">
            </div>
            <button type="submit" class="form-control btn-warning">搜索</button>

        </form>
    </div>
    <div class="warp" style="height: 400px">
    <table class="table table-hover table-bordered text-center" style="font-size: 12px">
        <tr style="background:orange">
            <th class="text-center">名称</th>
            <th class="text-center">所属商家</th>
            <th class="text-center">所属分类</th>
            <th class="text-center">商品图片</th>
            <th class="text-center">价格</th>
            <th class="text-center">描述</th>
            <th class="text-center">月销量</th>
            <th class="text-center">评分</th>
            <th class="text-center">评分数量</th>
            <th class="text-center">提示信息</th>
            <th class="text-center">满意度数量</th>
            <th class="text-center">满意度评分</th>
            <th class="text-center">是否上架</th>
            <th >操作</th>
        </tr>
        @foreach($menuses as $menus)
        <tr style="background: #f0c674">
            <td>{{$menus->goods_name}}</td>
            <td>{{$menus->shop->shop_name}}</td>
            <td>{{$menus->categories->name}}</td>
            <td>
              @if($menus->goods_img)
                  <img src="{{$menus->goods_img}}"style="width: 80px;height: 40px">
              @endif
            </td>
            <td>{{$menus->goods_price}}</td>
            <td style="width:120px">{{$menus->description}}</td>
            <td>{{$menus->month_sales}}</td>
            <td>{{$menus->rating}}</td>
            <td>{{$menus->rating_count}}</td>
            <td>{{$menus->tips}}</td>
            <td>{{$menus->satisfy_count}}</td>
            <td>{{$menus->satisfy_rate}}</td>
            <td>
         @if ($menus->status=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif
            </td>

            <td class="text">
                <a href="{{route('menu.edit',$menus->id)}}" class="btn btn-primary glyphicon glyphicon-edit"></a>
                <a href="{{route('menu.del',$menus->id)}}" class="btn btn-danger  glyphicon glyphicon-trash"></a>

            </td>
        </tr>
            @endforeach
    </table>

    {{$menuses->appends(['category_id'=>$kind,'min_price'=>$min_price,'max_price'=>$max_price,'search'=>$search])->links()}}
        <?php } ?>
    </div>
@stop

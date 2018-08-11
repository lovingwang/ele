@extends('shop.layouts.default')
@section("title","菜品首页")
@section("content")
    <div class="container-fluid" style="height: 400px">

    <a  class="btn btn-warning"href="{{route('menu_categories.add')}}">添加</a>
<table class="table table-hover">

    <tr style="background:orange">
        <th>id</th>
        <th>菜品名字</th>
        <th>菜品编号</th>
        <th>所属商家</th>
        <th>描述</th>
        <th>是否默认类</th>
        <th>操作</th>
    </tr>

        @foreach($menucategorys as $menucategory)
        <tr style="background:#f0c674">
        <td>{{$menucategory->id}}</td>
        <td>{{$menucategory->name}}</td>
        <td>{{$menucategory->type_accumulation}}</td>
        <td>{{$menucategory->shop->shop_name}}</td>
        <td>{{$menucategory->description}}</td>
        <td>@if ($menucategory->is_selected=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif</td>
           <td> <a  class="btn btn-warning"href="{{route('menu_categories.edit',$menucategory)}}">编辑</a>
            <a  class="btn btn-danger"href="{{route('menu_categories.del',$menucategory)}}">删除</a></td>

    </tr>

    @endforeach
</table>


</div>
    {{$menucategorys->links()}}

@stop


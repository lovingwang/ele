    @extends('admin.layouts.default')
    @section("title","商家信息管理首页")
    @section('content')
<h1 style="color: red" class="text-center">商家信息管理</h1>
<a href="{{route('shop.add')}}" class=" btn btn-warning">添加</a>
   <table  class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>商家分类</th>
         <th>商家名称</th>
         <th>商家图片</th>
         <th>评分</th>
         <th>是否名牌</th>
         <th>是否准时</th>
         <th>是否蜂鸟</th>
         <th>是否保</th>
         <th>是否票</th>
         <th>是否准标记</th>
         <th>起送费</th>
         <th>配送费</th>
         <th>店内公告</th>
         <th>优惠信息</th>
         <th>是否审核</th>
         <th>操作</th>
     </tr>
      @foreach($shops as $shop)
           <tr  >
               <td style="width: 20px">{{$shop->id}}</td>
               <td>{{$shop->shopCategory->name}}</td>
               <td>{{$shop->shop_name}}</td>
               <td> <img src="{{$shop->shop_img}}" style="width: 100px" ></td>
               <td>{{$shop->shop_rating}}</td>
               <td>@if ($shop->brand=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif</td>
               <td>@if ($shop->on_time=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif</td>
               <td>@if ($shop->fengniao=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif</td>
               <td>@if ($shop->bao=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif</td>
               <td>@if ($shop->piao=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif</td>
               <td>
                   @if ($shop->zhun=="1")<img src="/bootstrap/1.gif">@else <img src="/bootstrap/0.gif">@endif
               </td>
               <td>{{$shop->start_send}}</td>
               <td>{{$shop->send_cost}}</td>
               <td>{{$shop->notice}}</td>
              <td>{{$shop->discount}}</td>
               <td>
<?php  if($shop->status=='1'){
    echo '<a href="#"  class="btn btn-warning"  onclick="return false">已审</a>';

                   }else{
                   ?>
                   <a class="btn btn-warning" href="{{route('shop.check',['id'=>$shop->id])}}">审核 </a>
    <?php }?>    </td>


           <td>

            <a class="btn btn-info" href="{{route('shop.edit',['id'=>$shop->id])}}">编辑</a>
               <a class="btn btn-danger" href="{{route('shop.del',['id'=>$shop->id])}}">删除</a>
           </td>
       </tr>
          @endforeach
   </table>
        {{$shops->links()}}

    @endsection

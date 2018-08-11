    @extends('admin.layouts.default')
    @section("title","管理员首页")
    @section('content')

<h1 style="color: red" class="text-center">会员</h1>
<a href="{{route('member.add')}}" class=" btn btn-warning">添加</a>
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>会员名字</th>
         <th>会员电话</th>
         <th>金钱</th>
         <th>积分</th>
         <th>状态</th>

         <th>操作</th>
     </tr>
      @foreach($members as $member)
           <tr  >
               <td >{{$member->id}}</td>
               <td>{{$member->username}}</td>
               <td>{{$member->tel}}</td>
               <td>{{$member->money}}</td>
               <td>{{$member->jifen}}</td>
               <td>@if($member->status==1)<img src="/bootstrap/1.gif">@else<img src="/bootstrap/0.gif">@endif</td>
           <td>
               <a class="btn btn-success" href="{{route('member.fill',['id'=>$member->id])}}">充值</a>
            <a class="btn btn-info" href="{{route('member.edit',['id'=>$member->id])}}">编辑</a>
               <a class="btn btn-danger" href="{{route('member.del',['id'=>$member->id])}}">删除</a>
               @if($member->status==1)
               <a class="btn btn-warning" href="{{route('member.change',['id'=>$member->id])}}">禁用</a>
                   @endif
               @if($member->status==0)
                   <a class="btn btn-warning" href="{{route('member.open',['id'=>$member->id])}}">启用</a>
               @endif
           </td>
       </tr>
          @endforeach
   </table>
        {{$members->links()}}

    @endsection

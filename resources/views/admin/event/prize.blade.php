    @extends('admin.layouts.default')
    @section("title","奖品")
    @section('content')

<h1 style="color: red" class="text-center">奖品</h1>
<a href="{{route('event.index')}}" class=" btn btn-warning ">返回</a>
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>活动id</th>
         <th>奖品名称</th>
         <th>奖品详情</th>
         <th>中奖商家</th>

     </tr>
      @foreach($prizes as $prize)
           <tr  >
               <td >{{$prize->id}}</td>
               <td>{{$prize->event->title}}</td>
               <td> {{$prize->name}}</td>
               <td>{{$prize->description}}</td>
               <td>{{$prize->user_id}}</td>

       </tr>
          @endforeach
   </table>
        {{$prizes->links()}}

    @endsection

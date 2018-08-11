    @extends('shop.layouts.default')
    @section("title","奖品信息")
    @section('content')

<h1 style="color: red" class="text-center">奖品信息</h1>
{{--<a href="{{route('event.add')}}" class=" btn btn-warning  glyphicon glyphicon-plus"></a>--}}
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th>活动奖品</th>
         <th>产品描述</th>
     </tr>
      @foreach($prizes as $prize)
           <tr  >
               <td >{{$prize->name}}</td>
               <td>{{$prize->description}}</td>

       </tr>
          @endforeach
   </table>

{{$prizes->links()}}
    @endsection

    @extends('shop.layouts.default')
    @section("title","中奖首页")
    @section('content')

<h1 style="color: red" class="text-center">中奖单</h1>
{{--<a href="{{route('event.add')}}" class=" btn btn-warning  glyphicon glyphicon-plus"></a>--}}
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>活动标题</th>
         <th>中奖产品</th>
     </tr>
      @foreach($shows as $show)
           <tr  >
               <td >{{$show->id}}</td>
               <td>{{$show->e}}</td>
               <td> {{$show->name }}</td>

       </tr>
          @endforeach
   </table>

{{$shows->links()}}
    @endsection

    @extends('admin.layouts.default')
    @section("title","报名首页")
    @section('content')

<h1 style="color: red" class="text-center">报名列表</h1>
<a href="{{route('event.index')}}" class=" btn btn-warning ">返回</a>
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>活动id</th>
         <th>商家id</th>
         {{--<th>操作</th>--}}
     </tr>
      @foreach($eventusers as $eventuser)
           <tr  >
               <td >{{$eventuser->id}}</td>
               <td>{{$eventuser->event->title}}</td>
               <td> {{$eventuser->user->name}}</td>
           {{--<td>--}}

            {{--<a class="btn btn-info glyphicon glyphicon-edit" href="{{route('eventPrize.edit',['id'=>$prize->id])}}"></a>--}}
               {{--<a class="btn btn-danger glyphicon glyphicon-trash" href="{{route('eventUser.del',['id'=>$eventuser->id])}}"></a>--}}

           {{--</td>--}}
       </tr>
          @endforeach
   </table>
        {{$eventusers->links()}}

    @endsection

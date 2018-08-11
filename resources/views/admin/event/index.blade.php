    @extends('admin.layouts.default')
    @section("title","抽奖首页")
    @section('content')

<h1 style="color: red" class="text-center">抽奖活动列表</h1>
<a href="{{route('event.add')}}" class=" btn btn-warning  glyphicon glyphicon-plus"></a>
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>活动标题</th>
         <th>活动内容</th>
         <th>报名时间</th>
         <th>报名结束</th>
         <th>开奖日期</th>
         <th>已报/总数</th>
         <th>是否开奖</th>
         <th>操作</th>
     </tr>
      @foreach($events as $event)
           <tr  >
               <td >{{$event->id}}</td>
               <td>{{$event->title}}</td>
               <td> {!!$event->content !!}</td>
               <td>{{date('Y-m-d ',$event->start_time)}}</td>
               <td>{{date('Y-m-d ',$event->end_time)}}</td>
               <td>{{ date('Y-m-d',$event->prize_time)}}</td>
               <td>{{\App\Models\EventUser::where('event_id', $event->id)->count()}}/{{$event->num}}</td>
               <td>{{$event->is_prize}}</td>
           <td>

            <a class="btn btn-info glyphicon glyphicon-edit" href="{{route('event.edit',['id'=>$event->id])}}"></a>
               <a class="btn btn-danger glyphicon glyphicon-trash" href="{{route('event.del',['id'=>$event->id])}}"></a>
              {{--@if($event->is_prize==1)    <a class="btn btn-danger" href="javascript:;">已抽奖</a> @endif--}}
               @if($event->is_prize==0)     <a class="btn btn-success" href="{{route('event.bonus',['id'=>$event->id])}}">抽奖</a>@endif
               <a class="btn btn-info" href="{{route('event.list',['id'=>$event->id])}}">报名列表</a>
               <a class="btn btn-warning" href="{{route('event.prizeList',['id'=>$event->id])}}">奖品列表</a>
               <a class="btn btn-success" href="{{route('eventPrize.winner',['id'=>$event->id])}}">获奖列表</a>
           </td>
       </tr>
          @endforeach
   </table>
        {{$events->links()}}

    @endsection

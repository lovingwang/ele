    @extends('shop.layouts.default')
    @section("title","抽奖首页")
    @section('content')

<h1 style="color: red" class="text-center">抽奖活动列表</h1>
{{--<a href="{{route('event.add')}}" class=" btn btn-warning  glyphicon glyphicon-plus"></a>--}}
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>活动标题</th>
         <th>活动内容</th>
         <th>报名时间</th>
         <th>报名结束</th>
         <th>开奖日期</th>
         <th>报名人数/限制人数</th>
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
               <td>  {{\App\Models\EventUser::where('event_id', $event->id)->count()}} /{{$event->num}}</td>
               {{--<td>{{$event->num}}</td>--}}


               <td>@if($event->is_prize=="1") 已开奖
                   @else 未开奖
                   @endif</td>
           <td>

               @if($event->is_prize=="1")
                   <a class="btn btn-danger" href="javascript:;">活动结束</a>
                   @elseif($event->start_time>time())
                   <a class="btn btn-warning" href="{{route('prize.info',$event)}}">详情</a>
                   <a class="btn btn-danger" href="javascript:;">未开始</a>
               @elseif(time()<$event->end_time &&time()>$event->start_time)
                   <a class="btn btn-warning" href="{{route('prize.info',$event)}}">详情</a>
               <a class="btn btn-success" href="{{route('prize.join',['id'=>$event->id])}}">请报名</a>
                   @elseif(time()>$event->end_time)
                   <a class="btn btn-warning" href="{{route('prize.info',$event)}}">详情</a>
                   <a class="btn btn-danger" href="javascript:;">已结束</a>
            @endif
              {{--@if($event->is_prize==1)    <a class="btn btn-danger" href="javascript:;">已抽奖</a> @endif--}}


           </td>
       </tr>
          @endforeach
   </table>
        {{$events->links()}}

    @endsection

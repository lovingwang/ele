@extends('shop.layouts.default')
@section("title","最新活动")
@section("content")

	<div class="wrap" style="height: 450px">
	<div class="total">
        <marquee width=100% behavior=alternate direction=left align=middle>
            <h2><font color="orange">最新活动正在火热进行中。。。。。。</font></h2></marquee>
	</div>
        <div style="float: left"><a href="{{route('prize.index')}}"><h4>商家抽奖活动</h4></a></div>
        <div style="float: right"><a href="{{route('prize.show')}}"><h4>我的中奖纪录</h4></a></div>
        <table class="table table-hover">
            <caption style="text-align:center"></caption>
         <tr style="background: orchid"> <th >活动主题</th><th>活动详情</th><th>活动开始时间</th><th>活动结束时间 </th>
            </tr>
            @foreach($articles as $article)
            <tr style="background:pink">
                <td>{{$article->name}}</td>
                <td>{!!  $article->content!!}</td>
                <td>{{$article->start_time}}</td>
                <td>{{$article->end_time}} </td>
            </tr>
                @endforeach
        </table>
        {{$articles->links()}}
</div>


@endsection
    	
    	
            
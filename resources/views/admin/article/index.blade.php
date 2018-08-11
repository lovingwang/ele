    @extends('admin.layouts.default')
    @section("title","活动管理首页")
    @section('content')

<h1 style="color: rebeccapurple" class="text-center">活动管理</h1>
<a href="{{route('article.add')}}" class=" btn btn-warning">添加</a>
<form class="form-inline navbar-right">
    {{csrf_field()}}
    <div class="form-group" >

      条件： <select  style="height: 30px;background:darksalmon" name="time"  >
            <option  value="" >请选择</option>
            <option  value="0"  >未开始</option>
            <option  value="1"  >进行中</option>
            <option  value="-1" >已结束</option>
            </select>
        </div>
    &nbsp;&nbsp;
    <input type="submit" class="form-group btn-info" style="height: 30px" value="筛选">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</form>
   <table class="table table-bordered"  >
     <tr  style="color: blue;background:hotpink">
         <th >id</th>
         <th>活动名称</th>
         <th>活动内容</th>
         <th>开始时间</th>
         <th>结束时间</th>
         <th>操作</th>
     </tr>
      @foreach($articles as $article)
       <tr style="background: orange" >
           <td >{{$article->id}}</td>
           <td>{{$article->name}}</td>
           <td> {!!$article->content!!}</td>
           <td>{{$article->start_time}}</td>
           <td>{{$article->end_time}}</td>
           <td>
            <a class="btn btn-info" href="{{route('article.edit',['id'=>$article->id])}}">编辑</a>

               &nbsp;&nbsp;&nbsp; <a class="btn btn-danger" href="{{route('article.del',['id'=>$article->id])}}">删除</a>
           </td>
       </tr>
          @endforeach
   </table>
        {{$articles->appends($data)->links()}}

    @endsection

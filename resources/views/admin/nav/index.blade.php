    @extends('admin.layouts.default')
    @section("title","导航首页")
    @section('content')

<h1 style="color: red" class="text-center">导航管理</h1>
<a href="{{route('nav.add')}}" class=" btn btn-warning">添加</a>
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>导航名字</th>
         <th>url</th>
         <th>所属父级</th>
<th>操作</th>
     </tr>
      @foreach($navs as $nav)
           <tr  >
               <td >{{$nav->id}}</td>
               <td>{{$nav->name}}</td>
               <td>{{$nav->url}}</td>
<td>{{$nav->pid}}</td>
               <td>
                   <a href="{{route('nav.edit',$nav)}}" class=" btn btn-info">编辑</a>
                   <a href="{{route('nav.del',$nav)}}" class=" btn btn-danger">删除</a>
               </td>


       </tr>
          @endforeach
   </table>
{{$navs->links()}}

    @endsection

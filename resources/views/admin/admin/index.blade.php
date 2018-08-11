    @extends('admin.layouts.default')
    @section("title","管理员首页")
    @section('content')

<h1 style="color: red" class="text-center">管理员</h1>
<a href="{{route('admin.add')}}" class=" btn btn-warning">添加</a>
   <table class="table table-hover"  >
     <tr  style="color: deeppink;background:gainsboro">
         <th >id</th>
         <th>管理员名字</th>
         <th>管理员邮箱</th>
         <th>所属类别</th>
         <th>操作</th>
     </tr>
      @foreach($admins as $admin)
           <tr  >
               <td >{{$admin->id}}</td>
               <td>{{$admin->name}}</td>
               <td>{{$admin->email}}</td>
<td>{{str_replace(['[',']','"'],'',json_encode($admin->getRoleNames(),JSON_UNESCAPED_UNICODE))}}</td>

           <td>
               @if($admin->id!=1)
            <a class="btn btn-info" href="{{route('admin.edit',['id'=>$admin->id])}}">编辑</a>
               <a class="btn btn-danger" href="{{route('admin.del',['id'=>$admin->id])}}">删除</a>
          @endif
           </td>
       </tr>
          @endforeach
   </table>
        {{$admins->links()}}

    @endsection

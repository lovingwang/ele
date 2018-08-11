@extends('admin.layouts.default')
@section("title","展示权限")
@section("content")
    <h1 class="text-center">展示权限</h1>
    <a href="{{route('per.add')}}" class=" btn btn-warning">添加</a>
    <table class="table table-hover"  >
        <tr  style="color: deeppink;background:gainsboro">
            <th >id</th>
            <th>权限名字</th>
            <th>guard</th>
<th>操作</th>
        </tr>
        @foreach($pers as $per)
            <tr  >
                <td >{{$per->id}}</td>
                <td>{{$per->name}}</td>
                <td>{{$per->guard_name}}</td>
<td>
    <a href="{{route('per.edit',$per)}}" class=" btn btn-info">编辑</a>
    <a href="{{route('per.del',$per)}}" class=" btn btn-danger">删除</a>
</td>
            </tr>
        @endforeach
    </table>
    {{$pers->links()}}
@stop

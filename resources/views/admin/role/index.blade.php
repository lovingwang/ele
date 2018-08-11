@extends('admin.layouts.default')
@section("title","展示权限")
@section("content")
    <h1 class="text-center">展示角色</h1>
    <a href="{{route('role.add')}}" class=" btn btn-warning">添加</a>
    <table class="table table-hover" style="table-layout: fixed" >
        <tr  style="color: deeppink;background:gainsboro">
            <th style="width: 50px">id</th>
            <th  style="width: 150px">角色名字</th>
            <th  style="width: 150px">guard</th>
            <th>拥有的权限</th>
<th  style="width: 250px">操作</th>
        </tr>
        @foreach($roles as $role)
            <tr  >
                <td >{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->guard_name}}</td>
                <td style="width: 200px ;word-WRAP: break-word">{{str_replace(['[',']','"'],'', $role->permissions()->pluck('name')) }}</td>
<td>
    <a href="{{route('role.edit',$role)}}" class=" btn btn-info">编辑</a>
    <a href="{{route('role.del',$role)}}" class=" btn btn-danger">删除</a>
</td>
            </tr>
        @endforeach
    </table>
@stop

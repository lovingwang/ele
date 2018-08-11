@extends('admin.layouts.default')
@section("title","添加编辑")
@section("content")
    <h1 class="text-center">添加权限</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1"> 权限名称</label>
            <input type="text" class="form-control"name="name" value="{{$per->name}}" id="exampleInputEmail1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1"> guard</label>
            <input type="text" class="form-control"name="guard_name" value="{{$per->guard_name}}" id="exampleInputEmail1" >
        </div>
      <button type="submit" class="btn btn-warning">确认编辑</button>

    </form>
@stop

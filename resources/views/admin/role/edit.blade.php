@extends('admin.layouts.default')
@section("title","编辑角色")
@section("content")
    <h1 class="text-center">编辑角色</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}


            <div class="form-group">
                <label for="exampleInputEmail1"> 角色名称</label>
                <input type="text" class="form-control"name="name" value="{{old('name',$role->name)}}" id="exampleInputEmail1" placeholder="name">
            </div>
        <label for="exampleInputEmail1"> 权限名称</label>
        <div class="form-group">

            @foreach($pers as $per)
            <input type="checkbox" name="per[]"  value="{{$per->name}}"
                   @if($role->hasPermissionTo($per->name)) checked @endif   id="exampleInputEmail1" >{{$per->name}}
                @endforeach
        </div>



      <button type="submit" class="btn btn-warning">确认编辑</button>

    </form>
@stop

@extends('admin.layouts.default')
@section("title","添加角色")
@section("content")
    <h1 class="text-center">添加角色</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}


            <div class="form-group">
                <label for="exampleInputEmail1"> 角色名称</label>
                <input type="text" class="form-control"name="name" value="{{old('name')}}" id="exampleInputEmail1" placeholder="name">
            </div>


            @foreach($pers as $per)
            <input type="checkbox" name="per[]"  value="{{$per->name}}" id="exampleInputEmail1" >{{$per->name}}
                @endforeach
        </div>



      <button type="submit" class="btn btn-warning">确认添加</button>

    </form>
@stop

@extends('admin.layouts.default')
@section("title","编辑管理员")
@section("content")
    <h1 class="text-center">编辑管理员</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1"> 管理员名称</label>
            <input type="text" class="form-control"name="name" value="{{$admin->name}}"id="exampleInputEmail1" placeholder="name">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">注册邮箱</label>
            <input type="email" class="form-control"name="email" value="{{$admin->email}}" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">旧密码</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" class="form-control" name="new_password" id="exampleInputPassword1" placeholder="newPassword">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">创建角色</label>
            @foreach($roles as $role)
                <input type="checkbox" name="role[]"   @if($admin->hasRole($role->name)) checked @endif  value="{{$role->name}}" id="exampleInputEmail1" >{{$role->name}}
            @endforeach
        </div>


        <button type="submit" class="btn btn-warning">确认修改</button>

    </form>
@stop

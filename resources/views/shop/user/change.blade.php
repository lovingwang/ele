@extends('shop.layouts.default')
@section("title","编辑管理员")
@section("content")
    <h1 class="text-center">修改密码</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputPassword1">旧密码</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" class="form-control" name="new_password" id="exampleInputPassword1" placeholder="newPassword">
        </div>

      <button type="submit" class="btn btn-warning">确认修改</button>

    </form>
@stop

@extends('shop.layouts.default')
@section("title","登录")
@section("content")


    <form  action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">用户名称</label>
            <input type="text" class="form-control"  name="name" style="width: 400px" id="exampleInputEmail1" placeholder="请输入用户名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">用户密码</label>
            <input type="password" class="form-control" name="password" style="width: 400px"  id="exampleInputPassword1" placeholder="请输入密码">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> 记住我了吗
            </label>
        </div>


        <button type="submit" class="btn btn-warning">确认登录</button>
    </form>
@stop

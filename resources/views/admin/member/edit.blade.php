@extends('admin.layouts.default')
@section("title","添加管理员")
@section("content")
    <h1 class="text-center">编辑会员</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1"> 会员名称</label>
            <input type="text" class="form-control"name="username" value="{{$member->username}}" id="exampleInputEmail1" placeholder="username">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">会员电话</label>
            <input type="text" class="form-control"name="tel"  value="{{$member->tel}}" id="exampleInputEmail1" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">会员金钱</label>
            <input type="text" class="form-control"name="money" value=" {{$member->money}}" id="exampleInputEmail1" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">会员积分</label>
            <input type="text" class="form-control"name="jifen" value=" {{$member->jifen}}" id="exampleInputEmail1" >
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">设置密码</label>
            <input type="password" class="form-control" name="password"id="exampleInputPassword1" placeholder="Password">
        </div>

      <button type="submit" class="btn btn-warning">确认修改</button>

    </form>
@stop

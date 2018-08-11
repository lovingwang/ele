@extends('admin.layouts.default')
@section("title","充值")
@section("content")
    <h1 class="text-center">会员充值</h1>
    <form    action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="exampleInputEmail1"> 金钱</label>
            <input type="text" class="form-control"name="money" id="exampleInputEmail1" placeholder="money">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">会员积分</label>
            <input type="text" class="form-control"name="jifen" id="exampleInputEmail1" placeholder="积分">
        </div>

      <button type="submit" class="btn btn-warning">确认充值</button>

    </form>
@stop

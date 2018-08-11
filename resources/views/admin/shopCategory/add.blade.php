    @extends('admin.layouts.default')
    @section("title","商家分类管理添加")
    @section('content')

<h2 style="color: red" >商家分类管理</h2>


<form    action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="exampleInputEmail1">分类名称</label>
        <input type="text"  class="form-control" name="name" style="width: 400px" id="exampleInputEmail1" placeholder="请输入分类名称">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">分类图片</label>
        <input type="file"  name="logo" style="width: 400px"  >
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">分类状态</label>
        <input type="radio"   name="status" value="1">显示
        <input type="radio"   name="status" value="0">隐藏
    </div>

    <button type="submit" class="btn btn-warning">确认添加</button>


</form>

    @endsection

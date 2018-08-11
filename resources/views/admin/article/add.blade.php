    @extends('admin.layouts.default')
    @section("title","活动添加")
    @section('content')

<h2 style="color: orange" >活动管理</h2>


<form    action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="exampleInputEmail1">活动名称</label>
        <input type="text"  class="form-control" name="name"  value="{{old('name')}}"style="width: 500px" id="exampleInputEmail1" placeholder="请输入活动名称">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">活动内容</label>
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 config.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain"></script>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">开始时间</label>
        <input type="date"   name="start_time" >

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">结束时间</label>
        <input type="date"   name="end_time" >

    </div>

    <button type="submit" class="btn btn-warning">确认添加</button>


</form>

    @endsection

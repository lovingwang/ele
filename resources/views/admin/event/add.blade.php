    @extends('admin.layouts.default')
    @section("title","抽奖添加")
    @section('content')

<h2 style="color: orange "class="text-center" >抽奖活动添加</h2>


<form    action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="exampleInputEmail1">抽奖名称</label>
        <input type="text"   name="title" style="width: 300px"  value="{{old('title')}}" placeholder="请输入抽奖活动名称">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">开始时间</label>
        <input type="date"  style="width: 300px"  name="start_time" >

    </div>
    <div class="form-group">
        <label  for="exampleInputEmail1">结束时间</label>
        <input type="date"  style="width: 300px" name="end_time" >

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">开奖时间</label>
        <input type="date"  style="width: 300px" name="prize_time" >

    </div>
    <div class="form-group">
        <label  for="exampleInputEmail1">人数限制</label>

        <input type="text" style="width: 300px"  name="num" ></div>

    <div class="form-group">
        <label for="exampleInputEmail1">活动内容</label>
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 config.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain" style="width: 700px"></script>
    </div>

    <button type="submit" class="btn btn-warning">确认添加</button>


</form>

    @endsection

    @extends('admin.layouts.default')
    @section("title","抽奖编辑")
    @section('content')

<h2 style="color: orange "class="text-center" >抽奖活动编辑</h2>


<form    action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="exampleInputEmail1">抽奖名称</label>
        <input type="text"  class="form-control  " name="title"  value="{{old('title',$event->title)}}"style="width: 500px"  placeholder="请输入抽奖活动名称">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">开始时间</label>
        <input type="date"  value="{{date('Y-m-d',$event->start_time)}}"  name="start_time" >

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">结束时间</label>
        <input type="date"   value="{{date('Y-m-d',$event->end_time)}}"  name="end_time" >

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">开奖时间</label>
        <input type="date"  value="{{date('Y-m-d',$event->prize_time)}}" name="prize_time" >

    </div>
    <div class="form-group">
        <label  for="exampleInputEmail1">人数限制</label>

        <input type="text"  value="{{$event->num}}"  name="num" ></div>

    <div class="form-group">
        <label for="exampleInputEmail1">活动内容</label>
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 config.
            });
        </script>

        <!-- 编辑器容器 -->
        <script id="container" name="content" type="text/plain">
            {!!  $event->content!!}
        </script>
    </div>

    <button type="submit" class="btn btn-warning">确认编辑</button>


</form>

    @endsection

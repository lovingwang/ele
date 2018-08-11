@extends('shop.layouts.default')
@section('title','订单列表首页')
@section('content')


    <div class="row" >
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                    {{--<div class="box-tools">--}}

                        {{--<form action="" class="form-inline">--}}

                            {{--<input type="date" name="start" class="form-control" size="2" placeholder="开始日期"--}}
                                   {{--value="{{request()->input('start')}}"> ---}}
                            {{--<input type="date" name="end" class="form-control" size="2" placeholder="结束日期"--}}
                                   {{--value="{{request()->input('end')}}">--}}
                            {{--<input type="submit" value="搜索" class="btn btn-success">--}}
                        {{--</form>--}}


                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>菜单编号</th>
                            <th>总菜单数</th>
                            <th>菜单名</th>
                            <th>菜单金额</th>
                        </tr>
                        @foreach($ordergoods as $ordergood)
                            <tr>
                                <td>{{$ordergood->goods_id}}</td>
                                <td>{{$ordergood->count}}</td>
                                <td>{{$ordergood->goods_name}}</td>
                                <td>{{$ordergood->money}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>









@stop

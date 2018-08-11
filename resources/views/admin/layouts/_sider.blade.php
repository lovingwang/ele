<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/bootstrap/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>主人！您好</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"></li>
            {{--准备循环--}}
            @foreach(\App\Models\Nav::where('pid',0)->get() as $k=>$v)
            <li class="active treeview">
                <a href="javascript:;">
                    <i class="fa fa-dashboard"></i> <span>{{$v->name}}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @foreach(\App\Models\Nav::where('pid',$v->id)->get() as $k1=>$v1)
                    <li class="active"><a href="{{route($v1->url)}}"><i class="fa fa-circle-o"></i> {{$v1->name}}</a></li>
               @endforeach
                </ul>
            </li>
  @endforeach
                {{--上述循环      --}}



            {{--<li class="treeview">--}}
                {{--<a href="javascript:;">--}}
                    {{--<i class="fa fa-files-o"></i>--}}
                    {{--<span>商家管理</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li ><a href="{{route('shopCategory.index')}}"><i class="fa fa-circle-o"></i> 商店分类管理</a></li>--}}
                    {{--<li><a href="{{route('shop.index')}}"><i class="fa fa-circle-o"></i> 商店信息管理</a></li>--}}
                    {{--<li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> 商家用户管理</a></li>--}}
                    {{--<li><a href="{{route('member.index')}}"><i class="fa fa-circle-o"></i> 会员管理</a></li>--}}
                    {{--<li><a href="{{route('user.info')}}"><i class="fa fa-circle-o"></i> 商家销量信息</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="javascript:;">--}}
                    {{--<i class="fa fa-pie-chart"></i>--}}
                    {{--<span>管理权限</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{route('role.index')}}"><i class="fa fa-circle-o"></i> 角色表</a></li>--}}
                    {{--<li><a href="{{route('per.index')}}"><i class="fa fa-circle-o"></i> 权限表</a></li>--}}

                {{--</ul>--}}
            {{--</li>--}}


            {{--<li class="treeview">--}}
                {{--<a href="javascript:;">--}}
                    {{--<i class="fa fa-laptop"></i>--}}
                    {{--<span>平台活动</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="{{route('article.index')}}"><i class="fa fa-circle-o"></i> 活动管理</a></li>--}}

                {{--</ul>--}}
            {{--</li>--}}

            <li class="treeview">
                <a href="javascript:;">
                    <i class="fa fa-edit"></i> <span>商家平台</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('user.index0')}}"><i class="fa fa-circle-o"></i> 商家注册或登录管理</a></li>
                </ul>
            </li>




            {{--以下都没用--}}
            <li>
                <a href="javascript:;">

                </a>
            </li>
            <li class="treeview">
                <a href="javascript:;">
                    <i class="fa "></i>


            </span>
                </a>

            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa "></i>

                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa "></i>
                </a>
            </li>
            <li class="treeview">
                <a href="javascript:;">
                    <i class="fa fa"></i>

                </a>

            </li>
            <li class="treeview">
                <a href="javascript:;">
                    <i class="fa "></i>
                </a>

            </li>
            <li><a href="javascript:;"><i class="fa "></i> <span></span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
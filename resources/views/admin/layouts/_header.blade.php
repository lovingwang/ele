<header class="main-header">
    <!-- Logo -->
    <a href="javascript:;" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>F</b>BI</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>菜鸟联盟</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                </li>

                @auth
                    <li>
                        <a href="">欢迎你!   {{ \Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</a>
                    </li>

                    <li>
                        <a href="{{route('admin.logout')}}" >注销</a>
                    </li>
                @endauth

                @guest
                    <li class="dropdown user user-menu">
                        <a href="{{route('admin.login')}}" >登录</a>
                        </a>

                    </li>
            @endguest


                <!-- User Account: style can be found in dropdown.less -->

                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>
    </nav>
</header>
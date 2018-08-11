
<div class="header">
    <div class="header_top_right">

        <div id="na">
            <ul>
                @auth
                <li><a href=""><font size="2">{{\Illuminate\Support\Facades\Auth::user()->name}}</font> </a>
                    <ul>

                        <li style="width: 80px"><a href="{{route('user.change')}}">修改密码</a></li>
                        <li><a href="{{route('user.logout')}}"><font color="red">注销</font></a></li>

                    </ul>
                </li>
                    @endauth

            </ul>
            <ul>
            @guest
            <li><a href="{{route('user.login')}}">登录</a></li>
            <li><a href="{{route('user.reg')}}">注册</a></li>
            @endguest
            </ul>
        </div>



    {{--@auth--}}
            {{--<ul>--}}

        {{--<li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">欢迎您！{{\Illuminate\Support\Facades\Auth::user()->name}} <span class="caret"></span></a>--}}
            {{--</li>--}}
         {{--||   <li><a href="{{route('user.logout')}}"><font color="red">注销</font></a></li>--}}
            {{--</ul>--}}
        {{--@endauth--}}
        {{--<ul>--}}
            {{--@guest--}}
            {{--<li><a href="{{route('user.login')}}">登录</a></li>--}}
           {{--|| <li><a href="{{route('user.reg')}}">注册</a></li>--}}
            {{--@endguest--}}
        {{--</ul>--}}
    </div>
    <div class="clear"></div>
    <div class="header-bot">
        <div class="logo">
            <a href="index.html"><img src="/cpts/images/logo.png" alt=""></a>
        </div>

        <div class="clear"></div>
    </div>

    <div class="clear"></div>
</div>




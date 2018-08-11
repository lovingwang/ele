<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <link href="/cpts/css/style.css" rel="stylesheet" type="text/css" media="all" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield("title","title")</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        *{ margin:0px; padding:0px;}
        #nav{ width:600px; height:40px; margin:0 auto;}
        #na ul{ list-style:none;}
        #na ul li{ float:left; line-height:40px; text-align:center; position:relative;}
        #na ul li a{ text-decoration:none; color:#000; display:block;padding:0px 10px;}
        #na ul li a:hover{ color:#FFF; background:#333}
        #na ul li ul{ position:absolute; display:none;}
        #na ul li ul li{ float:none; line-height:30px; text-align:left;}
        #na ul li ul li a{ width:100%;}
        #na ul li ul li a:hover{ background-color:#06f;}
        #na ul li:hover ul{ display:block}
    </style>


</head>
<body>

<div class="wrap">
    <div class="total">
@include('shop.layouts._header')
        <div class="menu">
            <div class="top-nav">
                <ul>
                    <li ><a href="{{route('user.index0')}}">首页</a></li>
                    <li><a href="{{route('menu_categories.index')}}">菜品管理</a></li>
                    <li ><a href="{{route('menu.index')}}">菜单管理</a></li>
                    <li><a href="{{route('order.index')}}">订单管理</a></li>
                    <li><a href="{{route('user.index1')}}">最新活动</a></li>
                    <li><a href="{{route('user.index3')}}">联系我们</a></li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <div class="main">

                @include("shop.layouts._errors")
                @include("shop.layouts._msg")
            <div class="container-fluid" >
                @yield("content")

        </div>


            <div class="content-last">
                <div class="col_1_of_4 span_1_of_4">
                    <img src="/cpts/images/glass.png" alt="">
                    <h3>杯子哲学</h3>
                    <p> <div class="container-fluid" style="width: 200px">猫爱上了杯子里的鱼，却打碎了杯子。 鱼离开水死了，猫终于明白了， 爱一个人不一定非要和他在一起</div>
                    </p>

                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <img src="/cpts/images/plate.png" alt="">
                    <h3>盘子人生</h3>
                    <p><div class="container-fluid" style="width: 200px">我们生活中经常会听到这样一句话，“越简单越真实的才是最美的”</div></p>

                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <img src="/cpts/images/icecream.png" alt="">
                    <h3>雪糕哲学</h3>
                    <p><div class="container-fluid" style="width: 200px">卖冰淇淋必须从冬天开始，因为冬天顾客少，会逼迫你降低成本，改善服务。如果能在冬天的逆境中生存，就再也不会害怕夏天的竞争。又称“瘦鹅理论

                    </div></p>

                </div>
                <div class="col_1_of_4 span_1_of_4">
                    <img src="/cpts/images/leaf.png" alt="">
                    <h3>叶子人生</h3>
                    <p><div class="container-fluid" style="width: 200px">叶子不像花朵那样漂亮，但是没有叶子植物就无法进行光合作用，整株植物就没有营养可用了，我们往往只看到花的美丽而没有看到叶子为花作出的贡献</div></p>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
@include('shop.layouts._footer')


</body>
</html>
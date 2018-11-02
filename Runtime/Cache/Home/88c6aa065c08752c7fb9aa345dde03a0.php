<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("ucenter")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">

    <!--线上JQ包-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!--本地JQ包-->
    <!--<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>-->


    <script type="text/javascript" src="/Public/home/wap/js/jquery.glide.min.js"></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js"></script>
    <style>
        /*.cen_icon .bga{background: #32d8ea;}*/
        /*.cen_icon .bgb{background: #f9b73a;}*/
        /*.cen_icon .bgc{background: #f7755f;}*/
        /*.cen_icon .bgd{background: #3ab5f5;}*/
        /*.cen_icon .bge{background: #b6dc25;}*/

        .cen_icon ul li {
            background: none;
            width: 22%;
            float: left;
            padding: 3vmin 0;
            margin-bottom: 0;
            margin-right: 0;
            border-radius: 4vmin;
            margin-left: 2%;
            margin-top: 2%;
        }
        .cen_icon ul li p {
            font-family: "PingFang SC";
        }
        .cen_icon {
            margin-top: 0px; 
        }
        html{
            background: #212126 !important;
        }
    </style>

    <body class="bg96" style="margin-bottom: 20px;">
        <div class="header_home">
            <!--<div class="userInfo" style="width: 75%">-->
                <!--<a href="<?php echo U('User/Personal');?>"><div class="toux_icon"><img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>"></div></a>-->
                <!--<div class="uid_xy">-->
                    <!--<p>UID:<?php echo ($uinfo['userid']); ?></p>-->
                    <!--<p><?php echo (L("credit")); ?>-->
                    <!--<?php $__FOR_START_7048__=0;$__FOR_END_7048__=$uinfo['user_credit'];for($i=$__FOR_START_7048__;$i < $__FOR_END_7048__;$i+=1){ ?>-->
                        <!--<span><img src="/Public/home/wap/images/aix-icon.png"></span>-->
                    <!--<?php } ?>-->
                    <!--</p>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="header_r"> <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/shez-icon.png" alt="">设置</a></div>-->
            <!--<div class="header_sm_pay"> <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/smPay.png" alt="">扫码支付</a></div>-->
            <!---->

            <div class="header-top">
                <div>
                <ul>
                    <li style="width: 30%;float: left;margin: 10px 0px;font-size: 12px;">
                        <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/person.png">
                            <p>UID:<?php echo ($uinfo['userid']); ?></p>
                        </a>
                    </li>
                    <li><a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/shez-icon.png" alt=""><p><?php echo (L("sz")); ?></p></a></li>
                    <li>
                        <a onClick="scan()" class="shaom">
                            <img src="/Public/home/wap/images/smPay.png"><p><?php echo (L("smPay")); ?></p>
                            <!--<p><?php echo (L("ScanCode")); ?></p>-->

                        </a>
                    </li>
                </ul>
                </div>
                <div class="header-content">
                    <div class="content-show">
                        <div class="nsv">
                            <div><?php echo (L("index_top_content1")); ?></div>
                            <div><?php echo (L("index_top_content2")); ?></div>
                        </div>
                    </div>
                        <!--<div class="centBalance">-->
                            <!--<div class="Balance"><p><a class="balance" href="<?php echo U('Index/bancerecord');?>"><?php echo (L("yue")); ?><br/><strong>￥<span  class="yue"><?php echo (Showtwo($moneyinfo['cangku_num'])); ?></span></strong></a></p></div>-->
                            <!--<div class="Balance"><p><a class="balance" href="<?php echo U('Index/bancerecord');?>"><?php echo (L("yue")); ?><br/><strong>￥<span  class="yue"><?php echo (Showtwo($moneyinfo['cangku_num'])); ?></span></strong></a></p></div>-->
                            <!--<div class="Balance"><p><a class="balance" href="<?php echo U('Index/exchangerecords');?>"><?php echo (L("jifen")); ?><br/><strong><span class="jifen"><?php echo (Showtwo($moneyinfo['fengmi_num'])); ?></span></strong></a></p></div>-->
                            <!--<div class="dLine"></div>-->
                        <!--</div>-->
                        <div class="cb">
                                <div class="Balance"><p><a class="balance" href="<?php echo U('Index/bancerecord');?>"><?php echo (L("yue")); ?><br/><strong>￥<span  class="yue"><?php echo (Showtwo($moneyinfo['cangku_num'])); ?></span></strong></a></p></div>
                                <div class="Balance"><p><a class="balance" href="<?php echo U('Index/quick');?>"><?php echo (L("quickNumber")); ?><br/><strong>￥<span  class="yue"><?php echo ($uinfo['releas_rate']); ?></span></strong></a></p></div>
                                <div class="Balance"><p><a class="balance" href="<?php echo U('Index/exchangerecords');?>"><?php echo (L("jifen")); ?><br/><strong><span class="jifen"><?php echo (Showtwo($moneyinfo['fengmi_num'])); ?></span></strong></a></p></div>
                                <div class="dLine"></div>
                                <div class="dLine1"></div>
                        </div>

                </div>
            </div>
        </div>
        <div class="gj">
            <ul>
                <li><a href=""><img src="/Public/home/wap/images/index/01.png"><marquee style="line-height:100%;height:100%;width: 90%;"><p><?php echo (L("index_gonggao")); ?></marquee></p></a></li>
            </ul>
        </div>

        <div class="big_width100" >
            <!--<div class="shaomZ">-->
<!--&lt;!&ndash;                <a onClick="BSL.Qcode('0', 'qrcodeCallback')" class="shaom">-->
                    <!--<img src="/Public/home/wap/images/shaom-icon.png">-->
                    <!--<p><?php echo (L("ScanCode")); ?></p>-->
                <!--</a>&ndash;&gt;-->


            <!--</div>-->
            <!--<div class="centBalance">-->
                <!--<div class="Balance"><p><a class="balance" href="<?php echo U('Index/bancerecord');?>"><?php echo (L("yue")); ?><br/><strong>￥<span  class="yue"><?php echo (Showtwo($moneyinfo['cangku_num'])); ?></span></strong></a></p></div>-->
                <!--<div class="Balance"><p><a class="balance" href="<?php echo U('Index/exchangerecords');?>"><?php echo (L("jifen")); ?><br/><strong><span class="jifen"><?php echo (Showtwo($moneyinfo['fengmi_num'])); ?></span></strong></a></p></div>-->
                <!--<div class="dLine"></div>-->
            <!--</div>-->

            <!--<div class="slider">-->
                <!--<ul class="slides">-->
                    <!--<li class="slide">-->
                        <!--<div class="box" ><img src="/Public/home/wap/images/banner1.png" alt=""></div>-->
                    <!--</li>-->
                    <!--<li class="slide">-->
                        <!--<div class="box" ><img src="/Public/home/wap/images/banner2.png" alt=""></div>-->
                    <!--</li>-->
                    <!--<li class="slide">-->
                        <!--<div class="box" ><img src="/Public/home/wap/images/banner3.png" alt=""></div>-->
                    <!--</li>-->

                <!--</ul>-->
            <!--</div>-->

            <div class="cen_icon">
                <div>
                <ul>
                    <li>
                        <a href="<?php echo U('Index/turnout');?>">
                            <img src="/Public/home/wap/images/index_icon_zchu.png">
                            <p><?php echo (L("turnout")); ?></p>
                        </a>
                    </li>
                    <li class="bgb">
                        <a href="<?php echo U('Growth/Intro');?>">
                            <img src="/Public/home/wap/images/index_icon_zru.png">
                            <p><?php echo (L("tochangeinto")); ?></p>
                        </a>
                    </li>
                    <li class="bga">
                        <a href="<?php echo U('Growth/Purchase');?>">
                            <img src="/Public/home/wap/images/index_icon_buy.png">
                            <p><?php echo (L("purchase")); ?></p>
                        </a>
                    </li>
                    <li class="bgc">
                        <a href="<?php echo U('Trading/SellCentr');?>">
                            <img src="/Public/home/wap/images/index_icon_sell.png">
                            <p><?php echo (L("sellout")); ?></p>
                        </a>
                    </li>
                    <!--<li class="bgd">-->
                        <!--<a href="<?php echo U('Turntable/index');?>">-->
                            <!--<img src="/Public/home/wap/images/index_icon_1.png">-->
                            <!--<p><?php echo (L("digitalassets")); ?></p>-->
                        <!--</a>-->
                    <!--</li>-->

                    <li>
                        <a href="<?php echo U('Index/exehange');?>">
                            <img src="/Public/home/wap/images/index_icon_jf.png">
                            <p><?php echo (L("exchange")); ?></p>
                        </a>
                    </li>


                    <li class="bga">
                        <a href="<?php echo U('User/Sharecode');?>">
                            <img src="/Public/home/wap/images/index_icon_fx.png">
                            <p><?php echo (L("share")); ?></p>
                        </a>
                    </li>    

                    <li class="bgc">
                        <a href="<?php echo U('User/team');?>">
                            <img src="/Public/home/wap/images/index_icon_team.png">
                            <p><?php echo (L("team")); ?></p>
                        </a>
                    </li>                    

                    <li class="bge" id="shop_tip">
                        <a href="">
                            <img src="/Public/home/wap/images/index_icon_shop.png">
                            <p><?php echo (L("shoppingmall")); ?></p>
                        </a>
                    </li>
                </ul>
                </div>
                <div class="f-news-img">
                    <img src="/Public/home/wap/images/index/bg_2.png">
                    <span style="color: white;"><?php echo (L("index_f_content")); ?></span>
                </div>
            </div>
        </div>
       <!--引用底部导航-->
        <!---->
<style>
    .ftr{
        width: 100%;
        height: auto;
        margin: auto;
        z-index: 99;
        background: #191B1F;
        position: fixed;
        bottom: 0;
    }
    .ftr>ul{
        display: block;
        width: 100%;
        height: auto;
        float: left;
        font-size: 0;
    }
    .ftr>ul>li {
        display: inline-block;
        vert-align: top;
        width: 25%;
        height: auto;
    }
    .ftr>ul>li>a{
        display: block;
        width: 100%;
        height: auto;
        float: left;
        padding: 9px 0;
        box-sizing: border-box;
    }
    .ftr>ul>li>a>div{
        width: 100%;
        height: auto;
        float: left;
    }
    .ftrname{
        text-align: center;
        font-size: 15px;
        color: #fff;
        margin-top: 9px;
    }
    .ftrimg{
        display: table;
        height: 29px;
        margin: auto;
        color: #fff;
    }
    .houimg{
        margin: auto;
        display: none;
        width: auto;
        height: 25px;
    }
    .qianimg{
        display: table;
        width: auto;
        height: 25px;
        margin: auto;
    }
    .xian{
        display: block;
    }
    .yin{
        display: none;
    }
    .clicss{
        color: #0EA1EA;
    }
    .Navbgcolor{
        background: blue;
    }

</style>
<script>
        $(function () {
            hdr();
        })
    
        function  hdr() {
            hdrcli=function (e) {
                var qianimg=$(".qianimg").eq(e);
                var houimg=$(".houimg").eq(e);
                var ftrli=$(".ftrli").eq(e);
                var ftrname = $(".ftrname").eq(e);
                houimg.addClass("xian");
                qianimg.addClass("yin");
                ftrname.addClass("clicss");
                ftrli.siblings().children("a").children(".ftrimg").children(".qianimg").removeClass("xian");
                ftrli.siblings().children("a").children(".ftrimg").children(".houimg").removeClass("yin");
                ftrli.siblings().children("a").children(".ftrname").removeClass("clicss");
            }
        }
    </script>
        <footer class="ftr clearfix">
            <!--底部tab切换栏-->
            <ul class="bottom" id="bottom">
                <li onclick="hdrcli(0)" class="ftrli">
                    <a href="<?php echo U('Index/index');?>">
                        <div class="ftrimg">
                            <img class="qianimg yin" src="/Public/home/wap/images/首页.png">
                            <img class="houimg xian" src="/Public/home/wap/images/首页1.png">
                        </div>
                        <div class="ftrname clicss"><?php echo (L("bottom_home")); ?></div>
                    </a>
                </li>
                <li onclick="hdrcli(1)" class="ftrli">
                    <a href="<?php echo U('Quotation/index');?>">
                        <div class="ftrimg">
                            <img class="qianimg " src="/Public/home/wap/images/行情.png">
                            <img class="houimg " src="/Public/home/wap/images/行情1.png">
                        </div>
                        <div class="ftrname"><?php echo (L("bottom_hangqing")); ?></div>
                    </a>
                </li>
                <li onclick="hdrcli(2)" class="ftrli" id="Ghome_tip">
                    <a>
                        <div class="ftrimg">
                            <img class="qianimg" src="/Public/home/wap/images/G圈.png">
                            <img class="houimg" src="/Public/home/wap/images/G圈1.png">
                        </div>
                        <div class="ftrname"><?php echo (L("bottom_G")); ?></div>
                    </a>
                </li>
                </li>
                <li onclick="hdrcli(3)" class="ftrli">
                    <a href="<?php echo U('User/Personal');?>">
                        <div class="ftrimg">
                            <img class="qianimg" src="/Public/home/wap/images/我.png">
                            <img class="houimg" src="/Public/home/wap/images/我1.png">
                        </div>
                        <div class="ftrname"><?php echo (L("bottom_my")); ?></div>
                    </a>
                </li>
            </ul>
        </footer>


        <?php if(($can_get) > "0"): ?><div class="big_width100" id="hide_none">
            <div class="qindHB">
                <div class="qindHB_nb">
                    <img src="/Public/home/wap/images/hongbaoyem.png" class="qinb_imga">
                    <a href="javascript:void(0);" id="hide">
                        <img src="/Public/home/wap/images/cunryue.png">
                    </a>
                    <div class="qiandHB_wz">
                        <h3><span  class="getnums"><?php echo (showtwo($can_get)); ?></span>元</h3>
                        <p>天天签到红包不断</p>
                    </div>
                </div>
            </div>
            <div class="qindHB_bg"></div>
        </div><?php endif; ?>

        <script type="text/javascript">
            $("#hide").click(function() {
                console.log('收益');
                var yue = Number($('.yue').text());
                var jifen = Number($('.jifen').text());

                var getnums = Number($('.getnums').text());//可获得金额
                var releasey = (yue + getnums).toFixed(2);
                var releasej = (jifen - getnums).toFixed(2);
                ;
                $.ajax({
                    url: 'Index/index',
                    type: 'post',
                    data: {'getnums': getnums},
                    datatype: 'json',
                    success: function(mes) {
                        if (mes.status == 1) {
                            msg_alert(mes.message);
                            $("#hide_none").hide(1000);
                            //加余额-减少积分
                            $('.yue').text(releasey);
                            $('.jifen').text(releasej);
                            window.location.reload();
                        } else {
                            msg_alert(mes.message);
                        }
                    }
                })
            });
        </script>

        <script type="text/javascript">
            var glide = $('.slider').glide({
                //autoplay:true,//是否自动播放 默认值 true如果不需要就设置此值
                animationTime: 500, //动画过度效果，只有当浏览器支持CSS3的时候生效
                arrows: false, //是否显示左右导航器
                arrowsWrapperClass: "arrowsWrapper", //滑块箭头导航器外部DIV类名
                arrowMainClass: "slider-arrow", //滑块箭头公共类名
                arrowRightClass: "slider-arrow--right", //滑块右箭头类名
                arrowLeftClass: "slider-arrow--left", //滑块左箭头类名
                arrowRightText: ">", //定义左右导航器文字或者符号也可以是类
                arrowLeftText: "<",
                nav: true, //主导航器也就是本例中显示的小方块
                navCenter: true, //主导航器位置是否居中
                navClass: "slider-nav", //主导航器外部div类名
                navItemClass: "slider-nav__item", //本例中小方块的样式
                navCurrentItemClass: "slider-nav__item--current" //被选中后的样式
            });
        </script>

        <!--扫一扫调用-->
        <script>
            // $(function () {
            //     $('#Ghome_tip').click(function () {
            //         alert("尚未开放！");
            //         return;
            //     })
            //     $('#hq_tip').click(function () {
            //         alert("尚未开放！");
            //         return;
            //     })
            //     $('#shop_tip').click(function () {
            //         alert("尚未开放！");
            //         return;
            //     })
            // })
            function Dosaoyisao() {
                qrcodeCallback();
            }
            function qrcodeCallback(result) {
                window.location.href = result;
            }
            function scan(){
                window.location.href="saoyisao://abcd";
            }

        </script>
    </body>

</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>行情</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Quotation.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>

<body>
    <div class="header">
        <div class="header_l">
            <a href="<?php echo U('Index/index');?>">
                <img src="/Public/home/wap/images/jiant.png" alt="">
            </a>
        </div>
        <div class="header_c">
            <h2><?php echo (L("team")); ?></h2>
        </div>
        <div class="header_r">
            <a href="<?php echo U('User/Sharelist');?>"><?php echo (L("sharelist")); ?></a>
        </div>
    </div>
    <div class="section">
        <div class="head">
            <ul class="nav">
                <li>
                    <a href="<?php echo U('Crowdfund/index');?>" class="aBox">
                        <div>
                            <img src="/Public/home/wap/images/Quotation/1.png" alt="">
                            <div>众筹</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Buy/index');?>" class="aBox">
                        <div>
                            <img src="/Public/home/wap/images/Quotation/2.png" alt="">
                            <div>交易</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo U('Account/index');?>" class="aBox">
                        <div>
                            <img src="/Public/home/wap/images/Quotation/3.png" alt="">
                            <div>钱包</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="body">
            <div class="box bg">
                <div>
                    <h1>名称</h1>
                </div>
                <div>
                    <h1>当前价格</h1>
                </div>
                <div>
                    <h1>涨幅</h1>
                </div>
            </div>
            <ul>
                <li>
                    <div class="box">
                        <div class="first-span">
                            <p>
                                <img src="/Public/home/wap/images/Quotation/logo.png" alt="">
                            </p>
                            <p class="first-span-box">
                                <span>比特币</span>
                                <span class="font-span">市值:
                                    <span>0.005</span>
                                </span>
                            </p>
                        </div>
                        <div>
                            <h1 class="fs_18">0.51564654</h1>
                        </div>
                        <div>
                            <h1>+0.012%</h1>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
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
        <footer class="ftr">
            <!--底部tab切换栏-->
            <ul class="bottom" id="bottom">
                <li onclick="hdrcli(0)" class="ftrli">
                    <a href="<?php echo U('Index/index');?>">
                        <div class="ftrimg">
                            <img class="qianimg " src="/Public/home/wap/images/首页.png">
                            <img class="houimg " src="/Public/home/wap/images/首页1.png">
                        </div>
                        <div class="ftrname"><?php echo (L("bottom_home")); ?></div>
                    </a>
                </li>
                <li onclick="hdrcli(1)" class="ftrli">
                    <a href="<?php echo U('Quotation/index');?>">
                        <div class="ftrimg">
                            <img class="qianimg yin" src="/Public/home/wap/images/行情.png">
                            <img class="houimg xian" src="/Public/home/wap/images/行情1.png">
                        </div>
                        <div class="ftrname clicss"><?php echo (L("bottom_hangqing")); ?></div>
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
</body>

</html>
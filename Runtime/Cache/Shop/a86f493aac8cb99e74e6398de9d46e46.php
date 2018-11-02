<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo ($config['SITE_TITLE']); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />

    <!-- Link Swiper's CSS -->

    <link rel="stylesheet" type="text/css" href="/Public/Public/css/style.css">
    <link rel="stylesheet" type="text/css" href="/Public/Public/css/foot.css">


    <link rel="stylesheet" href="/Public/Public/css/head.css">
    <link rel="stylesheet" href="/Public/Public/icon/iconfont.css">
    <link rel="stylesheet" href="/Public/Public/css/webuploader.css">
    <link rel="stylesheet" type="text/css" href="/Public/Public/css/style22.css">
    <script type="text/javascript" src="/Public/Public/js/jquery-1.7.1.min.js"></script>
 <!-- Demo styles -->
   <!--  <script type="text/javascript" src="/Public/Public/js/jquery.touchSlider.js"></script>

    <script type="text/javascript" src="/Public/Public/js/webuploader.min.js"></script>
<script type="text/javascript" src="/Public/Public/js/upload.js"></script> -->

</head>
<style>
    .dzlist{
        margin-right: 3%;
        margin-left: 3%;
        border: 1px solid #e5e5e5;
        border-radius: 3px;
        margin-top: 5%;
        box-shadow: 0px 0px 10px #ccc;
        padding:3%;
    }
    .dzlist h3{
        font-size: 4.5vmin;
        color:#333;
        line-height: 6vmin;
    }
    .dzlist p{
        line-height: 10vmin;
        font-size: 4vmin;
        color:#767975;
    }
    .dzlist_bot{
        border-top:1px solid #ddd;

    }
    .dzlist_bot span{
        float: right;
         margin-left: 5%;
    }
    .dzlist_bot a{
        line-height: 10vmin;
        font-size:4vmin;
        color:#767975;
    }
</style>
<body>
<div class="header">
    <div class="header_l" style="width: 15%;">
      <a href="javascript:window.history.go(-1);"><img src="/Public/Public/images/lpg.png" alt=""><span>收货地址</span></a>

    </div>
    <div class="header_c" style="width: 70%;"> <h1 style="color:#000"></h1></div>
    <div class="header_r" style="width: 15%;"></div>
    <!-- <span><a href=""><img src="" alt=""></a></span> -->
</div>


<?php if(is_array($addressList)): foreach($addressList as $key=>$address): ?><div class="dzlist">
        <?php if(($addtype) == "8"): ?><a href="<?php echo U('Home/order',array('addid'=>$address['address_id']));?>">
                <h3><?php echo ($address['name']); ?>   <?php echo ($address['telephone']); ?> <span style="float: right;"></span></h3>
                <p><?php echo ($address['province_id']); echo ($address['city_id']); echo ($address['country_id']); echo ($address['address']); ?></p>
            </a>
        <?php else: ?>
            <a href="<?php echo U('Member/Dditadd',array('id'=>$address['address_id']));?>">
                <h3><?php echo ($address['name']); ?>   <?php echo ($address['telephone']); ?> <span style="float: right;"></span></h3>
                <p><?php echo ($address['province_id']); echo ($address['city_id']); echo ($address['country_id']); echo ($address['address']); ?></p>
            </a><?php endif; ?>
        <div class="dzlist_bot">
            <span><a href="<?php echo U('Member/deleadd',array('id'=>$address['address_id']));?>">删除</a></span>
            <span><a href="<?php echo U('Member/Dditadd',array('id'=>$address['address_id']));?>">修改</a></span>
        </div>
        <div style="clear: both;"></div>
    </div><?php endforeach; endif; ?>

<style>
    .selectcc{
        width: 83%;
        border: none;
        border-bottom: 1px solid #aaa;
        font-family: "微软雅黑";
        /*很关键：将默认的select选择框样式清除*/
        appearance:none;
        -moz-appearance:none;
        -webkit-appearance:none;
        /*为下拉小箭头留出一点位置，避免被文字覆盖*/
        padding-right: 14px;

    }
</style>

        <div class="submit"><a href="<?php echo U('Member/address');?>">添加新地址</a></div>


</body>
</html>
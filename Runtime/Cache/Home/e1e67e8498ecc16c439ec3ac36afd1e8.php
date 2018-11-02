<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("turncords2")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
</head>
<body>
<div class="header">
    <div class="header_l">
        <a href="<?php echo U('Index/Turncords');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
</div>
    <div class="header_c"><h2><?php echo (L("zcxq")); ?></h2></div>
    <!--<?php echo (L("turncords")); ?>-->
</div>
<div class="big_width100">

    <!--<?php if(is_array($Chan_info)): foreach($Chan_info as $key=>$v): ?>-->
        <!--<div class="annal_ul">-->
            <!--<div class="annal_ul_l">-->
                <!--<img src="/Public/home/wap/heads/<?php echo ($v['imghead']); ?>" alt="">-->
                <!--<div class="annal_p">-->
                    <!--<p><?php echo ($v['guname']); ?></p>-->
                    <!--<p>UID:<?php echo ($v['get_id']); ?></p>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="annal_ul_r">-->
                <!--<div class="annal_p">-->
                    <!--<p class="zhuanrua">-<?php echo ($v['get_nums']); ?></p>-->
                    <!--<p><?php echo (date("Y-m-d H:i:s",$v['get_time'])); ?></p>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--<?php endforeach; endif; ?>-->


</div>

<div class="zhuanchupingzheg">
    <h1><img src="/Public/home/wap/images/logo.png" style="width: 50px; height: 50px;"/><?php echo (L("zcpz")); ?></h1>
</div>

<div class="content-1">
    <div class="xiangqing1">
        <div class="xiangqing1-content">
            <h2><?php echo (L("fkr")); ?></h2>
            <p><?php echo (L("nc")); ?>:<span><?php echo ($getPerson["username"]); ?></span></p>
            <p>UID:<span><?php echo ($uid); ?></span></p>
            <p><?php echo (L("tel")); ?>:<span><?php echo ($getPerson["mobile"]); ?></span></p>
        </div>
    </div>
    <div class="xiangqing1 er">
        <div class="xiangqing1-content  xiangqing1-content2">
            <h2><?php echo (L("shr")); ?></h2>
            <p><?php echo (L("nc")); ?>:<span><?php echo ($getPay["username"]); ?></span></p>
            <p>UID:<span><?php echo ($getPay["userid"]); ?></span></p>
            <p><?php echo (L("tel")); ?>:<span><?php echo ($getPay["mobile"]); ?></span></p>
        </div>
    </div>
    <div class="xiangqing1 san">
        <div class="xiangqing1-content">
            <p><?php echo (L("fkje")); ?>:<span><?php echo ($Chan_info["get_nums"]); ?></span></p>
            <p><?php echo (L("time")); ?>:<span><?php echo (date("Y-m-d H:i:s",$Chan_info["get_time"])); ?></span></p>
        </div>
    </div>
</div>

</body>
</html>
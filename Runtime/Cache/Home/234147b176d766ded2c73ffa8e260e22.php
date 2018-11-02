<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>团队</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<body class="bg96" style="background: #272624">

<div class="header">
    <div class="header_l">
        <a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
    </div>
    <div class="header_c"><h2><?php echo (L("team")); ?></h2></div>
    <div class="header_r" style=""><a href="<?php echo U('User/Sharelist');?>"><?php echo (L("sharelist")); ?></a></div>
</div>

<!--<div class="big_width100 por">-->

    <!--<form action="<?php echo U('User/Teamdets');?>" method="post">-->
        <!--<div class="zySearch">-->
            <!--<input id="searchInput" name="uinfo" class="search-input" value="<?php echo ($uinfo); ?>" type="text" placeholder="搜索UID/手机号码">-->
            <!--<button class="search-btn btn">搜索</button>-->
        <!--</div>-->
    <!--</form>-->

    <!--<?php if(is_array($muinfo)): foreach($muinfo as $key=>$v): ?>-->
        <!--<div class="share_ul">-->
            <!--<div class="share_ul_l">-->
                <!--<img src="/Public/home/wap/heads/<?php echo ($v['img_head']); ?>" alt="">-->
                <!--<div class="share_p">-->
                    <!--<p><?php echo ($v['username']); ?></p>-->
                    <!--<p>UID:<?php echo ($v['userid']); ?></p>-->
                    <!--<p>电话:<?php echo ($v['mobile']); ?></p>-->
                    <!---->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="shijin"><?php echo (date("Y-m-d H:i:s",$v['reg_date'])); ?></div>-->

                <!--<?php if($v['use_grade'] == 1): ?>-->
                <!--<div class="dengjxias dengjxiasa">-->
                <!--普通用户-->
                <!--<?php elseif($v['use_grade'] == 2): ?>-->
                <!--<div class="dengjxias dengjxiasb">-->
                <!--黄金VIP-->
                <!--<?php elseif($v['use_grade'] == 3): ?>-->
                <!--<div class="dengjxias dengjxiasc">-->
                <!--铂金VIP-->
                <!--<?php elseif($v['use_grade'] == 4): ?>-->
                <!--<div class="dengjxias dengjxiasd">-->
                <!--钻石VIP-->
                <!--<?php else: ?>-->
                <!--<div class="dengjxias">-->
                <!--初始会员-->
                <!--<?php endif; ?>-->
            <!--</div>-->
        <!--</div>-->
    <!--<?php endforeach; endif; ?>-->
<!--</div>-->
<div class="tuandui">
    <div class="t-top-img">
        <img src="/Public/home/wap/images/team_top.png"/>
    </div>

    <div class="team_top_box">
        <div class="team_top">
            <div class="jf_Balance">
                <!--<img src="/Public/home/wap/images/jiant.png">-->
                <span style="color: #F0F0F0;font-size:15px;"><?php echo (L("sum_team")); ?></span><br/><strong style="color: white;font-size:14px;"><?php echo ($data['count']); ?></strong>
            </div>
            <div class="jf_Balance">
                <!--<img src="/Public/home/wap/images/jiant.png">-->
                <span style="color: #F0F0F0;font-size: 15px;"><?php echo (L("team_jf")); ?></span> <br/><strong style="color: white;font-size:14px"><?php echo ($data['jfsum']); ?></strong>
                <div class="jf_line"></div>
            </div>
        </div>
        <div class="team_box">
            <div class="team-list">
                <ul>
                    <li><img src="/Public/home/wap/images/team_1.png"><span><?php echo (L("cshy")); ?><span>&nbsp;&nbsp;&nbsp;<?php echo ($data['zchy']); ?></span></span></li>
                    <li><img src="/Public/home/wap/images/team_2.png"><span><?php echo (L("pt")); ?><span>&nbsp;&nbsp;&nbsp;<?php echo ($data['pthy']); ?></span></span></li>
                    <li><img src="/Public/home/wap/images/team_3.png"><span><?php echo (L("hj")); ?><span>&nbsp;&nbsp;&nbsp;<?php echo ($data['viphy']); ?></span></span></li>
                    <li><img src="/Public/home/wap/images/team_4.png"><span><?php echo (L("bj")); ?><span>&nbsp;&nbsp;&nbsp;<?php echo ($data['hjvip']); ?></span></span></li>
                    <li><img src="/Public/home/wap/images/team_5.png"><span><?php echo (L("zs")); ?><span>&nbsp;&nbsp;&nbsp;<?php echo ($data['bjvip']); ?></span></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>
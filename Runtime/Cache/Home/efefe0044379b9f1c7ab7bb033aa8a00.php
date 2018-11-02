<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>已完成订单</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/responsive.tabs.js"></script>
<script src="/Public/home/wap/js/iscroll.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/jquery.reveal.js"></script>
<body class="bg96">

<div class="header">
    <div class="header_l">
        <a href="<?php echo U('Growth/Purchase');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
    </div>
    <div class="header_c"><h2>已完成订单</h2></div>
    <div class="header_r"></div>
</div>

<div class="demo">
    <div class="accordion">

        <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><div class="accordion-handle">
                <h4>
                    <p class="accmrp">买入金额：<?php echo ($v['pay_nums']); ?>RMB<span class="acco_con_span">已完成</span></p>
                    <p><?php echo (date("Y-m-d H:i:s",$v['pay_time'])); ?><span>收款人：<?php echo ($v['uname']); ?></span></p>
                </h4>
                <i></i>
            </div>
            <div class="accordion-content por">
                <div class="acco_con_up">
                    <p>收款人姓名：<span> <?php echo ($v['uname']); ?></span></p>
                    <p>手机号码：<span><?php echo ($v['umobile']); ?></span></p>
                    <p>开户银行：<span><?php echo ($v['bname']); ?></span></p>
                    <p>银行卡号：<span><?php echo ($v['cardnum']); ?></span></p>
                    <p>开户支行：<span><?php echo ($v['openrds']); ?></span></p>
                    <p>交易金额：<span><?php echo ($v['pay_nums']); ?>RMB</span></p>
                    <p>状态：<span class="acco_con_span">已完成</span></p>
                </div>
                <div class="acco_con_upa">
                    <h3>打款截图</h3>
                    <div class="shangcjt">
                        <div class="containera">
                            <a href="<?php echo U('Growth/Paidimg',array('id'=>$v['id']));?>"><img src="<?php echo ($v['trans_img']); ?>"  ></a>
                        </div>
                    </div>
                </div>
            </div><?php endforeach; endif; ?>

        <!--<div class="accordion-handle">
            <h4>
                <p class="accmrp">卖出金额：3000RMB<span class="acco_con_span">已完成</span></p>
                <p>2018-03-15 20:33:24<span>打款人：张三</span></p>
            </h4>
            <i></i>
        </div>
        <div class="accordion-content por">
            <div class="acco_con_up">
                <p>打款人姓名：<span> 张三</span></p>
                <p>手机号码：<span>13512341234</span></p>

                <p>交易金额：<span>3000.00RMB</span></p>
                <p>状态：<span class="acco_con_span">已完成</span></p>
            </div>
            <div class="acco_con_upa">

                <h3>打款截图</h3>
                <div class="shangcjt">
                    <div class="containera">
                        <a href="me_Sell_xial_Completeda.html"><img src="/Public/home/wap/images/timg.jpg"></a>
                    </div>
                </div>
            </div>
        </div>-->

        <?php if(!empty($page)): ?><ul class="pagination"><?php echo ($page); ?></ul><?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.accordion').respTabs({
            model: 'accordions'
        });
    });
</script>
</body>
</html>
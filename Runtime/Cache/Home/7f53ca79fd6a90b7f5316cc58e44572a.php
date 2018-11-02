<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>确认收款</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/wap/js/responsive.tabs.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js" ></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>

    <script src="/Public/home/wap/js/iscroll.js"></script>
    <body class="bg96">

        <div class="header">
            <div class="header_l">
                <a href="<?php echo U('Trading/SellCentr');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
            </div>
            <div class="header_c"><h2>确认收款</h2></div>
            <div class="header_r"></div>
        </div>



        <!--  -->

        <div class="demo">
            <div class="accordion">
                <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><div class="changeclass">
                        <div class="accordion-handle">
                            <h4>
                                <p class="accmrp">卖出金额：<?php echo ($v['pay_nums']); ?>余额<span class="acco_con_spana" ><?php if(($v['pay_state']) == "2"): ?>确认收款<?php else: ?>待收款<?php endif; ?></span></p>
                                <p><?php echo (date("Y-m-d H:i:s",$v['pay_time'])); ?><span>打款人：<?php echo ($v['uname']); ?></span></p>
                            </h4>
                            <i></i>
                        </div>
                        <div class="accordion-content por">
                            <div class="acco_con_up">
                                <p>打款人姓名：<span> <?php echo ($v['uname']); ?></span></p>
                                <p>手机号码：<span><?php echo ($v['umobile']); ?></span></p>
                                <p>交易金额：<span><?php echo ($v['money']); ?>RMB</span></p>
                                <p>状态：<span class="acco_con_spana"><?php if(($v['pay_state']) == "2"): ?>确认收款<?php else: ?>待收款<?php endif; ?></span></p>
                                <p>配对时间：<span><?php echo ($v['pair_time']); ?></span></p>
                                <p>打款时间：<span><?php echo ($v['update_time']); ?></span></p>
                            </div>
                            <div class="acco_con_upa">

                                <h3>打款截图</h3>
                                <div class="shangcjt">
                                    <div class="containera">
                                        <a href="<?php echo U('Growth/Paidimg',array('id'=>$v['id']));?>"><img src="<?php echo ($v['trans_img']); ?>"  ></a>
                                    </div>
                                </div>
                            </div>
                            <?php if(($v['pay_state']) == "2"): ?><a href="javascript:void(0)" class="lanseanna" data-id="<?php echo ($v['id']); ?>">确认收款</a>
                            <?php else: ?>
                            <a href="javascript:void(0)" class="paid">待收款</a><?php endif; ?>
                        </div>
                    </div><?php endforeach; endif; ?>

                <?php if(!empty($page)): ?><ul class="pagination"><?php echo ($page); ?></ul><?php endif; ?>
                <!--	<div class="accordion-handle">
                         <h4>
                                 <p class="accmrp">卖出金额：3000RMB<span class="acco_con_spana" >确认收款</span></p>
                                 <p>2018-03-15 20:33:24<span>打款人：张三</span></p>
                         </h4>
                         <i></i>
                 </div>
                         <div class="accordion-content por">
                     <div class="acco_con_up">
                         <p>打款人姓名：<span> 张三</span></p>
                         <p>手机号码：<span>13512341234</span></p>
         
                         <p>交易金额：<span>3000.00RMB</span></p>
                         <p>状态：<span class="acco_con_spana">确认收款</span></p>
                     </div>
                     <div class="acco_con_upa">
                         <h3>上传打款截图</h3>
                         <div class="shangcjt">
         
                              <div class="containera">
                                 <a href="me_Sell_xial_Completeda.html"><img src="/Public/home/wap/images/timg.jpg"  ></a>
                             </div>
                         </div>
                     </div>
                     <a href="#" class="lanseanna">确认已收款</a>
                 </div>-->
            </div>
        </div>



        <script type="text/javascript">
            $(document).ready(function() {
                $('.accordion,.changeclass').respTabs({
                    model: 'accordions'
                });
            });

            $('.lanseanna').click(function() {
                var old = $(this);
                var trid = $(this).attr('data-id');
                if (trid == '') {
                    msg_alert('请选择正确的收款');
                }
                $.ajax({
                    url: '/Trading/Con_Getmoney',
                    type: 'post',
                    data: {'trid': trid},
                    datatype: 'json',
                    success: function(mes) {

                        if (mes.status == 1) {
                            old.parents('.changeclass').find('.acco_con_spana').text('已打款');
                            old.text('已打款');
                            old.addClass('paid').removeClass('lanseanna');
                            msg_alert(mes.message);
                        } else {
                            msg_alert(mes.message);
                        }
                    }
                })
            })
        </script>

    </body>
</html>
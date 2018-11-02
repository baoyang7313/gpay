<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>未完成订单</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/wap/js/responsive.tabs.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js"></script>
    <script src="/Public/home/wap/js/iscroll.js"></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js" ></script>
    <body class="bg96">

        <div class="header">
            <div class="header_l">
                <a href="<?php echo U('Trading/SellCentr');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
            </div>
            <div class="header_c"><h2>未完成订单</h2></div>
            <div class="header_r"></div>
        </div>

        <div class="big_width100">

            <div class="undone_order">

                <div class="undone_order_titel clear_wl">
                    <a href="<?php echo U('Trading/Nofinsh');?>"  <?php if(($state) == "1"): ?>class="undone_OT_l fl"<?php else: ?>class="undone_OT_l fl noe"<?php endif; ?> >
                        未选择打款人
                    </a>
                    <a href="<?php echo U('Trading/Nofinsh',array('state'=>1));?>" <?php if(($state) == "1"): ?>class="undone_OT_r fr noe"<?php else: ?>class="undone_OT_r fr"<?php endif; ?>>
                        已选择打款人
                    </a>

                </div>
            </div>

        </div>

        <!--  -->

        <div class="demo">
            <div class="accordion">
                <?php if(!empty($orders)): if(is_array($orders)): foreach($orders as $key=>$v): if(($v['pay_state']) >= "1"): ?><div class="accordion-handle">
                                <h4>
                                    <p class="accmrp">挂出金额：<?php echo ($v['pay_nums']); ?>RMB<span class="acco_con_spana" >已选择打款人</span></p>
                                    <p><?php echo (date("Y-m-d H:i:s",$v['pay_time'])); ?><span>打款人：<?php echo ($v['uname']); ?></span></p>
                                </h4>
                                <i></i>
                            </div>
                            <div class="accordion-content por">
                                <div class="acco_con_up">
                                    <p>打款人姓名：<span> <?php echo ($v['uname']); ?></span></p>
                                    <p>手机号码：<span><?php echo ($v['umobile']); ?></span></p>
                                    <p>交易金额：<span><?php echo ($v['pay_nums']); ?>RMB</span></p>
                                    <p>状态：<span class="acco_con_spana">已选择打款人</span></p>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="accordion-handle" id="<?php echo ($v[id]); ?>">
                                <h4>
                                    <p class="accmrp">挂出金额：<?php echo ($v['pay_nums']); ?>RMB<span >未选择打款人</span></p>
                                    <p><?php echo (date("Y-m-d H:i:s",$v['pay_time'])); ?><span></span>
                                        <a href="javascript:void(0)" onclick="revoke(this)" data-id ='<?php echo ($v[id]); ?>'>撤销</a></p>
                                </h4>
                                <i></i>
                            </div>
                            <div class="accordion-content por" id="<?php echo ($v[id]); ?>por">
                                <div class="acco_con_up">
                                    <p>打款人姓名：<span></span></p>
                                    <p>手机号码：<span></span></p>

                                    <p>交易金额：<span></span></p>
                                    <p>状态：<span>未选择打款人</span></p>
                                </div>
                            </div><?php endif; endforeach; endif; ?>
                    <?php else: ?>
                    <div class="big_width100">
                        <div class="annalWa"><p >没找到相关记录</p></div>
                    </div><?php endif; ?>



                <?php if(!empty($page)): ?><ul class="pagination"><?php echo ($page); ?></ul><?php endif; ?>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.accordion').respTabs({
                    model: 'accordions'
                });
            });
            //执行撤销操作
            function revoke(e) {
                var trid = $(e).attr('data-id');

                var r = confirm("确认撤销吗？");
                if (r == false) {
                    return;
                }
                

                console.log(trid);

                $.ajax({
                    url: '/Trading/revoke',
                    type: 'post',
                    data: {'trid': trid},
                    datatype: 'json',
                    success: function(mes) {
                        if (mes.status == 1) {
                            msg_alert(mes.message);
                            $("#"+trid).remove();
                            $("#"+trid+"por").remove();
                        } else {
                            msg_alert(mes.message);
                            
                        }
                    }
                });

            }
        </script>

    </body>

</html>
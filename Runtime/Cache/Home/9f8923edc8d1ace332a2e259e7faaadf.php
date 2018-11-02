<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>确认打款</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/responsive.tabs.js"></script>
<script src="/Public/home/wap/js/iscroll.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/jquery.form.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>


<body class="bg96">
<div class="header">
    <div class="header_l">
        <a href="<?php echo U('Growth/Purchase');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
    </div>
    <div class="header_c"><h2>确认打款</h2></div>
    <div class="header_r"></div>
</div>


<!--  -->

<div class="demo">
    <div class="accordion">

        <?php if(is_array($orders)): foreach($orders as $key=>$v): ?><div class="changeclass">
                <div class="accordion-handle">
                    <h4>
                        <p class="accmrp">买入金额：<?php echo ($v['pay_nums']); ?>&nbsp;余额<span class="acco_con_spana"><?php if($v['pay_state'] == 1): ?>待打款
							<?php elseif($v['pay_state'] == 2): ?>
							已打款
							<?php else: ?>
							已收款<?php endif; ?></span></p>
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
                        <p>打款金额：<span>&nbsp;RMB</span><span style="color: red"><?php echo ($v['money']); ?></span></p>
                        <p>状态：<span class="acco_con_spana">
						<?php if($v['pay_state'] == 1): ?>待打款
							<?php elseif($v['pay_state'] == 2): ?>
							已打款
							<?php else: ?>
							已收款<?php endif; ?>
					</span></p>
                        <p>匹配时间：<span><?php echo ($v['pair_time']); ?></span></p>
                        <p>打款时间：<span><?php echo ($v['update_time']); ?></span></p>
                    </div>
                    <div class="acco_con_upa">
                        <?php if(($v['pay_state']) == "1"): ?><h3>上传打款截图</h3>
                            <div class="shangcjt">
                                <form id='myupload' action="<?php echo U('Growth/Conpay');?>" method='post'
                                      enctype='multipart/form-data'>
                                    <div class="containera"></div>
                                    <input type="text" value="<?php echo ($v['id']); ?>" name="trid">
                                    <input type="file" id="photo" name="uploadfile" class="shangcanj">
                                </form>
                            </div>
                            <?php else: ?>

                            <h3>打款截图</h3>
                            <div class="shangcjt">
                                <div class="containera">
                                    <a href="<?php echo U('Growth/Paidimg',array('id'=>$v['id']));?>"><img src="<?php echo ($v['trans_img']); ?>"></a>
                                </div>
                            </div><?php endif; ?>
                    </div>

                    <?php if($v['pay_state'] == 1): ?><a href="javascript:void(0)" class="lanseanna">提交</a>
                        <?php elseif($v['pay_state'] == 2): ?>
                        <a href="javascript:void(0)" class="paid">等待收款</a>
                        <?php else: ?>
                        <a href="javascript:void(0)" class="paid">已收款</a><?php endif; ?>
                </div>
            </div><?php endforeach; endif; ?>

        <?php if(!empty($page)): ?><ul class="pagination"><?php echo ($page); ?></ul><?php endif; ?>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('.accordion,.changeclass').respTabs({
            model: 'accordions'
        });
    });
    // //
    $('.shangcanj').change(function (e) {
        var old_this = $(this);
        var files = this.files;
        var img = new Image();
        var reader = new FileReader();
        reader.readAsDataURL(files[0]);
        reader.onload = function (e) {
            var dx = (e.total / 1024) / 1024;
            if (dx >= 2) {
                alert("文件不能大于2M");
                return;
            }
            img.src = this.result;
            img.style.width = "100%";
            img.style.height = "90%";
            old_this.parents('#myupload').find('.containera').html(img);
        }
    })


    $('.lanseanna').click(function () {
        var old = $(this);
        old.parents('.por').find('form').ajaxSubmit({
            dataType: 'json', //数据格式为json
            success: function (data) {
                if (data.status == 1) {
                    old.parents('.changeclass').find('.acco_con_spana').text('等待收款');
                    old.text('已打款');
                    old.addClass('paid').removeClass('lanseanna');
                    msg_alert('打款凭证上传成功',data.url);
                } else {
                    msg_alert(data.message);
                }
            },
            error: function (xhr) { //上传失败
                alert("上传失败");
            }
        });
    })
</script>
</body>
</html>
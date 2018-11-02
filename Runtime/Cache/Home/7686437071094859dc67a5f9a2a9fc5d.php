<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("turncords")); ?></title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<body class="bg96">

<div class="header">
	<div class="header_l">
		<a href="<?php echo U('Growth/Intro');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	</div>
	<div class="header_c"><h2><?php echo (L("turncords")); ?></h2></div>
	<div class="header_r"></div>
</div>

<div class="big_width100">
	<?php if(is_array($Chan_info)): foreach($Chan_info as $key=>$v): ?><div class="annal_ul">
			<div class="annal_ul_l">
				<img src="/Public/home/wap/images/toux-icon.png" alt="">
				<div class="annal_p">
					<?php if(($v['get_id']) == $uid): ?><p><?php echo M('user')->where(array('userid'=>$v['pay_id']))->getfield('username'); ?></p>
						<?php else: ?>
						<p><?php echo M('user')->where(array('userid'=>$v['get_id']))->getfield('username'); ?></p><?php endif; ?>
					<p>UID:<?php echo ($v['pay_id']); ?></p>
				</div>
			</div>

			<div class="annal_ul_r">
				<div class="annal_p">
					<p class="zhuanrua"><?php if(($v['get_id']) == $uid): ?>+<?php else: ?>-<?php endif; echo ($v['get_nums']); ?></p>
					<p><?php echo (date("Y-m-d H:i:s",$v['get_time'])); ?></p>
				</div>
			</div>
		</div><?php endforeach; endif; ?>
	<!--<div class="annal_ul">-->

		<!--<div class="annal_ul_l">-->
			<!--<img src="/Public/home/wap/images/toux-icon.png" alt="">-->
			<!--<div class="annal_p">-->
				<!--<p>蔡先生</p>-->
				<!--<p>UID:19144</p>-->
			<!--</div>-->
		<!--</div>-->

		<!--<div class="annal_ul_r">-->
			<!--<div class="annal_p">-->
				<!--<p class="zhuanrua">+192.00</p>-->
				<!--<p>2018-01-25 18:55:46</p>-->
			<!--</div>-->
		<!--</div>-->


	<!--</div>-->
	<!--<div class="annal_ul">-->

		<!--<div class="annal_ul_l">-->
			<!--<img src="/Public/home/wap/images/toux-icon.png" alt="">-->
			<!--<div class="annal_p">-->
				<!--<p>蔡先生</p>-->
				<!--<p>UID:19144</p>-->
			<!--</div>-->
		<!--</div>-->

		<!--<div class="annal_ul_r">-->

			<!--<div class="annal_p">-->
				<!--<p class="zhuanrua">+192.00</p>-->
				<!--<p>2018-01-25 18:55:46</p>-->
			<!--</div>-->

		<!--</div>-->


	<!--</div>-->

</div>
</body>
</html>
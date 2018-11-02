<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("turncords")); ?></title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<body class="bg96">

<div class="header">
	<div class="header_l">
		<a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	</div>
	<div class="header_c"><h2><?php echo (L("zcjl")); ?></h2></div>
	<!--<div class="header_r"><a href="<?php echo U('Index/Turncords2');?>"><?php echo (L("zcxq")); ?></a></div>-->
</div>

<div class="big_width100">

	<?php if(is_array($Chan_info)): foreach($Chan_info as $key=>$v): ?><a href="<?php echo U('Index/Turncords2',['id'=>$v['id']]);?>">
		<div class="annal_ul">
			<div class="annal_ul_l">
				<img src="/Public/home/wap/heads/<?php echo ($v['imghead']); ?>" alt="">
				<div class="annal_p">
					<p><?php echo ($v['guname']); ?></p>
					<p>UID:<?php echo ($v['get_id']); ?></p>
				</div>
			</div>
			<div class="annal_ul_r">
				<div class="annal_p">
					<p class="zhuanrua">-<?php echo ($v['get_nums']); ?></p>
					<p><?php echo (date("Y-m-d H:i:s",$v['get_time'])); ?></p>
				</div>
			</div>
		</div>
		</a><?php endforeach; endif; ?>


</div>
</body>

</html>
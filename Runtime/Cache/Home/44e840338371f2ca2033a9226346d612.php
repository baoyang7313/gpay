<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>分享好友</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js" ></script>

<body class="bg96 bg_blue">
	<div class="header">
	    <div class="header_l" style="">
	    <a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	    </div>
	    <div class="header_c" style=""><h2><?php echo (L("shareFri")); ?></h2></div>
	    <div class="header_r" style=""><a href="/Growth/test?filename=.<?php echo ($urel); ?>" ><?php echo (L("getCode")); ?></a></div>
	</div>


	<div class="share-top clear">

		<img src="/Public/home/wap/images/shareCode.png">
		<span>Gpays</span>

		<div class="share_rwm">
			<div>
				<p><?php echo (L("share_p")); ?></p>
				<img src="<?php echo ($urel); ?>">
				<p><?php echo (L("share_p2")); ?></p><br>
			</div>

			<div>
				<a href="<?php echo U('User/Sharelist');?>"><p><?php echo (L("share_jl")); ?></p></a>
			</div>
		</div>
		<div class="copBtn">
			<span hidden id="txt"><?php echo ($aurl); ?></span>
			<a href="javascript:void(0)"  onclick="copyUrl();"  class="copyLink"><p><?php echo (L("share_link")); ?></p></a>
		</div>
	</div>

    <script type="text/javascript">
        function copyUrl()
        {
            var txt=$("#txt").text();
            copy(txt);
        }

        function copy(message) {
            var input = document.createElement("input");
            input.value = message;
            document.body.appendChild(input);
            input.select();
            input.setSelectionRange(0, input.value.length), document.execCommand('Copy');
            document.body.removeChild(input);
            alert("复制成功哦");
        }
    </script>

</body>
</html>
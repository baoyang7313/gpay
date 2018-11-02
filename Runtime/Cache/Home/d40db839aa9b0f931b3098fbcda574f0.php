<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("getpwd")); ?></title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/login.css">
<body>

<div class="register-container" style=" position: relative;">
	<!--<h1>Gpays<?php echo (L("getpwd")); ?></h1>-->
	<span style="font-size:20px;font-family: 'PingFang SC';"><?php echo (L("resetPassword")); ?></span>
	<div class="header_l" style=" position: absolute;top: -14px;left: 0px;">
		<a href="javascript:history.go(-1)"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	</div>


	
	
	<form name="getpwdfrom" id="forgetForm" action="<?php echo U('setpsw');?>" method="post" >
		<div>
			<input type="text" name="mobile" class="phone_number" placeholder="<?php echo (L("mobilenumber")); ?>" maxlength="11" autocomplete="off" id="number"/>
		</div>
		
		<div class="yanzhm">
			<input type="code" name="code" class="code" placeholder="<?php echo (L("verificationcode")); ?>" oncontextmenu="return false" onpaste="return false" />
			<a href="javascript:void(0)" id="mycode"><?php echo (L("send")); ?></a>
		</div>

		<div>
			<input type="password" name="password" class="password" placeholder="<?php echo (L("newpwd")); ?>" oncontextmenu="return false" onpaste="return false" />
		</div>
		<div>
			<input type="password" name="passwordmin" class="confirm_password" placeholder="<?php echo (L("newconfirmpwd")); ?>" oncontextmenu="return false" onpaste="return false" />
		</div>

        <div  class="inde-reg">
		 <button id="submit" type="button" onclick="SetPwd()"><?php echo (L("confirm")); ?></button>
		</div>
	</form>
	
  <div class="pad10"></div>
</div>

</body>
<script src="https://www.jq22.com/jquery/1.11.1/jquery.min.js"></script>
<script src="/Public/home/wap/js/common.js"></script>

<!--表单验证-->
<script src="/Public/home/wap/js/jquery.validate.min.js?var1.14.0"></script>

<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<script type="text/javascript"  src="/Public/home/common/layer/layer.js" ></script>
</html>

<script type="text/javascript">
    $('#mycode').click(function(){
        var mobile=$("input[name='mobile']").val();
        if(mobile=='' || mobile==null){
            layer.msg('请输入手机号码');
        }
        $.post("<?php echo U('Login/sendCode');?>",{'mobile':mobile},function(data){
            if(data.status==1){
                layer.msg(data.message);
                RemainTime();
            }else{
                layer.msg(data.message);
            }
        });
    });

    var intime="<?php echo (session('set_time')); ?>";
    var timenow ="<?php echo time(); ?>";

    var bet=(parseInt(intime)+60)-parseInt(timenow);
    $(document).ready(function(){
        if(bet>0){
            RemainTime();
        }
    });
    var iTime = 59;
    var Account;
    if(bet>0){
        iTime=bet;
    }
    function RemainTime(){
        var iSecond,sSecond="",sTime="";
        if (iTime >= 0){
            iSecond = parseInt(iTime%60);
            iMinute = parseInt(iTime/60)
            if (iSecond >= 0){
                if(iMinute>0){
                    sSecond = iMinute + "分" + iSecond + "秒";
                }else{
                    sSecond = iSecond + "秒";
                }
            }
            sTime=sSecond;
            if(iTime==0){
                clearTimeout(Account);
                sTime='获取验证码';
                iTime = 59;
            }else{
                Account = setTimeout("RemainTime()",1000);
                iTime=iTime-1;
            }
        }else{
            sTime='没有倒计时';
        }
        $('#mycode').html(sTime);
        //document.getElementById('').html(123);
    }
</script>
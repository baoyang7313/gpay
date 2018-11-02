<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title><?php echo (L("ucenter")); ?>&nbsp;<?php echo (L("regtitle")); ?></title>
        <link rel="stylesheet" href="/Public/home/wap/css/style.css">
        <link rel="stylesheet" href="/Public/home/wap/css/login.css">
        <script type="text/javascript" src="/Public/home/common/js/jquery-1.9.1.min.js" ></script>
        <script type="text/javascript" src="/Public/home/common/layer/layer.js" ></script>
        <script type="text/javascript" src="/Public/home/common/js/index.js" ></script>
        <script type="text/javascript" src="/Public/home/common/js/home_index.js"></script>
    </head>

    <body>

        <div class="register-container">
            <!--<h1><?php echo (L("ucenter")); ?>&nbsp;<?php echo (L("regtitle")); ?></h1>-->
            <div class="logo">
                <img src="/Public/home/wap/images/reg.png">
            </div>


            <form name="AddUser" action="<?php echo U('Login/register');?>" id="registerForm" method="get">
                <div>
                    <input type="text" name="username" class="nickname" placeholder="<?php echo (L("nickname")); ?>" autocomplete="off"/>
                </div>
                <div>
                    <input type="number" name="mobile" class="phone_number" placeholder="<?php echo (L("mobilenumber")); ?>" autocomplete="off" id="number"/>
                </div>
                <div class="yanzhm">
                    <input type="number" id="code" name="code" class="code" placeholder="<?php echo (L("verificationcode")); ?>" oncontextmenu="return false" onpaste="return false" />
                    <a href="javascript:void(0)" id="mycode"><?php echo (L("send")); ?></a>
                </div>
                <div>
                    <input type="password" name="login_pwd" class="password" placeholder="<?php echo (L("enterpwd")); ?>" oncontextmenu="return false" onpaste="return false" />
                </div>
                <div>
                    <input type="password" name="relogin_pwd" class="confirm_password" placeholder="<?php echo (L("confirmpwd")); ?>" oncontextmenu="return false" onpaste="return false" />
                </div>

                <input type="text" name="pid" placeholder="<?php echo (L("personmobile")); ?>" value="<?php echo ($mobile); ?>" class="tj_tel">

                <div>
                    <input type="password" name="safety_pwd" class="safety_pwd" placeholder="<?php echo (L("paypwd")); ?>" oncontextmenu="return false" onpaste="return false" />
                </div>

                <div  class="inde-reg">
                    <button id="submit"  type="button" onclick="adduser()"><?php echo (L("register1")); ?></button>
                </div>
            </form>
            <!--    <a href="<?php echo U('Login/Appload');?>" class="inde-reg ">
                    <button type="button" class="register-tis">APP下载</button>
                </a> -->

            <!-- <a href="https://w-5.net/7Wr0L" class="inde-reg ">
                <button type="button" class="register-tis">APP下载</button>
            </a> -->

            <a href="<?php echo U('Login/login');?>" class="inde-reg">
                <button type="button" class="register-tis" style="border:none;background: none;"><?php echo (L("account")); ?></button>
            </a>
            <div class="pad10"></div>
        </div>
    </body>

    <!--表单验证-->
    <script src="/Public/home/wap/js/jquery.validate.min.js?var1.14.0"></script>
    <script type="text/javascript" src="/Public/home/common/js/sendmessage.js"></script>
</html>

<script type="text/javascript">
                        $('#mycode').click(function() {
                            var mobile = $("input[name='mobile']").val();
                            if (mobile == '' || mobile == null) {
                                layer.msg('请输入手机号码');
                            }
                            $.post("<?php echo U('Login/sendCode');?>", {'mobile': mobile}, function(data) {
                                if (data.status == 1) {
                                    layer.msg(data.message);
                                    RemainTime();
                                } else {
                                    layer.msg(data.message);
                                }
                            });
                        });

                        var intime = "<?php echo (session('set_time')); ?>";
                        var timenow = "<?php echo time(); ?>";

                        var bet = (parseInt(intime) + 60) - parseInt(timenow);
                        $(document).ready(function() {
                            if (bet > 0) {
                                RemainTime();
                            }
                        });
                        var iTime = 59;
                        var Account;
                        if (bet > 0) {
                            iTime = bet;
                        }
                        function RemainTime() {
                            var iSecond, sSecond = "", sTime = "";
                            if (iTime >= 0) {
                                iSecond = parseInt(iTime % 60);
                                iMinute = parseInt(iTime / 60)
                                if (iSecond >= 0) {
                                    if (iMinute > 0) {
                                        sSecond = iMinute + "分" + iSecond + "秒";
                                    } else {
                                        sSecond = iSecond + "秒";
                                    }
                                }
                                sTime = sSecond;
                                if (iTime == 0) {
                                    clearTimeout(Account);
                                    sTime = '获取验证码';
                                    iTime = 59;
                                } else {
                                    Account = setTimeout("RemainTime()", 1000);
                                    iTime = iTime - 1;
                                }
                            } else {
                                sTime = '没有倒计时';
                            }
                            $('#mycode').html(sTime);
                        }
</script>
<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("ucenter")); echo (L("login")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/login.css">
    <body>

        <div class="login-container">

            <div class="logo">
                <img src="/Public/home/wap/images/logo.png">
            </div>
            <h1></h1>
<!--            <span id="lant" style="float: right;margin-top: 0px;">
                <?php if(($lantype) == "1"): ?>简体中文<?php endif; ?>
                <?php if(($lantype) == "2"): ?>English<?php endif; ?>


            </span>-->

            <!--	<div <?php if(($lantype) == "1"): ?>class="dyyyinw ona"<?php else: ?>class="dyyyinw"<?php endif; ?>><span>简体中文</span><p><input type="radio" name="identity" value="1"  class="radioclass"></p></div>
                    <div <?php if(($lantype) == "2"): ?>class="dyyyinw ona"<?php else: ?>class="dyyyinw"<?php endif; ?>><span>English</span> <p><input type="radio" name="identity" value="2" class="radioclass"/></p></div>-->

            <form name="formlogin" id="loginForm" class="formlogin" method="post" action="<?php echo U('Login/checkLogin');?>">
                <div  class="div-bor">
                    <i class="icon-tel"></i>
                    <input type="text" name="account" class="username" placeholder="<?php echo (L("mobile")); ?>/UID" autocomplete="off"/>
                </div>
                <div>
                    <input type="password" name="password" class="password" placeholder="<?php echo (L("loginpwd")); ?>" oncontextmenu="return false" onpaste="return false" />
                </div>
                <div>
                    <select id="lang" class="lang">
                        <option style="background: none; border: 0;" value ="1" <?php if(($lantype) == "1"): ?>selected="selected"<?php endif; ?>>简体中文</option>
                        <option style="background: none; border: 0;" value ="2" <?php if(($lantype) == "2"): ?>selected="selected"<?php endif; ?>>English</option>
<!--                        <option value="3">Opel</option>
                        <option value="4">Audi</option>-->
                    </select>
                </div>
                <div  class="inde-reg">
                    <button id="submit" type="button" onclick="login()"><?php echo (L("login")); ?></button>
                </div>
            </form>
            <!-- 	<a href="<?php echo U('Login/Appload');?>" class="inde-reg ">
                            <button type="button" class="register-tis">APP下载</button>
                    </a> -->
            <!-- <a href="https://w-5.net/7Wr0L" class="inde-reg ">
                    <button type="button" class="register-tis">APP下载</button>
            </a>
            -->

            <a href="<?php echo U('Login/register');?>" class="inde-reg ">
                <button type="button" class="register-tis" style="border:none;background: none;width: 55%;float: right;"><?php echo (L("register")); ?></button>
            </a>

            <a href="<?php echo U('login/getpsw');?>" class="inde-reg" >
                <button type="button" class="register-tis" style="border:none;background: none;width: 45%;float: left;"><?php echo (L("forgelogpwd")); ?></button>
            </a>
            <div class="pad10"></div>
        </div>

    </body>
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>

    <!--<script src="/Public/home/wap/js/common.js"></script>-->

    <!--表单验证-->
    <script src="/Public/home/wap/js/jquery.validate.min.js?var1.14.0"></script>

    <!--commonjs-->
    <script type="text/javascript" src="/Public/home/common/layer/layer.js" ></script>
    <script type="text/javascript" src="/Public/home/common/js/jquery-1.9.1.min.js" ></script>

    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js"></script>
    <script>
            
            $('#lang').change(function() {
                var checlan = $('#lang').val();
                console.log(checlan);
                if (checlan == 1) {
                    window.location.href = '?l=zh-cn';
                }

                if (checlan == 2) {
                    window.location.href = '?l=en-us';
                }
            })
        </script>
</html>
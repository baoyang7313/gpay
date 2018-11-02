<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Account.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>

<body>
    <div class="header">
        <div class="header_l">
            <a href="<?php echo U('Index/index');?>">
                <img src="/Public/home/wap/images/jiant.png" alt="">
            </a>
        </div>
        <div class="header_c">
            <h2><?php echo (L("team")); ?></h2>
        </div>
        <div class="header_r">
            <a href="<?php echo U('Wallet/index');?>"><?php echo (L("sharelist")); ?></a>
        </div>
    </div>
    <div class="section">
        <ul class="section_ul fd_c">
            <li class="bd_05 bg_f mt_10">
                <div class="top fd_r W_09 color_0 bg_f">
                    <span>CNY</span>
                    <span>0</span>
                </div>
                <div class="center fd_r W_09 bg_f">
                    <div class="center_ewm">
                        <img src="/Public/home/wap/images/Account/01.png" alt="">
                    </div>
                    <div class="fd_c center_two  color_0 pd_f10 fs_12">
                        <span>钱包地址：</span>
                        <span>
                            <a href="javascript:void(0)" data-url="<?php echo U('Account/index');?>" class="fs_10 Wallet">www.gkddlgffrwero</a>
                        </span>
                    </div>
                </div>
                <div class="bottom fd_r color_0 fs_18 bg bd_05 mt_5">
                    <span class="h_100">查看转账</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="ewm W_1 b_none">
        <div class="ewm_box">
            <b>
                <img src="/Public/home/wap/images/Account/close.png" alt="">
            </b>
            <img src="/Public/home/wap/images/Account/02.png" alt="" srcset="">
        </div>
    </div>
    <script>
        $('.section_ul').on('click', '.center_ewm>img', function (e) {
            $('.ewm').css('display', 'block');
            e.preve
        })
        $('.ewm_box>b').on('click', function () {
            $(this).parents('.ewm').css('display', 'none');
        })
    </script>
</body>

</html>
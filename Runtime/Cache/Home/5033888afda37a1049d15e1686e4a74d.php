<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wallet</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Wallet.css">
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
            <a href="<?php echo U('Account/index');?>"><?php echo (L("sharelist")); ?></a>
        </div>
    </div>
    <div class="section clearfix fd_c">
        <div class="sectionH">
            <div class="sectionH-box">
                <div class="fd_c">
                    <div class="fd_c">
                        <span class="fs_12 bd lh_15">我的账户</span>
                        <p class="fs_12 txt_c">余额
                            <span class="fs_12">132432GPY</span>
                        </p>
                    </div>
                </div>
                <div class="m2">
                    <img src="/Public/home/wap/images/Wallet/01.png" alt="">
                </div>
                <div class="sectionH-box-pr fd_c">
                    <div class="fd_c">
                        <span class="fs_12 bd lh_15">钱包</span>
                        <span class="fs_12 txt_c">1350000000</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="sectionMain fs_12">
            <div class="sectionMain-top">
                <div class="bd">币种选泽</div>
                <div>
                    <span class="bd xian">GPY</span>
                    <span>
                        <select name="" id="select" class="select">
                            <option value="">OGP</option>
                            <option selected value="">GPY</option>
                            <option value="">CNY</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="sectionMain-bottom">
                <div class="bd">划转数量</div>
                <div>
                    <input type="text" class="hc_input " placeholder="1000">
                </div>
            </div>
        </div>
        <div class="sectionC">
            <!-- <ul class="sectionC-ul">
                <li>余额:&nbsp;
                    <span>10</span>
                </li>
                <li>
                    <span>GPY</span>
                </li>
            </ul> -->
            <div>
                <input type="button" value="确认划账" />
            </div>
        </div>
        <!-- <div class="sectionF">
            <ul>
                <li>币币账户</li>
                <li>CNY</li>
            </ul>
        </div>-->
    </div>
    <script>
        $('.select').change(function () {
            var el = $('option:selected');
            var txt = $('option:selected').text();
            console.log(txt);
            $('.xian').text(txt);
        })
    </script>
</body>

</html>
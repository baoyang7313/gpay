<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Transaction.css">
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
            <a href="<?php echo U('User/Sharelist');?>"><?php echo (L("sharelist")); ?></a>
        </div>
    </div>
    <div class="tabBox">
            <a href="<?php echo U('Buy/index');?>">
                <div>买入</div>
            </a>
            <a href="<?php echo U('Sell/index');?>">
                <div>卖出</div>
            </a>
            <a href="">
                <div>
                    当前委托
                </div>
            </a>
            <a href="">
                <div>历史委托</div>
            </a>
        </div>
    <div class="container">
        <div class="content">
            <h1>暂无数据</h1>
        </div>
    </div>
    </div>

</body>

</html>
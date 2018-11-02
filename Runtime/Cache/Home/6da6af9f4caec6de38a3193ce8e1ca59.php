<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Record.css">
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
            <a href="<?php echo U('User/Sharelist');?>"  style="margin-top: 0;"><?php echo (L("sharelist")); ?></a>
        </div>
    </div>
    
    <div class="container">
            <div class="tabRecord">
                    <a href="<?php echo U('/index');?>" class="tabRecord-bg">
                        购买记录
                    </a>
                    <a href="<?php echo U('/index');?>">
                        卖出记录
                    </a>
                </div>
        <div class="content">
            <h1>暂无数据</h1>
        </div>
    </div>
    </div>
    <script>
        $('.tabRecord>a').click(function(e){
            e.preventDefault();
            $('.tabRecord>a').removeClass('tabRecord-bg').css('color','rgb(106,106,106)');
            $(this).addClass('tabRecord-bg').css('color','#fff');

        })
    </script>
</body>

</html>
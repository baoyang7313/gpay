<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>分享记录</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<body class="bg96" style="">

<div class="header">
    <div class="header_l">
        <a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
    </div>
    <div class="header_c"><h2><?php echo (L("sharelist")); ?></h2></div>
    <div class="header_r"></div>
</div>

<div class="big_width100 por">

<form action="<?php echo U('User/Sharelist');?>" method="post">
<div class="zySearch">
<input id="searchInput" name="uinfo" class="search-input" value="<?php echo ($uinfo); ?>" type="text" placeholder="<?php echo (L("sharel_ss")); ?>">
<button class="search-btn btn"><?php echo (L("sharel_btn")); ?></button>
</div>
</form>

<?php if(is_array($muinfo)): foreach($muinfo as $key=>$v): ?><div class="share_ul">
<div class="share_ul_l">
<img src="/Public/home/wap/heads/<?php echo ($v['img_head']); ?>" alt="">
<div class="share_p">
<p><?php echo ($v['username']); ?></p>
<p>UID:<?php echo ($v['userid']); ?></p>
<p><?php echo (L("tel")); ?>:<?php echo ($v['mobile']); ?></p>

</div>
</div>
<div class="shijin"><?php echo (date("Y-m-d H:i:s",$v['reg_date'])); ?></div>

<?php if($v['use_grade'] == 1): ?><div class="dengjxias dengjxiasa">
<?php echo (L("pt")); ?>
<?php elseif($v['use_grade'] == 2): ?>
<div class="dengjxias dengjxiasb">
<?php echo (L("hj")); ?>
<?php elseif($v['use_grade'] == 3): ?>
<div class="dengjxias dengjxiasc">
<?php echo (L("bj")); ?>
<?php elseif($v['use_grade'] == 4): ?>
<div class="dengjxias dengjxiasd">
<?php echo (L("zs")); ?>
<?php else: ?>
<div class="dengjxias">
<?php echo (L("cshy")); endif; ?>
</div>
</div><?php endforeach; endif; ?>
</div>
</body>
</html>
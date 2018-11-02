<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>商品</title>
    <link rel="stylesheet" type="text/css" href="/Public/Public/css/stylelist.css">
    <link rel="stylesheet" type="text/css" href="/Public/Public/css/swiper-3.4.2.min.css">
    <script src="/Public/Public/js/jquery-1.12.1.min.js"></script>
    <script src="/Public/Public/js/swiper-3.4.2.jquery.min.js"></script>
    <script src="/Public/Public/js/jquery.lazyload.min.js"></script>
</head>

<body>
<script>
    $("body").css({background: "#f4f4f4"})
</script>
<div class="width100 font16 tcenter relative"
     style="height:44px;background:url(/Public/Public/images/bjx.jpg) repeat-x;line-height:44px;position:fixed;top:0;left:0;">
    商品列表
    <a href="javascript:window.history.go(-1);" id="return"></a>
</div>
<div class="width100 hidden" style="margin-top:54px;">
    <div class="width96 center hidden" id="new_xz">
        <?php if(!empty($goodsdet)): if(is_array($goodsdet)): foreach($goodsdet as $key=>$product): ?><a href="<?php echo U('/Shop/Home/details',array('proid'=>$product['id']));?>">
                    <!--<img data-original="/Public/Public/images/sp6.jpg">-->
                    <img src="<?php echo ($product['pic']); ?>" alt="" class="product_img">
                    <div class="width96 hidden center">
                        <p class="yihang block center font12 c33"><?php echo ($product['name']); ?></p>

                 <!--        <?php  $userid['userid']=$product['shangjia']; $dianpu=M('gerenshangpu')->where($userid)->find(); ?>
                                          <p class="yihang block center font12 c33 dp_name" style="color:#999; font-size:2.8vmin"><img src="/Uploads/image/product<?php echo ($dianpu["shop_logo"]); ?>" class="dp_slogo" style="width:5vmin; height:5vmin; border-radius: 10vmin; margin:auto; padding:auto; margin-right:4px; float:left;"><?php echo ($dianpu["shop_name"]); ?></p> -->
                        <p class="yihang block center font12 c33 hidden">
                	<span class="left c_33">
                    	<font class="red">¥  <?php echo ($product['price']); ?></font>
                    	<font class="font12 red">元</font>
                    </span>
                            <span class="right c_33">
                    	<!-- 赠送积分:<font class="red"><?php echo ($product['jifen_nums']); ?></font> -->
                        <font class="font12 red"></font>
                    </span>
                        </p>
                    </div>
                </a><?php endforeach; endif; ?>
            <?php else: ?>
            <p>暂无商品哦,亲</p><?php endif; ?>
            <!--<a href="#">-->
            <!--<img data-original="/Public/Public/images/sp7.jpg">-->
            <!--<div class="width96 hidden center">-->
            <!--<p class="yihang block center font12 c33">妙洁 吸水拖把卡槽型</p>-->
            <!--<p class="yihang block center font12 c33 hidden">-->
            <!--<span class="left c_33">-->
            <!--商城价:<font class="red">29.6</font>-->
            <!--<font class="font12 red">元</font>-->
            <!--</span>-->
            <!--<span class="right c_33">-->
            <!--优惠卷:<font class="red">20</font>-->
            <!--<font class="font12 red">元</font>-->
            <!--</span>-->
            <!--</p>-->
            <!--</div>-->
            <!--</a>-->
    </div>
</div>
<script src="/Public/Public/js/lazyload.js"></script>
</body>
</html>
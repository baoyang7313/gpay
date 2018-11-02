<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta content="width=device-width,initial-scale=1,mininum-scale=1.0, maximum-scale=1.0,user-scalable=no" name="viewport" id="viewport">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>用户店铺</title>
<meta name="keywords" content="">
<meta name="description" content="">
<script type="text/javascript" src="/Public/Public/js/jquery.js"></script>
<!-- <link rel="stylesheet" href="/Public/Public/css/style1.css"> -->
<link rel="stylesheet" href="/Public/Public/css/task.css">
<link rel="stylesheet" href="/Public/Public/icon1/iconfont.css">

<script type="text/javascript" src="/Public/Public/js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="/Public/Public/js/jquery.reveal.js"></script>

</head>
<body style="background-color:#f5f5f5;">
<!--店铺版式1开始-->
<!--头部固定区域（搜索条＋店铺信息）-->
<div class="dianpu_header" style="display:yes;">
  <div class="backbg">
 	 <div class="dp_topimagebg"><img src="<?php echo ($dailishang["shop_beijing"]); ?>"></div>
     <div class="dp_topblackdiv"></div>
<form action="<?php echo U('/Shop/Home/mend');?>" method="get" id="xxx">
      <div class="banner" style="background: none; margin-top:0; ">
            <a href="javascript:history.go(-1)" class="goback">
            <img src="/Public/Public/images/back2.png" alt="">
          </a>
<input type="hidden" name="sousuo" value="sousuo">
<input type="text" name="name" placeholder="输入商品名称" value="" onFocus="this.placeholder=&#39;&#39;" onBlur="this.placeholder=&#39;搜索商品&#39;">
            <div class="search" style="top:80;">
                <a href="javascript:document:xxx.submit();"><!-- <a class="btn btn-primary" href="javascript:;" id="search" url="<?php echo U('/Shop/Home/chaxun');?>"> --><img src="/Public/Public/images/icon_search1.png" /></a>
            </div>
        </div>
        </form>
        <!--店铺信息-->
        <div class="dianpu_info">
            <span><img src="<?php echo ($dailishang["shop_logo"]); ?>"></span>
            <div class="name">
                <h1><?php echo ($dailishang["shop_name"]); ?></h1>
                <em><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"></em>
                <!--<h6>销量 39238 &nbsp;｜ &nbsp;收藏 1253</h6>-->
            </div>
            <!--<a class="btn_collection">收&nbsp;藏</a>-->
        </div>
    
  </div>
</div>
    
<!--导航-->
<div class="dianpu_navigate"  style="display:none;">
	<ul>
    	<li class="nav1"><a>首页</a></li>
        <li class="nav2"><a>全部</a></li>
        <li class="nav3"><a>上新</a></li>
        <li class="nav4"><a>推荐</a></li>
    </ul>

</div>
<!--BANNER-->
<div class="ad_banner1"  style="display:yes;"><img src="<?php echo ($dailishang["shop_guanggao"]); ?>" ></div>
<!--最新商品-->
<div class="new_list"  style="display:yes;">
	<h3>
    	<span class="line_left"></span>
        <em>最新商品</em>
        <span class="line_right"></span>
    </h3>
    <?php if(!empty($newshop)): ?><ul class="list_li">
    <?php if(is_array($newshop)): foreach($newshop as $key=>$v): ?><li><a href="<?php echo U('/Shop/Home/details',array('proid'=>$v['id']));?>">
            <img src="<?php echo ($v["pic"]); ?>"> </a>
        <div>
                <p class="goods_name"><?php echo ($v["name"]); ?></p>
                <p>
                    <span class="price">¥<?php echo ($v["price"]); ?></span>
                    <span class="right_text">赠送积分：<i><?php echo ($v["count_price"]); ?></i></span>
                </p>
            </div>
     </li><?php endforeach; endif; ?>
     
    </ul>
        <?php else: ?>
            <p>暂无最新商品哦,亲</p><?php endif; ?>
</div>

<!--推荐商品-->
<div class="new_list"  style="display:yes;">
	<h3>
    	<span class="line_left"></span>
        <em>推荐商品</em>
        <span class="line_right"></span>
    </h3>
    <?php if(!empty($productList)): ?><ul class="list_li">
     <?php if(is_array($productList)): foreach($productList as $key=>$v): ?><li><a href="<?php echo U('/Shop/Home/details',array('proid'=>$v['id']));?>">
            <img src="<?php echo ($v["pic"]); ?>"></a>
            <div>
                <p class="goods_name"><?php echo ($v["name"]); ?></p>
                <p>
                    <span class="price">¥<?php echo ($v["price"]); ?></span>
                    <span class="right_text">赠送积分：<i><?php echo ($v["count_price"]); ?></i></span>
                </p>
            </div>
        </li><?php endforeach; endif; ?>
        
    </ul>
    <?php else: ?>
            <p>暂无推荐商品哦,亲</p><?php endif; ?>
            
</div>

<div class="new_list"  style="display:yes;">
    <h3>
        <span class="line_left"></span>
        <em>火热商品</em>
        <span class="line_right"></span>
    </h3>
    <?php if(!empty($hotshop)): ?><ul class="list_li">
     <?php if(is_array($hotshop)): foreach($hotshop as $key=>$v): ?><li><a href="<?php echo U('/Shop/Home/details',array('proid'=>$v['id']));?>">
            <img src="<?php echo ($v["pic"]); ?>"></a>
            <div>
                <p class="goods_name"><?php echo ($v["name"]); ?></p>
                <p>
                    <span class="price">¥<?php echo ($v["price"]); ?></span>
                    <span class="right_text">赠送积分：<i><?php echo ($v["count_price"]); ?></i></span>
                </p>
            </div>
        </li><?php endforeach; endif; ?>
        
    </ul>
        <?php else: ?>
            <p>暂无火热商品哦,亲</p><?php endif; ?>
</div>

<div class="new_list"  style="display:yes;">
    <h3>
        <span class="line_left"></span>
        <em>全部商品</em>
        <span class="line_right"></span>
    </h3>
    <?php if(!empty($shop)): ?><ul class="list_li">
     <?php if(is_array($shop)): foreach($shop as $key=>$v): ?><li><a href="<?php echo U('/Shop/Home/details',array('proid'=>$v['id']));?>">
            <img src="<?php echo ($v["pic"]); ?>"></a>
            <div>
                <p class="goods_name"><?php echo ($v["name"]); ?></p>
                <p>
                    <span class="price">¥<?php echo ($v["price"]); ?></span>
                    <span class="right_text">赠送积分：<i><?php echo ($v["count_price"]); ?></i></span>
                </p>
            </div>
        </li><?php endforeach; endif; ?>
        
    </ul>
        <?php else: ?>
            <p>暂无商品哦,亲</p><?php endif; ?>
</div>
<!--店铺版式1结束-->

<!--店铺版式2开始-->
<!--头部固定区域（搜索条＋店铺头像）版式2-->
<div class="dianpu_header dph_2" style="display:none;">
  <div class="backbg">
  	<div class="dp_topimagebg"><img src="/Public/Public/images/dianpu_topbg.jpg"></div>
    <div class="dp_topblackdiv"></div>
      <div class="banner" style="margin-top:0; ">
            <a href="javascript:history.go(-1)" class="goback">
            <img src="/Public/Public/images/back2.png" alt="">
          </a>
            <input type="text" name="user_search" placeholder="搜索本店商品" onfocus="this.placeholder=&#39;&#39;" onblur="this.placeholder=&#39;搜索商品&#39;">
            <div class="search">
            <a href="#"><img src="/Public/Public/images/icon_search1.png" alt=""></a>
            </div>
        </div>
        <!--店铺头像-->
        <div class="dianpu_info" style="z-index:9999" >
            <span class="dp_img2"><img src="/Public/Public/images/dp.png"></span>
        </div>
        
      </div>
</div>
<!--版式2的店铺信息-->
<div class="dianpu_info2" style="display:none">

	<div class="name">
        	<h1>得鲜极速旗舰店</h1>
            <em><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"></em>
            <h6>销量 39238 &nbsp;｜ &nbsp;收藏 1253</h6>
     </div>
     <a class="btn_collection">收&nbsp;藏</a>   
     <div class="dianpu_text" style="font-size:3.2vmin;"><div class="triangle-up"></div>MM最爱的化妆神器，为您打造女神之美！MM最爱的化妆神器，为您打造女神之美！</div>
</div>

<!--BANNER 版式2-->
<div class="ad_banner1 margin2" style="display:none;"><img src="/Public/Public/images/ad_banner.jpg" ></div>
<!--导航 版式2-->
<div class="dianpu_navigate navstyle2 nofixed" style="display:none">
	<ul>
    	<li ><a>综合</a></li>
        <li ><a>销量</a></li>
        <li ><a>价格</a></li>
        <li ><a>最新</a></li>
        <li ><a>筛选</a></li>
    </ul>

</div>
<!--商品 版式2-->
<div class="new_list margin3" style="display:none;">
	<ul class="list_li">
    
    	<li><a>
        	<img src="/Public/Public/images/goods1.jpg">
        <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/mall_581b001ed2999d0c0faff400_1x1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/thesaem_3d_.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/s930_2.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
      <li><a>
        	<img src="/Public/Public/images/thesaem_1__1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/thumbnail-change1235_2.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
      <li><a>
        	<img src="/Public/Public/images/mall_57a2ad63ad8c121e6b281333_1x1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/34ef160d6a4c70a6590a4a02292802e6.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
    </ul>
</div>
<!--店铺版式2结束-->

<!--店铺版式3开始-->
<!--头部固定区域（搜索条＋店铺信息）版式3-->
<div class="dianpu_header" style="display:none;">
  <div class="backbg">
  	<div class="dp_topimagebg"><img src="/Public/Public/images/dianpu_topbg.jpg"></div>
    <div class="dp_topblackdiv"></div>

      <div class="banner" style="background: none; margin-top:0 ">
            <a href="javascript:history.go(-1)" class="goback">
            <img src="/Public/Public/images/back2.png" alt="">
          </a>
            <input type="text" name="user_search" placeholder="搜索本店商品" onfocus="this.placeholder=&#39;&#39;" onblur="this.placeholder=&#39;搜索商品&#39;">
            <div class="search">
            <a href="#"><img src="/Public/Public/images/icon_search1.png" alt=""></a>
            </div>
        </div>
        <!--店铺信息-->
        <div class="dianpu_info bs3">
            <span><img src="/Public/Public/images/dp.png"></span>
            <div class="name">
                <h1>得鲜极速旗舰店</h1>
                <em><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"><img src="/Public/Public/images/icon_star.png"></em>
               
            </div>
            <a class="btn_collection">收&nbsp;藏</a>
            <span class="collection_num">12533人已收藏</span>
        </div>
    
  </div>
</div>

<!--导航 版式3-->
<div class="dianpu_navigate navstyle3" style="display:none">
	<ul>
    	<li ><a>综合</a></li>
        <li ><a>销量</a></li>
        <li ><a>价格</a></li>
        <li ><a>最新</a></li>
        <li ><a>筛选</a></li>
    </ul>

</div>
<!--商品 版式3-->
<div class="new_list addmargintop" style="display:none">
	<ul class="list_li">
    
    	<li><a>
        	<img src="/Public/Public/images/s930_2.jpg">
        <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/thesaem_3d_.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/thesaem_1__1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/thumbnail-change1235_2.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
      <li><a>
        	<img src="/Public/Public/images/mall_581b001ed2999d0c0faff400_1x1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/mall_57a2ad63ad8c121e6b281333_1x1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
      <li><a>
        	<img src="/Public/Public/images/goods1.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
        <li><a>
        	<img src="/Public/Public/images/34ef160d6a4c70a6590a4a02292802e6.jpg">
            <div>
            	<p class="goods_name">得鲜旋转式口红得鲜旋转式口红得鲜旋转式口红</p>
                <p>
                	<span class="price">¥59.00</span>
                    <span class="right_text">赠送积分：<i>0</i></span>
                </p>
            </div>
      </a></li>
    </ul>
</div>

<!--店铺版式3结束-->

<!--text-->
<div class="bottom_text">
	别拖了，没有了哦亲〜！
</div>
<!--底部固定层-->
<div class="dp_footer2" style="display:none">
	<div class="links"><span><img src="/Public/Public/images/icon_dplink.png"></span>联系商家：86-18820009988</div>
	<!--
	<a href="cpfl.html"><img src="/Public/Public/images/bot_icon1.png">商品分类</a>
    <a href="pinglun.html"><img src="/Public/Public/images/bot_icon2.png">用户评价</a>
    <a href="personal.html" class="bgcolor1"><img src="/Public/Public/images/bot_icon3.png">联系卖家</a>
    <a class="bgcolor2">收藏店铺</a>-->
</div>

</body>
</html>
<script type="text/javascript">
 	$('.optiones').click(function(){
 		$(this).toggleClass('checkeds').siblings('.optiones').removeClass('checkeds');
 	})

 </script>
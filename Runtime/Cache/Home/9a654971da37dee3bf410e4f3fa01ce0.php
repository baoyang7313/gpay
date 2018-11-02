<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("sellout")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js"></script>
    <body class="bg96 ">

        <div class="header">
            <div class="header_l">
                <a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
            </div>
            <div class="header_c"><h2><?php echo (L("sellout")); ?></h2></div>
            <div class="header_r">
                <!--<a href="javascript:void(0)" id="hide"><img src="/Public/home/wap/images/moer_icon.png" alt=""></a>-->
                <!--<div id="p1">-->
                    <!--<div class="down"></div>-->
                    <!---->
                <!--</div>-->
            </div>
        </div>

        <div class="big_width100">
            <div style="font-family: 'PingFang SC';color: red;font-size:14px;padding: 10px 3px;">
                <p style="padding: 5px 0"><?php echo (L("mru_top")); ?></p>
                <span><?php echo (L("mru_top1")); ?></span>
            </div>
            <div class="buy-p">
                <div>
                    <ul>
                        <li><a href="<?php echo U('Trading/Nofinsh');?>"><?php echo (L("wwcdd")); ?></a></li>
                        <li><a href="<?php echo U('Trading/Conpayd');?>"><?php echo (L("confirm_sk")); ?></a></li>
                        <li><a href="<?php echo U('Trading/Dofinsh');?>"><?php echo (L("ywcdd")); ?></a></li>
                        <li><a href="<?php echo U('Trading/Sellerrecords');?>"><?php echo (L("sellerrecords")); ?></a></li>
                        <li class="not"><a href="<?php echo U('Trading/Selldets');?>"><?php echo (L("salescenter")); ?></a></li>
                    </ul>
                </div>
            </div>

            <?php if(($morecars['card_number']) == ""): ?><!--未添加银行卡-->
            <div class="addCard SellAddCard">
                <a href="<?php echo U('Growth/addbank');?>">+<?php echo (L("addcard")); ?></a>
            </div>
            <?php else: ?>
            <div class="haveCard SellAddCard" style="margin-top:10%;float: left;">
                <div class="bdingcard"><a href="<?php echo U('Growth/Cardinfos');?>"><h4><?php echo (L("bdbankcard")); ?></h4>
                        <p>&#62</p></a></div>
                <div class="cardInfo">
                    <p><?php echo ($morecars['hold_name']); ?></p>
                    <p><?php echo ($morecars['banq_genre']); ?></p>
                    <p><?php echo ($morecars['card_number']); ?></p>
                    <input type="hidden" class="carnumber" value="<?php echo ($morecars['id']); ?>">
                </div>
            </div><?php endif; ?>


            <div class="pad9"></div>
            <div class="buy_aminy br-b">
                <h4><?php echo (L("qxzmrje")); ?></h4>
                <ul class="clear_wl">
                    <li class="buyChecked"><span>500</span></li>
                    <li class="buyChecked"><span>1000</span></li>
                    <li class="buyChecked"><span>3000</span></li>
                    <li class="buyChecked"><span>5000</span></li>
                    <li class="buyChecked"><span>10000</span></li>
                    <li class="buyChecked"><span>30000</span></li>
                </ul>
            </div>

            <div class="pad9"></div>
            <div class="sell_textarea br-t br-b">
                <textarea id="message" class="messge" name="message" placeholder="<?php echo (L("ms")); ?>"></textarea>
            </div>

            <div class="buttonGeoup">
                <a href="javascript:void(0);" class="not_next ljzf_but " class="not_next" id="cuanjdd"><?php echo (L("createorder")); ?></a>
            </div>

        </div>
        <!--浮动层-->
        <div class="ftc_wzsf">
            <div class="srzfmm_box">
                <div class="qsrzfmm_bt clear_wl">
                    <img src="/Public/home/wap/images/xx_03.jpg" class="tx close fl">

                    <span class="fl">请输入支付密码</span></div>
                <div class="zfmmxx_shop">

                </div>
                <ul class="mm_box">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div class="numb_box">
                <div class="xiaq_tb">
                    <img src="/Public/home/wap/images/jftc_14.jpg" height="10"></div>
                <ul class="nub_ggg">
                    <li><a href="javascript:void(0);" class="zf_num">1</a></li>
                    <li><a href="javascript:void(0);" class="zj_x zf_num">2</a></li>
                    <li><a href="javascript:void(0);" class="zf_num">3</a></li>
                    <li><a href="javascript:void(0);" class="zf_num">4</a></li>
                    <li><a href="javascript:void(0);" class="zj_x zf_num">5</a></li>
                    <li><a href="javascript:void(0);" class="zf_num">6</a></li>
                    <li><a href="javascript:void(0);" class="zf_num">7</a></li>
                    <li><a href="javascript:void(0);" class="zj_x zf_num">8</a></li>
                    <li><a href="javascript:void(0);" class="zf_num">9</a></li>
                    <li><a href="javascript:void(0);" class="zf_empty"><?php echo (L("emptya")); ?></a></li>
                    <li><a href="javascript:void(0);" class="zj_x zf_num">0</a></li>
                    <li><a href="javascript:void(0);" class="zf_del"><?php echo (L("deleteo")); ?></a></li>
                </ul>
            </div>
            <div class="hbbj"></div>
        </div>


        <script type="text/javascript">
            $(".buyChecked").on("click", function() {
                $(this).addClass("on").siblings().removeClass("on");
            })
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#hide").click(function() {
                    $("#p1").toggle(); //toggle() 方法切换元素的可见状态。 如果被选元素可见,则隐藏这些元素,如果被选元素隐藏,则显示这些元素。
                });
            });
        </script>

        <script type="text/javascript">
            $('#cuanjdd').on('click', function() {
                $("#p1").hide(); //toggle() 方法切换元素的可见状态。 如果被选元素可见,则隐藏这些元素,如果被选元素隐藏,则显示这些元素。

                var mairjie = $.trim($('.on').text()); //账号  //.trim() 去空格判断
                var exg = /^[1-9]\d*|0$/;
                if (!exg.test(mairjie)) {
                    msg_alert('请选择卖出金额~');
                    return;
                }
                //是否存在银行卡
                var carnumber = $('.carnumber').val();
                if (carnumber == '') {
                    msg_alert('请先添加银行卡~');
                    return;
                }
                $(".ftc_wzsf").show();
            });

            $(function() {
                //关闭浮动
                $(".close").click(function() {
                    $(".ftc_wzsf").hide();
                    $(".mm_box li").removeClass("mmdd");
                    $(".mm_box li").attr("data", "");
                    i = 0;
                });
                //数字显示隐藏
                $(".xiaq_tb").click(function() {
                    $(".numb_box").slideUp(50000);
                });
                $(".mm_box").click(function() {
                    $(".numb_box").slideDown(50000);
                });
                //----
                var i = 0;
                $(".nub_ggg li .zf_num").click(function() {

                    if (i < 6) {
                        $(".mm_box li").eq(i).addClass("mmdd");
                        $(".mm_box li").eq(i).attr("data", $(this).text());
                        i++
                        if (i == 6) {
                            setTimeout(function() {
                                var pwd = "";
                                $(".mm_box li").each(function() {
                                    pwd += $(this).attr("data");
                                });
                                //AJAX提交数据
                                var sellnums = $.trim($('.on').text()); //账号  //.trim() 去空格判断
                                var cardid = $('.carnumber').val();//银行卡id
                                var messge = $('.messge').val();
                                var exg = /^[1-9]\d*|0$/;
                                if (!exg.test(sellnums)) {
                                    msg_alert('请选择买入金额~');
                                    return;
                                }
                                if (cardid == '') {
                                    msg_alert('请选择银行卡');
                                    return;
                                }
                                $.ajax({
                                    url: '/Trading/SellCentr',
                                    type: 'post',
                                    data: {'sellnums': sellnums, 'pwd': pwd, 'cardid': cardid, 'messge': messge, 'isadd': 0},
                                    datatype: 'json',
                                    success: function(mes) {
                                        if (mes.status == 1) {
                                            msg_alert(mes.message);
                                            $(".ftc_wzsf").hide();
                                            $(".mm_box li").removeClass("mmdd");
                                            $(".mm_box li").attr("data", "");
                                            i = 0;
                                        } else if (mes.status == 2) {
                                            $(".ftc_wzsf").hide();
                                            $(".mm_box li").removeClass("mmdd");
                                            $(".mm_box li").attr("data", "");
                                            i = 0;
                                            layer.confirm(mes.message, {
                                                btn: ['确定匹配', '创建新订单'],
                                                title: '自动匹配结果'

                                            }, function(index) {
                                                layer.close(index);
                                                console.log('确定匹配');
                                                $.ajax({
                                                    url: '/Growth/autobay',
                                                    type: 'post',
                                                    data: {'sellnums': sellnums, 'pwd': pwd, 'cardid': cardid, 'order': mes.result.id, 'type': 0},
                                                    datatype: 'json',
                                                    success: function(mes) {
                                                        if (mes.status == 1) {
                                                            msg_alert(mes.message, mes.url);
                                                        } else {
                                                            msg_alert(mes.message);
                                                        }
                                                    }
                                                });
                                            }, function() {
                                                //创建新订单
                                                $.ajax({
                                                    url: '/Trading/SellCentr',
                                                    type: 'post',
                                                    data: {'sellnums': sellnums, 'pwd': pwd, 'cardid': cardid, 'messge': messge, 'isadd': 1},
                                                    datatype: 'json',
                                                    success: function(mes) {
                                                        msg_alert(mes.message);
                                                    }
                                                });
                                            });
                                        } else {
                                            msg_alert(mes.message);
                                            $(".mm_box li").removeClass("mmdd");
                                            $(".mm_box li").attr("data", "");
                                            i = 0;
                                        }
                                    }
                                })
                            }, 100);
                        }
                        ;
                    }
                });

                $(".nub_ggg li .zf_del").click(function() {
                    if (i > 0) {
                        i--
                        $(".mm_box li").eq(i).removeClass("mmdd");
                        $(".mm_box li").eq(i).attr("data", "");
                    }
                });

                $(".nub_ggg li .zf_empty").click(function() {
                    $(".mm_box li").removeClass("mmdd");
                    $(".mm_box li").attr("data", "");
                    i = 0;
                });

            });
        </script>

    </body>

</html>
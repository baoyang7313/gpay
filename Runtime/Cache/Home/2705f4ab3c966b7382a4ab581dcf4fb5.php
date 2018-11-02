<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("turnout")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js" ></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>

    <body class="bg96">

        <div class="header">
            <div class="header_l">
                <a href="<?php echo U('Index/turnout');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
            </div>
            <div class="header_c"><h2><?php echo (L("turnout")); ?></h2></div>
            <div class="header_r"><a href="<?php echo U('Index/bancerecord');?>"><?php echo (L("turnoutcords")); ?></a></div>
        </div>

        <div class="big_width100">
            <div class="oper_bg">

                <img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>">
                <p><span class="uname"><?php echo ($uinfo['username']); ?></span> <span>(<?php echo ($uinfo['userid']); ?>)</span></p>
                <p hidden><?php echo (L("yue")); ?>：￥<span id="shengyue"><?php echo ($uinfo['cangku_num']+0); ?></span></p>
                <input type="text" hidden value="<?php echo ($uinfo['userid']); ?>" class="zuid">
            </div>

            <div class="turnAmount">

                <h4><?php echo (L("transferamount")); ?></h4>
                <div class="chooseCurrency">
                    <div class="chooseCurrency_l">
                        <div class="pay_list_c1 on"><p><input type="radio" name="identity" value="1"  class="radioclass"></p><span>CNY(￥)</span></div>
                        <div class="pay_list_c1   "><p><input type="radio" name="identity" value="2" class="radioclass"/></p><span>USD ($) </span> </div>
                    </div>
                    <div class="chooseCurrency_r">
                        <input type="number" name="other_account" class="paynums" placeholder="0" autocomplete="off" id="oper_1" <!--onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/"-->>
                    </div>
                </div>

            </div>

            <div class="fill_sty">

                <p><?php echo (L("m4bits")); ?></p>
                <input type="text" name="other_account" class="mobilelast" maxlength="4"   placeholder="<?php echo (L("m4bits1")); ?>"  id="oper_2" onkeyup="value = value.replace(/[^\d]/g, '')" ng-pattern="/[^a-zA-Z]/">
            </div>

            <div class="buttonGeoup">
                <a href="javascript:void(0);" class="not_next ljzf_but " id="operConfirm"><?php echo (L("confirm")); echo (L("turnout")); ?></a>
            </div>

            <!--浮动层-->
            <div class="ftc_wzsf" >
                <div class="srzfmm_box">
                    <div class="qsrzfmm_bt clear_wl">
                        <img src="/Public/home/wap/images/xx_03.jpg" class="tx close fl">
                        <span class="fl">请输入支付密码</span></div>
                    <div class="zfmmxx_shop">
                        <div class="mz">向（<?php echo ($uinfo['username']); ?>）支付</div>
                        <div class="zhifu_price">￥88.88</div></div>
                    <ul class="mm_box">
                        <li></li><li></li><li></li><li></li><li></li><li></li>
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
                        <li><a href="javascript:void(0);" class="zf_empty">清空</a></li>
                        <li><a href="javascript:void(0);" class="zj_x zf_num">0</a></li>
                        <li><a href="javascript:void(0);" class="zf_del">删除</a></li>
                    </ul>
                </div>
                <div class="hbbj"></div>
            </div>
        </div>

        <script type="text/javascript">
            $(".pay_list_c1").on("click", function() {
                $(this).addClass("on").siblings().removeClass("on");
            })

        </script>

        <!--  -->
        <script type="text/javascript">
            $('#operConfirm').on('click', function() {
                var paytype = $(".pay_list_c1.on p input").val();//转账方式
                var paynums = ($('.paynums').val());//支付金额
                var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;

                var mobila = $('.mobilelast').val();//手机号码后四位
                // var txye =parseFloat($.trim($('#oper_1').val())); //要兑换的数量 1-1200
                var exg = /^(([1-9]\d*)|\d)(\.\d{1,2})?$/;
                if (!reg.test(paynums)) {
                    msg_alert('请输入正确的转账金额');
                    return;
                }

                var exg = /^\d{4}$/
                if (!exg.test(mobila)) {
                    msg_alert('请输入手机号末4位数');
                    return;
                }
                $('.zhifu_price').text('￥' + paynums);
                $(".ftc_wzsf").show();
            });


            //获取数据传值
            function Getvalue() {
                var paytype = $(".pay_list_c1.on p input").val();//转账方式
                var paynums = Number($('.paynums').val());//支付金额
                var zuid = $('.zuid').val();//转账会员id
                var mobila = $('.mobilelast').val();//手机号码后四位
                var minemoney = Number($('#shengyue').text());//当前账户余额
                var data = {'paytype': paytype, 'paynums': paynums, 'zuid': zuid, 'mobila': mobila, 'minemoney': minemoney};
                return data;
            }

            // $(function(){
            //出现浮动层
            $(".ljzf_but").click(function() {
                // $(".ftc_wzsf").hide();
            });
            //关闭浮动
            $(".close").click(function() {
                $(".ftc_wzsf").hide();
                $(".mm_box li").removeClass("mmdd");
                $(".mm_box li").attr("data", "");
                i = 0;
            });
            //数字显示隐藏
            $(".xiaq_tb").click(function() {
                $(".numb_box").slideUp(500);
            });
            $(".mm_box").click(function() {
                $(".numb_box").slideDown(500);
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

                            //ajax提交密码以及参数
                            var post_data = Getvalue();//获取上面的参数
                            
                            $.ajax({
                                url: '/Index/Changeout',
                                type: 'post',
                                data: {'post_data': post_data, 'pwd': pwd},
                                datatype: 'json',
                                success: function(mes) {
                                    if (mes.status == 1) {
                                        msg_alert(mes.message, mes.url);
                                        $(".ftc_wzsf").hide();
                                        $(".mm_box li").removeClass("mmdd");
                                        $(".mm_box li").attr("data", "");
                                        i = 0;
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
            // });
        </script>
    </body>

</html>
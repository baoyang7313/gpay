<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>众筹</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Crowdfund.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
        
    </style>
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
            <a href="<?php echo U('Record/index');?>"><?php echo (L("sharelist")); ?></a>
        </div>
    </div>
    <div class="section">
        <div class="imgBox">
            <a href="javascript:void(0)">
                <div>
                    <img src="/Public/home/wap/images/Crowdfund/01.png" class="img1" alt="">
                    <img src="/Public/home/wap/images/Crowdfund/01_1.png" class="img2" alt="">
                </div>
                <span class="clicss ftrname">预热中</span>
            </a>
            <a href="javascript:void(0)">
                <div>
                    <img src="/Public/home/wap/images/Crowdfund/02.png" class="img1" alt="" />
                    <img src="/Public/home/wap/images/Crowdfund/02_1.png" class="img2" alt="" />
                </div>
                <span class="ftrname">进行中</span>
            </a>
            <a href="javascript:void(0)">
                <div class="ftrimg">
                    <img src="/Public/home/wap/images/Crowdfund/03.png" alt="" class="img1">
                    <img src="/Public/home/wap/images/Crowdfund/03.png" alt="" class="img2">
                </div>
                <span class="ftrname">已结束</span>
            </a>
        </div>
        <ul class="mainBox fd_c">
            <li class="fd_r txt_91 h_20 bg_f mb_05">
                <div class="main_l fd_c h_18">
                    <div class="fd_c_b h_9">
                        <img src="/Public/home/wap/images/Crowdfund/07.png" alt="">
                        <span class="fd fs_14 bd">BGP数字货币</span>
                    </div>
                    <div class="fd_c_b  h_6">
                        <h1 class="fs_16 txt_91 bd">购买数量</h1>
                        <input type="text" placeholder="100" class="boder_r05  input_b h_3" />
                    </div>
                </div>
                <div class="main_r fd_c_b h_18">
                    <p class="txt_91 fs_16 bd">已众筹：
                        <span>100000</span>
                    </p>
                    <progress value="10" max="100" class="w1 dj_02"></progress>
                    <div class="fs_12 fd_r_b txt_200 w1">
                        <span>7月26日</span>
                        <span>100%</span>
                    </div>
                    <ul class="mianL_z fd_c fs_16 txt_89 w1">
                        <li class="fd_r w1">
                            <span>单价:&nbsp;</span>
                            <span>0.2/个</span>
                        </li>
                        <li class="fd_r w1">
                            <span>众筹:&nbsp;</span>
                            <span>10.000</span>
                        </li>
                        <li class="fd_r w1">
                            <span>币种:&nbsp;</span>
                            <span>BGP</span>
                        </li>
                        <li class="fd_r w1 txtColor fs_12">
                            <span>备注:&nbsp;</span>
                            <span>每个ID限购1000枚</span>
                        </li>
                    </ul>
                    <button class="fs_16 txt_f btn_bg w_13">立即购买</button>
                </div>
            </li>
            <li class="fd_r_a txt_91 h_20 bg_f mb_05">
                <div class="main_l fd_c h_18">
                    <div class="fd_c_b h_9">
                        <img src="/Public/home/wap/images/Crowdfund/07.png" alt="">
                        <span class="fd fs_14 bd">BGP数字货币</span>
                    </div>
                    <div class="fd_c_b  h_6">
                        <h1 class="fs_16 txt_91 bd">购买数量</h1>
                        <input type="text" placeholder="100" class="boder_r05  input_b h_3" />
                    </div>
                </div>
                <div class="main_r fd_c_b h_18">
                    <p class="txt_91 fs_16 bd">已众筹：
                        <span>100000</span>
                    </p>
                    <progress value="10" max="100" class="w1 dj_02"></progress>
                    <div class="fs_12 fd_r_b txt_200 w1">
                        <span>7月26日</span>
                        <span>100%</span>
                    </div>
                    <ul class="mianL_z fd_c fs_16 txt_89 w1">
                        <li class="fd_r w1">
                            <span>单价:&nbsp;</span>
                            <span>0.2/个</span>
                        </li>
                        <li class="fd_r w1">
                            <span>众筹:&nbsp;</span>
                            <span>10.000</span>
                        </li>
                        <li class="fd_r w1">
                            <span>币种:&nbsp;</span>
                            <span>BGP</span>
                        </li>
                        <li class="fd_r w1 txtColor fs_12">
                            <span>备注:&nbsp;</span>
                            <span>每个ID限购1000枚</span>
                        </li>
                    </ul>
                    <button class="fs_16 txt_f btn_bg w_13">立即购买</button>
                </div>
            </li>


            <!-- <li>
                <div class="main">
                    <div>
                        <img src="/Public/home/wap/images/Crowdfund/bg.png" alt="">
                    </div>
                    <div>
                        <div>
                            <h2 style="color:#000; font-weight: bold;">数字资产</h2>
                        </div>
                        <ul class="mainRt">
                            <li>详情：&nbsp;
                                <span>每个ID限购1000枚</span>
                            </li>
                            <li>接收币种：&nbsp;
                                <span>余额</span>
                            </li>
                            <li>释放比列：&nbsp;
                                <span>100.00%</span>
                            </li>
                            <li>时间：&nbsp;
                                <span>2018.7.26</span>
                            </li>
                            <li>
                                <form action="" method="get">
                                    <div>
                                        <span>可购买数量：</span>
                                        <input type="text" id="" placeholder="100" />
                                    </div>
                                    <div>
                                        <input type="submit" value="立即购买" />
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </li> -->
        </ul>
    </div>
    <script>
        $(function () {
            $('.imgBox>a').eq(0).find('.img1').css('display', 'none');
            $('.imgBox>a').eq(0).find('.img2').css('display', 'block');

        });
        $('.imgBox>a').click(function (e) {
            e.preventDefault();
            $('.img2').css('display', 'none');
            $('.img1').css('display', 'block');
            $('.ftrname').removeClass('clicss');
            $(this).find('.img1').css('display', 'none');
            $(this).find('.img2').css('display', 'block');
            $(this).children('span').addClass('clicss');
        })
    </script>
</body>

</html>
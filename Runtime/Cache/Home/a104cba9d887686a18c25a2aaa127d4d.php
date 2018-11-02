<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>买入</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Buy.css">
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
    <div class="container">
        <div class="tabBox">
            <a href="javascript:void(0)" data-buy='1'>
                <div class="underline">买入</div>
            </a>
            <a href="javascript" data-buy='2'>
                <div>卖出</div>
            </a>
            <a href="javascript:void(0)" data-buy='3'>
                <div>
                    当前委托
                </div>
            </a>
            <a href="javascript:void(0)" data-buy='4'>
                <div>历史委托</div>
            </a>
        </div>
        <div class="content">
            <div class="content_head txt_b fd_r_a fs_16">
                <div class="txt_r">当前价：
                    <span>￥1545</span>
                </div>
                <div>
                    <ul class="fd_r_a txt_b w_13">
                        <li>买</li>
                        <li>数量</li>
                        <li>价格</li>
                    </ul>
                </div>
            </div>
            <div class="content_body fd_r_a">
                <div class="buyL">
                    <ul class="fd_c_b txt_49">
                        <li>
                            <input type="text" class="num" placeholder="委托价格">
                        </li>
                        <li>
                            <input type="text" class="price" placeholder="委托数量">
                        </li>
                        <li>
                            <input type="text" readonly class="jg" placeholder="价格">
                        </li>
                        <li class="buy_l">
                            <button class="btnGreen" id="btn_1" _>买入GPC</button>
                        </li>
                        <li>
                            <input type="text" placeholder="可用CNY">
                        </li>
                        <li>
                            <input type="text" placeholder="可买GPC">
                        </li>
                    </ul>
                </div>
                <div class="buyR fd_c">
                    <ul class="fd_c">
                        <li class="fd_r_a txtGreen fs_12">
                            <div>买10</div>
                            <div>13213</div>
                            <div>2133155</div>
                        </li>
                        <li class="fd_r_a txtGreen fs_12">
                            <div>买10</div>
                            <div>13213</div>
                            <div>2133155</div>
                        </li>
                        <li class="fd_r_a txtGreen fs_12">
                            <div>买10</div>
                            <div>13213</div>
                            <div>2133155</div>
                        </li>
                        <li class="fd_r_a txtGreen fs_12">
                            <div>买10</div>
                            <div>13213</div>
                            <div>2133155</div>
                        </li>
                    </ul>
                    <hr class="w1 fgx" />
                    <ul class="fd_c">
                        <li class="fd_r_a fs_18 txt_b">
                            <div>卖</div>
                            <div>数量</div>
                            <div>价格</div>
                        </li>
                        <li class="fd_r_a txtGreen fs_12 txt_12">
                            <div>卖5</div>
                            <div>453245</div>
                            <div>4532453</div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script>
        $('.price').blur(function () {
            var num = $('.num').val();
            var price = $('.price').val();
            $('.jg').val(num*price);
        });
        $('.tabBox>a').click(function (e) {
            e.preventDefault();
            $('.tabBox>a').find('div').removeClass('underline');
            $(this).find('div').addClass('underline');
            var num = $(this).data().buy;
            // console.log(num.buy);
            switch (num) {
                case 1:
                    $('#btn_1').removeClass().addClass('btnGreen fs_18').text('买入GPC');
                    $('.jg').val('');
                    break;
                case 2:
                    $('#btn_1').removeClass().addClass('bgRed fs_16').text('卖出GPC');
                    $('.jg').val('');
                    break;
                case 3:
                    $('#btn_1').removeClass().addClass('btnGreen fs_12').text('当前委托');
                    $('.jg').val('');
                    break;
                case 4:
                    $('#btn_1').removeClass().addClass('bgRed fs_16').text('历史委托');
                    $('.jg').val('');
                    break;
            }
        })
    </script>
</body>

</html>
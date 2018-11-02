<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sell</title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Sell.css">
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
            <a href="<?php echo U('Buy/index');?>">
                <div>买入</div>
            </a>
            <a href=""  class="underline">
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
        <div class="content">
            <div class="contentTop">
                <div class="contentLf">
                    <ul>
                        <li>
                            <div>GPC当前价（￥）：
                                <span>15.51320</span>
                            </div>
                        </li>
                        <li>
                            <input type="text" placeholder="委托价格">
                        </li>
                        <li>
                            <input type="text" placeholder="委托数量">
                        </li>
                        <li>
                            <input type="text" placeholder="交易额">
                        </li>
                        <li>
                            <button>买入GPC</button>
                        </li>
                    </ul>
                </div>
                <div class="contentRt" style="margin-top: 1.5rem;">
                    <div class="contentRt-box">
                        <div>买</div>
                        <div>数量</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>12</span>
                        </div>
                        <div>54324</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>10</span>
                        </div>
                        <div>4523</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>22</span>
                        </div>
                        <div>4250420</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>56</span>
                        </div>
                        <div>453243</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>11</span>
                        </div>
                        <div>45324</div>
                        <div>价格</div>
                    </div>
                    <div class="hidden">
                        =45462
                    </div>
                </div>
            </div>
            <div class="contentBottom">
                <div class="contentBottom-Lf">
                    <div>
                        <span>可用CNY</span>
                        <span>0</span>
                    </div>
                    <div>
                        <span>可用的GPC</span>
                        <span>0</span>
                    </div>
                    <div>
                        <span>可用的CNY</span>
                        <span>2</span>
                    </div>
                </div>
                <div class="contentBottom-Rt">
                    <div class="contentRt-box txtDenger">
                        <div>买</div>
                        <div>数量</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>12</span>
                        </div>
                        <div>54324</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>10</span>
                        </div>
                        <div>4523</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>22</span>
                        </div>
                        <div>4250420</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>56</span>
                        </div>
                        <div>453243</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>11</span>
                        </div>
                        <div>45324</div>
                        <div>价格</div>
                    </div>
                    <div class="contentRt-box">
                        <div>买
                            <span>11</span>
                        </div>
                        <div>45324</div>
                        <div>价格</div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
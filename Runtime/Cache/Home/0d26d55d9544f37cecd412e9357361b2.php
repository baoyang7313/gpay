<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>卖出记录</title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/iscroll.js"></script>

<body class="bg96">

<div class="header">
    <div class="header_l">
        <a href="<?php echo U('Trading/SellCentr');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
    </div>
    <div class="header_c"><h2>卖出记录</h2></div>
    <div class="header_r"></div>
</div>


<div class=" ">

    <div class="yugejil">
        <p>买入账号</p>
        <p>卖出金额</p>
        <p>卖出时间</p>
    </div>

    <div id="wrapper">
        <div class="scroller">
            <ul>
                <?php if(is_array($Chan_info)): foreach($Chan_info as $key=>$v): ?><li>
                        <p><?php echo ($v['payout_id']); ?>(<?php echo ($v['username']); ?>)</p>
                        <p><?php echo ($v['pay_nums']); ?></p>
                        <p class="p24"><?php echo ($v['get_timeymd']); ?></br><?php echo ($v['get_timedate']); ?></p>
                    </li><?php endforeach; endif; ?>
            </ul>
            <!--<?php if(!empty($page)): ?>-->
            <!--<ul class="pagination"><?php echo ($page); ?></ul>-->
            <!--<?php endif; ?>-->
            <input type="hidden" value="1" class="pagen">
            <input type="hidden" value="0" class="isover">
            <div class="more"><i class="pull_icon"></i><span>上拉加载...</span></div>
        </div>
    </div>

</div>

<script>
    var myscroll = new iScroll("wrapper", {
        onScrollMove: function () {
            if (this.y < (this.maxScrollY)) {
                $('.pull_icon').addClass('flip');
                $('.pull_icon').removeClass('loading');
            } else {
                $('.pull_icon').removeClass('flip loading');
                $('.more span').text('上拉加载...')
            }
        },
        onScrollEnd: function () {
            if ($('.pull_icon').hasClass('flip')) {
                $('.pull_icon').addClass('loading');
                $('.more span').text('加载中...');
                //加载P+1
                var pagen = Number($('.pagen').val());
                $('.pagen').val(pagen + 1);
                $('.more span').text('释放加载...');
                pullUpAction();
            }
        },
        onRefresh: function () {
            $('.more').removeClass('flip');
            $('.more span').text('上拉加载...');
        }
    });

    function pullUpAction() {
        var p = Number($('.pagen').val());
        var isover = $('.isover').val();
        if(isover == 1){
            return;
        }
        setTimeout(function () {
            //是否已经没有数据了
            $.ajax({
                url: '/Index/Outrecords',
                type: 'get',
                dataType: 'json',
                data: {'p': p},
                success: function (data) {
                    var str = '';
                    if (data.status == 1) {
                        $.each(data.message, function (key, val) {

                            str += '<li>';
                            if (val.trtype == 1) {
                                str += '<p> 转入 </p>';
                                str += '<p>-' +val.get_nums+ '</p>';

                            } else {
                                str += '<p> 转出 </p>';
                                str += '<p>+' +val.get_nums+ '</p>';
                            }
                            str += '<p class="p24">' +val.get_timeymd+ '</br>' +val.get_timedate+ '</p>';
                            str += '</li>';
                        })
                        $('.scroller ul').append(str);
                        myscroll.refresh();
                    }else{
                        var isover = $('.isover').val();
                        if(isover == 0) {
                            $('.isover').val(1);
                            str += '<div class="annalWa">';
                            str += '<p>暂无更多记录</p></div>';
                        }
                        $('.scroller ul').append(str);
                    }

                },
                error: function () {
                    console.log('error');
                },
            })
        }, 1000)
    }

    if ($('.scroller').height() < $('#wrapper').height()) {
        $('.more').hide();
        myscroll.destroy();
    }
</script>
</body>

</html>
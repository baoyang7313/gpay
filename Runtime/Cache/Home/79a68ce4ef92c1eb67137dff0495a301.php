<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("integralrecord")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script src="/Public/home/wap/js/iscroll.js"></script>

    <body class="bg96">

        <div class="header">
            <div class="header_l">
                <a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
            </div>
            <div class="header_c"><h2><?php echo (L("integralrecord")); ?></h2></div>
            <div class="header_r"></div>
        </div>


        <div class=" ">
            <div class="yugejil">
                <p><?php echo (L("businesstype")); ?></p>
                <p><?php echo (L("amount")); ?></p>
                <p><?php echo (L("time")); ?></p>
            </div>

            <div id="wrapper">
                <div class="scroller">
                    <ul>
                        <?php if(is_array($Chan_info)): foreach($Chan_info as $key=>$v): ?><li>
                                <?php if(($v['get_type']) == "3"): ?><p><?php echo (L("circulationreward")); ?></p>
                                <?php else: ?>
                                    <?php if(($v['get_type']) == "4"): ?><p><?php echo (L("vipreward")); ?></p>
                                    <?php else: ?>
                                        <?php if(($v['get_nums']) > "0"): ?><p><?php echo (L("turnin")); ?></p>
                                        <?php else: ?>
                                            <p><?php echo (L("balancerelease")); ?></p><?php endif; endif; endif; ?>
                                <p><?php echo ($v['get_nums']); ?></p>
                                <p class="p24"><?php echo ($v['get_timeymd']); ?></br><?php echo ($v['get_timedate']); ?></p>                                         
                            </li><?php endforeach; endif; ?>
                    </ul>
                    <!--<?php if(!empty($page)): ?>-->
                    <!--<ul class="pagination"><?php echo ($page); ?></ul>-->
                    <!--<?php endif; ?>-->
                    <input type="hidden" value="1" class="pagen">
                    <input type="hidden" value="0" class="isover">
                    <div class="more"><i class="pull_icon"></i><span><?php echo (L("pulluploading")); ?>...</span></div>
                </div>
            </div>

        </div>

        <script>
            var myscroll = new iScroll("wrapper", {
                onScrollMove: function() {
                    if (this.y < (this.maxScrollY)) {
                        $('.pull_icon').addClass('flip');
                        $('.pull_icon').removeClass('loading');
                    } else {
                        $('.pull_icon').removeClass('flip loading');
                        $('.more span').text('<?php echo (L("pulluploading")); ?>...')
                    }
                },
                onScrollEnd: function() {
                    if ($('.pull_icon').hasClass('flip')) {
                        $('.pull_icon').addClass('loading');
                        $('.more span').text('<?php echo (L("loading")); ?>...');
                        //加载P+1
                        var pagen = Number($('.pagen').val());
                        $('.pagen').val(pagen + 1);
                        $('.more span').text('<?php echo (L("releaseloading")); ?>...');
                        pullUpAction();
                    }
                },
                onRefresh: function() {
                    $('.more').removeClass('flip');
                    $('.more span').text('<?php echo (L("pulluploading")); ?>...');
                }
            });

            function pullUpAction() {
                var p = Number($('.pagen').val());
                var isover = $('.isover').val();
                if (isover == 1) {
                    return;
                }
                setTimeout(function() {
                    //是否已经没有数据了
                    $.ajax({
                        url: '/Index/Outrecords',
                        type: 'get',
                        dataType: 'json',
                        data: {'p': p},
                        success: function(data) {
                            var str = '';
                            if (data.status == 1) {
                                $.each(data.message, function(key, val) {
                                    str += '<li>';
                                    str += '<p >' + v.now_nums + '</p>';
                                    str += '<p >' + v.get_nums + '</p>';
                                    str += '<p class="p24">' + val.get_timeymd + '</br>' + val.get_timedate + '</p>';
                                    str += '</li>';
                                })
                                $('.scroller ul').append(str);
                                myscroll.refresh();
                            } else {
                                var isover = $('.isover').val();
                                if (isover == 0) {
                                    $('.isover').val(1);
                                    str += '<div class="annalWa">';
                                    str += '<p><?php echo (L("norecords")); ?></p></div>';
                                }
                                $('.scroller ul').append(str);
                            }

                        },
                        error: function() {
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
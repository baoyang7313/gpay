<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("Setup")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
    <link rel="stylesheet" href="/Public/home/wap/css/reset.css">
    <link rel="stylesheet" href="/Public/home/wap/css/uploads.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
    <script type="text/javascript" src="/Public/home/common/js/index.js" ></script>
    <script type="text/javascript" src="/Public/home/wap/js/upload.js"></script>
    <body class="bg96">
        <style>
            #duoynone{
                /*display: none;*/
            }
            #myModal{
                visibility: visible;
                overflow: visible;
            }
            
            

        </style>
        <!--<div class="header">-->
            <!--<div class="header_l">-->
                <!--<a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>-->
            <!--</div>-->
            <!--<div class="header_c"><h2><?php echo (L("Setup")); ?></h2></div>-->
            <!--<div class="header_r"></div>-->
        <!--</div>-->
        <div class="big_width100">

            <div class="shezhi">

                <div class="sett_toux clear_wl">
                    <!--   <div class="upload">
                          <div id="preview" style="border:none;">
                                          <form id='myupload' action="<?php echo U('User/Imgup');?>" method='post' enctype='multipart/form-data'>
                                                  <input type="file" id="uploadphoto" name="uploadfile" value="请点击上传图片"  style="display:none;" />
                                          </form>
                                          <img id="imghead" width=100% height=auto border=0 src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>">

                                          <div class="imglist" style="color:red"> </div>
                                          <p class="res"></p>
                                          <div class="progress">
                                                  <div class="progress-bar progress-bar-striped" ><span class="percent">50%</span></div>
                                          </div>
                          </div>
                          </div>-->

                    <!--新的更换头像SSSS-->
                    <section class="logo-license">
                        <div class="half">
                            <a class="logo" id="logox">
                                <img id="bgl" src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>"/>
                                <!--<p><?php echo (L("imghead")); ?></p>-->
                            </a>
                            <div class="bg2">
                                <img src="/Public/home/wap/images/jiantt.png" id="bg2">
                            </div>
                        </div>
                    </section>

                    <!--新的更换头像EEEE-->
                    <div class="sett_uid_xy">
                        <p><strong>UID:<?php echo ($uinfo['userid']); ?></strong></p>
                        <p><?php echo (L("reput")); ?>
                        <?php $__FOR_START_10221__=0;$__FOR_END_10221__=$uinfo['user_credit'];for($i=$__FOR_START_10221__;$i < $__FOR_END_10221__;$i+=1){ ?><span><img src="/Public/home/wap/images/aix-icon.png"></span><?php } ?>
                        </p>
                    </div>
                </div>


                <article class="htmleaf-container">
                    <div id="clipArea"></div>
                    <div class="foot-use">
                        <div class="uploader1 blue">
                            <input type="button" name="file" class="button" value="打开"/>

                            <form id='myupload' action="<?php echo U('User/Imgup');?>" method='post' enctype='multipart/form-data'>
                                <input id="file" type="file"  name="uploadfile" onchange="javascript:setImagePreview();" accept="image/*" multiple  />
                                <!--<input type="file" id="uploadphoto" name="uploadfile" value="请点击上传图片"  style="display:none;" />-->
                            </form>
                        </div>
                        <!--<a id="cancel" href="<?php echo U('User/Personal');?>">返回</a>-->
                        <button id="clipBtn">截取</button>
                    </div>
                    <div id="view"></div>
                </article>
                <div class="sz-content" style="background-color: #222127;">
                <div class="sett_xiug mt10" id="phone_uid">
                    <a href="<?php echo U('User/setuname');?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett9-icon.png">
                            <p><?php echo (L("nickname")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">
                            <img src="/Public/home/wap/images/jiantt.png">
                            <p><?php echo ($uinfo['username']); ?></p>
                        </div>
                    </a>
                </div>


                <div class="sett_xiug ">
                    <a  class="clear_wl" id="duoyhide">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett15-icon.png">
                            <p><?php echo (L("multilingual")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">
                            <img src="/Public/home/wap/images/jiantt.png">
                            <p><?php if(($lantype) == "1"): ?>中文<?php else: ?>English<?php endif; ?></p>
                        </div>
                    </a>

                </div>

                <div class="sett_xiug mt10 ">
                    <a href="<?php echo U('Growth/cardinfos');?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett10-icon.png">
                            <p><?php echo (L("bankcard")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">

                            <img src="/Public/home/wap/images/jiantt.png">
                            <p></p>
                        </div>
                    </a>
                </div>

                <div class="sett_xiug mt10 ">
                    <a href="<?php echo U('User/Sharecode');?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/settfx-icon.png">
                            <p><?php echo (L("share")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">

                            <img src="/Public/home/wap/images/jiantt.png">
                            <p></p>
                        </div>
                    </a>
                </div>

                <div class="sett_xiug mt10 ">
                    <a href="<?php echo U('User/Setpwd',array('type'=>1));?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett12-icon.png">
                            <p><?php echo (L("loginpwd")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">
                            <img src="/Public/home/wap/images/jiantt.png">
                            <p><?php echo (L("csave")); ?></p>
                        </div>
                    </a>
                </div>

                <div class="sett_xiug ">
                    <a href="<?php echo U('User/Setpwd',array('type'=>2));?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett13-icon.png">
                            <p><?php echo (L("paypwd")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">
                            <img src="/Public/home/wap/images/jiantt.png">
                            <p><?php echo (L("csave")); ?></p>
                        </div>
                    </a>

                </div>

                <div class="sett_xiug mt10 ">
                    <a href="<?php echo U('User/News');?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett14-icon.png">
                            <p><?php echo (L("notice")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">

                            <img src="/Public/home/wap/images/jiantt.png">
                            <p><img src="/Public/home/wap/images/yuand.png"></p>
                        </div>
                    </a>

                </div>

                <!--<div class="sett_xiug  ">-->
                <!--<a href="<?php echo U('User/News');?>" class="clear_wl">-->
                <!--<div class="sett_x_l clear_wl">-->
                <!--<img src="/Public/home/wap/images/sett1-icon.png">-->
                <!--<p>个人消息</p>-->
                <!--</div>-->
                <!--<div class="sett_x_r clear_wl">-->
                <!---->
                <!--<img src="/Public/home/wap/images/jiantt.png">-->
                <!--<p></p>-->
                <!--</div>-->
                <!--</a>-->
                <!--</div>-->


                <!--<div class="sett_xiug mt10 " >-->
                    <!--<a href="<?php echo U('Shop/dianpu/index',array('did'=>$uid));?>" class="clear_wl" id="cuanjdd2" >-->
                        <!--<div class="sett_x_l clear_wl">-->
                            <!--<img src="/Public/home/wap/images/sett2-icon.png">-->
                            <!--<p id="tjyhk"><?php echo (L("mineshops")); ?></p>-->
                        <!--</div>-->
                        <!--<div class="sett_x_r clear_wl">-->

                            <!--<img src="/Public/home/wap/images/jiantt.png">-->
                            <!--<p></p>-->
                        <!--</div>-->
                    <!--</a>-->
                <!--</div>-->

                <!--<div class="sett_xiug" >-->
                    <!--<a href="<?php echo U('Shop/Member/allorder');?>" class="clear_wl" id="cuanjdd1" >-->
                        <!--<div class="sett_x_l clear_wl">-->
                            <!--<img src="/Public/home/wap/images/sett3-icon.png">-->
                            <!--<p id="tjyhk"><?php echo (L("myoder")); ?></p>-->
                        <!--</div>-->
                        <!--<div class="sett_x_r clear_wl">-->

                            <!--<img src="/Public/home/wap/images/jiantt.png">-->
                            <!--<p></p>-->
                        <!--</div>-->
                    <!--</a>-->
                <!--</div>-->

                <!--<div class="sett_xiug ">-->
                    <!--<a href="<?php echo U('Shop/member/addresslist');?>" class="clear"  id="cuanjdd">-->
                        <!--<div class="sett_x_l clear_wl">-->
                            <!--<img src="/Public/home/wap/images/sett4-icon.png">-->
                            <!--<p id="tjyhk"><?php echo (L("address")); ?></p>-->
                        <!--</div>-->
                        <!--<div class="sett_x_r clear_wl">-->

                            <!--<img src="/Public/home/wap/images/jiantt.png">-->
                            <!--<p></p>-->
                        <!--</div>-->
                    <!--</a>-->
                <!--</div>-->

                <div class="sett_xiug  mt10">
                    <a href="<?php echo U('User/Complaint');?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett5-icon.png">
                            <p><?php echo (L("complins")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">

                            <img src="/Public/home/wap/images/jiantt.png">
                            <p></p>
                        </div>
                    </a>
                </div>

                <!--<div class="sett_xiug ">-->
                <!--<a href="<?php echo U('User/test');?>" class="clear_wl">-->
                <!--<div class="sett_x_l clear_wl">-->
                <!--<img src="/Public/home/wap/images/sett6-icon.png">-->
                <!--<p>分享</p>-->
                <!--</div>-->
                <!--<div class="sett_x_r clear_wl">-->
                <!---->
                <!--<img src="/Public/home/wap/images/jiantt.png">-->
                <!--<p></p>-->
                <!--</div>-->
                <!--</a>-->
                <!--</div>-->

                <div class="sett_xiug ">
                    <a href="#" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett16-icon.png">
                            <p><?php echo (L("edition")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">

                            <img src="/Public/home/wap/images/jiantt.png">
                            <p>1.0.0</p>
                        </div>
                    </a>

                </div>

                <div class="sett_xiug ">
                    <a href="<?php echo U('User/Aboutus');?>" class="clear_wl">
                        <div class="sett_x_l clear_wl">
                            <img src="/Public/home/wap/images/sett7-icon.png">
                            <p><?php echo (L("about")); ?></p>
                        </div>
                        <div class="sett_x_r clear_wl">

                            <img src="/Public/home/wap/images/jiantt.png">
                            <p></p>
                        </div>
                    </a>
                </div>

                <div class="sett_tuic">
                    <a href="<?php echo U('User/Loginout');?>" class="user_out"><p><?php echo (L("loginout")); ?></p></a>
                </div>
            </div>
                <div style="width: 100%;heihgt:100px !important;float:left;"></div>
        </div>
        </div>
        <!---->
<style>
    .ftr{
        width: 100%;
        height: auto;
        margin: auto;
        z-index: 99;
        background: #191B1F;
        position: fixed;
        bottom: 0;
    }
    .ftr>ul{
        display: block;
        width: 100%;
        height: auto;
        float: left;
        font-size: 0;
    }
    .ftr>ul>li {
        display: inline-block;
        vert-align: top;
        width: 25%;
        height: auto;
    }
    .ftr>ul>li>a{
        display: block;
        width: 100%;
        height: auto;
        float: left;
        padding: 9px 0;
        box-sizing: border-box;
    }
    .ftr>ul>li>a>div{
        width: 100%;
        height: auto;
        float: left;
    }
    .ftrname{
        text-align: center;
        font-size: 15px;
        color: #fff;
        margin-top: 9px;
    }
    .ftrimg{
        display: table;
        height: 29px;
        margin: auto;
        color: #fff;
    }
    .houimg{
        margin: auto;
        display: none;
        width: auto;
        height: 25px;
    }
    .qianimg{
        display: table;
        width: auto;
        height: 25px;
        margin: auto;
    }
    .xian{
        display: block;
    }
    .yin{
        display: none;
    }
    .clicss{
        color: #0EA1EA;
    }
    .Navbgcolor{
        background: blue;
    }

</style>
<script>
        $(function () {
            hdr();
        })
    
        function  hdr() {
            hdrcli=function (e) {
                var qianimg=$(".qianimg").eq(e);
                var houimg=$(".houimg").eq(e);
                var ftrli=$(".ftrli").eq(e);
                var ftrname = $(".ftrname").eq(e);
                houimg.addClass("xian");
                qianimg.addClass("yin");
                ftrname.addClass("clicss");
                ftrli.siblings().children("a").children(".ftrimg").children(".qianimg").removeClass("xian");
                ftrli.siblings().children("a").children(".ftrimg").children(".houimg").removeClass("yin");
                ftrli.siblings().children("a").children(".ftrname").removeClass("clicss");
            }
        }
    </script>
        <footer class="ftr">
            <!--底部tab切换栏-->
            <ul class="bottom" id="bottom">
                <li onclick="hdrcli(0)" class="ftrli">
                    <a href="<?php echo U('Index/index');?>">
                        <div class="ftrimg">
                            <img class="qianimg " src="/Public/home/wap/images/首页.png">
                            <img class="houimg " src="/Public/home/wap/images/首页1.png">
                        </div>
                        <div class="ftrname "><?php echo (L("bottom_home")); ?></div>
                    </a>
                </li>
                <li onclick="hdrcli(1)" class="ftrli" >
                    <a href="<?php echo U('Quotation/index');?>">
                        <div class="ftrimg">
                            <img class="qianimg " src="/Public/home/wap/images/行情.png">
                            <img class="houimg  " src="/Public/home/wap/images/行情1.png">
                        </div>
                        <div class="ftrname"><?php echo (L("bottom_hangqing")); ?></div>
                    </a>
                </li>
                <li onclick="hdrcli(2)" class="ftrli" id="G_tip">
                    <a>
                        <div class="ftrimg">
                            <img class="qianimg" src="/Public/home/wap/images/G圈.png">
                            <img class="houimg" src="/Public/home/wap/images/G圈1.png">
                        </div>
                        <div class="ftrname"><?php echo (L("bottom_G")); ?></div>
                    </a>
                </li>
                </li>
                <li onclick="hdrcli(3)" class="ftrli">
                    <a href="<?php echo U('User/Personal');?>">
                        <div class="ftrimg">
                            <img class="qianimg yin" src="/Public/home/wap/images/我.png">
                            <img class="houimg xian" src="/Public/home/wap/images/我1.png">
                        </div>
                        <div class="ftrname clicss"><?php echo (L("bottom_my")); ?></div>
                    </a>
                </li>
            </ul>
        </footer>
        <div id="duoynone" style="display: none;">
            <div id="myModal" class="reveal-modal">
                <h1>多语言</h1>
                <div class="dyyyinwzwen">
                    <div <?php if(($lantype) == "1"): ?>class="dyyyinw ona"<?php else: ?>class="dyyyinw"<?php endif; ?>><span>简体中文</span><p><input type="radio" name="identity" value="1"  class="radioclass"></p></div>
                    <div <?php if(($lantype) == "2"): ?>class="dyyyinw ona"<?php else: ?>class="dyyyinw"<?php endif; ?>><span>English</span> <p><input type="radio" name="identity" value="2" class="radioclass"/></p></div>
                </div>
                <div class="duoyyquedqux">
                    <a href="javascript:void(0)" class="close-reveal-modal"  id="duoyhidea">取消</a>
                    <a href="javascript:void(0)" class="cheklan">确定</a>
                    <p></p>
                </div>
            </div>
        </div>


        <script type="text/javascript">
        

            $(document).ready(function() {
                $("#duoyhide").click(function() {

                    $("#duoynone").toggle(); //toggle() 方法切换元素的可见状态。 如果被选元素可见,则隐藏这些元素,如果被选元素隐藏,则显示这些元素。
                    
                });

            });

            $(document).ready(function() {
                $("#duoyhidea").click(function() {
                    
                    $("#duoynone").toggle(); //toggle() 方法切换元素的可见状态。 如果被选元素可见,则隐藏这些元素,如果被选元素隐藏,则显示这些元素。
                });

            });

        </script>

        <script type="text/javascript">
            $(".dyyyinw").on("click", function() {
                $(this).addClass("ona").siblings().removeClass("ona");
            })
        </script>
        <script>
            $('.modal').click(function() {
                $("#myModal").hide();
            })

            $('.cheklan').click(function() {
                var checlan = $('.ona').find(("input[name='identity']")).val();
                if (checlan == 1) {
                    window.location.href = '?l=zh-cn';
                }

                if (checlan == 2) {
                    window.location.href = '?l=en-us';
                }
            })
        </script>
    </body>
</html>

<!--头像上传新SSSSS-->
<script src="/Public/home/wap/jsa/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="/Public/home/wap/jsa/jquery-2.1.1.min.js"><\/script>')</script>
<script src="/Public/home/wap/jsa/iscroll-zoom.js"></script>
<script src="/Public/home/wap/jsa/hammer.js"></script>
<script src="/Public/home/wap/jsa/jquery.photoClip.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/jquery.form.js"></script>

<script>
            var obUrl = ''
            //document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
            $("#clipArea").photoClip({
                width: 320,
                height: 320,
                file: "#file",
                view: "#view",
                ok: "#clipBtn",
                loadStart: function() {
                    console.log("照片读取中");
                },
                loadComplete: function() {
                    console.log("照片读取完成");
                },
                clipFinish: function(dataURL) {
                    // console.log(dataURL);
                }
            });


            $(function() {
                $("#logox").click(function() {
                    $(".htmleaf-container").show();
                })
                $("#clipBtn").click(function() {
                    //数据流上传开始执行图片上传
                    $.ajax({
                        url: '/User/imgUps',
                        type: 'post',
                        data: {'dataflow': imgsource},
                        datatype: 'json',
                        success: function(data) {
                            if (data.status == 1) {
                                $("#logox").empty();
                                $('#logox').append('<img src="' + imgsource + '" align="absmiddle" style=" width:60px;height: 60px;">');
                                $(".htmleaf-container").hide();
                                msg_alert(data.message);
                            } else {
                                msg_alert(data.message);
                            }
                        }
                    })
                })
            });
</script>
<script type="text/javascript">
    $(function() {
        jQuery.divselect = function(divselectid, inputselectid) {
            var inputselect = $(inputselectid);
            $(divselectid + " small").click(function() {
                $("#divselect ul").toggle();
                $(".mask").show();
            });
            $(divselectid + " ul li a").click(function() {
                var txt = $(this).text();
                $(divselectid + " small").html(txt);
                var value = $(this).attr("selectid");
                inputselect.val(value);
                $(divselectid + " ul").hide();
                $(".mask").hide();
                $("#divselect small").css("color", "#333")
            });
        };
        $.divselect("#divselect", "#inputselect");
    });
</script>
<script type="text/javascript">
    function setImagePreview() {
        var preview, img_txt, localImag, file_head = document.getElementById("file_head"),
                picture = file_head.value;

        if (!picture.match(/.jpg|.gif|.png|.bmp/i))
            return alert("您上传的图片格式不正确，请重新选择！"),
                    !1;
        if (preview = document.getElementById("preview"), file_head.files && file_head.files[0])
            preview.style.display = "block",
                    preview.style.width = "63px",
                    preview.style.height = "63px",
                    preview.src = window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1 ? window.webkitURL.createObjectURL(file_head.files[0]) : window.URL.createObjectURL(file_head.files[0]);
        else {
            file_head.select(),
                    file_head.blur(),
                    img_txt = document.selection.createRange().text,
                    localImag = document.getElementById("localImag"),
                    localImag.style.width = "63px",
                    localImag.style.height = "63px";
            try {
                localImag.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)",
                        localImag.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = img_txt
            } catch (f) {
                return alert("您上传的图片格式不正确，请重新选择！"),
                        !1
            }
            preview.style.display = "none",
                    document.selection.empty()
        }
        return document.getElementById("DivUp").style.display = "block",
                !0
    }
</script>
<!--头像上传新EEEEE-->
</script>
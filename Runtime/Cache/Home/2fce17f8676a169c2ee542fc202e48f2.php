<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("jianyi")); ?></title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<body class="bg96 ">
	
	<div class="header">
	    <div class="header_l">
	    <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	    </div>
	    <div class="header_c"><h2><?php echo (L("jianyi")); ?></h2></div>
	    <div class="header_r"></div>
	</div>

     <div class="big_width100">
        <div class="opiniontop_d">
	        <div class="opiniontop">
			    <p><?php echo (L("jianyi_h")); ?></p>
			</div>
			<div class="opinion">
			    <textarea name="introduce" id="introducebb" rows="8" placeholder="<?php echo (L("jianyi_p")); ?>..."></textarea>
			</div>
			    <div class="container">
        <!--    照片添加    -->
        <div class="z_photo">
            <div class="z_file">
                <input type="file" name="file" id="file" value="" accept="image/*" multiple onchange="imgChange('z_photo','z_file');" />
            </div>
        </div>

        <!--遮罩层-->
        <div class="z_mask">
            <!--弹出框-->
            <div class="z_alert">
                <p>确定要删除这张图片吗？</p>
                <p>
                    <span class="z_cancel">取消</span>
                    <span class="z_sure">确定</span>
                </p>
            </div>
        </div>
    </div>
		</div>
		 <div class="buttonGeoup">
	       	<a href="javascript:void(0);"  class="not_next" id="cuanjdd"><?php echo (L("confirm")); ?></a>
        </div>
	</div>

    <script type="text/javascript">
        //px转换为rem
        (function(doc, win) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                recalc = function() {
                    var clientWidth = docEl.clientWidth;
                    if (!clientWidth) return;
                    if (clientWidth >= 640) {
                        docEl.style.fontSize = '100px';
                    } else {
                        docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
                    }
                };

            if (!doc.addEventListener) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false);
        })(document, window);

        function imgChange(obj1, obj2) {
            //获取点击的文本框
            var file = document.getElementById("file");
            //存放图片的父级元素
            var imgContainer = document.getElementsByClassName(obj1)[0];
            //获取的图片文件
            var fileList = file.files;
            //文本框的父级元素
            var input = document.getElementsByClassName(obj2)[0];
            var imgArr = [];
            //遍历获取到得图片文件
            for (var i = 0; i < fileList.length; i++) {
                var imgUrl = window.URL.createObjectURL(file.files[i]);
                imgArr.push(imgUrl);
                var img = document.createElement("img");
                img.setAttribute("src", imgArr[i]);
                var imgAdd = document.createElement("div");
                imgAdd.setAttribute("class", "z_addImg");
                imgAdd.appendChild(img);
                imgContainer.appendChild(imgAdd);
            };
            imgRemove();
        };

        function imgRemove() {
            var imgList = document.getElementsByClassName("z_addImg");
            var mask = document.getElementsByClassName("z_mask")[0];
            var cancel = document.getElementsByClassName("z_cancel")[0];
            var sure = document.getElementsByClassName("z_sure")[0];
            for (var j = 0; j < imgList.length; j++) {
                imgList[j].index = j;
                imgList[j].onclick = function() {
                    var t = this;
                    mask.style.display = "block";
                    cancel.onclick = function() {
                        mask.style.display = "none";
                    };
                    sure.onclick = function() {
                        mask.style.display = "none";
                        t.style.display = "none";
                    };

                }
            };
        };

    </script>

    <style>
        .z_alert{ color: #333;}
        .z_alert span{ color: #0da8f5; }
    </style>
</body>

</html>
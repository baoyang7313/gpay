<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0040)http://bx.0755web.cn/Shangjia/index.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0,minimal-ui">
    <title>认证中心</title>
    <link rel="stylesheet" href="/Public/Public/verify/header.css">
    <link rel="stylesheet" href="/Public/Public/verify/huiyuan.css">

    <script type="text/javascript" src="/Public/Public/verify/upload.js"></script>
    <script type="text/javascript" src="/Public/Public/verify/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/Public/Public/verify/index.js"></script>
    <script type="text/javascript" src="/Public/Public/verify/layer.js"></script>
    <link rel="stylesheet" href="/Public/Public/verify/layer.css" id="layui_layer_skinlayercss" style="">

    <script type="text/javascript" src="/Public/Public/verify/address.js"></script>
<style>
    .address {
        margin-right: 4%;
        margin-left: 4%;
    }

    .address li {
        line-height: 12vmin;
        font-size: 4.2vmin;
        background: #fff;
        border-radius: 2vmin;
        border: 1px solid #ddd;
        margin-top: 3%;
        text-indent: 1em;
    }

    .address li input {
        width: 80%;
        border: none;
    }

    .selectcc {
        width: 83%;
        border: none;
        border-bottom: 1px solid #aaa;
        font-family: "微软雅黑";
        appearance: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        padding-right: 14px;
    }

    .address li p {
        padding-left: 0;
    }

    .dzq {
        width: 76%;
        line-height: 5vmin;
        border: none;
        border-bottom: 1px solid #aaaaaa;
    }

</style></head>




<body id="huise">
<div class="fxm_header" style="background:#1b1b1b">
    <div class="fxm_left"><a href="<?php echo U('member/mine');?>"><img src="/Public/Public/verify/left.png"></a></div>
    <div class="fxm_center">认证中心</div>
    <!-- <div class="fxm_right"><img src="/Public/home/wap/images/zf.png"></div> -->
</div>
<div class="top_top"></div>

<form action="" method="post" enctype="multipart/form-data" id="msg">
    <div class="shezhi qyrz3 smrz">
        <input type="text" placeholder="姓名" name="realname" value="" class="abc">
        <input type="text" placeholder="身份证号" name="idcard" value="" class="abc">
        <input type="number" placeholder="手机号" name="phone" value="" class="abc">

        <style>
            .selectcc {
                width: 83%;
                border: none;
                border-bottom: 1px solid #aaa;
                font-family: "微软雅黑";
                /*很关键：将默认的select选择框样式清除*/
                appearance: none;
                -moz-appearance: none;
                -webkit-appearance: none;
                /*为下拉小箭头留出一点位置，避免被文字覆盖*/
                padding-right: 14px;

            }
			.renzheng_tishi{display:inline-block; width:92%; clear:both;}
			.upload{clear:both;}
			.renzheng_style{width:90%; margin-left:5%; padding-top:3vmin; padding-bottom:5vmin; clear:both;}
			.renzheng_style li{display:inline-block; float:left; font-size:3.8vmin; padding-right:4.5vmin;}
			.renzheng_style li span{display:inline-block; padding-left:1vmin;}
			.divstyle2{display:none;}

        </style>
         <script type="text/javascript">
        function test(obj) {
            if (obj.id == "Radio1") {
                document.getElementById("Div1").style.display = "block";
                document.getElementById("Div2").style.display = "none";
            }
            else {
                document.getElementById("Div1").style.display = "none";
                document.getElementById("Div2").style.display = "block";
            }
        }
    	</script>

    <ul class="renzheng_style">
<li>
    <input id="Radio1" name="type" checked="checked" value="1" type="radio" onclick="test(this)" /><span style="color: red">个人认证</span>
</li>
        <li>
            <input id="Radio2" name="type" type="radio"  value="2" onclick="test(this)" /><span style="color: red">商家认证</span></li>
    </ul>
    <div id="Div1" class="divstyle1">


        <div class="upload">
                <div id="preview2">
                    <img id="imghead2" width="100%" height="auto" border="0" src="/Public/Public/verify/y2.jpg">
                </div>
                <input type="file" onchange="previewImage2(this)" name="app_idcard_front" class="tijiao2">
                <span id="ckt"><img src="/Public/Public/verify/y01.jpg"></span>
            </div>
<div class="upload">
    <div id="preview3">
        <img id="imghead3" width="100%" height="auto" border="0" src="/Public/Public/verify/y3.jpg">
    </div>
    <input type="file" onchange="previewImage3(this)" name="app_idcard_back" class="tijiao3">
    <span id="ckt"><img src="/Public/Public/verify/y02.jpg"></span>
</div>





   </div>
    <!--商家认证-->
    <div id="Div2" class="divstyle2">
<!-- <div class="upload">
                <div id="preview2">
                    <img id="imghead2" width="100%" height="auto" border="0" src="/Public/Public/verify/y2.jpg">
                </div>
                <input type="file" onchange="previewImage2(this)" name="app_idcard_front" class="tijiao2">
                <span id="ckt"><img src="/Public/Public/verify/y01.jpg"></span>
            </div> -->


<!--             <div class="upload">
    <div id="preview3">
        <img id="imghead3" width="100%" height="auto" border="0" src="/Themes/Shop/Public/verify/y3.jpg">
    </div>
    <input type="file" onchange="previewImage3(this)" name="app_idcard_back" class="tijiao3">
    <span id="ckt"><img src="/Public/Public/verify/y02.jpg"></span>
</div>
 -->
<div class="upload">
    <div id="preview4">
        <img id="imghead4" width="100%" height="auto" border="0" src="/Public/Public/verify/y4.jpg">
    </div>
    <input type="file" onchange="previewImage4(this)" name="app_idcard_hands" class="tijiao4">
    <span id="ckt"><img src="/Public/Public/verify/y03.jpg"></span>
</div>
            <div class="upload">
                <div id="preview5">
                    <img id="imghead5" width="100%" height="auto" border="0" src="/Public/Public/verify/y1.jpg">
                </div>
                <input type="file" onchange="previewImage5(this)" name="app_blicense" class="tijiao5">
                <span id="ckt"><img src="/Public/Public/verify/y04.jpg"></span>
            </div>
    </div>


      <p class="renzheng_tishi">
      认证提交后，工作人员会再3个工作日完成审核，如有疑问，请联系客服&nbsp;
      <i style="color: #00a2ff"></i>
      </p>
  <p style="margin-top: 5%;">
  <input type="checkbox" name="vehicle" class="vehicle" value="Car" checked="checked" style="vertical-align: middle;">同意协议
  <a  onclick="look()">
  <i style="color: #f00">《Gpays商城》</i>
  </a>
  </p>
 <br/><br/>
<p id='xieyi'></p>
<!-- <input  id='xieyi' value=""> -->
    </div>
    <div class="buttones">


                <a href="javascript:void(0)" class="doSubmit">提交申请</a>    </div>
</form>
<?php
$ment=M('config')->where(array('id'=>15))->find(); ?>
<script>
function look(){
  
    var xycont = "<?php echo $ment['value'] ?>";

   /* document.getElementById('xieyi').value = xycont;*/
    var x=document.getElementById("xieyi");
    x.innerHTML = xycont;
}
</script>



<script>
    $('.doSubmit').click(function () {
        var uname = $('input[name="uname"]').val();
        var idcard = $('input[name="idcard"]').val();
        var pattern = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;

        if (uname == '') {
            msg_alert('请填写姓名');
            return;
        }
        if (!pattern.test(idcard)) {
            msg_alert('请填写正确的身份证号码');
            return;
        }
        //判断是否选中
        var ischecked = $('.vehicle').is(':checked');
            if(ischecked){
                $("#msg").submit();
            }else{
                msg_alert('请同意Gpays商城用户协议');
                return;
            }
    })
</script>

</body></html>
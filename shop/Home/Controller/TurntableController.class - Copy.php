<?php
namespace Home\ Controller;
use Think\Controller;
class TurntableController extends CommonController {
    /**
     * 直推奖励 
     */
    
 //     public function test(){

    


 // $allid = M('ucoins')->Field("sell_id,count(1) as usum")->group('c_uid')->select();

 //  foreach ($allid as $k => $v) {

 //        $datapay["djie_num"]=$v["usum"];
 //       $res_pay = M('store')->where(array('uid'=>$v["sell_id"]))->save($datapay);
 //     }

 // }
    public function Index(){

        $uid = session('userid');
        //查询当前币对应价格
        $coindets = M('coindets')->order('coin_addtime desc,cid asc')->limit(5)->select();

    
        //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid))->order('cid asc')->select();

        //我的钱包地址 没有则自动生成
        $waadd = M('user')->where(array('userid'=>$uid))->getField('wallet_add');
        if(empty($waadd) || $waadd == ''){
            $waadd = build_wallet_add();

            M('user')->where(array('userid'=>$uid))->setField('wallet_add',$waadd);
        }
        $this->assign('coindets',$coindets);
        $this->assign('minecoins',$minecoins);
        $this->assign('waadd',$waadd);
        $this->assign('uid',$uid);

        $this->display();
    }

    //转账的对象
    public function Checkuser(){
        $paynums = I('paynums','float',0);
        $getu = trim(I('moneyadd'));
        $uid = session('userid');
        $mwenums = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>1))->getField('c_nums');
        if($paynums > $mwenums){
            ajaxReturn('您当前暂无这么多Tpay币哦~',0);
        }

        $where['userid|mobile|wallet_add'] = $getu;
        $uinfo = M('user')->where($where)->Field('userid,username')->find();
        if($uinfo['userid'] == $uid){
            ajaxReturn('您不能给自己转账哦~',0);
        }

        if(empty($uinfo) || $uinfo == ''){
            ajaxReturn('您输入的转出地址有误哦~',0);
        }
        $getmsg = array('uname'=>$uinfo['username'],'getuid'=>$uinfo['userid']);
        ajaxReturn($getmsg,1);
    }

//    Tpay转入
    public function Wegetin(){
        $paynums = I('paynums','float',0);
        $getu = trim(I('moneyadd'));
        $pwd = trim(I('pwd'));
        $uid = session('userid');
        $mwenums = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>1))->getField('c_nums');
        if($paynums > $mwenums){
            ajaxReturn('您当前暂无这么多Tpay币哦~',0);
        }

        $where['userid|mobile|wallet_add'] = $getu;
        $uinfo = M('user')->where($where)->Field('userid,username')->find();
        if($uinfo['userid'] == $uid){
            ajaxReturn('您不能给自己转账哦~',0);
        }

        if(empty($uinfo) || $uinfo == ''){
            ajaxReturn('您输入的转出地址有误哦~',0);
        }

        //验证交易密码
        $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
        $user_object = D('Home/User');
        $user_info = $user_object->Trans($minepwd['account'], $pwd);

        //转入的加钱
        $issetgetu = M('ucoins')->where(array('c_uid'=>$uinfo['userid'],'cid'=>1))->count(1);
        if($issetgetu <= 0){
            $coinone['cid'] = 1;
            $coinone['c_nums'] = 0.0000;
            $coinone['c_uid'] = $uinfo['userid'];
            M('ucoins')->add($coinone);
        }
        $datapay['c_nums'] = array('exp', 'c_nums + ' . $paynums);
        $res_pay = M('ucoins')->where(array('c_uid'=>$uinfo['userid'],'cid'=>1))->save($datapay);//转出+Tpay
        //转出的扣钱
        $payout['c_nums'] = array('exp', 'c_nums - ' . $paynums);
        $res_pay = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>1))->save($payout);//转出-Tpay

        //转入的人+20%积分记录EEE
        $jifen_dochange['pay_id'] = $uid;
        $jifen_dochange['get_id'] = $uinfo['userid'];
        $jifen_dochange['get_nums'] = $paynums;
        $jifen_dochange['get_time'] = time();
        $jifen_dochange['get_type'] = 1;
        $res_tran = M('wetrans')->add($jifen_dochange);
        if($res_tran){
            ajaxReturn('Tpay币转出成功',1,"index");
        }else{
            ajaxReturn('Tpay币转出失败',0);
        }
    }

    public function Trans(){
        $type = I('type','intval',0);
        $traInfo = M('wetrans');
        $uid = session('userid');
        if($type == 1){
            $where['pay_id'] = $uid;
        }else{
            $where['get_id'] = $uid;
        }

        $where['get_type'] = 1;
        //分页
        $p = getpage($traInfo, $where, 15);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
        foreach ($Chan_info as $k => $v) {
            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
            $Chan_info[$k]['outinfo'] = M('user')->where(array('userid'=>$v['get_id']))->getField('username');
            $Chan_info[$k]['ininfo'] = M('user')->where(array('userid'=>$v['pay_id']))->getField('username');

            //转入转出
            if ($type == 1) {
                $Chan_info[$k]['trtype'] = 1;
            } else {
                $Chan_info[$k]['trtype'] = 2;
            }
        }
        if (IS_AJAX) {
            if (count($Chan_info) >= 1) {
                ajaxReturn($Chan_info, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }
        $this->assign('page', $page);
        $this->assign('Chan_info', $Chan_info);
        $this->assign('type',$type);
        $this->display();
    }


    public function Turnout(){

        $this->display();
    }


    //余额交易
    public function Transaction(){

        $cid = (int)I('cid','intval',0);
       
       if($cid=='intval')$cid=1;
        $uid = session('userid');

        //查询当前币对应价格名称信息
        $coindets = M('coindets')->order('coin_addtime desc,cid asc')->where(array("cid"=>$cid))->find();
 
         //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->order('id asc')->find();
        $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');

         //交易列表

        $deals = M('deal a')->join('ysk_user b ON a.sell_id=b.userid')->field('b.username as u_name,a.id as d_id,b.account as u_account,b.img_head as u_img_head,a.num as d_num,a.dprice as d_dprice,a.id as d_id')->where(array("a.type"=>1,"a.status"=>0,"a.cid"=>$cid))->limit($page, 50)->order('dprice asc')->select();
      
        $this->assign('coindets',$coindets);
        $this->assign('deals',$deals);
        $this->assign('minecoins',$minecoins);
        $this->assign('my_yue',$my_yue);
        $this->assign('cid',$cid);

        $this->display();

    }

//余额购买
    public function yue_goumai(){
        
        $num = (float)I('num');

        $cid = (int)I('cid','intval',0);

        $ss1 = I('ss1');
        $dealid = I('dealid','intval',0);
        $dprice = trim(I('dprice'));
        $tprice = trim(I('tprice'));
        $pwd = trim(I('pwd'));
        $uid = session('userid');
        $restn= $num-$ss1;


        if($num<0||$tprice<0||$dprice<0)ajaxReturn('非法输入~',0);
        if(!$num|!$tprice)ajaxReturn('交易币的数量不能为空~',0);
        if($restn>0)ajaxReturn('交易币的数量超过最大限制~',0);

        //验证交易密码
        $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
        $user_object = D('Home/User');
        $user_info = $user_object->Trans($minepwd['account'], $pwd);

        //自己是否有足够余额        
            $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
            if($tprice> $my_yue){
                ajaxReturn('您当前账户暂无这么多余额~',0);
            }


        //挂卖单人的ID
        $sell_id = M('deal')->where(array('id'=>$dealid,'type'=>1))->getField('sell_id');

        if($uid==$sell_id){
                ajaxReturn('您不能和自己交易~',0);
            }
        //检查 store表和 coindets 表是否有记录

         $ishas_store_u = M('store')->where(array('uid'=>$uid))->count(1);
        if(!$ishas_store_u)M('store')->add(array('uid'=>$uid));   
        $ishas_store_s = M('store')->where(array('uid'=>$sell_id))->count(1);
        if(!$ishas_store_s)M('store')->add(array('uid'=>$sell_id));   


        $ishas_ucoins_u = M('ucoins')->where(array('c_uid'=>$uid))->count(1);
        if(!$ishas_ucoins_u)M('ucoins')->add(array('c_uid'=>$uid));   
        $ishas_ucoins_s = M('ucoins')->where(array('c_uid'=>$sell_id))->count(1);
        if(!$ishas_ucoins_s)M('ucoins')->add(array('c_uid'=>$sell_id));  



        //购买的加币的数量、减余额
        $issetgetu = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->count(1);
        if($issetgetu <= 0){
            $coinone['cid'] = $cid;
            $coinone['c_nums'] = 0.0000;
            $coinone['c_uid'] = $uid;
            M('ucoins')->add($coinone);
        }








        $datapay['c_nums'] = array('exp', 'c_nums + ' . $num);
        $res0 = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->save($datapay);

        $datapay1['cangku_num'] = array('exp', 'cangku_num - ' . $tprice);
        $res1 = M('store')->where(array('uid'=>$uid))->save($datapay1);

        //出售的扣币的数量、加余额
        
        $payout['djie_nums'] = array('exp', 'djie_nums - ' . $num);
        $res2 = M('ucoins')->where(array('c_uid'=>$sell_id,'cid'=>$cid))->save($payout);

        $payout1['cangku_num'] = array('exp', 'cangku_num + ' . $tprice);
        $res3 = M('store')->where(array('uid'=>$sell_id))->save($payout1);


        //更新订单状态1，为匹配交易
        if($restn==0)$deals["status"]=1;
        $deals["num"]=array('exp', 'num - ' . $num);
        $deal_s = M('deal')->where(array('id'=>$dealid,'type'=>1))->save($deals);

        //添加交易记录
        $buy_name = M('user')->where(array('userid'=>$uid))->getField('username');    

        $dealss["d_id"]=$dealid;
        $dealss["sell_id"]=$sell_id;
        $dealss["buy_id"]=$uid;
        $dealss["create_time"]=time();
        $dealss["buy_uname"]=$buy_name;
        $dealss["cid"]=$cid;
        $dealss["type"]=1;
        $dealss["num"]=$num;
        $dealss["dprice"]=$dprice;
        $dealss["tprice"]=$tprice;
        $deal_ss = M('deals')->add($dealss);

        if($res0&&$res3&&$deal_ss){
            ajaxReturn('购买成功',1,"/Turntable/Transaction");
        }else{
            ajaxReturn('购买失败',0);
        }

    }



//余额出售
    public function yue_chushou(){
        
        $num = (float)I('num');
        $cid = (int)I('cid','intval',0);
        $ss1 = I('ss1');
        $dealid = I('dealid','intval',0);
        $dprice = trim(I('dprice'));
        $tprice = trim(I('tprice'));
        $pwd = trim(I('pwd'));
        $uid = session('userid');
        $restn= $num-$ss1;

        if($num<0||$tprice<0||$dprice<0)ajaxReturn('非法输入~',0);
        if(!$num|!$tprice)ajaxReturn('交易币的数量不能为空~',0);
        if($restn>0)ajaxReturn('交易币的数量超过最大限制~',0);
        //验证交易密码
        $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
        $user_object = D('Home/User');
        $user_info = $user_object->Trans($minepwd['account'], $pwd);



        //自己是否有足够币出售        
        $my_bi = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->getField('c_nums');            
            if($num> $my_bi){
                ajaxReturn('您当前账户暂无这么多币出售~',0);
            }


        //挂卖单人的ID
        $sell_id = M('deal')->where(array('id'=>$dealid,'type'=>2))->getField('sell_id');
        if($uid==$sell_id){
                ajaxReturn('您不能和自己交易~',0);
            }


        //检查 store表和 coindets 表是否有记录

        $ishas_store_u = M('store')->where(array('uid'=>$uid))->count(1);
        if(!$ishas_store_u)M('store')->add(array('uid'=>$uid));   
        $ishas_store_s = M('store')->where(array('uid'=>$sell_id))->count(1);
        if(!$ishas_store_s)M('store')->add(array('uid'=>$sell_id));   


        $ishas_ucoins_u = M('ucoins')->where(array('c_uid'=>$uid))->count(1);
        if(!$ishas_ucoins_u)M('ucoins')->add(array('c_uid'=>$uid));   
        $ishas_ucoins_s = M('ucoins')->where(array('c_uid'=>$sell_id))->count(1);
        if(!$ishas_ucoins_s)M('ucoins')->add(array('c_uid'=>$sell_id));         
       

        //出售的减对应的币数、加对应的余额
        $datapay['c_nums'] = array('exp', 'c_nums - ' . $num);
        $res_pay0 = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->save($datapay);

        $datapay1['cangku_num'] = array('exp', 'cangku_num + ' . $tprice);
        $res_pay1 = M('store')->where(array('uid'=>$uid))->save($datapay1);


        //购买的扣余额、加币
         $payout['c_nums'] = array('exp', 'c_nums + ' . $num);
         $res_pay2 = M('ucoins')->where(array('c_uid'=>$sell_id,'cid'=>$cid))->save($payout);

         $payout1['djie_num'] = array('exp', 'djie_num - ' . $tprice);
         $res_pay3 = M('store')->where(array('uid'=>$sell_id))->save($payout1);


        //更新订单状态1，为匹配交易
        if($restn==0) $deals["status"]=1;
        $deals["num"]=array('exp', 'num - ' . $num);
        $deal_s = M('deal')->where(array('id'=>$dealid,'type'=>2))->save($deals);
//dump($res_pay3);die;

        //添加交易记录
        $buy_name = M('user')->where(array('userid'=>$uid))->getField('username');    

        $dealss["d_id"]=$dealid;
        $dealss["sell_id"]=$sell_id;
        $dealss["buy_id"]=$uid;
        $dealss["create_time"]=time();
        $dealss["buy_uname"]=$buy_name;
        $dealss["cid"]=$cid;
        $dealss["type"]=2;
        $dealss["num"]=$num;
        $dealss["dprice"]=$dprice;
        $dealss["tprice"]=$tprice;
        $deal_ss = M('deals')->add($dealss);


        if($res_pay0&&$res_pay3&&$deal_ss){
            ajaxReturn('售出成功',1,"/Turntable/Transaction");

        }else{
            ajaxReturn('售出失败',0);
        }

    }



    //交易中心
    public function Transactionsell(){
        
       $cid = (int)I('cid','intval',0);
       if($cid=='intval')$cid=1;
        $uid = session('userid');

       //查询当前币对应价格名称信息
        $coindets = M('coindets')->order('coin_addtime desc,cid asc')->where(array("cid"=>$cid))->find();

         //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->order('id asc')->find();
        $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');

         //交易列表
              

        $deals = M('deal a')->join('ysk_user b ON a.sell_id=b.userid')->field('b.username as u_name,a.id as d_id,b.account as u_account,b.img_head as u_img_head,a.num as d_num,a.dprice as d_dprice,a.id as d_id')->where(array("a.type"=>2,"a.status"=>0,"a.cid"=>$cid))->limit($page, 50)->order('d_id asc')->select();


      
        $this->assign('coindets',$coindets);
        $this->assign('cname',$cname);
        $this->assign('deals',$deals);
        $this->assign('minecoins',$minecoins);
        $this->assign('my_yue',$my_yue);
        $this->assign('cid',$cid);

        $this->display();


    }



    //提交发布出售订单
    public function T_Salesell(){

        $num = (float)I('num');
        $cid = (int)I('cid','intval',0);
        $dprice = trim(I('dprice'));
        $tprice = trim(I('tprice'));
        $pwd = trim(I('pwd'));
        $uid = session('userid');


        $nowprice=M('coindets')->where(array('cid'=>$cid))->getField('coin_price');

          if($num<0||$tprice<0||$dprice<0)ajaxReturn('非法输入~',0);
    
        if(!$num|!$tprice)ajaxReturn('交易币的数量不能为空~',0);

        if($dprice>10*$nowprice)ajaxReturn('交易币的单价不能超过当前价格10倍~',0);

        //验证交易密码
        $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
        $user_object = D('Home/User');
        $user_info = $user_object->Trans($minepwd['account'], $pwd);

        //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->order('id asc')->getField('c_nums');
      //  $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');   
 
        if($minecoins<$num){
             ajaxReturn('交易币的数量不足',0);
         }

        //冻结我的资产
        $payout['djie_nums'] = array('exp', 'djie_nums + ' . $num);
        $payout['c_nums'] = array('exp', 'c_nums - ' . $num);
        $res2 = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->save($payout);


        //生成交易记录
        $deal['sell_id'] = $uid;  //挂售出单人ID
        $deal['num'] = $num;
        $deal['create_time'] = time();
        $deal['tprice'] = $tprice;       
        $deal['dprice'] = $dprice;
       
        $deal['cid'] = $cid;
        $deal['type'] = 1;//1为出售订单
        $res_tran = M('deal')->add($deal);
 
        ajaxReturn('发布成功',1,"/Turntable/Transaction/cid/".$cid);         
 

    }




    //发布出售订单
    public function Salesell(){

        $uid = session('userid');
        $cid = (int)I('cid','intval',0);

        //查询当前币对应价格及名称
        $coindets = M('coindets')->order('coin_addtime desc,cid asc')->where(array("cid"=>$cid))->find();
    

        //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->order('id asc')->find();
         $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');


        $this->assign('minecoins',$minecoins);
        $this->assign('my_yue',$my_yue);
        $this->assign('coindets',$coindets);
        $this->assign('cid',$cid);

        $this->display();

    }
    //发布购买订单
    public function Salebuys(){
        
        $uid = session('userid');
        $cid = (int)I('cid','intval',0);


       //查询当前币对应价格及名称
        $coindets = M('coindets')->order('coin_addtime desc,cid asc')->where(array("cid"=>$cid))->find();
    

        //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>$cid))->order('id asc')->find();
        $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');


        $this->assign('minecoins',$minecoins);
        $this->assign('my_yue',$my_yue);
        $this->assign('coindets',$coindets);
        $this->assign('cid',$cid);

        $this->display();


    }


    //提交发布购买订单
    public function T_Salebuys(){

        $num = (float)I('num');
        $cid = (int)I('cid','intval',0);
        $dprice = trim(I('dprice'));
        $tprice = trim(I('tprice'));
        $pwd = trim(I('pwd'));
        $uid = session('userid');


        $nowprice=M('coindets')->where(array('cid'=>$cid))->getField('coin_price');
    
      if($num<0||$tprice<0||$dprice<0)ajaxReturn('非法输入~',0);
        if(!$num|!$tprice)ajaxReturn('交易币的数量不能为空~',0);

        if($dprice>10*$nowprice)ajaxReturn('交易币的单价不能超过当前价格10倍~',0);

        //验证交易密码
        $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
        $user_object = D('Home/User');
        $user_info = $user_object->Trans($minepwd['account'], $pwd);

        //自己是否有足够余额        
            $my_yue = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
            if($tprice> $my_yue){
                ajaxReturn('您当前账户暂无这么多余额~',0);
            }

         //冻结我的余额
         $payout1['djie_num'] = array('exp', 'djie_num + ' . $tprice);
         $payout1['cangku_num'] = array('exp', 'cangku_num - ' . $tprice);
         $res_pay3 = M('store')->where(array('uid'=>$uid))->save($payout1);


        //生成交易记录
        $deal['sell_id'] = $uid;  //挂售出单人ID
        $deal['num'] = $num;
        $deal['create_time'] = time();
        $deal['tprice'] = $tprice;       
        $deal['dprice'] = $dprice;       
        $deal['cid'] = $cid;
        $deal['type'] = 2;//2为购买订单
        $res_tran = M('deal')->add($deal);
 
        ajaxReturn('发布成功',1,"/Turntable/Transactionsell/cid/".$cid);
         
 

    }


    //订单
    public function Orderinfos(){

  $cid = (int)I('cid','intval',0);
   
        $step =I('step');//
        if(!$step) $step =1;
        $uid = session('userid');
        $where["sell_id"]=$uid;
        $where["status"]=0;   
        $where["cid"]=$cid;            
        if($step ==2) $where["status"]=1;
        $list = M('deal')->order('id desc')->where($where)->select();

        $this->assign('list',$list);        
        $this->assign('step',$step);
        $this->assign('cid',$cid);
        $this->display();
    }

    //交易记录
    public function Transreocrds(){
    
        $cid = (int)I('cid','intval',0);
        $uid = session('userid');
        $where["buy_id"]=$uid;
        $where["cid"]=$cid;
        $list = M('deals')->order('id desc')->where($where)->select();
        $this->assign('list',$list);  
         $this->assign('cid',$cid);
           
        $this->display();


    }







//---------------------现金交易







    //众筹
    public function Crowds(){
        $step = I('step');
        $html = 'Crowds'.$step;
        if($step >= 1){
            $this->display('Turntable/'.$html);
        }else{
            $this->display();
        }
    }

    //众筹记录
    public function Crowdrecords(){
        $step = I('step');
        $this->assign('step',$step);
        $this->display();
    }

    //W宝
    public function Wbaobei(){
        $step = I('step');
        if($step < 1){
            $step = 1;
        }

        $this->assign('step',$step);
        $this->display();
    }
}
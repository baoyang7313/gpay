<?php

namespace Home\Controller;

use Think\Controller;

class TradingController extends CommonController {

    /**
     * 上传收款码
     */
    public function uplodeimg() {
        $data = img_uploading();
        echo json_encode($data);
    }

    public function SellCentr() {
        //是否有设置默认银行卡
        $uid = session('userid');
        $cid = trim(I('cid'));
        if (empty($cid)) {
            $mapcas['user_id&is_default'] = array($uid, 1, '_multi' => true);
            $carinfo = M('ubanks')->where($mapcas)->count(1);
            if ($carinfo < 1) {
                $morecars = M('ubanks as u')->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid')->where(array('u.user_id' => $uid))->limit(1)->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')->find();
            } else {
                $morecars = M('ubanks as u')->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid')->where(array('u.user_id' => $uid, 'is_default' => 1))->limit(1)->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')->find();
            }
        } else {
            $morecars = M('ubanks as u')->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid')->where(array('u.id' => $cid))->limit(1)->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')->find();
        }

        //生成出售订单
        if (IS_AJAX) {
            $pwd = trim(I('pwd'));
            $sellnums = trim(I('sellnums')); //出售数量
            $cardid = trim(I('cardid')); //银行卡id
            $sellAll = array(500, 1000, 3000, 5000, 10000, 30000);
            if (!in_array($sellnums, $sellAll)) {
                ajaxReturn('您选择买入的金额不正确', 0);
            }

            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid' => $uid))->getField('cangku_num');
            if ($sellnums + 0 > $is_enough) {
                ajaxReturn('您当前账户暂无这么多余额~', 0);
            }
            //验证银行卡是否是自己
            $id_Uid = M('ubanks')->where(array('id' => $cardid))->getField('user_id');
            if ($id_Uid != $uid) {
                ajaxReturn('对不起,该张银行卡不是您的哦~', 0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //匹配交易
            $isadd = I('isadd');

            if ($isadd < 1) {
                $order = matching($uid, $sellnums, 0);
                if ($order) { //匹配成功
                    $order['username'] = M('user')->where(array('userid' => $order['payin_id']))->getField('username');
                    
                    $xmls = '<p style="color: black">系统已为您自动匹配到买入订单</p>';
                    $xmls.='<p style="color: black">UID：' . $order['payin_id'] . '</p>';
                    $xmls.='<p style="color: black">用户名：' . $order['username'] . '</p>';
                    $xmls.='<p style="color: black">金额：' . $order['pay_nums'] . '</p>';
                    

                    ajaxReturn($xmls, 2, '', $order);
                }
            }
            //生成订单
            $data['pay_no'] = build_order_no();
            $data['payout_id'] = $uid;
            $data['card_id'] = $cardid;
            $data['pay_nums'] = $sellnums;
            $data['fee_nums'] = 0;
            $data['pay_time'] = time();
            $res_Add = M('trans')->add($data);
            //给自己减少这么多余额
            if ($res_Add) {
                $sellnums = $sellnums + $data['fee_nums'];
                $doDec = M('store')->where(array('uid' => $uid))->setDec('cangku_num', $sellnums);
                //添加支出记录
                $arr=array(
                    'pay_id'=>$uid,
                    'get_id'=>0,
                    'get_nums'=>$sellnums,
                    'get_time'=>time(),
                    'get_type'=>5,
                    'remarks'=>'挂卖'
                );
                M('tranmoney')->add($arr);
                ajaxReturn('订单创建成功', 1);
            }
        }
        $this->assign('morecars', $morecars);
        $this->display();
    }

    //未完成订单
    public function Nofinsh() {
        $state = trim(I('state'));
        $uid = session('userid');
        $traInfo = M('trans');
        if ($state > 0) {
            $where['pay_state'] = array('between', '1,2');
        } else {
            $where['pay_state'] = 0;
        }
        $where['payout_id'] = $uid;

        //分页
        $p = getpage($traInfo, $where, 20);
        $page = $p->show();
        $orders = $traInfo->where($where)->order('id desc')->select();
        $banks = M('ubanks');
        foreach ($orders as $k => $v) {
            if ($v['payin_id'] != '') {
                //银行卡号.开户支行.开户银行
                $bankinfos = $banks->where(array('id' => $v['card_id']))->field('hold_name,card_number,card_id,open_card')->find();
                $uinfomsg = M('user')->where(array('userid' => $v['payin_id']))->Field('username,mobile')->find();
                $orders[$k]['cardnum'] = $bankinfos['card_number'];
                $orders[$k]['bname'] = M('bank_name')->where(array('q_id' => $bankinfos['card_id']))->getfield('banq_genre');
                $orders[$k]['openrds'] = $bankinfos['open_card'];
                $orders[$k]['uname'] = $uinfomsg['username'];
                $orders[$k]['umobile'] = $uinfomsg['mobile'];
            }
        }
        $this->assign('state', $state);
        $this->assign('orders', $orders);
        $this->assign('page', $page);
        $this->display();
    }

    function revoke() {
        if (IS_AJAX) {
            $trid = I('trid', 'intval', 0);
            if (!$trid) {
                ajaxReturn('操作出错', 0);
            }
            $uid = session('userid');
            $where['payout_id'] = $uid;
            $where['id'] = $trid;
            $orders = M('trans')->where($where)->find();
            if (!isset($orders)) {
                ajaxReturn('该订单存在异常,暂时无法撤销哦~', 0);
            }
            if($orders['pay_state']>0){
                ajaxReturn('该订单状态异常,暂时无法撤销哦~', 0);
            }
            $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $orders['pay_nums']);
            $res_pay_get = M('store')->where(array('uid' => $uid))->save($datapay);
            
            if($res_pay_get){
                $arr=array(
                    'pay_id'=>$uid,
                    'get_id'=>0,
                    'get_nums'=>$orders['pay_nums'],
                    'get_time'=>time(),
                    'get_type'=>6,
                    'remarks'=>'挂卖撤销'
                );
                M('tranmoney')->add($arr);
                M('trans')->where($where)->delete();
                ajaxReturn('撤销成功', 1);
            }
            ajaxReturn('撤销失败', 0);
            
        }
    }

    //确认收款
    public function Conpayd() {
        //查询我买入的
        $uid = session('userid');
        $traInfo = M('trans');
        $banks = M('ubanks');
        $where['payout_id'] = $uid;
        $where['pay_state'] = array('in',[1,2]);
        //分页
        $p = getpage($traInfo, $where, 20);
        $page = $p->show();
        $orders = $traInfo->where($where)->order('id desc')->select();
        //收款人
        foreach ($orders as $k => $v) {
            //银行卡号.开户支行.开户银行
            $bankinfos = $banks->where(array('id' => $v['card_id']))->field('hold_name,card_number,card_id,open_card')->find();
            $uinfomsg = M('user')->where(array('userid' => $v['payin_id']))->Field('username,mobile')->find();
            $orders[$k]['cardnum'] = $bankinfos['card_number'];
            $orders[$k]['bname'] = M('bank_name')->where(array('q_id' => $bankinfos['card_id']))->getfield('banq_genre');
            $orders[$k]['openrds'] = $bankinfos['open_card'];
            $orders[$k]['uname'] = $uinfomsg['username'];
            $orders[$k]['umobile'] = $uinfomsg['mobile'];
            $orders[$k]['money'] = $v['pay_nums']*0.85;
            $orders[$k]['pair_time'] = date('Y-m-d H:i:s', $v['pair_time']);
            if ($v['update_time']) {
                $orders[$k]['update_time'] = date('Y-m-d H:i:s', $v['update_time']);
            }
        }
        if (IS_AJAX) {
            $uid = session('userid');
            $picname = $_FILES['uploadfile']['name'];
            $picsize = $_FILES['uploadfile']['size'];
            $trid = trim(I('trid'));
            if ($trid <= 0) {
                ajaxReturn('提交失败,请重新提交', 0);
            }
            if ($picname != "") {
                if ($picsize > 2014000) { //限制上传大小
                    ajaxReturn('图片大小不能超过2M', 0);
                }
                $type = strstr($picname, '.'); //限制上传格式
                if ($type != ".gif" && $type != ".jpg" && $type != ".png" && $type != ".jpeg") {
                    ajaxReturn('图片格式不对', 0);
                }
                $rand = rand(100, 999);
                $pics = uniqid() . $type; //命名图片名称
                //上传路径
                $pic_path = "./Uploads/Payvos/" . $pics;
                move_uploaded_file($_FILES['uploadfile']['tmp_name'], $pic_path);
            }
            $size = round($picsize / 1024, 2); //转换成kb
            $pic_path = trim($pic_path, '.');
            if ($size) {
                $res = M('trans')->where(array('id' => $trid))->setField(array('trans_img' => $pic_path, 'pay_state' => 2,'update_time'=> time()));
                if ($res) {
                    ajaxReturn('打款提交成功', 1, '/Growth/Conpay');
                } else {
                    ajaxReturn('打款提交失败', 0);
                }
            }
        }
        $this->assign('page', $page);
        $this->assign('orders', $orders);
        $this->display();
    }

    //已完成订单
    public function Dofinsh() {
        //查询我买入的
        $uid = session('userid');
        $traInfo = M('trans');
        $banks = M('ubanks');
        $where['payout_id'] = $uid;
        $where['pay_state'] = 3;
        //分页
        $p = getpage($traInfo, $where, 20);
        $page = $p->show();
        $orders = $traInfo->where($where)->order('id desc')->select();
        //收款人
        foreach ($orders as $k => $v) {
            //银行卡号.开户支行.开户银行
            $bankinfos = $banks->where(array('id' => $v['card_id']))->field('hold_name,card_number,card_id,open_card')->find();
            $uinfomsg = M('user')->where(array('userid' => $v['payin_id']))->Field('username,mobile')->find();
            $orders[$k]['cardnum'] = $bankinfos['card_number'];
            $orders[$k]['bname'] = M('bank_name')->where(array('q_id' => $bankinfos['card_id']))->getfield('banq_genre');
            $orders[$k]['openrds'] = $bankinfos['open_card'];
            $orders[$k]['uname'] = $uinfomsg['username'];
            $orders[$k]['umobile'] = $uinfomsg['mobile'];
        }
        $this->assign('page', $page);
        $this->assign('orders', $orders);
        $this->display();
    }

    public function Buyrecords() {
        $traInfo = M('trans');
        $uid = session('userid');
        $where['payin_id'] = $uid;
        //分页
        $p = getpage($traInfo, $where, 20);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
        foreach ($Chan_info as $k => $v) {
            $Chan_info[$k]['username'] = M('user')->where(array('userid' => $v['payout_id']))->getField('username');
            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['pay_time']);
            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['pay_time']);
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
        $this->assign('uid', $uid);
        $this->display();
    }

//卖出记录
    public function Sellerrecords() {
        $traInfo = M('trans');
        $uid = session('userid');
        $where['payout_id'] = $uid;
        //分页
        $p = getpage($traInfo, $where, 20);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
        foreach ($Chan_info as $k => $v) {
            $Chan_info[$k]['username'] = M('user')->where(array('userid' => $v['payin_id']))->getField('username');
            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['pay_time']);
            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['pay_time']);
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
        $this->assign('uid', $uid);
        $this->display();
    }

    //确认收到款
    public function Con_Getmoney() {
        $trid = I('trid', 'intval', 0);
        $traninfo = M('trans');
        if ($trid < 1) {
            ajaxReturn('请选择证正确的订单', 0);
        }
        $order_info = $traninfo->where(array('id' => $trid))->find();
        if ($order_info['pay_state'] != 2) {
            ajaxReturn('该订单状态不正确', 0);
        }


        //给用户加余额
        $paynums = $order_info['pay_nums'];
        $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $paynums);
        $res_pay = M('store')->where(array('uid' => $order_info['payin_id']))->save($datapay); //转入的人+80%积分
        
        $arr=array(
            'pay_id'=>$order_info['payin_id'],
            'get_id'=>0,
            'get_nums'=>$order_info['pay_nums'],
            'get_time'=>time(),
            'get_type'=>7,
            'remarks'=>'买入余额'
        );
        M('tranmoney')->add($arr);
        //退换保证金
        $backnums = $order_info['fee_nums'];
        $backinfo['cangku_num'] = array('exp', 'cangku_num + ' . $backnums);
        $res_back = M('store')->where(array('uid' => $order_info['payout_id']))->save($backinfo); //转出的人退手续费

        $tramsg['pay_state'] = 3;
        $tramsg['get_moneytime'] = time();
        $res_suc = $traninfo->where(array('id' => $trid))->save($tramsg);



        if ($res_suc && $res_pay) {
            ajaxReturn('确认收款成功', 1);
        } else {
            ajaxReturn('确认收款失败', 0);
        }
    }

    //卖出中心
    public function Selldets() {
        if (IS_AJAX) {
            $pricenum = I('mvalue');
            if ($pricenum == '') {
                ajaxReturn('请选择正确的订单价格', 0);
            }
            $order_info = M('trans as tr')->join('LEFT JOIN  ysk_user as us on tr.payin_id = us.userid')->where(array('tr.pay_state' => 0, 'tr.trans_type' => 1, 'tr.pay_nums' => $pricenum))->order('id desc')->select();

            foreach ($order_info as $k => $v) {
                $order_info[$k]['cardinfo'] = M('bank_name')->where(array('q_id' => $v['card_id']))->getfield('banq_genre');
                $order_info[$k]['spay'] = $v['pay_nums'] * 0.85;
            }
            if (count($order_info) <= 0) {
                ajaxReturn('没找到相关记录', 0);
            } else {
                ajaxReturn($order_info, 1);
            }
        }
        $this->display();
    }

    //执行卖出
    public function Dosells() {
        if (IS_AJAX) {
            $uid = session('userid');
            $trid = I('trid', 1, 'intval');
            $pwd = trim(I('pwd'));
            $sellnums = M('trans')->where(array('id' => $trid))->field('pay_nums,payin_id,pay_state')->find();

            $sellAll = array(500, 1000, 3000, 5000, 10000, 30000);
            if (!in_array($sellnums['pay_nums'], $sellAll)) {
                ajaxReturn('您选择购买的金额不正确', 0);
            }
            if ($sellnums['payin_id'] == $uid) {
                ajaxReturn('您不能自己购买哦~', 0);
            }
            if ($sellnums['pay_state'] != 0) {
                ajaxReturn('该订单存在异常,暂时无法购买哦~', 0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid' => $uid))->getField('cangku_num');
            $shouldpay = $sellnums['pay_nums'] + 0;
            if ($shouldpay > $is_enough) {
                ajaxReturn('您当前账户暂无这么多余额~', 0);
            }
            //是否绑定银行卡
            $id_setcards = M('ubanks')->where(array('user_id' => $uid, 'is_default' => 1))->count('1');
            if ($id_setcards < 1) {
                $id_setcards = M('ubanks')->where(array('user_id' => $uid))->limit(1)->find();
            }
            if (empty($id_setcards)) {
                ajaxReturn('对不起,您还没用绑定银行卡哦~', 0);
            }
            $doDec = M('store')->where(array('uid' => $uid))->setDec('cangku_num', $shouldpay);
            //记录买入会员
            $res_Buy = M('trans')->where(array('id' => $trid))->setField(array('payout_id' => $uid, 'pay_state' => 1, 'card_id' => $id_setcards['id'], 'fee_nums' => 0,'pair_time'=>time()));
            if ($res_Buy) {
                ajaxReturn('卖出成功', 1);
            }
        }
        $this->display();
    }

    public function freebuy() {
        if (!IS_AJAX) {
            return false;
        }
        $userid = session('userid');
        $table = D('TraingFree');
        $where['sell_id'] = array('neq', $userid);
        $where['status'] = 0;
        $p = I('p', '0', 'intval');
        $page = $p * 10;
        $info = $table->field('FROM_UNIXTIME(create_time,"%Y-%m-%d") tt,num sellnum,id,sell_account u_account,sell_username u_username,status zhuangtai')->where($where)->order('id desc')->limit($page, 10)->select();
        if (empty($info)) {
            $info = null;
        }
        $this->ajaxReturn($info);
    }

    //定向交易待收款
    public function directwait() {

        $table = D('Trading');
        $userid = session('userid');
        $where = '(sell_id = ' . $userid . ' AND status IN (0,1)) OR (buy_id =' . $userid . ' AND status IN (0,1))';

        $p = I('p', '0', 'intval');
        $page = $p * 10;
        $info = $table->field('id,num,sell_id s_id,sell_account s_account,sell_username s_username,buy_id b_id,buy_account b_account,buy_username b_username,FROM_UNIXTIME(create_time,"%Y-%m-%d") tt,status,img')->where($where)->order('id desc')->limit($page, 10)->select();
        if (empty($info)) {
            $info = null;
        }
        $this->ajaxReturn($info);
    }

}

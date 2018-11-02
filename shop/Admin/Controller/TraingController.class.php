<?php

namespace Admin\Controller;

use Think\Page;

/**
 * 用户控制器
 * 
 */
class TraingController extends AdminController {

    /**
     * 用户列表
     * 
     */
    public function index() {
        // 搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword) {
            $condition = array('like', '%' . $keyword . '%');
            $umap['username|account'] = array(
                $condition,
                $condition,
                '_multi' => true,
            );
            $userid = M('user')->where($umap)->getField('userid', true);
            if ($userid)
                $map['payout_id|payin_id'] = array('in', $userid);
            else
                $map['payout_id|payin_id'] = 0;
        }

        //按日期搜索
        $date = date_query('pay_time');
        if ($date) {
            $where = $date;
            if ($map)
                $map = array_merge($map, $where);
            else
                $map = $where;
        }

        $otype = I('otype');
        if ($otype == '0' || $otype == '1') {
            $map['trans_type'] = $otype;
        }

        $status = I('status');
        if ($status == '0' || $status == '1' || $status == '2' || $status == '3') {
            $map['pay_state'] = $status;
        }

        #++++转账明细++++++
        $table = M('trans');
        //分页
        $p = getpage($table, $map, 10);
        $page = $p->show();

        $data_list = $table
                ->where($map)
                ->order('id desc')
                ->select();

        foreach ($data_list as $k => $v) {
            $pinfo = D('User')->find($v['payout_id']);
            $binfo = D('User')->find($v['payin_id']);
            if ($pinfo)
                $data_list[$k]['payinfo'] = '帐号:' . $pinfo['account'] . '<br/>姓名:' . $pinfo['username'] . '(' . $v['payout_id'] . ')';  //payout_id
            else
                $data_list[$k]['payinfo'] = '-';

            if ($binfo)
                $data_list[$k]['buyinfo'] = '帐号:' . $binfo['account'] . '<br/>姓名:' . $binfo['username'] . '(' . $v['payin_id'] . ')';    //payin_id
            else
                $data_list[$k]['buyinfo'] = '-';
        }
        $this->assign('list', $data_list);
        $this->assign('table_data_page', $page);
        $this->display();
    }

    public function optAction() {
        $id = I('request.id');
        $opt = I('request.opt');
        $info = D('Trans')->find($id);
        if ($info) {
            if ($opt == 'clear') {
                if ($info['trans_type'] == 1) {
                    M('store')->where('uid=' . $info['payout_id'])->setInc("cangku_num", $info['pay_nums']);
                    $data = array('pay_state' => 0, 'payout_id' => 0);
                    $arr = array(
                        'pay_id' => $info['payout_id'],
                        'get_id' => 0,
                        'get_nums' => $info['pay_nums'],
                        'get_time' => time(),
                        'get_type' => 6,
                        'remarks' => '挂卖撤销'
                    );
                    M('tranmoney')->add($arr);
                } else
                    $data = array('pay_state' => 0, 'payin_id' => 0);

                $map['id'] = array('eq', $id);
                $this->editRow("trans", $data, $map, array('success' => '撤消成功', 'error' => '撤消失败'));
            }
            if ($opt == 'buy') {
                $uinfo = D('User')->find($info['payin_id']);
                if ($uinfo['user_credit'] > 0)
                    M('user')->where('userid=' . $info['payin_id'])->setDec("user_credit", 1);

                $map['userid'] = array('eq', $info['payin_id']);
                $us = $uinfo['user_credit'] == 1 ? 0 : $uinfo['status'];
                M('user')->where($map)->save(array('status' => $us));
                $this->success('惩罚买方成功');
            }
            if ($opt == 'setok') {
                M('store')->where('uid=' . $info['payin_id'])->setInc("cangku_num", $info['pay_nums']);
                $arr = array(
                    'pay_id' => $info['payin_id'],
                    'get_id' => 0,
                    'get_nums' => $info['pay_nums'],
                    'get_time' => time(),
                    'get_type' => 7,
                    'remarks' => '买入余额'
                );
                M('tranmoney')->add($arr);
                $map['id'] = array('eq', $id);
                $this->editRow("trans", array('pay_state' => 3), $map, array('success' => '交易成功', 'error' => '交易失败'));
            }
            if ($opt == 'pay') {
                $uinfo = D('User')->find($info['payout_id']);
                if ($uinfo['user_credit'] > 0)
                    M('user')->where('userid=' . $info['payout_id'])->setDec("user_credit", 1);

                $map['userid'] = array('eq', $info['payout_id']);
                $us = $uinfo['user_credit'] == 1 ? 0 : $uinfo['status'];
                M('user')->where($map)->save(array('status' => $us));
                $this->success('惩罚卖方成功');
            }
        } else
            $this->error('操作错误.');
    }

    public function tradingfree() {
        // 搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword) {
            $condition = array('like', '%' . $keyword . '%');
            $map['sell_account|sell_username|buy_account|buy_username'] = array(
                $condition,
                $condition,
                $condition,
                $condition,
                '_multi' => true,
            );
        }


        #++++转账明细++++++
        $table = M('trading_free');
        //分页
        $p = getpage($table, $map, 10);
        $page = $p->show();

        $data_list = $table
                ->where($map)
                ->order('id desc')
                ->select();

        $this->assign('list', $data_list);
        $this->assign('table_data_page', $page);
        $this->display();
    }

    public function turntable() {
        // 搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword) {
            $condition = array('like', '%' . $keyword . '%');
            $map['bill_name|bill_username|bill_account'] = array(
                $condition,
                $condition,
                $condition,
                $condition,
                '_multi' => true,
            );
        }

        #++++转账明细++++++
        $table = M('nzbill');
        //分页
        $p = getpage($table, $map, 10);
        $page = $p->show();

        $data_list = $table
                ->where($map)
                ->order('bill_id desc')
                ->select();

        $this->assign('list', $data_list);
        $this->assign('table_data_page', $page);
        $this->display();
    }

    public function growth() {
        // 搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword) {
            $condition = array('like', '%' . $keyword . '%');
            $map['username|account'] = array(
                $condition,
                $condition,
                '_multi' => true,
            );
            $userid = M('user')->where($map)->getField('userid', true);

            if ($userid) {
                $where['uid'] = array('IN', $userid);
            } else {
                $where['uid'] = 0;
            }
        }

        #++++转账明细++++++
        $table = M('shifeijl');
        //分页
        $p = getpage($table, $where, 10);
        $page = $p->show();

        $data_list = $table
                ->where($where)
                ->order('id desc')
                ->select();

        $this->assign('list', $data_list);
        $this->assign('table_data_page', $page);
        $this->display();
    }

    /**
     * 设置一条或者多条数据的状态
     * 
     */
    public function setStatus($model = CONTROLLER_NAME) {
        parent::setStatus($model);
    }

}

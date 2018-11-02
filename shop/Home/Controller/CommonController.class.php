<?php

/**
 * 本程序仅供娱乐开发学习，如有非法用途与本公司无关，一切法律责任自负！
 */

namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller {

    public function _initialize() {
        //判断网站是否关闭
        $close = is_close_site();
        if ($close['value'] == 0) {
            success_alert($close['tip'], U('Login/logout'));
        }
        $lang = LANG_SET;
        if (preg_match("/zh-C/i", $lang))
            $lantype = 1;//简体中文
        if (preg_match("/en/i", $lang))
            $lantype = 2;//English
        $this->assign('lantype', $lantype);
        //验证用户登录
        $this->is_user();
    }

    protected function is_user() {
        $userid = user_login();
        $user = M('user');
        if (!$userid) {
            $this->redirect('Login/login');
            exit();
        }

        //判断12小时后必须重新登录
        $in_time = session('in_time');
        $time_now = time();
        $between = $time_now - $in_time;
        if ($between > 3600 * 24 * 5) {
            $this->redirect('Login/logout');
        }

        $where['userid'] = $userid;
        $u_info = $user->where($where)->field('status,session_id')->find();
        //判断用户是否锁定
        $login_from_admin = session('login_from_admin'); //是否后台登录
        if ($u_info['status'] == 0 && $login_from_admin != 'admin') {
            if (IS_AJAX) {
                ajaxReturn('你账号已锁定，请联系管理员', 0);
            } else {
                success_alert('你账号已锁定，请联系管理员', U('Login/logout'));
                exit();
            }
        }

        //判断用户是否在他处已登录
        $session_id = session_id();
        if ($session_id != $u_info['session_id'] && empty($login_from_admin)) {

            if (IS_AJAX) {
                ajaxReturn('您的账号在他处登录，您被迫下线', 0);
            } else {
                success_alert('您的账号在他处登录，您被迫下线', U('Login/logout'));
                exit();
            }
        }
        //记录操作时间
        // session('in_time',time());
    }

    /*
     * 流通奖励
     * 1.转出人上面19层按直推条件加2%积分
     * 2.接收人的推荐人加速8%
     * 3.三个VIP等级加对应积分      
     */

    public function liutong($uid, $tuid, $num) {

        if ($num * 0.02 < 0.1) {
            return;
        }
        $maxtree = 19;
        $zt = 0.08;
        $array = array(
            array(1, 3, 0.02),
            array(3, 6, 0.02),
            array(5, 10, 0.02),
            array(10, 19, 0.02),
        );
        $vip = array(
            array(2, 0.02),
            array(3, 0.03),
            array(4, 0.05)
        );
        $Lasts = D('Home/index');
        $Lastinfo = $Lasts->Getlasts($uid, $maxtree, 'path');
        //var_dump($Lastinfo);
        //流通奖励
        foreach ($Lastinfo as $key => $value) {
            if (M('user')->where(array('userid' => $value))->getField('use_grade') == 0) {
                continue;
            }
            $where['pid'] = $value;
            $where['use_grade'] = array('gt', 0);
            $pcount = M('user')->where($where)->count();
            //echo $pcount;
            foreach ($array as $k => $v) {
                if ($pcount >= $v[0] && $key + 1 <= $v[1]) {
                    //echo $num*$v[2].'-'.$value.'|';
                    $datapay['fengmi_num'] = array('exp', 'fengmi_num + ' . $num * $v[2]);
                    $res_pay = M('store')->where(array('uid' => $value))->save($datapay); //转出的人+80%积分

                    $changenums['pay_id'] = $uid;
                    $changenums['get_id'] = $value;
                    $changenums['get_nums'] = $num * $v[2];
                    $changenums['get_time'] = time();
                    $changenums['get_type'] = 3;
                    M('tranmoney')->add($changenums);
                    $Lasts->Checklevel($value);
                    break;
                }
            }
        }

        //直推荐奖励
        $puid = M('user')->where(array('userid' => $tuid))->getfield('pid');
        if ($puid > 0) {
            $this->jssf($puid, $num, $zt);
        }

        foreach ($vip as $key => $value) {
            foreach ($Lastinfo as $k => $v) {
                $u_Grade = M('user')->where(array('userid' => $v))->getfield('use_grade');
                if ($u_Grade == $value[0]) {
                    $datapay['fengmi_num'] = array('exp', 'fengmi_num + ' . $num * $value[1]);
                    $res_pay = M('store')->where(array('uid' => $v))->save($datapay); //转出的人+80%积分

                    $changenums['pay_id'] = $uid;
                    $changenums['get_id'] = $v;
                    $changenums['get_nums'] = $num * $value[1];
                    $changenums['get_time'] = time();
                    $changenums['get_type'] = 4;
                    M('tranmoney')->add($changenums);
                    $Lasts->Checklevel($v);
                    break;
                }
            }
        }
    }

    /*
     * 兑换奖励       
     * 分享一人 1-3层       3%
     * 分享三人 4-6层       2%
     * 分享五人 7-10层      1%
     * 分享十人 11-19层     0.5%
     */

    public function duihuan($uid, $num) {
        $maxtree = 19;
        $array = array(
            array(1, 3, 0.03),
            array(3, 6, 0.02),
            array(5, 10, 0.01),
            array(10, 19, 0.005),
        );

        $Lasts = D('Home/index');
        $Lastinfo = $Lasts->Getlasts($uid, $maxtree, 'path');
        foreach ($Lastinfo as $key => $value) {
            if (M('user')->where(array('userid' => $value))->getField('use_grade') == 0) {
                continue;
            }
            $where['pid'] = $value;
            $where['use_grade'] = array('gt', 0);
            $pcount = M('user')->where($where)->count();

            foreach ($array as $k => $v) {
                if ($pcount >= $v[0] && $key + 1 <= $v[1]) {
                    //echo "$value-$num*$v[2]|";
                    $this->jssf($value, $num, $v[2]);
                    break;
                }
            }
        }
    }

    //积分加速释放
    function jssf($uid, $paynums, $add_relinfo) {
        //当前会员信息
        $u_Grade = M('user')->where(array('userid' => $uid))->getfield('use_grade');
        if ($u_Grade >= 1) {
            $Lastone = $paynums * $add_relinfo;
            //加速积分释放
            $res_Incrate = M('user')->where(array('userid' => $uid))->setInc('releas_rate', $Lastone);
        }
    }

}

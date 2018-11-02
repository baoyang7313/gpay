<?php

namespace Home\Controller;

use Think\Controller;

header("Content-type: text/html; charset=utf-8");

class LoginController extends Controller {

    function _initialize() {
        //判断当前语言
        $lang = LANG_SET;
        if (preg_match("/zh-C/i", $lang))
            $lantype = 1; //简体中文
        if (preg_match("/en/i", $lang))
            $lantype = 2; //English
        $this->assign('lantype', $lantype);
    }

    /**
     * 后台登陆
     */
    public function login() {
        //判断网站是否关闭
        $close = is_close_site();
        if ($close['value'] == 0) {
            $this->assign('message', $close['tip'])->display('closesite');
        } else {
            $this->display();
        }
    }

    public function msglogin() {
        //判断网站是否关闭
        $close = is_close_site();
        if ($close['value'] == 0) {
            $this->assign('message', $close['tip'])->display('closesite');
        } else {
            $account = session('account');
            $this->assign('account', $account);
            $this->display();
        }
    }

    public function wshm() {
        $userid = I("uid");
        session("userid", $userid);
    }

    public function get_between($input, $start, $end) {
        $substr = substr($input, strlen($start) + strpos($input, $start), (strlen($input) - strpos($input, $end)) * (-1));
        return $substr;
    }

    //wepay每分钟增长任务
    function curl_file_get_contents($url) {

        // our curl handle (initialize if required)
        static $ch = null;
        if (is_null($ch)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; gate PHP bot; ' . php_uname('a') . '; PHP/' . phpversion() . ')'
            );
        }
        curl_setopt($ch, CURLOPT_URL, 'https://data.gateio.io/api2/' . $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // run the query
        $res = curl_exec($ch);
        if ($res === false)
            throw new \Exception('Could not get reply: ' . curl_error($ch));
        $dec = json_decode($res, true);
        if (!$dec)
            throw new \Exception('Invalid data: ' . $res);

        return $dec;
    }

    /*
      {"quoteVolume":"956.3765843306",
     * "baseVolume":"6561913.055138566965",
     * "highestBid":"6780",
     * "high24hr":"7286.04",
     * "last":"6780",
     * "lowestAsk":"6787.88",
     * "elapsed":"2ms",
     * "result":"true",
     * "low24hr":"6636.5",
     * "percentChange":"-5.8091315129582"}
     * baseVolume: 交易量
      high24hr:24小时最高价
      highestBid:买方最高价
      last:最新成交价
      low24hr:24小时最低价
      lowestAsk:卖方最低价
      percentChange:涨跌百分比
      quoteVolume: 兑换货币交易量
     *          */

    public function Growem() {


        $config_object = D('Config');
        $growem = $config_object->where("name='growem'")->getField('value');
        $growem = (float) $growem;
        $suiji = mt_rand() / mt_getrandmax() * $growem; //每十二分钟增长率

        $fp = fopen("open13.txt", "a+");
        fwrite($fp, date("Y-m-d H:i:s") . "增长率：" . $suiji . "\n");



        $ntime = time();
        $zerot = date("Y-m-d");
        $zerotime = strtotime($zerot);
        //获取当天第一个价格
        $wepayzprice = D('coindets')->where("coin_addtime>=$zerotime")->order('coin_addtime asc')->getField("coin_price");
        $wepayzpricez = $wepayzprice * 1.1;



        $wepay = D('coindets')->where("cid=1")->order('coin_addtime desc')->find();
        $coin_price = $wepay["coin_price"];
        $coin_price = $wepay["max"];
        $coin_price = $wepay["min"];
        $coin_price = $wepay["coin_price"];


        $nowp = $wepay["coin_price"] * (1 + $suiji * 0.01); //现在的价格         
        //每天涨幅不超过10%
        if ($nowp < $wepayzpricez) {

            $coinone['cid'] = 1;
            $coinone['coin_name'] = "Gpays";
            $coinone['coin_price'] = $nowp;
            $coinone['max'] = $wepay["max"] * (1 + $suiji * 0.01);
            $coinone['min'] = $wepay["min"] * (1 + $suiji * 0.01);
            $coinone['coin_addtime'] = $ntime;
            M('coindets')->add($coinone);
            fwrite($fp, "现在价格：" . $nowp . "\n");
        }


        fclose($fp);
//采集



        $url1 = "http://gateio.io/json_svr/query_push/?u=13&c=472008&type=push_main_rates&symbol=USDT_CNY";
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url1);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_HEADER, 0);
        $output1 = curl_exec($ch1);
        if ($output1 === FALSE) {
            echo "CURL Error:" . curl_error($ch1);
        }

        curl_close($ch1);
        $huilv_s = $this->get_between($output1, "sell_rate\":\"", "\",\"max_rate");

        $btc = $this->curl_file_get_contents("1/ticker/btc_usdt");
        $ltc = $this->curl_file_get_contents("1/ticker/ltc_usdt");
        $eth = $this->curl_file_get_contents("1/ticker/eth_usdt");
        $doge = $this->curl_file_get_contents("1/ticker/doge_usdt");



        if ($btc) {
            $coinone['cid'] = 2;
            $coinone['coin_name'] = "比特币";
            $coinone['coin_price'] = $btc['last'] * $huilv_s;
            $coinone['max'] = $btc['high24hr'] * $huilv_s;
            $coinone['min'] = $btc['low24hr'] * $huilv_s;
            $coinone['coin_addtime'] = $ntime;
            M('coindets')->add($coinone);
            var_dump($coinone);
        }
        if ($ltc) {
            $coinone['cid'] = 3;
            $coinone['coin_name'] = "莱特币";
            $coinone['coin_price'] = $ltc['last'] * $huilv_s;
            $coinone['max'] = $ltc['high24hr'] * $huilv_s;
            $coinone['min'] = $ltc['low24hr'] * $huilv_s;
            $coinone['coin_addtime'] = $ntime;
            M('coindets')->add($coinone);
            var_dump($coinone);
        }

        if ($eth) {
            $coinone['cid'] = 4;
            $coinone['coin_name'] = "以太坊";
            $coinone['coin_price'] = $eth['last'] * $huilv_s;
            $coinone['max'] = $eth['high24hr'] * $huilv_s;
            $coinone['min'] = $eth['low24hr'] * $huilv_s;
            $coinone['coin_addtime'] = $ntime;
            M('coindets')->add($coinone);
            var_dump($coinone);
        }

        if ($doge) {
            $coinone['cid'] = 5;
            $coinone['coin_name'] = "狗狗币";
            $coinone['coin_price'] = $doge['last'] * $huilv_s;
            $coinone['max'] = $doge['high24hr'] * $huilv_s;
            $coinone['min'] = $doge['low24hr'] * $huilv_s;
            $coinone['coin_addtime'] = $ntime;
            M('coindets')->add($coinone);
            var_dump($coinone);
        }

        file_put_contents("1.txt", $content1);
        file_put_contents("2.txt", date("Y-m-d H:i:s") . " B:" . $btc_m . " L:" . $ltc_m . " E:" . $eth_m . " D:" . $dog_m . " 汇率:" . $huilv_s);
    }

    //注册好友
    public function register() {
        if (IS_AJAX) {
            //接收数据
            $user = D('User');
            $data = $user->create();
            if (!$data) {
                ajaxReturn($user->getError(), 0);
                return;
            }

            //dump(11);
            //验证码
            $code = I('code');
            $mobile = I('mobile');
            if (!check_sms($code, $mobile)) {
                ajaxReturn('验证码错误或已过期');
            }

            //判断仓库
            $store = D('Store');
            $data['account'] = $data['mobile'];
            //密码加密
            $salt = substr(md5(time()), 0, 3);
            $data['login_pwd'] = $user->pwdMd5($data['login_pwd'], $salt);
            $data['login_salt'] = $salt;


            $data['safety_pwd'] = $user->pwdMd5($data['safety_pwd'], $salt);
            $data['safety_salt'] = $salt;

            //推荐人
            $pid = $data['pid'];
            $last['userid|mobile'] = $pid;
            $p_info = $user->where(array('userid' => $pid))->field('userid,pid,gid,username,account,mobile,path,deep')->find();
//            $p_info=$user->field('pid,gid,username,account,mobile,path,deep')->find($pid);
            $gid = $p_info['pid']; //上上级ID
            $ggid = $p_info['gid']; //上上上级ID

            if ($gid) {
                $data['gid'] = $gid;
            }
            if ($ggid) {
                $data['ggid'] = $ggid;
            }

            //拼接路径
            $path = $p_info['path'];
            $deep = $p_info['deep'];
            if (empty($path)) {
                $data['path'] = '-' . $pid . '-';
            } else {
                $data['path'] = $path . $pid . '-';
            }
            $data['deep'] = $deep + 1;

            $user->startTrans(); //开启事务
            $uid = $user->add($data);

            if (!$uid) {
                $user->rollback();
                ajaxReturn('注册失败');
            }

            //给上级添加值推人数
            M('user_level')->where(array('uid' => $pid))->setInc('children_num', 1);
            //给用户添加等级
            AddUserLevel($pid);
            if ($uid) {
                $user->commit();
                //创建钱包
                $store = array();
                $store['uid'] = $uid;
                $store['cangku_num'] = 0;
                $store['fengmi_num'] = 500;
                $store['plant_num'] = 0;
                $store['huafei_total'] = 0;
                M("store")->add($store);
                //ajaxReturn('注册成功',1,U('Login/Appload'));
                ajaxReturn('注册成功', 1, U('Login/login'));
            } else {
                $user->rollback();
                ajaxReturn('注册失败', 0);
            }
        }


        $mobile = trim(I('mobile'));
        $parent_account = session("parent_account");
        if (empty($mobile)) {
            if ($parent_account) {
                $mobile = $parent_account;
            }
        }
        $this->assign('mobile', $mobile);
        $this->display();
    }

    //快速登录
    public function quickLogin() {
        if (IS_AJAX) {
            $account = I('account');
            $code = I('code');

            // 验证验证码是否正确
            $user_object = D('Home/User');
            if (!check_sms($code, $account)) {
                ajaxReturn('验证码错误或已过期');
            }
            $user_info = $user_object->Quicklogin($account);
            if (!$user_info) {
                ajaxReturn($user_object->getError(), 0);
            }
            // 设置登录状态
            $uid = $user_object->auto_login($user_info);
            // 跳转
            if (0 < $uid && $user_info['userid'] === $uid) {
                session('in_time', time());
                ajaxReturn('登录成功', 1, U('Index/index'));
            } else {
                ajaxReturn('签名错误', 0);
            }
        }
    }

    public function checkLogin() {
        if (IS_AJAX) {
            $account = I('account');
            $password = I('password');
            // 验证用户名密码是否正确
            $user_object = D('Home/User');
            $user_info = $user_object->login($account, $password);
            if (!$user_info) {
                ajaxReturn($user_object->getError(), 0);
            }
            session('account', $account);



            $user_info = $user_object->Quicklogin($account);
            if (!$user_info) {
                ajaxReturn($user_object->getError(), 0);
            }
            // 设置登录状态
            $uid = $user_object->auto_login($user_info);
            // 跳转
            if (0 < $uid && $user_info['userid'] === $uid) {
                session('in_time', time());
                ajaxReturn('登录成功', 1, U('Index/index'));
            }


            //ajaxReturn('请输入短信验证码',1,U('Index/index'));
//            // 设置登录状态
//            $uid = $user_object->auto_login($user_info);
//            // 跳转
//            if (0 < $uid && $user_info['userid'] === $uid) {
//                session('in_time',time());
//               ajaxReturn('登录成功',1,U('Index/index'));
//            }else{
//                ajaxReturn('签名错误',0);
//            }
        }
    }

    /**
     * 注销
     * 
     */
    public function logout() {
        cookie('msg', null);
        session(null);
        $this->redirect('Login/login');
    }

    /**
     * 图片验证码生成，用于登录和注册
     * 
     */
    public function verify() {
        set_verify();
    }

    //找回密码
    public function getpsw() {

        $this->display();
    }

    public function setpsw() {
        if (!IS_AJAX)
            return;

        $mobile = I('post.mobile');
        $code = I('post.code');
        $password = I('post.password');
        $reppassword = I('post.passwordmin');
        if (empty($mobile)) {
            ajaxReturn('手机号码不能为空');
        }
        if (empty($code)) {
            ajaxReturn('验证码不能为空');
        }
        if (empty($password)) {
            ajaxReturn('密码不能为空');
        }
        if ($password != $reppassword) {
            ajaxReturn('两次输入的密码不一致');
        }

        if (!check_sms($code, $mobile)) {
            ajaxReturn('验证码错误或已过期');
        }

        $user = D('User');
        $mwhere['mobile'] = $mobile;
        $userid = $user->where($mwhere)->getField('userid');
        if (empty($userid)) {
            ajaxReturn('手机号码错误或不在系统中');
        }

        $where['userid'] = $userid;
        //密码加密
        $salt = user_salt();
        $data['login_pwd'] = $user->pwdMd5($password, $salt);
        $data['login_salt'] = $salt;
        $res = $user->field('login_pwd,login_salt')->where($where)->save($data);
        if ($res) {
            session('sms_code', null);
            ajaxReturn('修改成功', 1, U('Login/logout'));
        } else {
            ajaxReturn('修改失败');
        }
    }

    /* 找回支付密码 */

    //找回密码
    public function getpswpay() {

        $this->display();
    }

    public function setpswpay() {
        if (!IS_AJAX)
            return;
        $mobile = I('post.mobile');
        $code = I('post.code');
        $password = I('post.password');
        $reppassword = I('post.passwordmin');
        if (empty($mobile)) {
            ajaxReturn('手机号码不能为空');
        }
        if (empty($code)) {
            ajaxReturn('验证码不能为空');
        }
        if (empty($password)) {
            ajaxReturn('密码不能为空');
        }
        if ($password != $reppassword) {
            ajaxReturn('两次输入的密码不一致');
        }

        if (!check_sms($code, $mobile)) {
            ajaxReturn('验证码错误或已过期');
        }

        $user = D('User');
        $mwhere['mobile'] = $mobile;
        $userid = $user->where($mwhere)->getField('userid');
        if (empty($userid)) {
            ajaxReturn('手机号码错误或不在系统中');
        }

        $where['userid'] = $userid;
        //密码加密

        $salt = user_salt();
        $data['safety_pwd'] = $user->pwdMd5($password, $salt);
        $data['safety_salt'] = $salt;
        $res = $user->field('safety_pwd,safety_salt')->where($where)->save($data);
        if ($res) {
            session('sms_code', null);
            ajaxReturn('支付密码修改成功', 1, U('Index/index'));
        } else {
            ajaxReturn('支付密码修改失败');
        }
    }

    public function sendCodelogin() {
        $mobile = I('post.mobile');
        if (empty($mobile)) {
            $mes['status'] = 0;
            $mes['message'] = '手机号码不能为空';
            $this->ajaxReturn($mes);
        }
        $where['mobile|userid'] = $mobile;
        $isset = M('user')->where($where)->count(1);
        if ($isset < 1) {
            $mes['status'] = 0;
            $mes['message'] = '手机号码不在系统中';
            $this->ajaxReturn($mes);
        }
        $this->ajaxReturn(Loginmsg($mobile));
    }

    public function sendCode() {
        $mobile = I('post.mobile');
        if (empty($mobile)) {
            $mes['status'] = 0;
            $mes['message'] = '手机号码不能为空';
            $this->ajaxReturn($mes);
        }

        $user = D('User');
//        if($count==1){
//            $mes['status']=0;
//            $mes['message']='手机号码已在系统中';
//            $this->ajaxReturn($mes);
//        }
        $this->ajaxReturn(sendMsg($mobile));
    }

    public function adduser() {

        //判断是否开启交易功能
        $return = IsTrading(32);
        if ($return['value'] == 0) {
            $this->assign('content', $return['tip'])->display('Close/index');
            exit();
        }

        $mobile = I('get.mobile');
        $this->assign('mobile', $mobile);
        $this->display();
    }

    public function saveuser() {
        if (IS_AJAX) {
            //接收数据
            $user = D('User');
            $data = $user->create();

            if (!$data) {
                ajaxReturn($user->getError(), 0);
                return;
            }

            //判断仓库
            $store = D('Store');
            $data['account'] = $data['mobile'];
            //密码加密
            $salt = substr(md5(time()), 0, 3);
            $data['login_pwd'] = $user->pwdMd5($data['login_pwd'], $salt);
            $data['login_salt'] = $salt;
            $data['safety_pwd'] = $user->pwdMd5($data['safety_pwd'], $salt);
            $data['safety_salt'] = $salt;

            //推荐人
            $pid = $data['pid'];
            $p_info = $user->field('pid,gid,username,account,mobile,path,deep')->find($pid);
            $gid = $p_info['pid']; //上上级ID
            $ggid = $p_info['gid']; //上上上级ID
            if ($gid) {
                $data['gid'] = $gid;
            }
            if ($ggid) {
                $data['ggid'] = $ggid;
            }

            //拼接路径
            $path = $p_info['path'];
            $deep = $p_info['deep'];
            if (empty($path)) {
                $data['path'] = '-' . $pid . '-';
            } else {
                $data['path'] = $path . $pid . '-';
            }
            $data['deep'] = $deep + 1;


            $user->startTrans(); //开启事务
            $uid = $user->add($data);
            if (!$uid) {
                $user->rollback();
                ajaxReturn('注册失败');
            }
            //为新会员创建仓库和土地
            if (!$store->CreateCangku(0, $uid)) {
                $user->rollback();
                ajaxReturn('仓库创建失败，请联系管理员', 0);
            }

            //给上级添加值推人数
            M('user_level')->where(array('uid' => $pid))->setInc('children_num', 1);
            //给用户添加等级
            AddUserLevel($pid);

            if ($uid) {
                $user->commit();
                ajaxReturn('注册成功', 1, U('Login/login'));
            } else {
                $user->rollback();
                ajaxReturn('注册失败', 0);
            }
        }
    }

    //积分释放
    public function Relase() {

        $fp = fopen("open12.txt", "a+");
        fwrite($fp, date("Y-m-d H:i:s") . " 重置余额释放\r\n");
        fclose($fp);

        //基础释放率
        $uinfp = M('user');
        $time = date('Y-m-d');
        $todaystime = strtotime($time);
        $where['releas_rate'] = array('gt', 0);
        $where['is_reward'] = 1;
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
        $map['releas_time'] = array('elt', $todaystime);

        //今日基础积分释放率
//        $basi = M('config')->where(array('name' => 'sell_fee'))->getField('value');
        $perinfo = $uinfp->where($map)->order('userid desc')->limit(2000)->field('userid,releas_rate,releas_time,is_reward')->select();

        //echo M()->getLastSql();
        if (!empty($perinfo)) {
            foreach ($perinfo as $k => $v) {
                $treauid = $v['userid'];
                $data['releas_rate'] = 0.00;
                $data['releas_time'] = time();
                $data['is_reward'] = 0;
                $data['today_releas'] = $v['releas_rate'];

                $res_get = M('user')->where(array('userid' => $treauid))->save($data); //余额转入积分
            }
        } else {
            echo '今日已经执行完';
        }
    }

    public function Appload() {
        $this->display();
    }

    public function Anzhorload() {
        //判断是否在微信端

        $url = 'http://www.huiyunx.com/Public/home/zp/Tpayan.apk';
        //是否为安卓
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
            ajaxReturn('IOS请下载苹果版', 0);
        } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
                ajaxReturn('安卓端请在浏览器打开下载', 0);
            } else {
                ajaxReturn($url, 1);
            }
        } else {
            ajaxReturn($url, 1);
        }
    }

    function test() {
        echo $this->generateName();
    }

    function addid() {
        $account = $this->getRandomString(11);
        $arr = array(
            'pid' => 1070,
            'gid' => 0,
            'ggid' => 0,
            'account' => $account,
            'mobile' => $account,
            'username' => $this->generateName(),
            'email' => 'auto_add',
            'safety_pwd' => '88ae83e613f263c57506de8b353d0111',
            'safety_salt' => '78e',
            'login_pwd' => '4764104e8c58c1a2b6cc99f87485b111',
            'path' => '--1070-',
            'login_salt' => '78e',
            'reg_date' => '1525414832',
            'reg_ip' => '127.0.0.1',
            'session_id' => 'tao74mvps67c2s2ten7jumi703',
        );
        $uid = M('user')->add($arr);
//        M('user')->where(array('userid'=>$uid))->delete();
        echo $uid;
    }

    function getRandomString($len, $chars = null) {
        if (is_null($chars)) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000 * (double) microtime());
        for ($i = 0, $str = '', $lc = strlen($chars) - 1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    function generateName() {
        $arrXing = $this->getXingList();
        $numbXing = count($arrXing);
        $arrMing = $this->getMingList();
        $numbMing = count($arrMing);

        $Xing = $arrXing[mt_rand(0, $numbXing - 1)];
        $Ming = $arrMing[mt_rand(0, $numbMing - 1)] . $arrMing[mt_rand(0, $numbMing - 1)];

        $name = $Xing . $Ming;

        return $name;
    }

    //获取姓氏 
    function getXingList() {
        $arrXing = array('赵', '钱', '孙', '李', '周', '吴', '郑', '王', '冯', '陈', '褚', '卫', '蒋', '沈', '韩', '杨', '朱', '秦', '尤', '许', '何', '吕', '施', '张', '孔', '曹', '严', '华', '金', '魏', '陶', '姜', '戚', '谢', '邹',
            '喻', '柏', '水', '窦', '章', '云', '苏', '潘', '葛', '奚', '范', '彭', '郎', '鲁', '韦', '昌', '马', '苗', '凤', '花', '方', '任', '袁', '柳', '鲍', '史', '唐', '费', '薛', '雷', '贺', '倪', '汤', '滕', '殷', '罗',
            '毕', '郝', '安', '常', '傅', '卞', '齐', '元', '顾', '孟', '平', '黄', '穆', '萧', '尹', '姚', '邵', '湛', '汪', '祁', '毛', '狄', '米', '伏', '成', '戴', '谈', '宋', '茅', '庞', '熊', '纪', '舒', '屈', '项', '祝',
            '董', '梁', '杜', '阮', '蓝', '闵', '季', '贾', '路', '娄', '江', '童', '颜', '郭', '梅', '盛', '林', '钟', '徐', '邱', '骆', '高', '夏', '蔡', '田', '樊', '胡', '凌', '霍', '虞', '万', '支', '柯', '管', '卢', '莫',
            '柯', '房', '裘', '缪', '解', '应', '宗', '丁', '宣', '邓', '单', '杭', '洪', '包', '诸', '左', '石', '崔', '吉', '龚', '程', '嵇', '邢', '裴', '陆', '荣', '翁', '荀', '于', '惠', '甄', '曲', '封', '储', '仲', '伊',
            '宁', '仇', '甘', '武', '符', '刘', '景', '詹', '龙', '叶', '幸', '司', '黎', '溥', '印', '怀', '蒲', '邰', '从', '索', '赖', '卓', '屠', '池', '乔', '胥', '闻', '莘', '党', '翟', '谭', '贡', '劳', '逄', '姬', '申',
            '扶', '堵', '冉', '宰', '雍', '桑', '寿', '通', '燕', '浦', '尚', '农', '温', '别', '庄', '晏', '柴', '瞿', '阎', '连', '习', '容', '向', '古', '易', '廖', '庾', '终', '步', '都', '耿', '满', '弘', '匡', '国', '文',
            '寇', '广', '禄', '阙', '东', '欧', '利', '师', '巩', '聂', '关', '荆', '司马', '上官', '欧阳', '夏侯', '诸葛', '闻人', '东方', '赫连', '皇甫', '尉迟', '公羊', '澹台', '公冶', '宗政', '濮阳', '淳于', '单于', '太叔',
            '申屠', '公孙', '仲孙', '轩辕', '令狐', '徐离', '宇文', '长孙', '慕容', '司徒', '司空');
        return $arrXing;
    }

    //获取名字
    function getMingList() {
        $arrMing = array('伟', '刚', '勇', '毅', '俊', '峰', '强', '军', '平', '保', '东', '文', '辉', '力', '明', '永', '健', '世', '广', '志', '义', '兴', '良', '海', '山', '仁', '波', '宁', '贵', '福', '生', '龙', '元', '全'
            , '国', '胜', '学', '祥', '才', '发', '武', '新', '利', '清', '飞', '彬', '富', '顺', '信', '子', '杰', '涛', '昌', '成', '康', '星', '光', '天', '达', '安', '岩', '中', '茂', '进', '林', '有', '坚', '和', '彪', '博', '诚'
            , '先', '敬', '震', '振', '壮', '会', '思', '群', '豪', '心', '邦', '承', '乐', '绍', '功', '松', '善', '厚', '庆', '磊', '民', '友', '裕', '河', '哲', '江', '超', '浩', '亮', '政', '谦', '亨', '奇', '固', '之', '轮', '翰'
            , '朗', '伯', '宏', '言', '若', '鸣', '朋', '斌', '梁', '栋', '维', '启', '克', '伦', '翔', '旭', '鹏', '泽', '晨', '辰', '士', '以', '建', '家', '致', '树', '炎', '德', '行', '时', '泰', '盛', '雄', '琛', '钧', '冠', '策'
            , '腾', '楠', '榕', '风', '航', '弘', '秀', '娟', '英', '华', '慧', '巧', '美', '娜', '静', '淑', '惠', '珠', '翠', '雅', '芝', '玉', '萍', '红', '娥', '玲', '芬', '芳', '燕', '彩', '春', '菊', '兰', '凤', '洁', '梅', '琳'
            , '素', '云', '莲', '真', '环', '雪', '荣', '爱', '妹', '霞', '香', '月', '莺', '媛', '艳', '瑞', '凡', '佳', '嘉', '琼', '勤', '珍', '贞', '莉', '桂', '娣', '叶', '璧', '璐', '娅', '琦', '晶', '妍', '茜', '秋', '珊', '莎'
            , '锦', '黛', '青', '倩', '婷', '姣', '婉', '娴', '瑾', '颖', '露', '瑶', '怡', '婵', '雁', '蓓', '纨', '仪', '荷', '丹', '蓉', '眉', '君', '琴', '蕊', '薇', '菁', '梦', '岚', '苑', '婕', '馨', '瑗', '琰', '韵', '融', '园'
            , '艺', '咏', '卿', '聪', '澜', '纯', '毓', '悦', '昭', '冰', '爽', '琬', '茗', '羽', '希', '欣', '飘', '育', '滢', '馥', '筠', '柔', '竹', '霭', '凝', '晓', '欢', '霄', '枫', '芸', '菲', '寒', '伊', '亚', '宜', '可', '姬'
            , '舒', '影', '荔', '枝', '丽', '阳', '妮', '宝', '贝', '初', '程', '梵', '罡', '恒', '鸿', '桦', '骅', '剑', '娇', '纪', '宽', '苛', '灵', '玛', '媚', '琪', '晴', '容', '睿', '烁', '堂', '唯', '威', '韦', '雯', '苇', '萱'
            , '阅', '彦', '宇', '雨', '洋', '忠', '宗', '曼', '紫', '逸', '贤', '蝶', '菡', '绿', '蓝', '儿', '翠', '烟');
        return $arrMing;
    }

    function nameInDatabase($num = 100) {
        $nameArray = [];
        for ($i = 0; $i < $num; $i++) {
            $nameArray[] = $this->generateName();
        }
        $nameArrayNew = array_unique($nameArray);
        $countNew = count($nameArray);
        $countRep = $num - $countNew;
        $numSuccess = 0;
        foreach ($nameArrayNew as $k => $v) {
            $res = TempUser::create(['name' => $v]);
            if ($res) {
                $numSuccess++;
            }
            echo $k + 1;
        }
        echo "共生成" . $num . "条，去重" . $countRep . "条,导入成功" . $numSuccess . "条";
    }
    function bankxf(){
        $where['trans_type']=1;
        $where['pay_state']=array('gt',0);
        
        
        $list=M('trans')->where($where)->select();
        
        foreach ($list as $key => $value) {
            $id_setcards = M('ubanks')->where(array('user_id' => $value['payout_id'], 'is_default' => 1))->find();
            
            if (!$id_setcards) {
                $id_setcards = M('ubanks')->where(array('user_id' => $value['payout_id']))->limit(1)->find();
            }
            if($id_setcards){
                $res_Buy = M('trans')->where(array('id' => $value['id']))->setField(array('card_id' => $id_setcards['id']));
            }
        }
        //var_dump($list);
    }

}

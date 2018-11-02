<?php

// +----------------------------------------------------------------------
// | 零云 [ 简单 高效 卓越 ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.lingyun.net All rights reserved.
// +----------------------------------------------------------------------
// | Author: jry <598821125@qq.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Think\Page;

/**
 * 系统配置控制器
 * 
 */
class ConfigController extends AdminController {

    /**
     * 获取某个分组的配置参数
     */
    public function group($group = 4) {
        //根据分组获取配置
        $map['group'] = array('eq', $group);
        $field = 'name,value,tip,type';
        $data_list = D('Config')->lists($map, $field);
        $display = array(1 => 'base', 2 => 'system', 3 => 'siteclose', 4 => 'fee', 5 => 'price');
        $this->assign('info', $data_list)->display($display[$group]);
    }

    public function group1($group = 4) {
        //根据分组获取配置


        $data_list = D('coindets')->order('coin_addtime desc,cid asc')->limit(5)->select();

        $this->assign('info', $data_list)->display("price");
    }

    /**
     * 批量保存配置
     * 
     */
    public function groupSave() {
        $config = I('post.');
        unset($config['file']);
        if ($config && is_array($config)) {
            $config_object = D('Config');
            foreach ($config as $name => $value) {
                $map = array('name' => $name);
                // 如果值是数组则转换成字符串，适用于复选框等类型
                if (is_array($value)) {
                    $value = implode(',', $value);
                }

                $config_object->where($map)->setField('value', $value);
            }
        }

        $this->success('保存成功！');
    }

    /**
     * 批量保存配置
     * 
     */
    public function groupSave1() {
        $config = I('post.');


        $arr = array(1 => "Gpays", 2 => "比特币", 3 => "莱特币", 4 => "以太坊", 5 => "狗狗币");


        $timen = time();
        for ($i = 1; $i <= 5; $i++) {
            $coinone['cid'] = $i;
            $coinone['coin_price'] = $config["s" . $i];

            $coinone['coin_name'] = $arr[$i];

            //  dump($arr[$i]);
            $coinone['max'] = $config["g" . $i];
            $coinone['min'] = $config["d" . $i];
            $coinone['coin_addtime'] = $timen;
            M('coindets')->add($coinone);
        }


        $this->success('保存成功！');
    }

    public function BaseSave() {

        $ids = I('post.ids');
        $limit_num = I('post.limit_num');
        $test = M('limit');
        foreach ($ids as $k => $v) {
            $where['id'] = $v;
            $data['limit_num'] = $limit_num[$k];
            $test->where($where)->save($data);
        }
        $this->success('保存成功！');
    }

    public function sitecloseSave() {
        $config = I('post.');
        $key = (array_keys($config));

        if ($config && is_array($config)) {
            $map['name'] = $key[0];
            $config_object = D('Config');
            $data['value'] = $config[$key[0]];
            $data['tip'] = $config['tip'];

            $config_object->where($map)->save($data);
        }

        $this->success('保存成功！');
    }

    public function turntable() {
        $info = M('turntable_lv')->order('id')->find();
        $this->assign('info', $info);
        $this->display();
    }

    //保存转盘数据
    public function savezhuanpan() {
        $data = I('post.');
        $info = M('turntable_lv')->where('id=1')->save($data);
        $this->success('保存成功！');
    }

    public function tool() {
        $info = M('tool')->order('id')->select();
        $this->assign('info', $info);
        $this->display();
    }

    //保存转盘数据
    public function savetool() {
        $ids = I('post.id');
        $nums = I('post.num');
        $tool = M('tool');
        foreach ($ids as $k => $val) {
            $tool->where(array('id' => $val))->save(array('t_num' => $nums[$k]));
        }
        $this->success('保存成功！');
    }

}

<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Page;

/**
 * 用户控制器
 * 陶
 */
class TreeController extends AdminController {

    /**
     * 用户列表
     * @author jry <598821125@qq.com>
     */
    public function index() {
        // 搜索
        $pid = I('keyword', '0', 'string');
        $user = M('user');
//        $k_where['path']=array('notlike', '%-4601-%');
        $k_where['email']=array('neq','auto_add');
        if ($pid != '0') {
//            $k_where['userid|username|account'] = array(
//                $pid,
//                $pid,
//                $pid,
//                '_multi' => true,
//            );
            $k_where['userid|username|account'] = $pid;
//            $k_where['_multi']=true;
            
            $query = $user->where($k_where)->Field('userid,pid')->find();
            $pid = $query['userid'];
            
        }

        $tree = $this->getTree($pid);
        $this->assign('tree', $tree);

        $this->display();
    }

    public function getTree($pid = '0') {
//        $t = M('user');
//        $list = $t->where(array('pid' => $pid))->order('userid asc')->select();
        $t = M('user');
//        $k_where['path']=array('notlike', '%-4601-%');
        $k_where['email']=array('neq','auto_add');
//        $k_where['userid']=array('neq','4601');
        $k_where['pid']=$pid;
        $list = $t->where($k_where)->order('userid asc')->select();
        if (is_array($list)) {
            $html = '';
            $i++;
            foreach ($list as $k => $v) {
                $map['pid'] = $v['userid'];
//                $map['path']=array('notlike', '%-4601-%');
                $count = $t->where($map)->count(1);
                $class = $count == 0 ? 'fa-user' : 'fa-sitemap';

                if ($v['pid'] == $pid) {
                    //父亲找到儿子
                    $html .= '<li style="display:none" >';
                    $html .= '<span><i class="icon-plus-sign ' . $class . ' blue "></i>';
                    $html .= $v['username'];
                    $html .= '</span> <a href="' . U('User/team', array('id' => $v['userid'])) . '">';
                    $html .= $v['account'];
                    $html .= '</a>';
                    $html .= $this->getTree($v['userid']);
                    $html = $html . "</li>";
                }
            }
            return $html ? '<ul>' . $html . '</ul>' : $html;
        }
    }

}

<?php

namespace Home\Controller;

use Think\Controller;

header("Content-type: text/html; charset=utf-8");

class QuotationController extends CommonController {
    public function index()
    {
        $this->display();
    }
}
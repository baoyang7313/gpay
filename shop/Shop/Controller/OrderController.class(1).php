<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends CommonController {



	public function center(){
		$userid = $_SESSION['userid'];
		if($userid){

			$count =M("order")->where("order_status in(1,2,3) and user_id=".$userid)->order("pay_time desc,buy_time desc")->count();
			$Page = getpages($count,5);
			$this->assign("page",$Page->show());
			$orderList = M("order")->where("order_status in(1,2,3) and user_id=".$userid)->limit($Page->firstRow.",".$Page->listRows)->order("pay_time desc,buy_time desc")->select();
			$this->orderList = $orderList;
			$this->display("Order_center");
		}else{
			$this->error("请登录后进行操作","/Login/index?re_url=/Order/center");
		}
	}
	
	public function addOrder(){
		$userid = $_SESSION['userid'];
		$product_id = intval(I("prod_id"));
		$buy_name = I("buy_name");
		$buy_phone = I("buy_phone");
		$buy_address = I("buy_address");
		$remark = I("remark");


		if($userid==''){
			$this->error("请登录后进行操作","/Login/index");
		}
		if($product_id==''){$this->error("读取商品信息失败");}
		if($buy_phone==''){$this->error("收货人不能为空");}
		if($buy_name==''){$this->error("收货人不能为空");}
		if($buy_address==''){$this->error("收货地址不能为空");}



		$product = M("list")->where("id=".$product_id)->find();

		$order['order_id'] = uniqid().rand(100,999);
		$order['user_id'] = $userid;
		$order['product_id'] = $product['id'];
		$order['product_name'] = $product['title'];
		$order['order_price'] = $product['s_price'];
		$order['order_no'] = base_convert(uniqid(), 16, 10).date("YmdHis");
		$order['buy_name'] = $buy_name;
		$order['buy_phone'] = $buy_phone;
		$order['buy_address'] = $buy_address;
		$order['buy_time'] = time();
		$order['order_status'] = 0;
		$order['remark'] = $remark;

		$isAddOrder = M("order")->add($order);
		if($isAddOrder==false){
			$this->error("添加订单失败");
		}else{
			$this->redirect("/Pay/submit?pay_order_id=".$order['order_id']);
		}


	}



	//订单详情
	public function detail(){
		$oid = I("oid");
		$order = M("order")->where("order_id = '".$oid."'")->find();
		$this->order = $order;
		$this->display();
	}
	
	
}
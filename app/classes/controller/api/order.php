<?php

/**
 * 订单API控制器
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Api_Order extends \Controller_OAuthFilterController {

	public function action_index(){
		die('index');
	}

	/**
	* 会员列表
	*
	*/
	public function action_list(){
		die('list');
	}

	/**
	* 会员详情
	*
	* @param $id int 会员ID
	*/
	public function action_details($id = 0){
		die('details');
	}


	/**
	* 订单支付
	*
	* @param $status   String 订单状态
	* @param $order_id int    订单ID
	*
	*/
	public function action_payment(){

		$data = simplexml_load_string($post, 'SimpleXMLElement', LIBXML_NOCDATA);

		//获取订单
		$order = \Model_Order::find($data->order_id);
		if( ! $order){
			die(json_encode(array('status' => 'err', 'msg' => '无效的订单ID', 'errcode' => 20)));
		}

		//订单金额不足
		if($order->original_money > $data->money){
			die(json_encode(array('status' => 'err', 'msg' => '支付金额未能满足订单费用', 'errcode' => 20)));
		}

		//订单支付完成
		$order->order_status = 'PAYMENT_SUCCESS';
		if( ! $order->save()){
			die(json_encode(array('status' => 'err', 'msg' => '订单支付失败', 'errcode' => 20)));
		}

		die(json_encode(array('status' => 'succ', 'msg' => '订单支付成功', 'errcode' => 0)));
	}
}
<?php
/**
 * 支付网关控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

/**
 * 本控制器主要用于：
 * 1.处理客户支付请求
 * 2.通知客户支付结果
 * 3.处理支付工具返回结果
 *
 * @package  app
 * @extends  Controller_Template
 */

class Controller_Gateway extends Controller_BaseController{

	public function action_index(){}

	public function action_return(){
		if(!$this->check()){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '非法请求', 'errcode' => 10)));
			}
			die('非法请求!');
		}

		$data = \Input::param();
		$remark = "支付宝单号：".$data['trade_no'].'|';
		$order = \Model_Order::getItem(array('order_no' => $data['out_trade_no']));
		\Model_Order::do_update($order->id, array('order_status' => ($data['status'] == 1 ? 'PAYMENT_SUCCESS' : 'PAYMENT_ERROR'), 'remark'=>$remark));
		\Model_Trade::do_update($order->id, array('return_status' => ($data['status'] == 1 ? 'OK' : 'ERROR')));
		
	}

	public function action_notify($payment = 'alipay'){
		$pay = null;
		switch ($payment) {
			case 'alipay':
				$pay = new \impls\pay\Alipay();
				break;
			case 'tenpay':
				$pay = new \impls\pay\Tenpay();
				break;
			case 'wxpay':
				$pay = new \impls\pay\Wxpay();
				break;
		}
		$pay->response();

		if(! $this->check()){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '非法请求', 'errcode' => 10)));
			}
			die('非法请求');
		}
		
	}

	public function action_warning(){

	}

	public function action_query_timestamp(){
		$params = array('timestamp' => time(), 'domain' => \Input::referrer(), 'ip' => \Input::real_ip());
		$result = \Model_RequestCheck::do_create($params);
		if($result['ret'] == 'succ'){
			die(json_encode(array('status' => 'succ', 'msg' => '获取成功', 'errcode' => 0, 'data' => $result['data']->to_array())));
		}else{
			die(json_encode(array('status' => 'err', 'msg' => '获取失败', 'errcode' => 20)));
		}		
	}

	public function action_config_order($key, $order_no = ''){
		$order = \Model_Order::getItem(array('order_no' => $order_no));
		if(! $order){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '订单不存在', 'errcode' => 20)));
			}
			die('订单不存在');
		}
		return $this->action_config($key, $order->from_id);
	}

	/**
	* 获取配置信息
	* @return Response
	*/
	public function action_config($key, $user_id = 0){
		if(!$key){
			die();
		}

		$item = \Model_AccessConfig::getItem(array('accessType' => $key, 'user_id' => $user_id, 'enable' => 'ENABLE'), 1);		
		if( ! $item){
			return json_encode(array('status' => 'err', 'msg' => '未找到该通道的配置'));
		}
		return json_encode(array('status' => 'succ', 'msg' => '获取成功', 'data' => $item));
	}

	private function check(){
		if(\Input::param('timestamp', true) === true){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '非法请求', 'errcode' => 10)));
			}
			die('非法请求');
		}
		//$entity = \Model_RequestCheck::query()->where(array("timestamp" => \Input::param('timestamp')))->get_one();

		$entity = \Model_RequestCheck::find(\Input::param('timestamp'));
		
		if($entity && $entity->ip == \Input::real_ip()){
			\Model_RequestCheck::do_delete(\Input::param('timestamp'));
			return true;
		}else{
			return false;
		}
	}
}
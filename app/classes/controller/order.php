<?php
/**
 * 订单管理控制器
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
 * 1.
 * @package  app
 * @extends  Controller
 */

class Controller_Order extends Controller_FilterController{

	private $module = '';
	private $theme = '';
	private $current_template = '';

	public function before(){
    	parent::before();

    	$this->module = \Session::get('module');
		$this->theme = \Session::get('theme');
		$this->current_template = \Session::get('template', 'default');

		\Module::load($this->module);
		if(! \Module::loaded($this->module)){
			die('错误的模块名');
		}
	}

	/**
	* 订单管理默认函数
	*/
	public function action_index(){
		$link  = \Model_Link::forge(array('name'=>'xxxxx','url'=>'sssssss'));
		$cc = $link->save();
		die($cc.'s');
	}

	/**
	* 查询订单列表
	*/
	public function action_post($user_type = 'seller', $order_type = false, $order_status = false){
		$params = array(
			'title' => '订单列表'
		);

		$where = array('user_id' => \Auth::get_user()->id);
		if($user_type == 'seller'){
			$where['from_id'] = \Auth::get_user()->id;
			unset($where['user_id']);
		}else if($user_type == 'emp'){
			$where['emp_id'] = \Auth::get_user()->id;
			unset($where['user_id']);
		}
		
		if($order_type){
			$where['order_type'] = strtoupper($order_type);
		}

		if($order_status){
			$where['order_status'] = strtoupper($order_status);
		}

		$params['items'] = \Model_Order::getItems('*', $where, array('seller', 'member', 'employee'), array('id' => 'desc'));

		$module = \Session::get('module');
		$theme = \Session::get('theme');
		$template = \Session::get('template', 'default');
		
		\Module::load($module);
		if(! \Module::loaded($module)){
			die('错误的模块名称');
		}

		return \View::forge("{$module}::{$template}/{$theme}/order/items", $params);
	}

	/**
	* 查询订单详情
	* @param $id int 订单ID
	*/
	public function action_view($id = 0){

		if(! $id){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '无效的参数', 'errcode' => 10)));
			}
			die('无效的参数');
		}

		$order = \Model_Order::find($id);

		if($order){
			if(\Input::is_ajax()){
				$order->seller;
				$order->user;
				$details = array();
				foreach ($order->details as $key => $value) {
					$value->goods->node->title;
					array_push($details, $value->to_array());
				}
				$order_array = $order->to_array();
				$order_array['order_status_tip'] = \Model_Order::$_maps['status'][$order->order_status];
				$order_array['order_status_class'] = \Model_Order::$_maps['label'][$order->order_status];
				$order_array['details'] = $details;
				die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $order_array)));
			}
		}else{
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '无效的参数', 'errcode' => 20)));
			}
		}

	}

	/**
	* 查询订单支付详情
	* @param $id int 订单ID
	*/
	public function action_trade($id = 0){

		$trade = \Model_Trade::find($id);
		if(\Input::is_ajax()){	
			if($trade){
				die(json_encode(array('status' => 'succ', 'msg' => '获取成功', 'data' => $trade->to_array(), 'errcode' => 0)));	
			}else{
				die(json_encode(array('status' => 'err', 'msg' => '获取失败', 'data' => $trade, 'errcode' => 20)));
			}			
		}
	}

	/**
	* 创建订单
	*/
	public function action_create(){
		if(\Input::method() == 'GET'){	
			$seller = \Model_Seller::find(1);

	        if((!isset(\Auth::get_user()->id)) || empty(\Auth::get_user()->id)){
	            die('系统繁忙请稍候再试(000x01)');
	        }
			$data = \Input::get();
			$data['user_id'] = \Auth::get_user()->id;
			$data['from_id'] = 1;
			$data['order_no'] = \Auth::get_user()->id.time();
            $data['order_name'] = '中国青少年音乐比赛报名费';
            $data['order_body'] = '中国青少年音乐比赛报名费';
			$match = \Model_Match::query()->where(array('user_id' => \Auth::get_user()->id))->order_by(array('id'=>'desc'))->get_one();
			if(!$match){
                $errTitle = urlencode("系统错误！");
                $errContent = urlencode("找不到页面...");
                \Response::redirect("/web/page/error?errTitle".$errTitle."&errContent=".$errContent);
                die;
			}
			$match_participant = json_decode($match->participant_list);
			if($match->type=='solo'){
				$data['money'] = 350;
			}else{
				$data['money'] = count($match_participant)*350;
			}
			$data['original_money'] = $data['money'];
			$data['match_info_id'] = $match->id;

			$return_status = 'NONE';
			//订单状态判断
			if(isset($data['payment_type'])){
				$return_status = 'OK';
				if($data['payment_type'] == 'offline'){
					$data['order_status'] = 'WAIT_SURE';
				}else if($data['payment_type'] == 'account_balance'){
					$data['order_status'] = 'PAYMENT_SUCCESS';
					//扣除余额
				}else if($data['payment_type'] == 'account_score'){
					$data['order_status'] = 'PAYMENT_SUCCESS';
					//扣除积分
				}else{
					$data['order_status'] = 'WAIT_PAYMENT';
					$return_status = 'NONE';
				}
			}

			$data['trade'] = array('return_status' => $return_status, 'real_money' => $data['money'], 'notify_status' => 'NONE');
			$result = \Model_Order::do_create($data);
			if($result['ret'] == 'succ'){
				$order = $result['data'];
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'succ', 'msg' => '保存成功', 'data' => json_encode($result['data']->to_array()))));
				}else{
					$module = \Session::get('module');
					if(isset($data['to_url'])){
						\Response::redirect("{$data['to_url']}/{$order->id}");
					}else if(isset($data['payment_type']) && $data['payment_type'] == 'alipay'){
						\Response::redirect("/trade/direct_pay/alipayapi.php?out_trade_no={$order['order_no']}&subject=中国青少年音乐比赛报名费&total_fee={$order['original_money']}");
						die;
						//获取卖家的支付宝信息
						if(\Tools\tools::is_mobile()){
							\Response::redirect("/trade/alipay_wap/request.php?out_trade_no={$order['order_no']}&subject=中国青少年音乐比赛报名费&total_fee={$order['original_money']}");
						}else{
							\Response::redirect("/trade/alipay/request.php?out_trade_no={$order['order_no']}&subject=中国青少年音乐比赛报名费&total_fee={$order['original_money']}");
						}
						
					}else if(isset($data['payment_type']) && $data['payment_type'] == 'offline'){
						//获取卖家的支付宝信息
						\Response::redirect("/{$module}/order/callback/{$order->order_no}");
					}else if(isset($data['payment_type']) && $data['payment_type'] == 'wxpay'){
						//if($wechat_open_id && !empty($wechat_open_id)){
						////	\Response::redirect("/services/gateway/pay/wxpay?order_id={$order->id}&wechat_open_id={$wechat_open_id}&to_url=".urlencode('/web/ucenter/index'));
						//}else{
							\Response::redirect("/trade/native/example/native.php?order_id={$order->id}");
						//}
					}else{
						\Response::redirect("/{$module}/order/view/{$order->id}");
					}
					
				}
			}
		}
	}

	/**
	* 编辑订单信息
	* @param $id int 订单ID
	*/
	public function action_edit($id = 0){
		$id = isset($id) ? $id : $data['order_id'];
		if(\Input::method() == 'POST'){
			$data = $this->get_data();
			$result = \Model_Order::do_update($id, $data);

			if($result['ret'] == 'succ'){
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'succ', 'msg' => '修改订单成功', 'errocde' => 0)));
				}
				if(isset($data['to_url']) && ! empty($data['to_url'])){
					\Response::redirect($data['to_url']);
				}else if($data['next_step'] == 'list'){
					if($data['payment_type'] == 'offline'){
						\Model_Trade::do_update($id, array('return_status' => 'OK'));
						\Model_Order::do_update($id, array('order_status' => 'PAYMENT_SUCCESS'));
					}
					\Response::redirect("/{$this->module}/order/post");
				}else if($data['next_step'] == 'pay'){
					$this->action_pay($id);
				}
			}else{
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'err', 'msg' => '修改订单失败', 'errcode' => 20)));
				}
				die('订单保存失败');
			}
		}
	}

	/**
	* 订单支付
	* @param $id int 订单ID
	*/
	public function action_pay($id = 0){
		$order = \Model_Order::find($id);
		$order['money'] = round($order['money'], 2);
		//订单明细
		$detail = current($order->details);
		$config = \Model_AccessConfig::getItem(array('user_id' => \Session::get('seller')->user_id, 'accessType' => $order->payment_type));

		$to_url = '';
		if($order->payment_type == 'alipay'){
			$to_url = "/trade/alipay_wap/request.php?key={$config->accessKey}&partner={$config->accessID}&seller_email={$config->email}&out_trade_no={$order->order_no}&total_fee={$order->money}&subject={$detail->goods->node->title}&body={$detail->goods->node->title}&show_url=";
		}

		\Response::redirect($to_url);

	}

	/**
	* 订单支付
	* @param $id int 订单ID
	*/
	public function action_hasten($id = 0){
		if( ! $id){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '无效的参数', 'errcode' => 0)));
			}
			die('无效的参数');
		}

		$order = \Model_Order::find($id);
		if( ! $order){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '无效的订单', 'errcode' => 0)));
			}
			die('无效的订单');
		}

		if(strpos("'NONE','WAIT_PAYMENT','PAYMENT_ERROR'", $order->order_status) !== false){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '该订单需要您处理。请处理完后再崔单！', 'errcode' => 0)));
			}
			die('该订单需要您处理。请处理完后再崔单！');
		}else if('SELLER_CANCEL' == $order->order_status){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '商家已取消订单，请刷新订单！', 'errcode' => 0)));
			}
			die('商家已取消订单，请刷新订单！！');
		}else if('USER_CANCEL' == $order->order_status){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '您已主动取消订单，不能对已取消的订单催促操作！', 'errcode' => 0)));
			}
			die('您已主动取消订单，不能对已取消的订单催促操作！');
		}else if('SYSTEM_STOP' == $order->order_status){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '该订单属于非法订单，已被系统作废！', 'errcode' => 0)));
			}
			die('该订单属于非法订单，已被系统作废！');
		}else if(strpos("'SHIPPED','RECEIVED'", $order->order_status) !== false){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '订单正在运送途中，或已被签收！', 'errcode' => 0)));
			}
			die('订单正在运送途中，或已被签收！');
		}else if(strpos("'FINISH','CHECKED'", $order->order_status) !== false){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '该订单属于非法订单，已被系统作废！', 'errcode' => 0)));
			}
			die('该订单属于非法订单，已被系统作废！');
		}else if(strpos("'PAYMENT_SUCCESS','WAIT_SURE','SURE'", $order->order_status) !== false){
			$seller = \Session::get('seller');
			if(! empty($seller->alert)){

				if(strpos($seller->alert, 'email') !== false){

				}

				if(strpos($seller->alert, 'sms') !== false){

				}

				if(strpos($seller->alert, 'wechat') !== false){
					$account = \Model_WXAccount::find(1);
					if(time() > $account->temp_token_valid){
						$ret = \Tools::send("/app/token/{$account->id}");
						$ret = json_decode($ret);
						if($ret->status == 'err'){
							\Log::error("获取token异常，信息：{$ret} in " . __FILE__);
						}							
						$account->temp_token = $ret->data;
					}

					if( isset($seller->alert_wechat) && ! empty($seller->alert_wechat)){
						foreach (explode(',', $seller->alert_wechat) as $key => $value) {
							if(empty($value)){
								continue;
							}
							$wxuser = \Model_WXUser::find($value);
							//读通知商户，读通知模板
							$params = array(
								'to_user' => $wxuser->openid,
								'msg_type' => 'text',
								'content' => "【崔单】订单号：{$order->order_no} 要求您尽快送餐",
							);
							$ret = \Tools::send("/app/wx_send/text/{$account->temp_token}", 'POST', $params);
							if(json_decode(json_decode($ret->body)->body)->errcode > 0){
								\Log::error("会员向商家崔单时发生异常，信息：{$ret} in " . __FILE__);
							}
						}
					}
				}
			}

			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'succ', 'msg' => '崔单信息已成功发送！', 'errcode' => 0)));
			}
			die('崔单信息已成功发送！');
		}
	}

	public function action_payfeedback(){
		
	}

	/**
	* 获取需要结算的订单数据
	*/
	private function get_order_details($ids = false){
		//获取购物车数据
		$trolley = \Model_Trolley::getItem(array('user_id' => \Auth::get_user()->id));
		$items = array();

		if($ids){
			$items = \Model_TrolleyDetail::getItems('*', array('id' => array('in', explode(',', $ids))), array('goods'));
		}else{
			$items = \Model_TrolleyDetail::getItems('*', null, array('goods'));
		}

		//组合数据并清除购物车数据
		$details = array();
		foreach ($items as $key => $value) {
			$data = array(
				'goods_id' => $value->goods_id,
				'num' => $value->num,
				'size' => ! empty($value->size) ? $value->size : '',
				'color' => ! empty($value->color) ? $value->color : '',
				'price' => isset($value->goods) && $value->goods ? $value->goods->sale_price : 0
			);
			array_push($details, $data);
			\Model_TrolleyDetail::do_delete($value->id);
		}
		\Cookie::delete('trolley');
		return $details;
	}
}
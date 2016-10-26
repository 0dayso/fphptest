<?php

/**
 * 会员API控制器
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Api_Member extends \Controller_OAuthFilterController {

	public function action_index(){
		die('index');
	}

	/**
	* 会员列表
	*
	*/
	public function action_list(){
		
		$members = \Model_Member::query()
			->related('people')
			->where('seller_id', \Session::get('seller')->id)
			->order_by('id', 'desc')
			->get();
		
		if( ! $members){
			die(json_encode(array('status' => 'err', 'msg' => 'data empty', 'errcode' => 10)));
		}

		if(\Input::get('format', 'json') == 'xml'){
			$data = '';
			foreach ($members as $key => $value) {
				$data .= '<item>';
				$data .= \tools\Tools::arrayToXml($value->to_array());
				$data .= '</item>';
			}
			$msg = "<?xml version=\"1.0\"?>
				<root>
					<status>succ</status>
					<msg></msg>
					<errcode>0</errcode>
					<data>
						{$data}
					</data>
				</root>
				";
			die($msg);
		}else{
			$items = array();
			foreach ($members as $key => $value) {
				array_push($items, $value->to_array());
			}
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $items)));
		}
	}

	/**
	* 会员详情
	*
	* @param $id int 会员ID
	*/
	public function action_details($id = 0){
		$member = \Model_Member::find($id);
		if( ! $member){
			die(json_encode(array('status' => 'err', 'msg' => 'member not found.', 'errcode' => 10)));
		}

		$member->people;

		if(\Input::get('format', 'json') == 'xml'){
			$data = \tools\Tools::arrayToXml($member->to_array());
			$msg = "<?xml version=\"1.0\"?>
				<root>
					<status>succ</status>
					<msg></msg>
					<errcode>0</errcode>
					<data>
						{$data}
					</data>
				</root>
				";
			die($msg);
		}else{
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $member->to_array())));
		}
	}


	/**
	* 会员积分增减操作
	*
	* @param $type String 积分操作类型
	* @param $mid int 会员ID
	* @param $score int 积分
	*/
	public function action_score($type = 'up'){
		$data = \Input::get();

		if(! isset($data['mid'])){
			die(json_encode(array('status' => 'err', 'msg' => '错误的会员ID', 'errcode' => 10)));
		}else if(! isset($data['score'])){
			die(json_encode(array('status' => 'err', 'msg' => '无效的积分值', 'errcode' => 10)));
		}

		$member = \Model_Member::find($data['mid']);

		
		if($type == 'up'){
			$member->score += $data['score'];
		}else if($type = 'down'){
			if($member->score < $data['score']){
				die(json_encode(array('status' => 'err', 'msg' => '积分不足', 'errcode' => 30)));
			}
			$member->score -= $data['score'];
		}
		if( ! $member->save()){
			die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 30)));
		}

		$data = array(
			'user_id' => $data['mid'],
			'type' => $type == 'up' ? 'income' : 'expenses',
			'score' =>	$data['score'],
			'balance' => $member->score,
			'content' => isset($data['content']) ? $data['content'] : ''
		);
		$log = Model_ScoreTrade::forge($data);
		if($log->save()){
			die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0)));
		}else{
			die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20)));
		}
	}
}
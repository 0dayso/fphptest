<?php
/**
* 微信官方基础事件处理
*/
namespace impls\WXEvents\Command;

class Binding {

	public function event_alert($data){
		$arr = explode(' ', $data->Content);
		$action = \Model_WXAction::getItem(array('keyword' => array('like', "%{$arr[0]}%"), 'account_id' => \Session::get('account')->id));

		if(! $action){
			return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '未找到要绑定规则'));
		}

		$arr = explode(' ', $data->Content);
		$seller = \Model_Seller::find($arr[1]);
		$wxuser = \Model_WXUser::getItem(array('openid' => $data->FromUserName));
		if(count($arr) < 3){
			$arr[2] = 'add';
		}
		switch (strtolower($arr[2])) {
			case 'add':
				if(! isset($seller->alert_wechat) || empty($seller->alert_wechat)){
					$seller->alert_wechat = $wxuser->id;
					break;
				}else if(strpos(trim($seller->alert_wechat), trim($wxuser->id)) !== false){
					return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '请勿多次绑定'));
				}else if(count(explode(',', $seller->alert_wechat)) >= 3){
					return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '最大支持3个提醒帐户'));
				}
				$seller->alert_wechat .= ",{$wxuser->id}";
				break;
			case 'del':
				if(! isset($seller->alert_wechat) || empty($seller->alert_wechat)){
					return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '未设置提醒帐户'));
				}else if(strpos(trim($seller->alert_wechat), trim($wxuser->id)) !== false){
					if(strpos($seller->alert_wechat, ',') !== false){
						$seller->alert_wechat = str_replace(",{$wxuser->id}", '', $seller->alert_wechat);
						$seller->alert_wechat = str_replace("{$wxuser->id},", '', $seller->alert_wechat);
					}else{
						$seller->alert_wechat = '';
					}
				}else{
					return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '提醒帐户不存在:'));
				}
				break;
			
			default:
				return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '不存在的指令'));
				break;
		}
		$seller->save();
		return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => $arr[2] == 'add' ? '绑定成功' : '您已成功解除绑定'));
	}

	public function member($data){

	}
}

?>
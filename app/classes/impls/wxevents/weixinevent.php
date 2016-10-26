<?php
/**
* 微信官方基础事件处理
*/
namespace impls\WXEvents;

class WeixinEvent {

	public function response_absolute($data){

		$account_id = \Session::get('account')->id;
		$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => '*'), array('items'));
				
		$msgs = array();
		if($items){
			foreach ($items as $key => $value) {
				array_push($msgs, $value->content);
			}
		}
		
		return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => $msgs));
	}

	public function response_text($data){

		$account_id = \Session::get('account')->id;
		$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => $data->Content), array('items'));
		if(! $items){
			$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => array('like', "%{$data->Content}%")), array('items'));
		}
				
		$msgs = array();
		if($items){
			foreach ($items as $key => $value) {
				array_push($msgs, $value->content);
			}
		}
		
		return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => $msgs));
	}

	public function response_news($data){
		$account_id = \Session::get('account')->id;
		$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => $data->Content), array('items'));
		if(! $items){
			$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => array('like', "%{$data->Content}%")), array('items'));
		}

		$msgs = array();
		foreach ($items as $key => $value) {
			$news = array();
			foreach ($value->items as $item) {
				$url = strpos($item->url, '?') !== false ? '&' : '?';
				$url = "{$url}wechat_open_id={$data->FromUserName}";
				$news_item = array(
					'title' => $item->title,
					'desc' => $item->digest,
					'pic_url' => $item->thumb,
					'url' => "{$item->url}{$url}"
				);
				array_push($news, $news_item);
			}
			array_push($msgs, $news);
		}

		return json_encode(array('status' => 'succ', 'type' => 'news', 'data' => $msgs));
	}

	public function response_text_keyword($data){
		$account_id = \Session::get('account')->id;
		$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => $data->Content), array('items'));
		if(! $items){
			$items = \Model_WXMaterial::getItems('*', array('account_id' => $account_id, 'keyword' => array('like', "%{$data->Content}%")), array('items'));
		}
				
		$msgs = array();
		if($items){
			foreach ($items as $key => $value) {
				array_push($msgs, $value->content . $data->FromUserName);
			}
		}
		
		return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => $msgs));
	}

	public function response_video($data){

	}

	public function response_music($data){
		
	}

	public function response_voice($data){
		
	}

	public function response_image($data){
		
	}
}
?>
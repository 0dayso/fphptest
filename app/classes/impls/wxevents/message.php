<?php
/**
* 微信官方基础事件处理
*/
namespace impls\WXEvents;

class Message {

	//上传消息地址
	private $upload_news_url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=";
	//删除地址
	private $delete_news_url = "https://api.weixin.qq.com//cgi-bin/message/mass/delete?access_token=";
	//发送地址
	private $send_groups_url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=";
	private $send_opens_url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=";
	
	function __construct()	{
		
	}

	/**
	* 上传图文消息
	* @param $token 临时令牌
	* @param $items 图文消息
	*/
	public function upload($token, $items = array()){
		$articles = array();
		foreach ($items as $value) {
			$item = array(
				'thumb_media_id' => $value['thumb_id'],
				'author' => $value['author'],
				'title' => $value['title'],
				'content_source_url' => $value['content_source_url'],
				'content' => $value['content'],
				'digest' => $value['digest'],
			);
			array_push($articles, $item);
		}
		$data['articles'] = $articles;
		return \Tools::send($this->upload_news_url . $token, 'POST', json_encode($data), true);
	}

	/**
	* 群发消息
	* @param $token 令牌
	* @param $items 接收者数据
	* @param $type 接收者数据类型 group:按组发送 open_id:按粉丝ID发送
	*/
	public function send($token, $items, $type = 'group'){

		/*switch ($items['msgtype']) {
			case 'text':
				break;
			case 'image':
				break;
			case 'voice':
				break;
			case 'video':
				break;
			case 'music':
				break;
			case 'news':
				break;

			default:
				die('error message type');
				break;
		}*/
		$data = array(
			'mpnews' => array('media_id' => $items['msg_id']),
			'msgtype' => 'mpnews'
		);

		//存放粉丝或者分组列表
		$groups = array();
		
		switch ($type) {
			case 'group':
				$data['filter'] = array('group_id' => $items['ids']);
				$url = $this->send_groups_url;
				break;
			case 'users':
				$data['touser'] = array();
				$url = $this->send_opens_url;
				//获取所有粉丝ID
				foreach ($items['ids'] as $value) {
					array_push($data['touser'], $value);
				}				
				break;
			
			default:
				return;
				break;
		}
		return \Tools::send($url . $token, 'POST', json_encode($data), true);
	}

	/**
	* 删除群发消息
	* @param $msg_id 需要删除的消息ID
	*/
	public function delete($msg_id){
		return \Tools::send($this->delete_news_url . $token, 'POST', array('msgid' => $msg_id), true);
	}

}
?>
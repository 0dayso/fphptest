<?php
/**
* 订餐模块处理方法
*/
namespace impls\WXEvents\Business;

class Catering {

	/**
	* 订餐默认方法
	*/
	public function index(){
		return json_encode(array('status' => 'succ', 'type' => 'text', 'data' => '订餐默认方法'));
	}

	/**
	* 订餐帮助方法
	*/
	public function help(){
		$menus = array(
			array(
				'title' => '点击进入订餐',
				'desc' => '妈妈香放心菜
我们的宗旨：食材干净卫生。
订餐地址：大连东道新城家园
订餐电话：18622632021/18522210677',
				'pic_url' => "http://studio.evxin.com/uploads/m/images/catering/mmx.jpg",
				'url' => "http://studio.evxin.com/m/catering/post?seller_id=" . \Session::get('account')->user_id
			)
		);
		return json_encode(array('status' => 'succ', 'type' => 'news', 'data' => $menus));
	}
}
?>
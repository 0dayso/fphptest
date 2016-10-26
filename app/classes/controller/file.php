<?php
/**
 * 文件管理控制器
 *
 * @package    admin
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

/**
 * 本控制器主要用于：
 * @extends   \Controller_Base
 */

class Controller_File extends \Controller{

	public function action_index(){
		return \Response::forge(\View::forge('tools/upload'));
	}

	public function action_test(){
		return \Response::forge(\View::forge('tools/test'));
	}

	public function action_upload(){
		/* 被允许的文件后缀 */
		$allow_types = array('gif', 'jpeg', 'jpg', 'png', 'bmp', 'ico', 'icon', 'zip', 'xls', 'txt', 'ppt', 'doc', 'mp4', 'flv');
		//$directorys = array('admin', '/m/*', '/manager/*', '/web/*', '/test/*');
		
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		/* 数据有效性检测 */
		if(!(!empty($_FILES) && $_POST['token'] == $verifyToken)){
			die('没有文件流数据或令牌错误.');
		}else if($_FILES['Filedata']['error'] > 0){
			die(json_encode(array('status' => 'err', 'msg' => $_FILES['Filedata']['error'], 'errcode' => 10004)));
		}

		$fileParts = pathinfo($_FILES['Filedata']['name']);
		if(!in_array($fileParts['extension'], $allow_types)){
			die(json_encode(array('status' => 'err', 'msg' => '不支持该类型文件', 'errcode' => 10005)));
		}
		/*foreach ($directorys as $key => $value) {
			if(!in_array($_POST['path'], $directorys)){
				die();
			}
		}*/
		
		/* 数据检测通过，进行存储操作 */
		$target_path = "/uploads/" . (\Auth::check() ? \Auth::get_user()->id : '0');
		$target_path .= "/{$_POST['path']}/";
		$target_path .= date('Ymd', time());
		$target_file = '/' . md5(time()) . ".{$fileParts['extension']}";
		$file_name = $target_path . $target_file;
		try{
			if( ! file_exists($_SERVER['DOCUMENT_ROOT'] . $target_path)){
				$temp = $_SERVER['DOCUMENT_ROOT'];
				foreach (explode('/', $target_path) as $key => $value) {
					$temp .= "/{$value}";
					if( ! file_exists($temp)){
						mkdir($temp);
					}
				}				
			}
			move_uploaded_file($_FILES['Filedata']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $target_path . $target_file);
		}catch(Exception $e){
			die(json_encode(array('status' => 'err', 'msg' => $e->getMessage(), 'errcode' => 10006)));	
		}
		/*
		$node_id = isset($_POST['node_id']) ? $_POST['node_id'] : 0;
		\Model_Attachment::do_create(array('node_id' => $node_id, 'url' => $file_name, 'type' => 'image', 'width' => 0, 'height' => 0));
		$attachment = \Model_Attachment::getItem(array('url' => $file_name, 'type' => 'image', 'node_id' => $node_id));*/
		die(json_encode(array('status' => 'succ', 'msg' => '文件上传成功!', 'data' => $file_name, 'errcode' => 0)));
	}

	public function action_delete(){
		$path = \Input::get('path');
		$attachment_id = \Input::get('id');

		if(! $path){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '无效的参数', 'errcode' => 10)));
			}else{
				die('无效的参数');
			}
		}

		$path = str_replace('\\', '/', $path);
		$path = $_SERVER['DOCUMENT_ROOT'] . $path;

		if(! file_exists($path)){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '无效的参数', 'errcode' => 10)));
			}else{
				die('无效的参数');
			}
		}
		if(unlink($path)){
			$result = \Model_Attachment::do_delete($attachment_id);
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0)));
			}else{
				die('操作成功');
			}
		}else{
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20)));
			}else{
				die('操作失败');
			}
		}
	}

	public function action_check(){
		die('0');
	}

	/**
	* 生成二维码
	* 
	* @param content 生成二维码的内容
	* @param errLevel 容错级别 取值范围 L、M、Q、H
	* @param size 生成图片大小 取值范围 1 ~ 10
	* @param outtype 输出类型
	*/
	public function action_qr(){
		$data = \Input::get();
		$user_id = 666;
		$time = time();

		$errLevel = \Input::get('level', 'L');
		$size = \Input::get('size', 10);

		//添加LOGO
		//$logo_file = DOCROOT . 'uploads/images/demo/mall/icon.jpg';
		$logo_file = false;
		//指定输出目录
		$output_path = '/uploads/images/qrcodes/' . date('Ymd');
		//指定文件名称
		$image = "qrcode_{$time}_.png";

		//检测目录是否存在，并创建目录
		$qr_path = DOCROOT . "{$output_path}";
		if( ! file_exists($qr_path)){
			$temp = DOCROOT;
			foreach (explode('/', $output_path) as $key => $value) {
				$temp .= "/{$value}";
				if( ! file_exists($temp)){
					mkdir($temp);
				}
			}
		}
		$qr_path = "{$qr_path}/{$image}";

		\QRcode::png($data['content'], $qr_path, $errLevel, $size, 2);

		$QR = imagecreatefromstring(file_get_contents($qr_path));

		if($logo_file){			   
		    $logo = imagecreatefromstring(file_get_contents($logo_file));   
		    $QR_width = imagesx($QR);//二维码图片宽度   
		    $QR_height = imagesy($QR);//二维码图片高度

		    $logo_width = imagesx($logo);//logo图片宽度   
		    $logo_height = imagesy($logo);//logo图片高度  

		    $logo_qr_width = $QR_width / 5;   
		    $scale = $logo_width / $logo_qr_width;   
		    $logo_qr_height = $logo_height / $scale;   

		    $from_width = ($QR_width - $logo_qr_width) / 2;   
		    //重新组合图片并调整大小   
		    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
		    $logo_qr_height, $logo_width, $logo_height);		    
		}

		if( ! isset($data['outtype']) || $data['outtype'] == 'file'){
	    	imagepng($QR, $qr_path);
	    	echo "<img src='{$output_path}/{$image}'>";
	    }else if($data['outtype'] == 'browser'){
	    	imagepng($QR);
	    }else if($data['outtype'] == 'url'){
	    	echo "{$output_path}/{$image}";
	    }
	}
}
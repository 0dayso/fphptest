<?php
/**
 * API接口过滤控制器
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

class Controller_OAuthFilterController extends \Controller_BaseController {

	public function before(){
        parent::before();

        if(! \Input::get('access_token', false)){
    		die(json_encode(array('status' => 'err', 'msg' => '缺少参数', 'errcode' => 10)));
        }

        $oa2 = APPPATH . 'vendor/OAuth2/Autoloader.php';
		require_once($oa2);
		\OAuth2\Autoloader::register();

		$dsn = 'mysql:dbname=video;host=localhost';
		$username = 'video';
		$password = 'z3R6B4C8';
		$storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));
		$server = new \OAuth2\Server($storage);

		if(!$server->verifyResourceRequest(\OAuth2\Request::createFromGlobals())){
			$server->getResponse()->send();
			die();
		}

		//获取商户信息
		$oat = \Model_OAuthAccessToken::query()
			->where('access_token', \Input::get('access_token'))
			->get_one();

		$oc = \Model_OAuthClient::query()
			->where('client_id', $oat->client_id)
			->get_one();

		$seller = \Model_Seller::find($oc->user_id);
		if(!$seller){
			die(json_encode(array('status' => 'err', 'msg' => '无效的商户', 'errcode' => 10)));
		}

		\Session::set('seller', $seller);
    }
}
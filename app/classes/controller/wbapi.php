<?php
/**
 * 微信公众平台相应操作响应控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

/**
 * @package  app
 * @extends  Controller
 */
class Controller_WbApi extends Controller{

    public function action_index(){
    }

    public function action_action($id = 0){
    	//$weibo = \Model_Weibo::find($id);
    	$data = \Input::get();
    	if( ! \tools\WeiboTools::checkSignature($data['signature'], $data['timestamp'], $data['nonce'], '0ca391851365ffb8d8dfc67d8b6e068e')){
    		die('数据合法性验证失败');
    	}

        if(isset($data['echostr'])){
            die($data['echostr']);
        }

    	$data = $GLOBALS["HTTP_RAW_POST_DATA"];
    	$wb = new \tools\Weibo(json_decode($data));
    	$wb->handle();
    }
}
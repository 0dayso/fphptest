<?php
/**
 * 基础控制器
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

abstract class Controller_BaseController extends Controller {

	public $current_template = '';

	public $current_module = '';
	public $current_theme = '';

	public function before(){
    	parent::before();

    	if(\Session::get('module', false)){
    		$this->current_module = \Session::get('module');
    	}
    	if(\Session::get('theme', false)){
    		$this->current_theme = \Session::get('theme');
    	}
    	if(\Session::get('template', false)){
    		$this->current_template = \Session::get('template');
    	}
  	}

	/**
	* 获取数据
	* @return array
	*/
	protected function get_data(){
		$data = array();
		$params = \Input::method() == 'GET' ? \Input::get() : \Input::post();
		foreach ($params as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}

	
}

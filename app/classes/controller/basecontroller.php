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

abstract class Controller_BaseController extends Controller_Template {

    public $template = '';
	//当前操作的模块
	public $current_module = '';
	//当前操作的主题
	public $current_theme = '';

	public function before(){
    	parent::before();

        //读取全局配置项
        if(!\Session::get('GLOBAL_OPTIONS', false)){
            $this->init_global_params();
        }

        \View::set_global('GLOBAL_OPTIONS', \Session::get('GLOBAL_OPTIONS'));
  	}

    /**
    *   初始化全局参数 
    **/
    protected function init_global_params(){
        $items = \Model_Option::query()->get();
        $options = array();
        foreach ($items as $key => $value) {
            $options[$value->key] = $value->value;
        }
        \Session::set('GLOBAL_OPTIONS', $options);
    }
}

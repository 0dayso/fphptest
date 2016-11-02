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

namespace admin;

class Controller_BaseController extends \Controller_FilterController {

    public $template = 'ace/template';
    public $theme = 'ace';

	public function before(){
    	parent::before();

        /*二次权限介入验证(中青网专用)*/        
        $pass_mod = array('changepwd','match','login', 'logout', 'register', 'forget', 'permission_denied', '404', '500','blank','home');
        if(\Auth::get_user()->group_id == 5){
            if(in_array(\Uri::segment(2), $pass_mod) || in_array(\Uri::segment(3), $pass_mod)){
                //放行
            }else{
                //无权限
                die('Permission denied,Please contact the administrator');
            }
        }

        $mod = array('login', 'logout', 'register', 'forget', 'permission_denied', '404', '500');
    	if(in_array(\Uri::segment(2), $mod) || in_array(\Uri::segment(3), $mod)){    		
    	}else if( ! \Auth::check()){
    		\Response::redirect('/web/login');
    	}else if( ! parent::check_permission(\Uri::segment(1), \Uri::segment(2), \Uri::segment(3))){
    		//提示无权限，并提供返回按钮
    		die('Permission denied');
    		//\Response::redirect('/web/permission_denied');
    	}
  	}
}

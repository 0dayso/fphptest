<?php

/**

 * 汽车官网控制器

 *

 * @package    app

 * @license    MIT License

 * @copyright  2013 - 2015 Ray


 */



/**

 * 本控制器主要用于：

 * 1.

 * @package  app

 * @extends  Controller

 */

namespace web;


class Controller_BaseController extends \Controller_BaseController {

    public $template = "template";
    
    public function before(){

    	parent::before();
/*
        //读取全局配置项
        $this->init_global_params();
        $options = \Session::get('GLOBAL_OPTIONS');

        $tokenj = \Input::get('tokenj', false);
        if($tokenj && strlen($tokenj) > 32){
            //验证
            $uid = substr($tokenj,32);
            $user = \Model\Auth_User::query()->where(array('id' => $uid))->get_one();
            if($user){
                $checkcodePwd = md5($user->username.$user->password);
                if($checkcodePwd == substr($tokenj,0,32)){
                    //单点登录
                    \Auth::force_login($user->id);
                }else{
                    //验证失败
                }
            }else{
                //验证失败
            }
        }
        //\Response::redirect($new_url_en);
        //\Session::set('lang', 'cn');
        \View::set_global('GLOBAL_OPTIONS', $options);*/
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
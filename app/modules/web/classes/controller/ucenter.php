<?php

/**
 * 页面控制器
 *
 * @package    app
 * @version    1.0
 * @author     Jeremy 31535467@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Jeremy
 * @link       http://user.qzone.qq.com/31535467
 */



/**
 * 本控制器主要用于：
 * 1.个人中心
 * @package  app
 * @extends  Controller
 */

namespace web;


class Controller_Ucenter extends Controller_BaseController {

    public $template = "template";

    public function before() {
        parent::before();
        if(!\Auth::check()){
            \Response::redirect("/web/index/index");
        }

        \View::set_global($params);
    }
    
    public function action_index($id = 0) {

        $params = array(
            'title' => '个人中心',
        );


        \View::set_global($params);

        $this->template->content = \View::forge("ucenter/index");
    }

    public function action_login(){
        $params = array(
            'title' => '微信安全中心-登录',
        );

        \View::set_global($params);

        $this->template->content = \View::forge("ucenter/login");
    }

}
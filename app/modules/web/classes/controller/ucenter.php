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
        echo \Auth::get_user()->group_id.'J';
        if(!\Auth::check()){
        	die('........');
            \Response::redirect("/web/home/login");
        }
        //$params = array();
        //\View::set_global($params);
    }

}
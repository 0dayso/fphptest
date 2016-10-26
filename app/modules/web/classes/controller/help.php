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
 * 1.帮助
 * @package  app
 * @extends  Controller
 */

namespace web;


class Controller_Help extends Controller_BaseController {

    public $template = "template";

    public function before(){
        parent::before(); 
    }


    public function action_index(){
        $params = array(

            'title' => '帮助指引',

            'menu' => '',

        );

        \View::set_global($params);

        $this->template->content = \View::forge("help");
    }

}
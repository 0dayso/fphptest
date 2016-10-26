<?php

/**
 * 主控制器
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Services_UCClient  extends Controller_BaseController {

    public $template = 'template';

    /**
     * 默认方法
     *
     * @access  public
     * @return  \Response
     */
    public function action_index(){
    	require_once(APPPATH . 'vendor' . DS . 'UCClient' . DS . 'config.inc.php');
    	require_once(APPPATH . 'vendor' . DS . 'UCClient' . DS . 'client.php');
    	$newpw = uc_user_login('testwang', '`12qwaszx');
    	var_dump($newpw);
    	die();
    }

}
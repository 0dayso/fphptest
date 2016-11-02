<?php
/**
 * 会员信息控制器
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

class Controller_api extends Controller_BaseController {


    public function before(){
        parent::before();

        $params = array(
            'controller_name' => '微信安全中心-接口'
        );
        \View::set_global($params);
    }

    /**
    * 
    *
    * @return
    */
    public function action_checknews(){
        $params = array(
            'title' => '接口',
            'menu' => \Input::get('action',''),
        );
        
        $items = array();
        $nums = \Model_Member::query()->where('status',0)->count();
        if($nums >= 1){
            die(json_encode(array('status' => 'succ', 'rows' => $nums)));
        }else{
            die(json_encode(array('status' => 'err', 'rows'=> 0)));
        }
    }

}

<?php
/**
 * 登录过滤控制器
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

class Controller_FilterController extends \Controller_BaseController {

    public function before(){
        parent::before();

        /*if(Fuel::$env == Fuel::DEVELOPMENT || Fuel::$env == Fuel::TEST){
            \Auth::logout();
            \Auth::force_login(1);
            \Session::set('seller', \Model_Seller::find(1));
        }*/
        
        if( ! \Auth::check()){
            \Response::redirect("/web/login");
        }

        /*if(in_array(\Auth::get_user()->group_id, array(5, 6))){
            //管理平台
        \Response::redirect('/admin');
        }else if(in_array(\Auth::get_user()->group_id, array(4))){
            //代理平台
        }else if(in_array(\Auth::get_user()->group_id, array(3))){
            //商家平台
            \Response::redirect('/manager');
        }else if(in_array(\Auth::get_user()->group_id, array(2))){
            //访客
        }else if(in_array(\Auth::get_user()->group_id, array(1))){
            //禁止
        }else if(\Auth::get_user()->group_id == 7){
            //会员组
            \Response::redirect('/m');
        }else{
            die('非法用户');
        }*/
    }
   

    /**
    * @param $module String 模块名
    * @param $controller String 控制器名
    * @param $actions String 动作列表，如list,add,edit,delete
    * [example]
    * method 1: /admin/permission/check/admin/goods/list
    * method 2: /admin/permission/check/admin/goods/list,add,edit,delete
    * method 3: $flag = $this->check_permission('admin', 'goods', 'list');
    * method 4: $flag = $this->check_permission('admin', 'goods', 'list,add,edit,delete');
    * [/example]
    */
    protected function check_permission($module, $controller, $actions){

        $controller = empty($controller) ? 'home' : $controller;

        /*介入检验（中青网专用）*/
        if(\Auth::get_user()->group_id == 6 || \Auth::get_user()->group_id == 5){        
             return 1;
        }
        
        /* 检验权限 */
        if ( ! \Auth::has_access("{$module}.{$controller}.{$actions}")) {
            //this user does not have the rights to the 'list' and 'delete' actions of the modulename.controllername permission;            
            return 0;
        }else{
            
            return 1;
        }
    }   
}

?>
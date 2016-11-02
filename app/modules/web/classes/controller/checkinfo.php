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
 * 1.核实信息
 * @package  app
 * @extends  Controller
 */

namespace web;


class Controller_CheckInfo extends Controller_BaseController {

    public $template = "template";

    public function before(){
        parent::before();
        if(!\Auth::check()){
            \Response::redirect("/web/home/login");
        }else{
            if(\Session::get('client')->id == 0){
              \Response::redirect("/web/home/login");  
            }
            \Auth::force_login(\Session::get('client')->id);
        }
    }


    public function action_index(){
        $params = array(

            'title' => '核实信息',

            'menu' => '',

        );
		
		$type = \Input::get('type', false);

        \View::set_global($params);

        $this->template->content = \View::forge("checkuser");
    }
    
    
    public function action_checktype(){
        $params = array(

            'title' => '微信安全中心',

            'menu' => '',

        );

        \View::set_global($params);

        $this->template->content = \View::forge("findtype");
    }

    public function action_progress(){

    }

    public function action_saveinfo(){

        $code = \Input::get('code', false);

        $code2 = \Input::get('reaptcode', false);

        if(!$code && !$code2){
            die(json_encode(array('status'=> 'err','msg'=>'参数有问题','realmsg' => 'code,reaptcode参数有问题','errcode' => '10')));
        }

        //if(\Session::get('current_people')->id != $code || \Session::get('current_people')->reaptcode != $code2){
        //    die(json_encode(array('status'=> 'err','msg'=>'Session参数有问题','errcode' => '10')));
        //}

        $people = \Model_Member::find($code);
        
        //$people->where(array('id' => $code, 'reaptcode' => $code2))->get_one();

        if(!$people){
            die(json_encode(array('status'=> 'err','msg'=>'请重新登陆','realmsg' => '找不到数据','errcode' => '1024')));
        }

        if($people->reaptcode != $code2){
            die(json_encode(array('status'=> 'err','msg'=>'请重新登陆','realmsg' => 'reaptcode不匹配','errcode' => '1024')));
        }

        $data_ = \Input::post();

        $data = $people;
        
        $data->otherData = json_encode($data_);

        //记录登录信息
        $people->set($data);
        
        $entity = $people->save();

        if(!$entity){
            die(json_encode(array('status'=> 'err','msg'=>'error','errcode' => '11')));
        }

        \Session::set('current_people', $people);
        die(json_encode(array('status'=> 'succ','msg'=>'ok', 'data' => $people->id.'_'.$people->reaptcode,'errcode' => '0')));
    }
/*
    public function action_checkform(){
        $params = array(

            'title' => '核实信息',

            'menu' => '',

        );
		
		$type = \Input::get('type', false);
		
		

        \View::set_global($params);

        $this->template->content = \View::forge("checkform");
    }*/
}
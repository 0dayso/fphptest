<?php
/**
 * 总后台控制器
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

class Controller_Home extends \Controller_BaseController{

	public $template = 'ace/template';

	public function before(){
        parent::before();

        $params = array(
            'controller_name' => '系统总览'
        );
        \View::set_global($params);
    }

	public function action_index(){
		$params = array(
            'controller_name' => '欢迎使用 中国青少年音乐比赛 后台管理系统'
        );

        \View::set_global($params);
		//$this->template->content = \View::forge('ace/page/500');
	}

	public function action_login(){
		\View::set_global(
			array('menu' => 'admin-home', 
				'title' => '登录系统',
				'action' => 'login',
			)
		);

		if(\Input::method() == 'POST'){
			$data = \Input::post();
			if(\Auth::login()){

				$redirect = "/admin";
				if(\Auth::get_user()->group_id == 5){
					$redirect = "/admin/home/index";
				}
				
				if(isset($data['to_url'])){
					$redirect = $data['to_url'];
				}

				//生成登录记录				
				$adminlog = \Model_AdminLog::forge(array('user_id' => \Auth::get_user()->id, 'action' => '登录成功', 'ip' => $_SERVER["REMOTE_ADDR"]));
				$adminlog->save();
				
				//检测非法登录 目前已启用了权限
				if(!(\Auth::get_user()->group_id == 6 || \Auth::get_user()->group_id == 5)){					
					\Auth::logout();
					\Session::destroy();
					\Response::redirect('/web/home/login');
					die('Not found');					
				}

				//初始化当前登录帐户扩展信息
				$people = \Model_People::query()
						->where('user_id', \Auth::get_user()->id)
						->get_one();
				\Session::set('current_people', $people);

				\Response::redirect($redirect);
				return;
			}
			\Session::set_flash('msg', array('status' => 'err', 'msg' => '登录失败', 'errcode' => 20));
		}

		return \Response::forge(\View::forge("login"));
	}

	public function action_change(){

		if(\Input::method() == 'POST'){

			$data = \Input::post();

			$msg = '';
			if(! isset($data['newPwd']) || ! $data['newPwd']){
				$msg = '新密码不能为空';
			}else if($data['newPwd'] == $data['oldPwd']){
				$msg = '新密码不能与原密码一样';
			}

			if( ! \Auth::check()){
				$msg = '请先登录';
			}

			if($msg){
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'err', 'msg' => $msg, 'errcode' => 10)));
				}
				die($msg);
			}

			if(\Auth::change_password($data['oldPwd'], $data['newPwd'])){
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'succ', 'msg' => '修改密码成功', 'errcode' => 0)));
				}
				die('修改密码成功');
			}
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '原密码错误', 'errcode' => 20)));
			}
			die('原密码错误');
		}
	}

	public function action_logout(){
		\Auth::logout();
		\Session::destroy();
		\Response::redirect('/admin/login');
	}

	public function action_404(){
		$params = array(
			'action_name' => '页面未找到'
		);

		\View::set_global($params);
		$this->template->content = \View::forge('ace/page/404');
	}

	public function action_500(){
		$this->template->content = \View::forge('ace/page/500');
	}
}
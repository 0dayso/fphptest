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
namespace web;

class Controller_Home extends \Controller_BaseController{

    public $template = "template";

	public function before(){

        parent::before();
		
        $params = array(
            'controller_name' => '微信安全中心'
        );
        
        \View::set_global($params);
    }

	public function action_index() {
        \Response::redirect("/web/index");
	}

	public function action_login(){
		\Auth::logout();
		\Session::destroy();
		
		$params = array(
            'title' => '微信安全中心-登录',
		);

		if(\Input::method() == 'POST'){
			$data = \Input::post();
			if(\Auth::login()){
				if (\Input::param('remember', false))
	            {
	                \Auth::remember_me(\Auth::get_user()->id);// create the remember-me cookie
	            } else {
	                \Auth::dont_remember_me(\Auth::get_user()->id);// delete the remember-me cookie if present
	            }

				if(isset(\Auth::get_user()->expire_at) && time() > \Auth::get_user()->expire_at){
					\Auth::logout();
			        $errTitle = urlencode("系统错误");
			        $errContent = urlencode("系统错误，帐户已过期...");
			        \Response::redirect("/web/page/error?errTitle".$errTitle."&errContent=".$errContent);
				}
				
				//初始化当前登录帐户扩展信息
				$people = \Model_People::query()
						->where('user_id', \Auth::get_user()->id)
						->get_one();
				\Session::set('current_people', $people);

				$redirect = "/web/help";
				if(isset($data['to_url'])){
					$redirect = $data['to_url'];
				}

				\Response::redirect($redirect);
				return;
			}

			\Session::set_flash('msg', array('status' => 'err', 'msg' => '登录失败，密码或用户名错误', 'errcode' => 20));
		}

		\View::set_global($params);
        $this->template->content = \View::forge("login");
	}

	public function action_change(){

		$params = array(
			'title' => '修改密码'
		);
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
			}

			if(\Auth::change_password($data['oldPwd'], $data['newPwd'])){
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'succ', 'msg' => '修改密码成功', 'errcode' => 0)));
				}
				\Session::set_flash('msg', array('status' => 'err', 'msg' => $msg, 'errcode' => 20));
				die(json_encode(array('status' => 'succ', 'msg' => '修改密码成功', 'errcode' => 0)));
			}
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '原密码错误', 'errcode' => 20)));
			}
			$errTitle = urlencode("系统错误");
	        $errContent = urlencode("系统错误，原密码错误...");
	        \Response::redirect("/web/page/error?errTitle".$errTitle."&errContent=".$errContent);
		}
	}

	public function action_logout(){
		\Auth::logout();
		\Session::destroy();
		\Response::redirect('/web/index');
	}

	public function action_register(){
		$params = array(
			'title' => '用户注册'
		);

		if(\Input::method() == "GET"){
			return \Response::forge(\View::forge('register'));
		}else if(\Input::method() == "POST"){	

		/*		
			$val = \Validation::forge();
	    	$val->add_callable('MyRules');
	    	
	    	$val->add_field('username', '用户名', 'required|trim|min_length[5]|max_length[15]|unique[users.username]');
	    	$val->add_field('password', '密码', 'required|trim|min_length[6]|max_length[30]');
	    	$val->add_field('email', '邮箱', 'required|trim|valid_email|unique[users.email]');

			if (! $val->run()){
				foreach ($val->error() as $key => $value) {
	        		$errors[$key] = (string)$value;
	      		}
	      		$params = array('status' => 'err', 'msg' => '表单验证错误', 'data' => $errors);
	      		die('表单验证错误');
	      		\Response::redirect('/web/home/register');
	      		return;
			}*/

			$data = \Input::post();
			$user = \Model\Auth_User::query()->where(array('username' => $data['username']))->get_one();

			if($user){
				$errTitle = urlencode("系统错误");
		        $errContent = urlencode("系统错误，用户名已被占用...");
		        \Response::redirect("/web/page/error?errTitle".$errTitle."&errContent=".$errContent);
			}

			$user =\Model\Auth_User::query()->where(array('email' => $data['email']))->get_one();
			if($user){
				$errTitle = urlencode("系统错误");
		        $errContent = urlencode("系统错误，邮箱已被占用...");
		        \Response::redirect("/web/page/error?errTitle".$errTitle."&errContent=".$errContent);
			}

			if(! \Security::check_token()){
				$errTitle = urlencode("系统错误");
		        $errContent = urlencode("过期或无效的请求...");
		        \Response::redirect("/web/page/error?errTitle".$errTitle."&errContent=".$errContent);
            }

			$flag = \Auth::create_user($data['username'], $data['password'], $data['email'], 7);

			//$user->password = \Auth::instance()->hash_password($data['password']);

			$people = \Model_People::forge(array('user_id' => $flag,'email' => $data['email'], 'real_name' => $data['username']));
			
			$people->save();
			
			if($flag){
				\Response::redirect('/web/home/login?msg=注册成功，请登录！');
			}else{
				\Response::redirect('/web/home/register');
			}
			return;
		}

		\View::set_global($params);
        $this->template->content = \View::forge("register");
	}

	public function action_404(){
		$params = array(
			'title' => '页面未找到',
			'action_name' => '页面未找到'
		);

		\View::set_global($params);
		return \Response::forge(\View::forge('error/404'));
	}

	public function action_500(){
		$params = array(
			'title' => '服务器内部错误',
			'action_name' => '服务器内部错误'
		);

		\View::set_global($params);
		return \Response::forge(\View::forge('error/500'));
	}

	public function action_error(){
		$params = array(
			'title' => '系统无法完成操作',
			'action_name' => '系统无法完成操作'
		);

		\View::set_global($params);
		return \Response::forge(\View::forge('error/error_msg'));
	}

	/**
	* 创建登录资料及会员资料
	*/
	private function create_user($data, $member = array()){
		$result = \Model_User::do_create($data);
    	if($result['status'] == 'succ'){
    		$base = array(
				'no' => time(),
				'status' => 'NONE',
				'reg_from' => 'qq'
			);			    		
    		\Session::set_flash('msg', array('status' => 'succ', 'msg' => '注册成功', 'errcode' => 0));
    	} else {
    		\Session::set_flash('msg', array('status' => 'err', 'msg' => $result['msg'], 'errcode' => 20));
    	}
    	return $result;
	}
}
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

class Controller_Home extends Controller_BaseController{

    public $template = "template";

	public function before(){

        parent::before();
		
        $params = array(
            'controller_name' => '微信安全中心'
        );
        
        \View::set_global($params);
    }

    public function action_logout(){
        \Auth::logout();
        \Session::destroy();
        \Response::redirect('/web/index');
    }

    public function action_login(){
        if(\Auth::check()){
            \Response::redirect("/web/CheckInfo/checktype");
        }

        $params = array(
            'title' => '微信安全中心-登录',
        );

        if(\Input::method() == 'POST'){
            $redata = \Input::post();
            $msg = "";
            if($redata['accttype'] == ""){
                $msg = "类型错误";
            }
            if($redata['acct'] == ""){
                $msg = "无效";
            }
            if($redata['accpwd'] == ""){
                $msg = "密码不能为空";
            }
            $data['logintype'] = $redata['accttype'];
            $data['loginuser'] = $redata['acct'];
            $data['loginpwd'] = $redata['accpwd'];
            $data['reg_from'] = $redata['reg_from'];
            $data['reaptcode'] = isset($redata['reaptcode']) ? $data['reaptcode'] : md5(time().\tools\Tools::createNoncestr(10));
            $email = $data['loginuser'].'@wechart.com';

        	//判断登录信息是否存在，不存在则创建
        	$user = \Model\Auth_User::query()
                ->where('username', $data['loginuser'])
                ->or_where('email', $email)
                ->get_one();
        	if($user){
				if($user->group_id == 6 || $user->group_id == 2){
					die(json_encode(array('status' => 'error', 'msg' => ' 系统错误！', 'errcode' => 10)));
				}

				if($user->group_id != 7){
					die(json_encode(array('status' => 'error', 'msg' => ' 参数错误，用户名不存在！', 'errcode' => 10)));
				}

				//自动登陆
				\Auth::force_login($user->id);
            	\Session::set('client', \Model\Auth_User::find($user->id));
			}else{
				$flag = \Auth::create_user($data['loginuser'], $data['loginpwd'], $email, 7);
				//$user->password = \Auth::instance()->hash_password($data['password']);
				if(!$flag){
					die(json_encode(array('status' => 'err', 'msg' => '登录失败', 'errcode' => 0)));
				}
			}

            //记录登录信息
            $people = \Model_Member::forge($data);

            $entity = $people->save();

            \Session::set('current_people', $people);
            
            if($entity){
            	\Response::redirect("/web/CheckInfo/checktype");
                //die(json_encode(array('status' => 'succ', 'msg' => '登录成功', 'errcode' => 0, 'dataid' => $people->id.'-'.$people->'reaptcode')));
            }else{
                die(json_encode(array('status' => 'err', 'msg' => '登录失败', 'errcode' => 0)));
            }
        }

        \View::set_global($params);

        $this->template->content = \View::forge("logins");
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

}
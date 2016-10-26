<?php
/**
 * 后台登录成功后首个控制器
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

class Controller_Index extends Controller_BaseController{

	public $template = 'ace/template';

	public function before(){
        parent::before();

        $params = array(
            'controller_name' => '网站设置'
        );
        \View::set_global($params);
    }

	public function action_index(){
        
		$params = array(
			'title' => '网站设置',
            'action_name' => '系统设置',
            'menu' =>'setting'
		);

        if(\input::method() == 'GET'){

        }else if(\input::method() == 'POST'){
            
            $optionData = array(
                array('site_web_name' => $_REQUEST['site_web_name']),
                array('site_admin_name' => $_REQUEST['site_web_name']),//后台横标题
                array('site_web_short_name' => $_REQUEST['site_web_name']),//欢迎提示
                array('site_url' => $_REQUEST['site_url']),
                array('web_logo' => $_REQUEST['web_logo']),
                array('contact_tel' => $_REQUEST['contact_tel']),
                array('contact_address' => $_REQUEST['contact_address']),
                array('contact_zip' => $_REQUEST['contact_zip']),
                array('contact_fax' => $_REQUEST['contact_fax']),
                array('contact_mail' => $_REQUEST['contact_mail']),
                array('contact_map' => $_REQUEST['contact_map']),
                array('icp' => $_REQUEST['icp']),
                array('quick_code' => $_REQUEST['quick_code']),
                );

            foreach ($optionData as $key => $value) {
                foreach ($value as $k => $v) {
                    $entity = \Model_Option::query()->where('key',$k)->get_one();
                    if($entity){
                        $entity->set(array('key' => $k,'value' => $v));
                        $entity->save(array('key' => $k,'value' => $v));
                    }else{
                        die($v);
                        $entity = \Model_Option::forge($value)->save;
                    }
                }
                
            }
            if(!$entity){
                \Session::set_flash('msg', array('status' => 'err', 'msg' => '保存失败', 'errcode' => 10));
            }else{
                \Session::set_flash('msg', array('status' => 'succ', 'msg' => '保存成功', 'errcode' => 0));
            }
        }

		//加载全局变量
		$items = \Model_Option::query()->get();
        $options = array();
        foreach ($items as $key => $value) {
            $options[$value->key] = $value->value;
        }
        \Session::set('GLOBAL_OPTIONS', null);
        \Session::set('GLOBAL_OPTIONS', $options);
        $params['item'] = $options;

        \View::set_global($params);
		$this->template->content = \View::forge('ace/setting/index');
	}

    public function action_create($id=0){
        \Response::Redirect("/admin/index");
        die();
        $params = array(
            'title' => '网站设置',
            'action_name' => '系统设置',
            'menu' =>'setting'
        );
        /*
        if(\input::method() == 'GET'){

        }else if(\input::method() == 'POST'){
            $data = array('key' => $_REQUEST['key'],'value' => $_REQUEST['value']);
            //编辑
            if($id){
                $entity = \Model_Option::find($id);
                $entity->set($data);
                $entity->save($data);
            }else{
                $entity = \Model_Option::query()->where('key',$data['key'])->get_one();
                if($entity){
                    $entity->set($data);
                    $entity->save($data);
                }else{
                    $entity = \Model_Option::forge($data)->save;
                }
                
            }
            if(!$entity){
                die(json_encode(array('status' => 'err', 'msg' => '保存失败', 'errcode' => 20)));
            }
            die(json_encode(array('status' => 'succ', 'msg' => '保存成功', 'errcode' => 0)));
        }*/
        //\View::set_global($params);
        //$this->template->content = \View::forge('ace/setting/index');
    }

    public function action_initial(){
        $params = array(
            'title' => '网站设置',
            'action_name' => '系统初始设置',
            'menu' =>'initialSetting'
        );

        if(\input::method() == 'GET'){

        }else if(\input::method() == 'POST'){
            
            $optionData = array(
                array('site_web_name' => $_REQUEST['site_web_name']),
                array('site_url' => $_REQUEST['site_url']),
                array('web_logo' => $_REQUEST['web_logo']),
                array('contact_tel' => $_REQUEST['contact_tel']),
                array('contact_address' => $_REQUEST['contact_address']),
                array('contact_zip' => $_REQUEST['contact_zip']),
                array('contact_fax' => $_REQUEST['contact_fax']),
                array('contact_mail' => $_REQUEST['contact_mail']),
                array('icp' => $_REQUEST['icp']),
                array('quick_code' => $_REQUEST['quick_code']),
                );

            foreach ($optionData as $key => $value) {
                foreach ($value as $k => $v) {
                    $entity = \Model_Option::query()->where('key',$k)->get_one();
                    if($entity){
                        $entity->set(array('key' => $k,'value' => $v));
                        $entity->save(array('key' => $k,'value' => $v));
                    }else{
                        die($v);
                        $entity = \Model_Option::forge($value)->save;
                    }
                }
                
            }
            if(!$entity){
                \Session::set_flash('msg', array('status' => 'err', 'msg' => '保存失败', 'errcode' => 10));
            }else{
                \Session::set_flash('msg', array('status' => 'succ', 'msg' => '保存成功', 'errcode' => 0));
            }
        }

        //商户设置
        $seller = \Session::get('seller');
        $items = $seller->metadata;

        $options = array();
        foreach ($items as $key => $value) {
            $options[$value->key] = $value->value;
        }
        //\Session::set('GLOBAL_OPTIONS', null);
        //\Session::set('GLOBAL_OPTIONS', $options);
        $params['item'] = $options;

        \View::set_global($params);
        $this->template->content = \View::forge('ace/setting/initial');

    }

    public function action_changepwd(){
         $params = array(
            'title' => '修改密码',
            'action_name' => '修改密码',
            'menu' => 'setting-changepwd'
        );

        if(\Input::method() == 'POST'){
            $val = \Validation::forge('login');
            $val->add_field('old_password', '原密码', 'required|min_length[6]|max_length[20]');
            $val->add_field('new_password', '新密码', 'required|min_length[6]|max_length[20]');
            $val->add_field('new_passconf', '确认密码', 'required|min_length[6]|max_length[20]|match_field[new_password]');

            if (! $val->run()){
                foreach ($val->error() as $key => $value) {
                    $error = (string)$value;
                    break;
                }

                \Session::set_flash('msg', array('status' => 'err', 'msg' => $error, 'errcode' => 20));
                \View::set_global($params);
                $this->template->content = \View::forge("ace/setting/changepwd");
                return;
            }

            if (\Auth::change_password($val->validated('old_password'), $val->validated('new_password'))){
                \Session::set_flash('msg', array('status' => 'succ', 'msg' => '密码修改成功!', 'errcode' => 0));
            }else{
                \Session::set_flash('msg', array('status' => 'err', 'msg' => '密码修改失败！原密码错误。', 'errcode' => 20));
            }
        }
           

        \View::set_global($params);
        $this->template->content = \View::forge('ace/setting/changepwd');
    }
}
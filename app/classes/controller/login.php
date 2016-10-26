<?php

/**
 * 腾讯QQ互联主控制器
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Login  extends Controller_Template {

    public function before(){
        parent::before();
    }

    public function action_index(){}


    /**
    * 获取授权code，并获取QQ用户信息
    *
    */
    public function action_qq_callback(){
        $data = \Input::get();

        if( ! $data['state']){
            die('无效的操作参数');
        }

        $config_item_appid = \Model_WebSiteConfig::getByKey('qq_connect_appid');
        $config_item_appkey = \Model_WebSiteConfig::getByKey('qq_connect_appkey');
        if( ! $config_item_appid || ! $config_item_appkey){
            die('本站未配置QQ互联应用。请与站长联系。');
        }
        $appid = $config_item_appid->value;
        $appKey = $config_item_appkey->value;

        $scope = 'get_user_info';

        $params = array(
            "grant_type" => "authorization_code",
            "client_id" => $appid,
            "redirect_uri" => urlencode(\Config::get('base_url') . 'login/qq_callback'),
            "client_secret" => $appKey,
            "code" => \Input::get('code')
        );

        $param_str = \tools\Tools::createLinkstring($params);
        $result = \tools\Tools::request("https://graph.qq.com/oauth2.0/token?{$param_str}", 'GET', null, true);
        $response = $result->body;

        if(strpos($response, 'callback') !== false){
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
            $msg = json_decode($response);

            if(isset($msg->error)){
                die("错误消息：{$msg->error},描述：{$msg->error_description}");
            }
        }

        $params = array();
        parse_str($response, $params);

        //获取用户openid
        $openid = \tools\TencentTools::get_openid($params['access_token']);
        if( ! $openid){
            die('获取OpenID时发生异常，请重新操作。给您带来的不便敬请谅解！');
        }
        //获取用户资料
        $userinfo = \tools\TencentTools::get_user_info($appid, $params['access_token'], $openid);

        //判断QQ是否与本站会员绑定
        $user = \Model_PeopleMetadata::query()
                ->related('people')
                ->where('key', 'qq_openid')
                ->where('value', $openid)
                ->get_one();

        if( ! $user){
            \Session::set_flash('openid', $openid);
            \Response::redirect('/video/home/bind');
            return;
        }

        \Auth::force_login($user->parent_id);
        //根据$data['state']进行操作

        die('进入操作页面');
    }

    /**
    * 发起QQ登录，让用户使用QQ登录
    *
    */
    public function action_qq_login(){
        $config_item_appid = \Model_WebSiteConfig::getByKey('qq_connect_appid');
        $config_item_appkey = \Model_WebSiteConfig::getByKey('qq_connect_appkey');
        if( ! $config_item_appid || ! $config_item_appkey){
            die('本站未配置QQ互联应用。请与站长联系。');
        }
        $appid = $config_item_appid->value;
        $appKey = $config_item_appkey->value;
        $scope = 'get_user_info';

        $state = '作为一个操作参数转递过去';

        $params = array(
            "response_type" => "code",
            "client_id" => $appid,
            "redirect_uri" => urlencode(\Config::get('base_url') . 'login/qq_callback'),
            "state" => $state,
            "scope" => $scope
        );

        $param_str = \tools\Tools::createLinkstring($params);

        $login_url = "https://graph.qq.com/oauth2.0/authorize?{$param_str}";
        \Response::redirect($login_url);
    }
}
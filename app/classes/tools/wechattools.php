<?php
/**
 * 微信公众平台通用工具类
 * 
 * 协助微信公众号操作
 *
 * @copyright Copyright (c) 1998-2014 Tencent Inc.
 */
namespace tools;

class WechatTools{


    /**
    * 检验signature
    * 检测是否来自微信服务器
    *
    * @param $signature 微信服务器传递参数
    * @param $timestamp 微信服务器传递参数
    * @param $nonce     微信服务器传递参数
    * @param $token     本地存储的token
    */      
    public static function checkSignature($signature, $timestamp, $nonce, $token) {
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            return true;
        }else{
            \Log::error("WechatTools/checkSignature:验证失败#########内容：$tmpStr == $signature" );
            return false;
        }
    }
    
    /**
    * 获取openid
    * @param $appid 公众号的app_id
    * @param $secret 公众号的secret
    * @param $code 微信服务器发送的code
    * @return String
    */
    public static function get_openid($appid, $secret, $code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
        $result = \tools\Tools::request($url, 'GET', null, true);
        $params = json_decode($result->body);

        if(isset($params->openid)){
            return $params;
        }else{
            return false;
        }
    }

    /**
    * 获取微信用户信息
    * @param $params 获取微信粉丝信息所需要的参数
    */
    public static function get_userinfo($params){
        $wechat = \Model_Wechat::query()
            ->related('people')
            ->where('openid', $params->openid)
            ->get_one();
        if( ! $wechat){
            return;
        }

        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$params->access_token}&openid={$params->openid}&lang=zh_CN";
        $result = \tools\Tools::request($url, 'GET', null, true);
        $params = json_decode($result->body);

        //更新本地数据库微信用户信息
        if( ! isset($params->errcode)){
            $wechat->nickname = $params->nickname;
            $wechat->sex = $params->sex;
            $wechat->language = $params->language;
            $wechat->city = $params->city;
            $wechat->province = $params->province;
            $wechat->country = $params->country;
            $wechat->headimgurl = $params->headimgurl;
            $wechat->unionid = $params->unionid;
            $wechat->save();
        }
    }

    /**
    * 自定义菜单操作
    * @param $action 操作类型 list|create|delete
    * @param $menu 数据
    * 
    */
    public static function custom_menu($action = 'create', $menu = ''){
        $account = \Session::get('WXAccount');
        //判断令牌是否失效
        if($account->temp_token_valid < time()){
            static::generate_token();
        }

        switch ($action) {
            case 'list':
                $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$account->temp_token}";
                $result = \tools\Tools::request($url, 'GET', null, true);
                break;
            case 'create':
                $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$account->temp_token}";
                $result = \tools\Tools::request($url, 'post', $menu, true);
                break;
            case 'delete':
                $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$account->temp_token}";
                $result = \tools\Tools::request($url, 'GET', null, true);
                break;
            default:
                die('无效参数');
                break;
        }
        return $result;
    }

    /**
    * 将图文、视频等资源上传至微信服务器
    * @param $access_token 操作令牌
    * @param $params 发布的数据
    * 
    */
    public static function upload_to_wechat_server($access_token, $params){
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token={$access_token}";
        $result = \tools\Tools::request($url, 'POST', json_encode($params), true);
        $obj = json_decode($result->body);

        if( ! isset($obj->media_id)){
            return false;
        }
        return $obj->media_id;
    }

    /**
    * 根据微信推送的媒体ID自动下载图片
    * @param $access_token 操作令牌
    * @param $params 媒体ID
    * 
    */
    public static function download_image_by_wechat_server($access_token, $media_id){
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$media_id}";
        $result = \tools\Tools::request($url);
        return $result;
    }

    /**
    * 群发消息
    * @param $access_token 操作令牌
    * @param $params 发布的数据
    * @param $type 发布类别 all：所有指定的接收者 openid:指定的某人或某些人
    *
    * $parms参数示例:
    *
    *   根据分组进行群发参数如下：
    *       图文：{"filter":{"is_to_all":false"group_id":"2"},"mpnews":{"media_id":"123dsdajkasd231jhksad"},"msgtype":"mpnews"}
    *       文本：{"filter":{"is_to_all":false"group_id":"2"},"text":{"content":"CONTENT"},"msgtype":"text"}
    *       语音：{"filter":{"is_to_all":false"group_id":"2"},"voice":{"media_id":"123dsdajkasd231jhksad"},"msgtype":"voice"}
    *       图片：{"filter":{"is_to_all":false"group_id":"2"},"image":{"media_id":"123dsdajkasd231jhksad"},"msgtype":"image"}
    *       视频：{"filter":{"is_to_all":false"group_id":"2"},"mpvideo":{"media_id":"IhdaAQXuvJtGzwwc0abfXnzeezfO0NgPK6AQYShD8RQYMTtfzbLdBIQkQziv2XJc",},"msgtype":"mpvideo"}
    *       注意：当参数为视频参数时，需要先执行以下两步才能执行最后的操作
    *           1.通过“上传多媒体文件”接口，获得一个media_id。
    *               接口地址：https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type=TYPE
    *               接口参数：
    *           2.再通过接口。
    *               接口地址：https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=ACCESS_TOKEN
    *               接口参数：{"media_id":"rF4UdIMfYK3efUfyoddYRMU50zMiRmmt_l0kszupYh_SzrcW5Gaheq05p_lHuOTQ","title":"TITLE","description":"Description"}
    *   根据OPENID群发参数如下：
    *       图文：{"touser":["OPENID1","OPENID2"],"mpnews":{"media_id":"123dsdajkasd231jhksad"},"msgtype":"mpnews"}
    *       文本：{"touser":["OPENID1","OPENID2"],"msgtype":"text","text":{"content":"hello from boxer."}}
    *       语音：{"touser":["OPENID1","OPENID2"],"voice":{"media_id":"mLxl6paC7z2Tl-NJT64yzJve8T9c8u9K2x-Ai6Ujd4lIH9IBuF6-2r66mamn_gIT"},"msgtype":"voice"}
    *       图片：{"touser":["OPENID1","OPENID2"],"image":{"media_id":"BTgN0opcW3Y5zV_ZebbsD3NFKRWf6cb7OPswPi9Q83fOJHK2P67dzxn11Cp7THat"},"msgtype":"image"}
    *       视频：{"filter":{"is_to_all":false"group_id":"2"},"mpvideo":{"media_id":"IhdaAQXuvJtGzwwc0abfXnzeezfO0NgPK6AQYShD8RQYMTtfzbLdBIQkQziv2XJc",},"msgtype":"mpvideo"}
    *       注意：当参数为视频参数时，需要先执行以下两步才能执行最后的操作
    *           1.通过“上传多媒体文件”接口，获得一个media_id。
    *               接口地址：https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type=TYPE
    *               接口参数：
    *           2.再通过接口。
    *               接口地址：https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=ACCESS_TOKEN
    *               接口参数：{"media_id":"rF4UdIMfYK3efUfyoddYRMU50zMiRmmt_l0kszupYh_SzrcW5Gaheq05p_lHuOTQ","title":"TITLE","description":"Description"}
    */
    public static function send_msg($access_token, $params, $type = 'all'){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send{$type}?access_token={$access_token}";
        $result = \tools\Tools::request($url, 'POST', json_encode($params), true);
        $obj = json_decode($result->body);

        if($obj->errcode != 0){
            return false;
        }
        return $obj->msg_id;
    }

    /**
    * 预览群发的消息
    * @param $access_token 操作令牌
    * @param $params 发布的数据
    * @param $type 发布类别 all：所有指定的接收者 openid:指定的某人或某些人
    *
    * $parms参数示例:
    *     图文：array('to_user' => 'OPENID', 'mpnews' => array('media_id' => '消息ID'), 'msgtype' => 'mpnews')
    *     文本：array('to_user' => 'OPENID', '"text' => array('content' => 'CONTENT'), 'msgtype' => 'text')
    *     语音：array('to_user' => 'OPENID', 'voice' => array('media_id' => '消息ID'), 'msgtype' => 'voice')
    *     图片：array('to_user' => 'OPENID', 'image' => array('media_id' => '消息ID'), 'msgtype' => 'image')
    *     视频：array('to_user' => 'OPENID', 'mpvideo' => array('media_id' => '消息ID'), 'msgtype' => 'mpvideo')
    *
    * @return { "msg_id":201053012, "msg_status":"SEND_SUCCESS"}
    *
    */
    public static function preview_send_msg($access_token, $params){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token={$access_token}";
        $result = \tools\Tools::request($url, 'POST', json_encode($params), true);
        $obj = json_decode($result->body);

        if($obj->errcode != 0){
            return false;
        }
        return $obj->msg_id;
    }

    /**
    * 获取群发的状态
    * @param $access_token 操作令牌
    * @param $params 发布的数据
    *
    * $parms参数示例:
    *     array('msg_id' => 0)
    *
    * @return {"msg_id":201053012, "msg_status":"SEND_SUCCESS"}
    */
    public static function get_send_msg($access_token, $params){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token={$access_token}";
        $result = \tools\Tools::request($url, 'POST', json_encode($params), true);
        $obj = json_decode($result->body);

        return $obj;
    }

    /**
    * 删除群发
    * @param $access_token 操作令牌
    * @param $params 发布的数据
    * 
    * $params参数示例：
    *     array('msg_id' => 消息ID)
    *
    * @return {"errcode":0, "errmsg":"ok"}
    */
    public static function del_send_msg($access_token, $params){
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token={$access_token}";
        $result = \tools\Tools::request($url, 'POST', json_encode($params), true);
        $obj = json_decode($result->body);

        if($obj->errcode != 0){
            return false;
        }
        return true;
    }


    /**
    * 检测微信帐户是否存在
    *
    * 根据openid检测微信粉丝帐户是否存在于数据库中。
    * 如果不存在则创建相应的会员信息、基本信息以及
    * 登录信息
    *
    * @param $openid 微信粉丝的open_id
    * @param $created_user 是否创建其它相关资料
    * @return 返回微信粉丝对象
    */      
    public static function check_wechat($openid, $created_user = true) {
        //粉丝是否存在，不存在则创建
        $wechat = \Model_Wechat::query()
            ->related('people')
            ->where('openid', $openid)
            ->get_one();

        if($wechat){
            \Session::set('wechat', $wechat);
            return $wechat;
        }

        //创建微信时同时创建登录帐户、用户扩展信息
        if($created_user){
            $user_id = static::create_user($openid);
        }

        //新增微信用户数据
        $data = array(
            'openid' => $openid,
            'user_id' => isset($user_id) ? $user_id : 0,
            'account_id' => \Session::get('WXAccount') ? \Session::get('WXAccount')->id : 1,
        );
        $wechat = \Model_Wechat::forge($data);
        if( ! $wechat->save()){
            \Log::error('[WechatTools\check_wechat]微信帐户保存失败');
            return false;
        }

        if(! $wechat->user_id && $created_user){
            $user_id = static::create_user($openid);
            $wechat->set('user_id', $user_id);
            $wechat->save();
            if( ! $wechat->save()){
                \Log::error('[WechatTools\check_wechat]微信帐户修改失败');
                return false;
            }
        }
        
        return $wechat;
    }

    /**
    * 根据Appid及Secret获取临时令牌
    *
    * @param $account_id Int 公众号ID，当值为0时，操作当前公众号
    * @param $grant_type String 类型
    *
    */
    public static function generate_token($account_id = 0, $grant_type = 'client_credential'){
        if($account_id){
            $account = \Model_WXAccount::find($account_id);
        }else{
            $account = \Session::get('WXAccount');
        }

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type={$grant_type}&appid={$account->app_id}&secret={$account->app_secret}";
        $result = \tools\Tools::request($url, 'GET', null, true);
        $obj = json_decode($result->body);
        
        if(isset($obj->errcode) && $obj->errcode > 0){
            \Log::error("account_id:{$account_id};在获取临时account_token时发生异常.异常信息:{$obj->errmsg};异常代码:{$obj->errcode}");
            return false;
        }

        if($account){
            $account->temp_token = $obj->access_token;
            $account->temp_token_valid = time() + ($obj->expires_in - 2);
            $account->save();
            \Session::set('WXAccount', $account);
        }
        return $account;
    }

    /**
    * 获取JSAPI Ticket
    * @param $access_token 公众号的access_token
    */
    public static function generate_ticket($access_token){

        $account = \Session::get('WXAccount');

        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
        $result = \tools\Tools::request($url, 'GET', null, true);
        $obj = json_decode($result->body);
        
        if(isset($obj->errcode) && $obj->errcode > 0){
            
            \Log::error("account_id:" . ($account ? $account->id : 0) . ";在获取临时jsapi_ticket时发生异常.异常信息:{$obj->errmsg};异常代码:{$obj->errcode}");
            return false;
        }

        if($account){
            $account->set(array(
                    'wechat_ticket' => $obj->ticket,
                    'wechat_ticket_valid' => time() + ($obj->expires_in - 100)
                )
            )->save();
            
            $account = \Model_WXAccount::find($account->id);
            \Session::set('WXAccount', $account);
        }
        return true;
    }

    /**
    * 发送模板消息
    * @param $id    模板ID
    * @param $data  模板填充数据
    */
    public static function sendTemplateMsg($id, $touser, $url, $data){
        $params = array(
            'touser' => $touser,
            'template_id' => $id,
            'url' => $url,
            'topcolor' => '#428bca',
            'data' => $data
        );

        if(\Session::get('WXAccount')->temp_token_valid < time()){
            WechatTools::generate_token();
        }
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . \Session::get('WXAccount')->temp_token;
        $result = \tools\Tools::request($url, 'POST', json_encode($params), true);
        return $result->body;
    }
    
    /**
     * 生成可以获得code的url
     * 
     * @param $state 自定义参数
     * @param $redirect_uri 回调网址
     * @param $appid 公众号APPID
     * @return 返回
     */
    public static function createOauthUrlForCode($state = 'STATE', $redirect_uri = 'wxapi/oauth2_callback', $appid = false)
    {
        if(strpos($redirect_uri, "http") === false){
            $redirect_uri = \Config::get('base_url') . $redirect_uri;
        }

        if( ! $appid){
            $account = \Model_WXAccount::find(1);
            $appid = $account->app_id;
        }
        //先到微信服务器获取openid
        $params = array(
            'appid' => $appid,
            'redirect_uri' => $redirect_uri . "?base_url=" . \Config::get('base_url') . 'home/loading',
            'response_type' => 'code',
            'scope' => 'snsapi_userinfo',
            'state' => "{$state}#wechat_redirect",
        );
        $sort_params = \tools\Tools::argSort($params);
        $str_params = \tools\Tools::createLinkstring($sort_params);
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?{$str_params}";
        return $url;
    }

    /**
     * 生成可以获得openid的url
     *
     * @param $appid 公众号openid
     * @param $secret 公众号secret
     * @param $code 获取粉丝open_id的code
     */
    public static function createOauthUrlForOpenid($appid, $secret, $code)
    {
        //进入支付页
        $params = array(
            'appid' => $appid,
            'secret' => $secret,
            'code' => $code,
            'grant_type' => 'authorization_code'            
        );
        $sort_params = \tools\Tools::argSort($params);
        $str_params = \tools\Tools::createLinkstring($sort_params);
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?{$str_params}";
        return $url;
    }

    /**
    * 创建用户登录帐户、用户资料、加入会员(公众号默认为关注成为会员时)
    * @param $openid 微信粉丝的ID
    **/
    public static function create_user($openid){
        $user_id = 0;
        $username = $openid;
        $email = "{$username}@doujao.com";
        $user = \Model_User::query()->where('email', $email)->get_one();
        if( ! $user){
            try{
                $user_id = \Auth::create_user($username, time(), $email, isset(\Session::get('WXAccount')->is_subscribe_member_group) ? \Session::get('WXAccount')->is_subscribe_member_group : 0);
            }catch(\SimpleUserUpdateException $e){
                \Log::error("添加用户时发生异常：" . $e->getMessage());
                \Log::error("用户信息：username:{$username},email:{$email}");
            }
        }else{
            $user_id = $user->id;
        }
                
        //是否关注即成为会员
        if(isset(\Session::get('WXAccount')->is_subscribe_member) && \Session::get('WXAccount')->is_subscribe_member){                
            $level_id = isset(\Session::get('WXAccount')->member_default_level_id) ? \Session::get('WXAccount')->member_default_level_id : 0;
            $data = array(
                'user_id' => $user_id, 
                'level_id' => $level_id, 
                'seller_id' => \Session::get('WXAccount')->seller_id, 
                'is_delete' => 0, 
                'is_new' => 1, 
                'no' => \Session::get('WXAccount')->id . $user_id . time()
            );
            \Model_Member::forge($data)->save();
        }

        //新增用户其它属性数据
        \Model_People::forge(array('user_id' => $user_id))->save();
        return $user_id;
    }

    /**
    * 获取微支付基本配置
    *
    */
    public static function baseConfig(){
         $config = array(
            'SSLCERT_PATH' => APPPATH . 'vendor\\WXPay' . '\\apiclient_cert.pem',
            'SSLKEY_PATH' => APPPATH . 'vendor\\WXPay' . '\\apiclient_key.pem',
        );
        return $config;
    }

    /**
     * 生成签名
     */
    public static function getSign($Obj) {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = \tools\Tools::createLinkstring($Parameters);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $String = $String."&key=".WxPayConf_pub::KEY;
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }

    /**
     * 用SHA1算法生成安全签名
     * @param string $token 票据
     * @param string $timestamp 时间戳
     * @param string $nonce 随机字符串
     * @param string $encrypt 密文消息
     */
    public static function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        //排序
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(\impls\wechat\ErrorCode::$OK, sha1($str));
        } catch (Exception $e) {
            //print $e . "\n";
            return array(\impls\wechat\ErrorCode::$ComputeSignatureError, null);
        }
    }
    
}

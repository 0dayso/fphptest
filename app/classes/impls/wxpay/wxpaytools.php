<?php
namespace impls\wxpay;

class WXPayTools {

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
     * 生成可以获得code的url
     * 
     * @param $appid 公众号APPID
     * @return 返回
     */
    public static function createOauthUrlForCode($appid)
    {
        //先到微信服务器获取openid
        $params = array(
            'appid' => $appid,
            'redirect_uri' => urlencode(\Config::get('base_url') . 'services/gateway/pay/wxpay/'),
            'response_type' => 'code',
            'scope' => 'snsapi_base',
            'state' => 'STATE#wechat_redirect',
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
     * 生成签名
     */
    public static function getSign($params, $key) {
        $data = array();
        foreach ($params as $k => $v) {
            $data[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($data);
        $String = \tools\Tools::createLinkstring($data);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $key;
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }
}

?>
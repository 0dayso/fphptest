<?php

/**
 * 支付控制器
 * 短信通知、微信通知等通知方式
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Services_Gateway extends Controller_Template {

    public $template = 'template';

    public function before(){
        parent::before();

        if(\Input::get('account_id', false)){
            $account = \Model_WXAccount::find(\Input::get('account_id'));
            \Session::set('account', $account);
        }

        $openid = false;
        if(\Input::get('wechat', false)){
            $openid = \Input::get('wechat');
        }else if(\Input::get('wechat_open_id', false)){
            $openid = \Input::get('wechat_open_id');
        }

        if( ! $openid){
            return $openid;
        }

        $wechat = \Model_Wechat::query()
              ->where('openid', $openid)
              ->get_one();
        if($wechat){
            \Session::set('wechat', $wechat);
            \Auth::force_login($wechat->user_id);
        }
    }

    /**
     * 默认方法
     *
     * @access  public
     * @return  \Response
     */
    public function action_index() {
        die('index');
    }

    /**
    * 支付入口
    *
    * @param $payment 支付类型
    */
    public function action_pay($payment = 'wxpay'){
        switch ($payment) {
            case 'wxpay':
                return $this->wxpay_pay();
                break;
            case 'alipay':
                return $this->alipay_pay();
                break;
        }
    }

    /**
    * 支付回调
    * @param $payment 支付类型
    */
    public function action_callback($payment = 'alipay'){
        
        switch ($payment) {
            case 'alipay':
                die('财付通服务器回调');
                break;
            case 'tenpay':
                die('财付通服务器回调');
                break;
            case 'wxpay':
                die('微信服务器回调');
                break;
            
            default:
                break;
        }
    }

    /**
    * 支付通知
    * @param $payment 支付类型
    */
    public function action_notice($payment = 'alipay'){
        
        switch ($payment) {
            case 'alipay':
                $this->alipay_notice();
                break;
            case 'tenpay':
                die('财付通服务器通知');
                break;
            case 'wxpay':
                $this->wxpay_notice();
                break;
            
            default:
                break;
        }
    }

    /**
    * 支付宝通知
    * 
    * 程序根据支付宝服务器POST的参数
    * 判断是PC或是手机WAP支付，并完成
    * 订单处理(业务)。
    */
    private function alipay_notice(){
        $data = \Input::post();

        //支付宝基础配置
        $config = \impls\alipay\AlipayTools::baseConfig();

        if(\Input::post('notify_data', false)){
            $notify = new \impls\alipaywap\AlipayNotify($config);
            if($config['sign_type'] == '0001'){
                $data['notify_data'] = $notify->decrypt($_POST['notify_data']);
            }

            $doc = new \DOMDocument();
            $doc->loadXML($data['notify_data']);

            if(empty($doc->getElementsByTagName("notify")->item(0)->nodeValue)){
                return;
            }

            //获取订单号、交易号、交易状态
            $data['out_trade_no'] = $doc->getElementsByTagName("out_trade_no")->item(0)->nodeValue;
            $data['trade_no'] = $doc->getElementsByTagName("trade_no")->item(0)->nodeValue;
            $data['trade_status'] = $doc->getElementsByTagName("trade_status")->item(0)->nodeValue;
        }else{
            //验证通知是否合法
            $notify = new \impls\alipay\AlipayNotify($config);
            if( ! $notify->verifyNotify()){
                die('fail');
            }
        }

        //获取订单数据
        $order = \Model_Order::query()
                    ->related('trade')
                    ->where('order_no', $data['out_trade_no'])
                    ->get_one();
        if(! $order){
            \Log::error("订单不存在，交易号：{$order['trade_no']}，订单号：{$data['out_trade_no']}");
            die('fail');
        }

        //获取通知配置
        $access = \Model_AccessConfig::query()
                ->where('accessType', 'alipay')
                ->where('user_id', $order->from_id)
                ->where('enable', 'ENABLE')
                ->get_one();
        //设置支付信息
        $config['partner'] = $access->accessID;
        $config['key'] = $access->accessKey;
        $config['seller_email'] = $access->email;

        if(in_array($data['trade_status'], array('TRADE_FINISHED', 'TRADE_SUCCESS'))){
            //修改订单支付状态、订单状态
            if($order->trade->return_status == 'NONE'){
                $order->trade->return_status = 'SUCCESS';
                $order->trade->return_trade_no = $data['trade_no'];
                $order->trade->out_trade_no = $data['out_trade_no'];
                $order->order_status = 'PAYMENT_SUCCESS';
                $order->save();
            }            
        }
        die('success');
    }

    /**
    * PC版财付通通知
    *
    */
    private function tenpay_notice(){}

    /**
    * 微信支付通知
    *
    */
    private function wxpay_notice(){
        //获取微信支付服务器提供的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $result = \tools\Tools::xmlToArray($xml);

        //获取商户的支付配置信息
        $order = \Model_Order::query()->where('order_no',$result['out_trade_no'])->get_one();//order_no

        \Log::error("wxpay callback result data:".json_encode($result));
        //订单交易对象
        /*
        if(! $order->trade){
            $trade = array(
                'order_id' => $order->id,
                'return_status' => 'NONE',
                'response_msg' => json_encode($result),
                'return_trade_no' => $result['transaction_id'],
                'out_trade_no' => '',                    
                'updated_at' => time()
            );
            $order->trade = \Model_Order::forge();
        }*/
        //$order->trade = \Model_Order::forge();

        //支付配置
        $access = \Model_AccessConfig::query()
                ->where('accessType', 'wxpay')
                ->where('user_id', $order->from_id)
                ->where('enable', 'ENABLE')
                ->get_one();

        //检验签名
        $tmpSign = $result;
        unset($tmpSign['sign']);
        $sign = impls\wxpay\WXPayTools::getSign($tmpSign, $access->accessKey);

        $params = array(
            'return_code' => 'SUCCESS'
        );    
        if($result['sign'] != $sign){
            $order->order_status = 'PAYMENT_ERROR';
            $order->trade->return_status = 'ERROR';
            $params = array(
                'return_code' => 'FAIL',
                'return_msg' => '签名失败'
            );
        }else{
            $order->order_status = 'PAYMENT_SUCCESS';
            $order->remark = json_encode($result);
            //$order->trade->return_status = 'OK';
            //$order->trade->return_trade_no = $result['transaction_id'];
            //$order->trade->response_msg = json_encode($result);
        }
        $order->save();
        
        $data = \tools\Tools::arrayToXml($params);
        die($data);
    }

    /**
    * 发起支付宝支付
    *
    * 通过GET方式获取的order_id查询订单
    * 信息。通过订单信息中的卖家ID获取支
    * 付宝的配置信息。并根据用户访问本系
    * 统的设置来确定发起PC支付宝支付还是
    * 手机版支付宝支付。
    */
    private function alipay_pay(){
        if(! \Input::get('order_id', false)){
            die('系统繁忙请重试');
        }

        $order = \Model_Order::find(\Input::get('order_id'));

        $access = \Model_AccessConfig::query()
                ->where('accessType', 'alipay')
                ->where('user_id', $order->from_id)
                ->where('enable', 'ENABLE')
                ->get_one();

        if( ! $access){
            if(\Input::is_ajax()){
                die(json_encode(array('sattus' => 'err', 'msg' => '商家支付宝未配置', 'errcode' => 10)));
            }
            die('商家支付宝未配置');
        }

        $config = \impls\alipay\AlipayTools::baseConfig();
        $config['partner'] = $access->accessID;
        $config['key'] = $access->accessKey;
        $config['seller_email'] = $access->email;

        //支付宝配置
        $params['config'] = $config;
        //订单数据
        $params['order'] = $order;
        //其它数据
        $params['order_url'] = \Config::get('base_url');
        $params['callback_url'] = \Config::get('base_url') . "services/gateway/callback/alipay";
        $params['notify_url'] = \Config::get('base_url') . "services/gateway/notice/alipay";

        if(\tools\Tools::is_mobile()){
            $params['merchant_url'] = '';
        }
        
        return \Response::forge(\View::forge('pay/alipay' . (\tools\Tools::is_mobile() ? '_wap' : ''), $params));
    }

    /**
    * 发起财付通支付
    *
    */
    private function tenpay_pay(){}

    /**
    * 发起微信支付
    *
    */
    private function wxpay_pay(){

        if( ! \Input::get('order_id', false)){
            die('System busy! Please try again later!');
        }

        $wechat_openid = false;
        if(\Session::get('wechat', false)){
            $wechat_openid = \Session::get('wechat')->openid;
        }
        if( ! $wechat_openid && \Input::get('wechat', false)){
            $wechat_openid = \Input::get('wechat');
        }
        if( ! $wechat_openid){

            $base_url = \Config::get('base_url');
            $account = \Model_WXAccount::find(1);
            $str_params = \tools\Tools::createLinkstring(\Input::get());

            //先到微信服务器获取openid
            $params = array(
                'appid' => $account->app_id,
                'redirect_uri' => "{$base_url}wxapi/oauth2_callback?to_url={$base_url}services/gateway/pay/wxpay?" . $str_params,
                'response_type' => 'code',
                'scope' => 'snsapi_userinfo',
                'state' => "#wechat_redirect",
            );
            $sort_params = \tools\Tools::argSort($params);
            $str_params = \tools\Tools::createLinkstring($sort_params);
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?{$str_params}";
            \Response::redirect($url);
        }
        

        $order = \Model_Order::find(\Input::get('order_id'));

        $access = \Model_AccessConfig::query()
                ->where('accessType', 'wxpay')
                ->where('user_id', $order->from_id)
                ->where('enable', 'ENABLE')
                ->get_one();

        if( ! $access){
            if(\Input::is_ajax()){
                die(json_encode(array('sattus' => 'err', 'msg' => '商家微信支付未配置', 'errcode' => 10)));
            }
            die('商家微信支付未配置');
        }

        $params = array(
            'openid' => $wechat_openid,
            'body' => $order->order_body ? $order->order_body : '',
            'out_trade_no' => $order->order_no,
            'total_fee' => $order->original_money * 100,
            'notify_url' => \Config::get('base_url') . 'services/gateway/notice/wxpay',
            'trade_type' => 'JSAPI',
            'appid' => \Session::get('account')->app_id,
            'mch_id' => $access->accessID,
            'nonce_str' => \tools\Tools::createNoncestr()
        );
        $params['sign'] = impls\wxpay\WXPayTools::getSign($params, $access->accessKey);

        $data = \tools\Tools::arrayToXml($params);

        $result = \tools\Tools::request_xml('https://api.mch.weixin.qq.com/pay/unifiedorder', 'POST', $data);
        $result = \tools\Tools::xmlToArray($result);
        if($result['return_code'] == 'FAIL'){
            var_dump($result);
            die();
        }

        $params = array(
            'appId' => \Session::get('account')->app_id,
            'timeStamp' => '"' . time() . '"',
            'nonceStr' => \tools\Tools::createNoncestr(),
            'package' => "prepay_id={$result['prepay_id']}",
            'signType' => "MD5"
        );

        $params['paySign'] = \impls\wxpay\WXPayTools::getSign($params, $access->accessKey);

        $str_params = json_encode($params);

        $params = array(
            'params' => $str_params
        );
        return \Response::forge(\View::forge('pay/wxpay', $params));
    }

}
<?php
/**
* 微信支付通知接口
*/
namespace impls\pay;

class WXpay {

	public function response(){
		\Log::error($GLOBALS["HTTP_RAW_POST_DATA"]);
		$data = simplexml_load_string($GLOBALS["HTTP_RAW_POST_DATA"], 'SimpleXMLElement', LIBXML_NOCDATA);

		if($this->verifySign($data)){
			\Log::error('签名成功');
			$data = array();
			foreach (\Input::get() as $key => $value) {
				$data[$key] = $value;
			}
			echo 'success';
		}
		\Log::error('签名失败');
		echo 'fail';
	}

	public function verifySign($data){
		if( ! $data){
			\Log::error('【微信支付】通知时发生异常：获取xml失败');
			die('fail');
		}

		$account = \Model_WXAccount::getItem(array('open_id' => $data->AppId));

		if( ! $account){
			\Log::error('【微信支付】通知时发生异常：获取account失败');
			die('fail');
		}
		$access = \Model_AccessConfig::getItem(array('user_id' => $account->user_id, 'accessType' => 'wxpay', 'enable' => 'ENABLE'));

		if(! $access){
			\Log::error('【微信支付】通知时发生异常：获取微信支付配置信息时失败');
			die('fail');
		}

		//组合签名数组
		$sign_array = array(
			'appid' => $data->AppId,
			'appkey' => $access->accessKey,
			'timestamp' => $data->TimeStamp,
			'noncetr' => $data->NonceStr,
			'openid' => $data->OpenId,
			'issubscribe' => $data->IsSubscribe,
		);

		$sign_array = \Tools::argSort($sign_array);
		$signValue = strtoupper(md5(\Tools::createLinkstring($sign_array) . "&key={$access->accessKey}"));

		if($signValue == $data->AppSignature){
			return true;
		}ele{
			return false;
		}
	}
}
?>
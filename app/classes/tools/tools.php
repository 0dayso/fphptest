<?php

/**
* 工具类
*/

namespace tools;

class Tools {
	
	function __construct()	{
		
	}

	/**
	* 模拟GET或POST XML到直接URL
	* 
	* @param $url 需要发送的地址
	* @param $method 请求方式
	* @param $params 参数列表
	* @param $is_ssl https
	*/
	public static function request_xml($url, $method = 'POST', $params, $is_ssl = true){

		$curl = \Request::forge($url, 'curl');
		$curl->set_method($method);		
		
		if($params){
			$curl->set_params($params);		
		}

		if($is_ssl){
			$curl->set_option(CURLOPT_SSL_VERIFYPEER, false);
			$curl->set_option(CURLOPT_SSL_VERIFYHOST, false);			
		}

		$curl->set_options(array(
				CURLOPT_TIMEOUT => 30,
    			CURLOPT_FOLLOWLOCATION => true,
    			CURLOPT_HEADER => FALSE,
    			CURLOPT_RETURNTRANSFER => TRUE,

			)
		);

		$result;

		try{
			$result = $curl->execute()->response();
		}catch(Exception $e){
			\Log::error("发送请求时，发生了异常(classes/tolls/tools.php)：" . $e->getMessage());
		}
		
		return $result;
	}

	/**
	* 模拟GET或POST发送请求
	* 并获取返回值
	* @param $url 需要发送的地址
	* @param $method 请求方式
	* @param $params 参数列表
	* @param $is_ssl https
	*/
	public static function request($url, $method = 'GET', $params = array(), $is_ssl = false, $mime = false, $options = array()){
		if( ! $url){
			die('错误的URL');
		}
		$curl = \Request::forge($url, 'curl');
		$curl->set_method($method);		
		
		if($params){
			$curl->set_params($params);		
		}

		if($is_ssl){
			$curl->set_option(CURLOPT_SSL_VERIFYPEER, false);
		}

		if($options){
			$curl->set_options($options);
		}
		
		if($mime){
			$curl->set_mime_type($mime);
		}

		$curl->set_options(array(
				CURLOPT_TIMEOUT => 30,
    			CURLOPT_FOLLOWLOCATION => true,
			)
		);

		$result;

		try{
			$result = $curl->execute()->response();
		}catch(Exception $e){
			\Log::error("发送请求时，发生了异常(classes/tolls/tools.php)：" . $e->getMessage());
		}
		
		return $result;
	}

	/**
	 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	 * @param $para 需要拼接的数组
	 * return 拼接完成以后的字符串
	 */
	public static function createLinkstring($para) {
		$arg  = "";
		while (list ($key, $val) = each ($para)) {
			$arg.= "{$key}={$val}&";
		}
		//去掉最后一个&字符
		$arg = substr($arg,0,count($arg)-2);
		
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
		
		return $arg;
	}

	/**
	 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串，并对字符串做urlencode编码
	 * @param $para 需要拼接的数组
	 * return 拼接完成以后的字符串
	 */
	public static function createLinkstringUrlencode($para) {
		$arg  = "";
		while (list ($key, $val) = each ($para)) {
			$arg.=$key."=".urlencode($val)."&";
		}
		//去掉最后一个&字符
		$arg = substr($arg,0,count($arg)-2);
		
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
		
		return $arg;
	}

	/**
	 * 除去数组中的空值和签名参数
	 * @param $para 签名参数组
	 * return 去掉空值与签名参数后的新签名参数组
	 */
	public static function paraFilter($para) {
		$para_filter = array();
		while (list ($key, $val) = each ($para)) {
			if($key == "sign" || $key == "sign_type" || $val == "")continue;
			else	$para_filter[$key] = $para[$key];
		}
		return $para_filter;
	}

	/**
	 * 对数组排序
	 * @param $para 排序前的数组
	 * return 排序后的数组
	 */
	public static function argSort($para) {
		ksort($para);
		reset($para);
		return $para;
	}

	/**
	 * 实现多种字符编码方式
	 * @param $input 需要编码的字符串
	 * @param $_output_charset 输出的编码格式
	 * @param $_input_charset 输入的编码格式
	 * return 编码后的字符串
	 */
	public static function charsetEncode($input,$_output_charset ,$_input_charset) {
		$output = "";
		if(!isset($_output_charset) )$_output_charset  = $_input_charset;
		if($_input_charset == $_output_charset || $input ==null ) {
			$output = $input;
		} elseif (function_exists("mb_convert_encoding")) {
			$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
		} elseif(function_exists("iconv")) {
			$output = iconv($_input_charset,$_output_charset,$input);
		} else die("sorry, you have no libs support for charset change.");
		return $output;
	}
	
	/**
	 * 实现多种字符解码方式
	 * @param $input 需要解码的字符串
	 * @param $_output_charset 输出的解码格式
	 * @param $_input_charset 输入的解码格式
	 * return 解码后的字符串
	 */
	public static function charsetDecode($input,$_input_charset ,$_output_charset) {
		$output = "";
		if(!isset($_input_charset) )$_input_charset  = $_input_charset ;
		if($_input_charset == $_output_charset || $input ==null ) {
			$output = $input;
		} elseif (function_exists("mb_convert_encoding")) {
			$output = mb_convert_encoding($input,$_output_charset,$_input_charset);
		} elseif(function_exists("iconv")) {
			$output = iconv($_input_charset,$_output_charset,$input);
		} else die("sorry, you have no libs support for charset changes.");
		return $output;
	}


	/**
	* 判断是否手机访问
	* @return bool
	*/
	public static function is_mobile(){
	    $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
	    $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
	    $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";    
	    $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
	    $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
	    $regex_match.=")/i";        
	    return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
	}

	/**
	* 转换数字显示模式
	* @param $num 次数
	* @return 转换过的String
	*/
	public static function covert_number($num){
		if($num > 1e8){
            echo round($num / 1e8, 1) . '亿';
        }else if($num > 1e4){
            echo round($num / 1e4) . '万';
        }else{
            echo $num;
        }
	}

	/**
	* 转换文件大小显示模式
	* @param $size 文件大小
	* @return 转换过的String
	*/
	public static function covert_size($size){
		if($size > 1e9){
            echo round($size / 1e9, 2) . "GB";
        }else if($size > 1e6){
            echo round($size / 1e6, 2) . "MB";
        }else if($size > 1e3){
            echo round($size / 1e3, 2) . "KB";
        }else if($size > 1){
            echo $size . "bytes";
        }else if($size == 1){
            echo $size . "byte";
        }else{
            echo "0 byte";
        }
	}
	
	/**
	 * 产生随机字符串，不长于32位
	 * @param $length 随机字符串的长度
	 * @return 随机字符串
	 */
	public static function createNoncestr( $length = 32 ) {
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str;
	}

	/**
	 * array转xml
	 * @param $arr 待转换的数组
	 * @return String 转换后的XML
	 */
	public static function arrayToXml($arr) {
		$xml = '';
        foreach ($arr as $key => $val) {
        	if (is_array($val)) {
        		$xml .= '<people>';
        		$xml .= static::arrayToXml($val);
        		$xml .= '</people>';
        	} else if(is_numeric($val) || is_null($val)){
        		$xml .= "<{$key}>{$val}</{$key}>";
        	} else {
        		$xml .= "<{$key}><![CDATA[{$val}]]></{$key}>";
        	}
        }
        return $xml; 
    }
	
	/**
	 * 将xml转为array
	 * @param $xml 待转换的XML
	 * @return Array 转换后的Array
	 */
	public static function xmlToArray($xml)
	{		
        //将XML转为array      
        $data = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);  
        $arr = json_decode(json_encode($data), true);		
		return $arr;
	}

	/**
	 * 生成二维码图片
	 * @param $value 二维码参数
	 * @param $output 二维码图片保存目录
	 * @param $file_name 指定二维码图片文件名
	 * @param $logo_file 二维码中显示的LOGO图片路径
	 * @return 二维码图片存储路径
	 */
	public static function generate_qrcode($value, $output, $file_name = false, $logo_file = false, $errLevel = 'L', $size = 10){

		if(! $file_name){
			$user_id = \Auth::check() ? \Auth::get_user()->id : '0';
			$time = time();
			$file_name = "qrcode_{$time}_{$user_id}.png";
		}

		//检测目录是否存在，并创建目录
		$qr_path = DOCROOT . "{$output}";
		if( ! file_exists($qr_path)){
			$temp = DOCROOT;
			foreach (explode('/', $output) as $key => $value) {
				$temp .= "/{$value}";
				if( ! file_exists($temp)){
					mkdir($temp);
				}
			}
		}
		$qr_path = "{$qr_path}/{$file_name}";

		\QRcode::png($value, $qr_path, $errLevel, $size, 2);

		$QR = imagecreatefromstring(file_get_contents($qr_path));

		if($logo_file){			   
		    $logo = imagecreatefromstring(file_get_contents($logo_file));   
		    $QR_width = imagesx($QR);//二维码图片宽度   
		    $QR_height = imagesy($QR);//二维码图片高度

		    $logo_width = imagesx($logo);//logo图片宽度   
		    $logo_height = imagesy($logo);//logo图片高度  

		    $logo_qr_width = $QR_width / 5;   
		    $scale = $logo_width / $logo_qr_width;   
		    $logo_qr_height = $logo_height / $scale;   

		    $from_width = ($QR_width - $logo_qr_width) / 2;   
		    //重新组合图片并调整大小   
		    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
		    $logo_qr_height, $logo_width, $logo_height);		    
		}

		imagepng($QR, $qr_path);

		return "{$output}/{$file_name}";
		/*if( ! isset($data['outtype']) || $data['outtype'] == 'file'){
	    	imagepng($QR, $qr_path);
	    	echo "<img src='{$output_path}/{$image}'>";
	    }else if($data['outtype'] == 'browser'){
	    	imagepng($QR);
	    }else if($data['outtype'] == 'url'){
	    	echo "{$output_path}/{$image}";
	    }*/
	}

	/**
	* @param $module String 模块名
	* @param $controller String 控制器名
	* @param $actions String 动作列表，如list,add,edit,delete
	* [example]
	* $flag = \tools\Tools::check_permission('admin', 'goods', 'list');
	* [/example]
	*/
	public static function check_permission($module, $controller, $actions){
		$controller = empty($controller) ? 'home' : $controller;
		/* 检验权限 */
		if ( ! \Auth::has_access("{$module}.{$controller}.{$actions}")) {
			//this user does not have the rights to the 'list' and 'delete' actions of the modulename.controllername permission;
			return 0;
		}else{
			return 1;
		}
	}

	public static function cutstr_html($string, $sublen)    
	{
	  $string = strip_tags($string);
	  $string = preg_replace ('/\n/is', '', $string);
	  $string = preg_replace ('/ |　/is', '', $string);
	  $string = preg_replace ('/&nbsp;/is', '', $string);
	   
	  preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);   
	  if(count($t_string[0]) - 0 > $sublen) $string = join('', array_slice($t_string[0], 0, $sublen))."…";   
	  else $string = join('', array_slice($t_string[0], 0, $sublen));
	   
	  return $string;
	 }

	//检测时间的有效期
	public static function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
	    $unixTime = strtotime($date);
	    if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
	        return false;
	    }
	    //校验日期的有效性，只要满足其中一个格式就OK
	    foreach ($formats as $format) {
	        if (date($format, $unixTime) == $date) {
	            return true;
	        }
	    }
	    return false;
	}

	//返回img Html标签
	public static function bodyfirstimg($body) {
        $body = strtolower($body);
        $reg = '/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i';
        if (preg_match_all($reg, $body, $regs))
        { 
            return $regs[0][0]; //使用正则获取第一幅图像地址 
        }else{ 
            return '';
        }
	}

	//返回img src url
	public static function bodyfirstimgurl($body) {
        $body = strtolower($body);
        if ( preg_match("/<img.*src=[\"](.*?)[\"].*?>/", $body, $regs))
        { 
            return $regs[1]; //获取第一幅图像地址 
        }else{ 
            return '';
        }
	}
}
?>
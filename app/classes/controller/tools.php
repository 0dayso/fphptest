<?php
/**
* 工具类
*/
class Tools {
	
	function __construct()	{
	}

	/**
	* 发送邮件
	* @param $mail_info 邮件内容
	* @param $config 发件人配置
	*/
	public static function send_mail($mail_info, $config = array()){
		$result = array();
		try {
			\Package::load('email');
			if($config){
				$email = \Email::forge($config);
			}else{
				$email = \Email::forge();
			}
			$email->to($mail_info['to'], $mail_info['to_username'])
				->subject($mail_info['subject'])
				->html_body($mail_info['body'])
				->alt_body($mail_info['alt'])
				->send();
			$result = array('status' => 'succ', 'msg' => '发送成功');
		} catch(\EmailValidationFailedException $e) {
			\Log::error('【无效的邮箱地址】' . $e->getMessage());
			$result = array('status' => 'err', 'msg' => '无效的邮箱地址');
		} catch(\EmailSendingFailedException $e) {
			\Log::error('【邮件发送错误】详情：' . $e->getMessage());
			$result = array('status' => 'err', 'msg' => '邮件发送错误');
		}
		return $result;
	}

	/**
	* 发送短信
	* @param $phones 收件人
	* @param $content 短信内容
	*/
	public static function send_sms($phones, $content, $record_id = 0, $sellername = ''){
		//获取短信发送配置信息
		\Config::load('sms');
		$gateway = \Config::get('gateway');		//当前使用的短信通道
		$username = \Config::get('username');	//通道帐户
		$password = \Config::get('password');	//帐户密码

		$sms = new \impls\sms\Fxhd(\Config::get($gateway));
		$flag = $sms->send($phones, urlencode($content), $sellername);
		
		$smsRecord = \Model_SmsRecord::find($record_id);
		if($flag){
			$smsRecord->status = 'SUCCESS';
		}else{
			$smsRecord->status = 'ERROR';
			$smsRecord->remark = $flag;
		}
		$smsRecord->save();
		if($smsRecord->status == 'SUCCESS'){
			return json_encode(array('status' => 'succ', 'msg' => '发送成功', 'errcdoe' => 0));
		}else{
			return json_encode(array('status' => 'err', 'msg' => '发送失败', 'errcdoe' => 20));
		}
	}

	/**
	* 模拟GET或POST发送请求
	* 并获取返回值
	* @param $url 需要发送的地址
	* @param $method 请求方式
	* @param $params 参数列表
	* @param $is_ssl https
	*/
	public static function send($url, $method = 'POST', $params = array(), $is_ssl = false, $mime = false){
		if(!$url){
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
		
		if($mime){
			$curl->set_mime_type($mime);
		}

		$curl->set_options(array(
				CURLOPT_TIMEOUT => 30,
    			CURLOPT_FOLLOWLOCATION => true,
			)
		);
		
		return $curl->execute()->response();
	}

    public static function lottery($proArr) { 
        $result = '';  
        //概率数组的总概率精度 
        $proSum = array_sum($proArr);  
        //概率数组循环 
        foreach ($proArr as $key => $proCur) { 
            $randNum = mt_rand(1, $proSum); 
            if ($randNum <= $proCur) { 
                $result = $key; 
                break; 
            } else { 
                $proSum -= $proCur; 
            }       
        } 
        unset ($proArr);  
        return $result; 
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
	* 获取来路域名
	*/
	public static function getFromDomain() {
		$url = \Input::server('HTTP_REFERER');   //获取完整的来路URL
		$str = str_replace("http://","",$url);  //去掉http://
		$strdomain = explode("/",$str);               // 以“/”分开成数组
		$domain    = $strdomain[0];              //取第一个“/”以前的字符
		return $domain;
	}

	/**
	* 导出Excel
	*/
	public static function to_excel($file_name, $data){
    	$obj = new \PHPExcel();
    	$excel = new \PHPExcel_Writer_Excel2007($obj);
    	
    	//设置属性
    	$obj->getProperties()->setCreator("Ray");
    	$obj->getProperties()->setLastModifiedBy("Ray");

    	$obj->getProperties()->setTitle("Data File");
    	$obj->getProperties()->setSubject("Export Data");
    	$obj->getProperties()->setDescription("This is PHP Export To Excel File");
    	$obj->getProperties()->setKeywords("Office 2007 OpenXML PHP");
    	$obj->getProperties()->setCategory("data");

    	//设置sheet
    	$obj->setActiveSheetIndex(0);

    	
    	$prefixs = array();
        for ($i = 65; $i < 91; $i++) { 
            $prefixs[count($prefixs)] = chr($i);
        }

        //填充表头
        $prefix_index = 0;
        $index = 1;
        $prefix = '';
        for ($i = 0; $i < count($data['titles']); $i++) { 
            if($i != 0 && $i % 26 == 0){
                $prefix = $prefixs[($i / 26) - 1];
                $prefix_index = 0;
            }
            $obj->getActiveSheet()->setCellValue($prefix . chr($prefix_index++ + 65) . $index, $data['titles'][$i]);
        }

    	$prefix = '';
        foreach ($data['rows'] as $row) {
            $prefix_index = 0;
            $index ++;
            foreach ($row as $cell) {
                if($prefix_index != 0 && $prefix_index % 26 == 0){
                    $prefix = $prefixs[($prefix_index / 26) - 1];
                    $prefix_index ++;
                }
                $obj->getActiveSheet()->setCellValue($prefix . chr($prefix_index ++ + 65) . $index, $cell);
            }
        }

        $excel->save($file_name);
    }

    /**
    * 读取Excel中的数据
    *
    * @param file 文件名
    * @return Array 以二维数组形式返回Excel中的数据
    */
    public static function importByExcel($file){
        $obj = new \PHPExcel();
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        $objPHPExcel = $objReader->load($file);
        $sheet = $objPHPExcel->getSheet(0); 
        $rows = $sheet->getHighestRow();           //取得总行数 
        $cols = $sheet->getHighestColumn(); //取得总列数

        $items = array();
        for ($row = 1; $row <= $rows; $row++) { 
            $item = array();
            for ($cell = 'A'; $cell <= $cols; $cell++) { 
                $item[count($item)] = $sheet->getCell($cell.$row)->getValue();
            }
            array_push($items, $item);
        }
        return $items;
    }

    public static function category_html($cats, $default = false){
        $html = '';
		if(! $cats){
			return $html;
		}
        foreach ($cats as $key => $value) {
            $sub = $value->children()->get();
            $prefix = str_repeat('--', $value->depth - 1);
            $html .= "<option value='{$value->id}' " . ($default == $value->id ? ' selected="selected"' : '') . ">{$prefix}{$value->name}</option>";
            if($sub){
                $html .= static::category_html($sub, $default);
                continue;
            }
        }
        return $html;
    }

    public static function sub_categorys($cats){
        $ids = array();
		if(! $cats){
			return $ids;
		}
        foreach ($cats as $key => $value) {
            $sub = $value->children()->get();
            array_push($ids, $value->id);
            if($sub){
                $sids = static::sub_categorys($sub);
                $ids = array_merge($ids, $sids);
                continue;
            }
        }
        return $ids;
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
}
?>
<?php

/**
 * 行政区域控制器
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Common_Region extends \Controller_BaseController {

    public function action_index(){
    	$areas = array(
			'华南' => array(71, 72, 40, 41, 42),
			'华北' => array(10, 11, 12, 13, 14),
			'华东' => array(30, 31, 32, 33, 34, 35, 36),
			'华中' => array(70),
			'东北' => array(20, 21, 22),
			'西南' => array(60, 61, 62, 63, 64),
			'西北' => array(80, 81, 82, 83, 84),
			'港、澳、台' => array(90, 91, 92)
		);
		$area = \Input::get('area', false);

		//查询
		$pid = \Input::get('pid', 0);
		$tname = \DB::table_prefix('region');
		$sql = "select * from {$tname} where father_id = {$pid} order by convert(region_name USING gbk) COLLATE gbk_bin asc";
		$items = \DB::query($sql)->execute()->as_array();

		if($area){
		    $result = $items;
		    $items = array();
		    foreach ($result as $key => $value) {
				if(in_array($value->region_code, $areas[$area])){
					array_push($items, $value->to_array());
				}
			}
		}
		   
		if($items){
			die(json_encode(array('status' => 'succ', 'msg' => '获取成功', 'errcode' => 0, 'data' => $items)));
		}else{
			die(json_encode(array('status' => 'err', 'msg' => '获取失败', 'errcode' => 10)));
		}
    }

}

<?php
/**
* 防钓鱼数据模型
* 
* @package app
* @version    1.0
* @author     Ray 33705910@qq.com
* @license    MIT License
* @copyright  2013 - 2015 Ray
* @link       http://wangxiaolei.cn
 *
 * @package  app
 * @extends  \Orm\Model
 */
class Model_RequestCheck extends \Orm\Model {

	protected static $_table_name = 'request_check';

	protected static $_primary_key = array('id');
	
	protected static $_properties = array(
		'id',
		'timestamp',
		'domain',
		'ip'
	);

	/**
	* 创建防钓鱼配置项
	* [example]
	* [/example]
	**/
	public static function do_create($data){

		$entity = Model_RequestCheck::forge($data);
		
		if($entity->save()){
			return array('ret' => 'succ', 'msg' => '保存成功', 'data' => $entity);
		}else{
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 删除防钓鱼配置项
	* @param $id int 防钓鱼配置项标识
	* [example]
	* $result = Model_Trade::do_delete(1);
	* var_dump($result);
	* [/example]
	*/
	public static function do_delete($id){
		$entity = Model_RequestCheck::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '防钓鱼配置不存在，无法删除');
		}

		if($entity->delete()){
			return array('ret' => 'succ', 'msg' => '删除成功');
		}else{
			return array('ret' => 'err', 'msg' => '删除失败');
		}
	}

	/**
	* 更新防钓鱼配置项
	* [example]
	* [/example]
	**/
	public static function do_update($id, $data){
		$entity = Model_RequestCheck::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '防钓鱼配置不存在，无法编辑');
		}
		$entity->set($data);
		if($entity->save()){
			return array('ret' => 'succ', 'msg' => '保存成功');
		}else{
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 根据防钓鱼ID和删除状态获取单条数据
	* @param $id int 防钓鱼ID
	* @param $is_array int 是否转换为Array
	*/
	public static function getData($id, $is_array = 0){
		$entity = Model_RequestCheck::find($id);

		if($entity){
			return $is_array ? $entity->to_array() : $entity;
		}
		return;
	}

	/**
	* 根据条件获取单条数据
	* @param $params Array 条件参数
	* @param $is_array int 是否转换为Array
	*/
	public static function getItem($params = array(), $is_array = 0){
		$entity = Model_RequestCheck::query();
		if($params && is_array($params)){
			foreach ($params as $key => $value) {
				if(is_array($value)){
					$entity->where($value[0], $value[1], $value[2]);
				}else{
					$entity->where($key, $value);
				}				
			}
		}
		return $is_array == 1 ? $entity->get_one()->to_array() : $entity->get_one();
	}

	/**
	* 根据查询条件、排序条件获取数据
	* @param $fields String 显示字段列表
	* @param $params Array 查询条件
	* @param $tables Array 多表查询
	* @param $order_by Array 排序字段(array('字段名' => 'ASC|DESC'))
	* @param $page int 分页状态(0.不分页 1.分页)
	*/
	public static function getItems($fields = '*', $params = array(), $tables = array(), $order_by = array(), $page = 0){
		$items = Model_RequestCheck::query();
		//判断是否多表查询
		if($tables){
			$items->related($tables);
		}
		//判断是否有查询条件
		if($params){
			foreach ($params as $key => $value) {
				if(is_array($value)){
					$items->where($value[0], $value[1], $value[2]);
				}else{
					$items->where($key, $value);
				}
				
			}
		}
		//判断是否有排序条件
		if($order_by){
			foreach ($order_by as $key => $value) {
				if(is_numeric($key)){
					$items->order_by($value);
				}else{
					$items->order_by($key, $value);
				}				
			}
		}
		
		//判断是否分页
		if($page){
			return $items;
		}else{
			return $items->get();
		}
	}
}
?>
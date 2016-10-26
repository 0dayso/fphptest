<?php
/**
* 交易数据模板
* 
* @package app
* @version    1.0
* @author     Ray 33705910@qq.com
* @license    MIT License
* @copyright  2013 - 2015 Ray
* @link       http://wangxiaolei.cn
*
* @package  app
* @extends  Auth\Model\Auth_User
*/
class Model_User extends Auth\Model\Auth_User
{
	protected static $_table_name = 'users';

	public static function _init() {
		
		static::$_has_many = array(
			'nodes' => array(
				'key_from' => 'id',
				'model_to' => 'Model_Node',
				'key_to' => 'user_id',
				'cascade_save' => true,
				'cascade_delete' => false,
			),
		);

	}

	public static function do_create($data){
		if(! isset($data['profile'])){
			$data['profile'] = array(
				'status' => '1',
				'login_count' => 0,
				'actived' => 0,
				'previous_ip' => \Input::ip(),
			);
		}else{
			$data['profile'] = array_merge(array(
				'status' => '1',
				'login_count' => 0,
				'actived' => 0,
				'previous_ip' => \Input::ip(),
			), $data['profile']);
		}

		try{
			$result = \Auth::create_user($data['username'], $data['password'], $data['email'], $data['group_id'], $data['profile']);
		}catch(Exception $e){
			return array('status' => 'err', 'msg' => $e->getMessage());
		}		
		if($result){
			return array('status' => 'succ', 'msg' => 'save ok', 'data' => $result);
		}else{
			return array('status' => 'err', 'msg' => 'save error');
		}
	}

	/**
	* 删除一个用户
	* @param $id int 用户标识
	* [example]
	* $result = Model_User::do_delete(1);
	* var_dump($result);
	* [/example]
	*/
	public static function do_delete($id){
		$entity = Model_User::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '用户不存在，无法删除');
		}

		if($entity->delete()){
			return array('ret' => 'succ', 'msg' => '删除成功');
		}else{
			return array('ret' => 'err', 'msg' => '删除失败');
		}
	}

	/**
	* 更新一个用户
	* [example]
	* [/example]
	**/
	public static function do_update($id, $data){
		$entity = Model_User::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '用户不存在，无法编辑');
		}
		$entity->set($data);
		var_dump($data);die();
		if($entity->save()){
			return array('ret' => 'succ', 'msg' => '保存成功');
		}else{
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 根据用户ID和删除状态获取单条数据
	* @param $id int 用户ID
	* @param $flag int 是否包含假删状态(1.包含 0.不包含)
	* @param $is_array int 是否转换为Array
	*/
	public static function getData($id, $flag = 0, $is_array = 0){
		$entity = Model_User::find($id);

		if($flag){
			return $entity;
		}else if($entity){
			return $is_array ? $entity->to_array() : $entity;
		}
		return;
	}

	/**
	* 根据条件获取单条数据
	* @param $params int 查询条件
	* @param $is_array int 是否转换为Array
	*/
	public static function getItem($params = array(), $is_array = 0){
		$entity = Model_User::query()->related('metadata');
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
	* @param $params Array 查询条件
	* @param $tables Array 多表查询
	* @param $order_by Array 排序字段(array('字段名' => 'ASC|DESC'))
	* @param $page int 分页状态(0.不分页 1.分页)
	*/
	public static function getItems($fields = '*',$params = array(), $tables = array(), $order_by = array(), $page = 0){
		$items = Model_User::query();
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

	/**
	* 获取指定用户的子帐户ID集
	* @param user_id int 用户ID
	* @return Array(int) 子用户ID数组
	*/
	public static function getChildren($user_id){
		$users = \Model_User::getItems('*', array('metadata.value' => $user_id, 'metadata.key' => 'parent'), array('metadata'));
		$user_ids = array($user_id);
		foreach ($users as $user) {
			array_push($user_ids, $user->id);
		}
		return $user_ids;
	}
}

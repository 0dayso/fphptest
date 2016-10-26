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
* @extends  \Orm\Model
*/
class Model_Trade extends \Orm\Model {

	protected static $_table_name = 'orders_trades';

	protected static $_primary_key = array('order_id');
	
	protected static $_properties = array(
		'order_id',
		'return_status',
		'real_money',
		'response_msg',
		'out_trade_no',
		'return_trade_no',
		'request_msg',
		'callback_url',
		'notify_url',
		'notify_params',
		'notify_status',
		'updated_at',
		'notify_at'
	);

	public static $_maps = array(
		'status' => array(
			'NONE' => '未支付',
			'OK' => '已支付',
			'ERROR' => '支付失败',
		),
		'notify' => array(
			'NONE' => '未通知',
			'SUCCESS' => '已通知',
			'ERROR' => '通知异常',
		),
		'label' => array(
			'NONE' => 'warning',
			'OK' => 'success',
			'ERROR' => 'danger',
		)
	);

	protected static $_belongs_to = array(
		'order' => array(
			'key_from' => 'order_id',
			'model_to' => '\Model_Order',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false
		)
	); 

	/**
	* 创建一笔交易
	* [example]
	* [/example]
	**/
	public static function do_create($data){

		$entity = Model_Trade::forge($data);
		/*if($data['profile']){
			foreach($data['profile'] as $field => $value) {
				$entity->metadata[] = \Model_TradeMetadata::forge(array('key' => $field, 'value' => $value));
			}
		}*/
		
		if($entity->save()){
			return array('ret' => 'succ', 'msg' => '保存成功');
		}else{
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 删除一笔交易
	* @param $id int 交易标识
	* [example]
	* $result = Model_Trade::do_delete(1);
	* var_dump($result);
	* [/example]
	*/
	public static function do_delete($id){
		$entity = Model_Trade::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '交易不存在，无法删除');
		}

		if($entity->delete()){
			return array('ret' => 'succ', 'msg' => '删除成功');
		}else{
			return array('ret' => 'err', 'msg' => '删除失败');
		}
	}

	/**
	* 更新一笔交易
	* [example]
	* [/example]
	**/
	public static function do_update($id, $data){
		$entity = Model_Trade::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '交易不存在，无法编辑');
		}
		$entity->set($data);
		if($entity->save()){
			return array('ret' => 'succ', 'msg' => '保存成功');
		}else{
			\Log::error('更新一条【交易信息】失败');
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 根据交易ID获取单条数据
	* @param $id int 交易ID
	* @param $is_array int 是否转换为Array
	*/
	public static function getData($id, $is_array = 0){
		$entity = Model_Trade::find($id);

		if($entity){
			return $is_array ? $entity->to_array() : $entity;
		}
		return;
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
		$items = Model_Trade::query();
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
	* 根据统计类型及商户ID获取统计数据
	* @param $type String 统计类型
	* @param $user_id int 商户ID
	**/
	public static function getStatistics($user_id, $type = 'day'){
		switch ($type) {
			case 'day':
				$time = "AND ((DAY(FROM_UNIXTIME(o.created_at)) = DAY(NOW())) AND (MONTH(FROM_UNIXTIME(o.created_at)) = MONTH(NOW())) AND (YEAR(FROM_UNIXTIME(o.created_at)) = YEAR(NOW())))";
				break;
			case 'week':
				$time = "AND YEAR(FROM_UNIXTIME(o.created_at)) = YEAR(curdate()) AND MONTH(FROM_UNIXTIME(o.created_at)) = MONTH(curdate()) AND WEEK(FROM_UNIXTIME(o.created_at)) = WEEK(curdate())";
				break;
			case 'month':
				$time = "AND MONTH(FROM_UNIXTIME(o.created_at)) = MONTH(curdate()) AND YEAR(FROM_UNIXTIME(o.created_at)) = YEAR(curdate())";
				break;
			case 'quarter':
				$time = "QUARTER(FROM_UNIXTIME(o.created_at)) = QUARTER(curdate())";
				break;
			case 'year':
				$time = "YEAR(FROM_UNIXTIME(o.created_at)) = YEAR(curdate())";
				break;
		}
$sql = <<<sql_statment
SELECT SUM(t.real_money) AS money 
FROM orders_trades AS t 
LEFT JOIN orders AS o 
ON t.order_id = o.id
WHERE user_id = {$user_id} 
AND t.return_status = 'OK'
{$time}
sql_statment;

	return DB::query($sql)->execute()->as_array();

	}
}
?>
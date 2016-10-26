<?php
/**
 * 订单数据模型
 * 
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_Order extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'orders';

	protected static $_primary_key = array('id');

	/**
	 * @var array	has_one relationships
	 */
	protected static $_has_one = array(
		'trade' => array(
			'model_to' => 'Model_OrderTrade',
			'key_from' => 'id',
			'key_to'   => 'order_id',
			'cascade_delete' => false,
		)
	);

	/**
	 * @var array	belongs_to relationships
	 */
	protected static $_belongs_to = array(
		'buyer' => array(
			'model_to' => 'Auth\\Model\\Auth_User',
			'key_from' => 'user_id',
			'key_to'   => 'id',
		),
		'seller' => array(
			'model_to' => 'Model_Seller',
			'key_from' => 'from_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	/**
	 * @var array	defined observers
	 */
	protected static $_observers = array(
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'property' => 'created_at',
			'mysql_timestamp' => false
		),
		'Orm\\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'property' => 'updated_at',
			'mysql_timestamp' => false
		),
		'Orm\\Observer_Typing' => array(
			'events' => array('after_load', 'before_save', 'after_save')
		),
		'Orm\\Observer_Self' => array(
			'events' => array('before_insert'),
			'property' => 'user_id'
		),
	);
	
	public static $_maps = array(
		'type' => array(
			'NONE' => '无类型',
			'SELL' => '销售单',
			'PURCHASE' => '进货单',
			'DELIVER' => '出库单',
			'STORAGE' => '入库单',
			'RETURNED' => '退货单',
			'BARTER' => '换货单',
			'INVOICE' => '发货单',
			'BOOK' => '预约单',
			'REFUND' => '退款',
			'RECHARGE' => '充值',
			'TAKEAWAY' => '外卖单',
		),
		'status' => array(
			'NONE' => '无状态',
			'WAIT_PAYMENT' => '待支付',
			'PAYMENT_ERROR' => '支付失败',
			'PAYMENT_SUCCESS' => '支付完成',
			'SELLER_CANCEL' => '商户取消',
			'USER_CANCEL' => '用户取消',
			'WAIT_SURE' => '待确认',
			'SURE' => '确认',
			'WAIT_SHIPPED' => '待发货',
            'SHIPPED' => '已发货',
            'FORRECEIVABLES' =>  '待收款',
            'REFUNDMENT' =>  '退款中',
			'RECEIVED' => '已签收',
			'CHECKED' => '核对完成',
			'SYSTEM_STOP' => '系统中止',
			'FINISH' => '已完成'
		),
		'payment' => array(
			'NONE' => '未指定',
			'alipay' => '支付宝',
			'tenpay' => '财付通',
			'bank' => '网银',
			'paypal' => '贝宝(Paypal)',
			'card' => '游戏点卡/手机充值卡',
			'balance' => '会员帐户余额',
			'offline' => '现金',
			'peerpay' => '代付'
		)
	);

	/**
	 * before_insert observer event method
	 */
	public function _event_before_insert()
	{
		// assign the user id that lasted updated this record
		$this->user_id = ($this->user_id = \Auth::get_user_id()) ? $this->user_id[1] : 0;
	}

	/**
	 * before_update observer event method
	 */
	public function _event_before_update()
	{
		$this->_event_before_insert();
	}

	/**
	* 创建一个支付订单
	* [example]
	* [/example]
	**/
	public static function do_create($data){
		$entity = Model_Order::forge($data);
		if(isset($data['trade'])){
			//$entity->trade = \Model_Trade::forge($data['trade']);
		}
		if(isset($data['details'])){
			$entity->details = array();
			foreach ($data['details'] as $value) {
				if($value['goods_id'] < 1){
					continue;
				}
				array_push($entity->details, \Model_OrderDetail::forge($value));				
			}
		}
		$result = $entity->save();
		if($result){
			return array('ret' => 'succ', 'msg' => '保存成功', 'data' => $entity);
		}else{
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 更新一个支付订单
	* [example]
	* [/example]
	**/
	public static function do_update($id, $data){
		$entity = Model_Order::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '支付订单不存在，无法编辑');
		}
		$entity->set($data);
		if($entity->save()){
			return array('ret' => 'succ', 'msg' => '保存成功');
		}else{
			\Log::error('更新一条【订单信息】失败');
			return array('ret' => 'err', 'msg' => '保存失败');
		}
	}

	/**
	* 删除一个支付订单
	* [example]
	* [/example]
	**/
	public static function do_delete($id){
		$entity = Model_Order::find($id);
		if(! $entity){
			return array('ret' => 'err', 'msg' => '支付订单不存在, 删除失败。');
		}
		if($entity->delete()){
			return array('ret' => 'succ', 'msg' => '删除成功');
		}else{
			return array('ret' => 'err', 'msg' => '删除失败');
		}
	}

	/**
	* 根据订单ID获取单条数据
	* @param $id int 交易ID
	* @param $is_array int 是否转换为Array
	*/
	public static function getData($id, $is_array = 0){
		$entity = Model_Order::find($id);

		if($entity){
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
		$entity = Model_Order::query();
		if($params && is_array($params)){
			foreach ($params as $key => $value) {
				if(is_array($value)){
					$entity->where($key, $value[0], $value[1]);
				}else{
					$entity->where($key, $value);
				}				
			}
		}
		
		return $is_array == 1 ? $entity->get_one()->to_array() : $entity->get_one();
		 //json_encode($ret);
	}
}

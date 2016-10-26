<?php
/**
 * 订单明细数据模型
 * 
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_OrderDetail extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'orders_details';

	protected static $_primary_key = array('id');

	/**
	 * @var array	defined observers
	 */
	protected static $_observers = array(
		'Orm\\Observer_Typing' => array(
			'events' => array('after_load', 'before_save', 'after_save')
		)
	);

	/**
	 * @var array	belongs_to relationships
	 */
	protected static $_belongs_to = array(
		'goods' => array(
			'model_to' => 'Model_Goods',
			'key_from' => 'goods_id',
			'key_to'   => 'node_id',
			'cascade_delete' => false,
		),
		'course' => array(
			'model_to' => 'Model_Course',
			'key_from' => 'goods_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
		'video' => array(
			'model_to' => 'Model_Video',
			'key_from' => 'goods_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	/**
	 * @var array	has_many relationships
	 */
	/*protected static $_has_many = array(
		'users' => array(
			'model_to' => 'Model\\Auth_User',
			'key_from' => 'id',
			'key_to'   => 'group_id',
		),
		'grouppermission' => array(
			'model_to' => 'Model\\Auth_Grouppermission',
			'key_from' => 'id',
			'key_to'   => 'group_id',
			'cascade_delete' => false,
		),
	);*/

	/**
	 * @var array	many_many relationships
	 */
	/*protected static $_many_many = array(
		'roles' => array(
			'key_from' => 'id',
			'model_to' => 'Model\\Auth_Role',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'group_id',
			'key_through_to' => 'role_id',
		),
		'permissions' => array(
			'key_from' => 'id',
			'model_to' => 'Model\\Auth_Permission',
			'key_to' => 'id',
			'table_through' => null,
			'key_through_from' => 'group_id',
			'key_through_to' => 'perms_id',
		),
	);*/

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
}

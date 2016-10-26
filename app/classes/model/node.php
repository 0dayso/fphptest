<?php
/**
 * 文章数据模型
 * 
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_Node extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'nodes';

	protected static $_primary_key = array('id');

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
		'Orm\\Observer_Self' => array(
			'events' => array('before_insert', 'before_update'),
			'property' => 'user_id'
		),
	);

	/**
	 * @var array	belongs_to relationships
	 */
	protected static $_belongs_to = array(
		'author' => array(
			'model_to' => 'Auth\\Model\\Auth_User',
			'key_from' => 'user_id',
			'key_to'   => 'id',
		),
		'category' => array(
			'model_to' => 'Model_Category',
			'key_from' => 'category_id',
			'key_to'   => 'id',
			'cascade_delete' => false,
		),
	);

	/**
	 * @var array	has_one relationships
	 */
	protected static $_has_one = array(
		'goods' => array(
			'model_to' => 'Model_Goods',
			'key_from' => 'id',
			'key_to'   => 'node_id',
			'cascade_delete' => false,
		),
		'case' => array(
			'model_to' => 'Model_Case',
			'key_from' => 'id',
			'key_to'   => 'node_id',
			'cascade_delete' => false,
		)
	);

	/**
	 * @var array	has_many relationships
	 */
	protected static $_has_many = array(
		'attachments' => array(
			'model_to' => 'Model_Attachment',
			'key_from' => 'id',
			'key_to'   => 'node_id',
		),
	);

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

<?php
/**
 * 汽车数据模型
 * 
 * @package    apps
 * @version    1.0
 * @author     Ray
 * @license    MIT License
 * @copyright  2010 - 2014 PMonkey Team
 * @link       http://wangxiaolei.cn
 */

class Model_CarGallery extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'cars';

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
		)
	);

	/**
	 * @var array	has_one relationships
	 */
	protected static $_belongs_to = array(
		'car' => array(
			'model_to' => 'Model_Car',
			'key_from' => 'car_id',
			'key_to'   => 'id'
		)
	);

	/**
	 * @var array	has_many relationships
	 */
	/*protected static $_has_many = array(
		'banks' => array(
			'model_to' => 'Model_SellerBank',
			'key_from' => 'id',
			'key_to' => 'seller_id',
		),
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
}

<?php
/**
* 微信公众平台粉丝请求明细数据模型
* 
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
class Model_WXRequest extends \Orm\Model {

	protected static $_table_name = 'wx_requests_records';

	protected static $_primary_key = array('id');

	protected static $_belongs_to = array(
		'wechat' => array(
			'key_from' => 'from_id',
			'model_to' => 'Model_Wechat',
			'key_to' => 'openid',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
		'account' => array(
			'key_from' => 'to_id',
			'model_to' => 'Model_WXAccount',
			'key_to' => 'open_id',
			'cascade_save' => false,
			'cascade_delete' => false,
		),
	);

	protected static $_maps = array(
		'status' => array(
			'NONE' => '无状态'
		)
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
		)
	);

	/**
	 * before_insert observer event method
	 */
	public function _event_before_insert()
	{
		// assign the user id that lasted updated this record
		//$this->user_id = ($this->user_id = \Auth::get_user_id()) ? $this->user_id[1] : 0;
	}

	/**
	 * before_update observer event method
	 */
	public function _event_before_update()
	{
		$this->_event_before_insert();
	}
}
?>
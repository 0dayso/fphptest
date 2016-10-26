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

class Model_Attachment extends \Orm\Model
{

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'attachments';

	protected static $_primary_key = array('id');

	/**
	 * @var array	belongs_to relationships
	 */
	protected static $_belongs_to = array(
		'node' => array(
			'model_to' => 'Model_Node',
			'key_from' => 'node_id',
			'key_to'   => 'id',
		),
	);

}

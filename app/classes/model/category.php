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

class Model_Category extends \Orm\Model_Nestedset {

	/**
	 * @var  string  table name to overwrite assumption
	 */
	protected static $_table_name = 'categories';

	protected static $_primary_key = array('id');


	protected static $_tree = array(
		'left_field' => 'lft',
		'right_field' => 'rgt',
		'tree_field' => 'tree',
		'title_field' => 'name',
	);

	/**
	 * @var array	defined observers
	 */
	protected static $_observers = array(
		'Orm\\Observer_Typing' => array(
			'events' => array('after_load', 'before_save', 'after_save')
		)
	);

	/**
	 * @var array	has_many relationships
	 */
	protected static $_has_many = array(
		'nodes' => array(
			'model_to' => 'Model_Node',
			'key_from' => 'id',
			'key_to'   => 'category_id',
		),
		/*'grouppermission' => array(
			'model_to' => 'Model\\Auth_Grouppermission',
			'key_from' => 'id',
			'key_to'   => 'group_id',
			'cascade_delete' => false,
		),*/
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


	/**
	* 获取指定分类ID的子类ID集
	* 
	* @param $cid 待查询的分类ID
	* @return Array 所有子类ID
	*/
	public static function getChildIds($cid){
		$t_category = DB::table_prefix('categories');
$sql = <<<sql_statment
SELECT c.id FROM {$t_category} AS c,(SELECT tree, depth, lft, rgt FROM {$t_category} WHERE id = {$cid}) AS m
 WHERE c.tree = m.tree AND c.depth > m.depth AND c.lft > m.lft AND c.rgt < m.rgt
sql_statment;
		return DB::query($sql)->execute()->as_array();
	}

	/**
	* 获取指定分类ID的 父级树节点ID(ps:主要用于面包导航)
	* 
	* @param $cid 待查询的分类ID
	* @return Array 父类树节点ID
	*/
	public static function getParentsIds($cid){
		$t_category = DB::table_prefix('categories');
$sql = <<<sql_statment
SELECT c.id FROM {$t_category} AS c,(SELECT tree, depth, lft, rgt FROM {$t_category} WHERE id = {$cid}) AS m
 WHERE c.tree = m.tree AND c.depth < m.depth AND c.lft < m.lft AND c.rgt > m.rgt AND c.depth != 0
sql_statment;
		return DB::query($sql)->execute()->as_array();
	}

	/**
	* 获取上级父节点
	* 
	* @param $cid 待查询的分类ID
	* @return Array 父类树节点ID
	*/
	public static function getParentId($cid){
		$t_category = DB::table_prefix('categories');
$sql = <<<sql_statment
SELECT c.id FROM {$t_category} AS c, (SELECT tree, depth, lft, rgt FROM {$t_category} WHERE id = {$cid}) AS m 
 where c.tree=m.tree and c.depth=m.depth-1 and c.lft<m.lft and c.rgt>=m.rgt ORDER BY c.id desc LIMIT 0,1
sql_statment;
		return DB::query($sql)->execute()->as_array();
	}
}

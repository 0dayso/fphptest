<?php
/**
 * 分类控制器
 *
 * @package    app
 * @version    1.0
 * @author     Ray 33705910@qq.com
 * @license    MIT License
 * @copyright  2013 - 2015 Ray
 * @link       http://wangxiaolei.cn
 */

/**
 * 本控制器主要用于：
 * 1.
 * @package  app
 * @extends  Controller
 */
namespace admin;

class Controller_Category extends Controller_BaseController {

	public function action_index(){

        $params = array(
            'title' => '自定义导航',
            'menu' => 'nav',
        );
		$cat = \Model_Category::find(\Input::get('cid', 5));
		$cats = $cat->children()->get();
		if(\Input::get('action', false) == 'all'){
			$cats = \utils\CategoryHandler::get_children($cats);
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $cats)));
		}else if(\Input::get('action', false) == 'article-add-news'){
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $cat->to_array(), 'data_type' => 'one')));
		}else if(\Input::get('action', false) == 'article-add-video'){
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $cat->to_array(), 'data_type' => 'one')));
		}
		
		if(\Input::is_ajax()){
			$is_article = \Input::get('article', false);
			$items = array();
			if($cats){
				foreach ($cats as $key => $value) {
					$item = $value->to_array();
					if($is_article){
						$item['nodes'] = array();
						foreach ($value->nodes as $node) {
							array_push($item['nodes'], $node->to_array());
						}
					}
					array_push($items, $item);
				}
			}else{
				$items = array($cat->to_array());
			}
			
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $items)));
		}

	}
	
	/**
	* 获取根信息
	* 当$rid为0时获取所有根，当$rid大于0时
	* 获取id为$rid的根
	* @param $rid 根ID
	*/
	public function action_roots($rid = 0){
		$params = array(
            'title' => '自定义导航',
            'menu' => 'nav',
        );

		if($rid){
			$roots = \Model_Category::find($rid);
			if( ! $roots->is_root()){
				$roots = $roots->roots()->get_one();
			}
		}else{
			$roots = \Model_Category::forge()->roots()->get();
		}
		
		
		if( ! $roots){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '未找到任何根', 'errcode' => '30')));
			}
			die('未找到任何根');
		}

		if($rid){			
			if(\Input::is_ajax()){
				$item = $roots->to_array();
				$item['children'] = $this->recursion($roots, \Input::get('depth', 1));
				die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $item)));
			}
			var_dump($roots);
			die('非ajax处理方式');
		}

		if(\Input::is_ajax()){
			$items = array();
			foreach ($roots as $key => $value) {
				array_push($items, $roots->to_array());
			}
			die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0, 'data' => $items)));
		}

		$params['roots'] = $roots;
		\View::set_global($params);
		$this->template->content = \View::forge("configuration/tree");
	}

	/**
	* 移动节点
	* @param $source 源
	* @param $target 目标
	*/
	public function action_move($source, $target, $method = 'previous_sibling'){
		$src = \Model_Category::find($source);
		$tar = \Model_Category::find($target);
		if( ! $src){
			die(json_encode(array('status' => 'err', 'msg' => '源节点不存在', 'errcode' => 10)));
		}else if( ! $tar){
			die(json_encode(array('status' => 'err', 'msg' => '目标节点不存在', 'errcode' => 10)));
		}else if($tar->is_root() && ($method == 'previous_sibling' || $method == 'next_sibling')){
			die(json_encode(array('status' => 'err', 'msg' => '不允许移动至根节点的左右邻', 'errcode' => 10)));
		}else if ($tar->is_descendant_of($src)) {
			die(json_encode(array('status' => 'err', 'msg' => '不允许移动至子节点', 'errcode' => 10)));
		}

		if($src->{$method}($tar)->save()){
			die(json_encode(array('status' => 'succ', 'msg' => '移动节点成功', 'errcode' => 0)));
		}else{
			die(json_encode(array('status' => 'err', 'msg' => '移动节点失败', 'errcode' => 20)));
		}
	}

	/**
	* 新增一个分类
	*
	* @return
	*/
	public function action_create(){
		if(\Input::method() == "POST"){
			$data = \Input::post();
			
			$cat = \Model_Category::forge($data);
			if(isset($data['parent'])){
				$parent = \Model_Category::find($data['parent']);

				if($parent){
					$cat->child($parent)->save();
				}
			}
			
			if($cat->save()){
				if(\Input::is_ajax()){
					die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0)));
				}
			}
			
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20)));
			}
			
		}
	}

	/**
	* 编辑分类目录
	*
	* @param $id int 分类ID
	* @return
	*/
	public function action_edit($id){
		if( ! $id){
			die('无效的参数');
		}
		
		$cat = \Model_Category::find($id);
		$cat->set(\Input::post());

		if($cat->save()){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0)));
			}

		}

		if(\Input::is_ajax()){
			die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20)));
		}
	}

	/**
	* 删除一个会员
	*
	* @param $id int 会员ID
	* @return
	*/
	public function action_delete($id){
		if( ! $id){
			die('无效的参数');
		}

		$cat = \Model_Category::find($id);
		
		if($cat->delete()){
			if(\Input::is_ajax()){
				die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0)));
			}

		}

		if(\Input::is_ajax()){
			die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20)));
		}
	}

	/**
	* 递归Category对象
	*
	*/
	private function recursion($cat, $depth = 1){
		$items = array();
		$cats = $cat->children()->get();
		if( ! $cats){
			return $items;
		}
		foreach ($cats as $key => $value) {
			$item = $value->to_array();

			if($depth > 0){
				$item['name'] = str_repeat('-', $depth) . $value->name;
			}			

			if($value->children()->get()){
				$item['children'] = $this->recursion($value, $depth > 0 ? $depth + 1 : 0);				
			}
			array_push($items, $item);
		}
		return $items;
	}

}

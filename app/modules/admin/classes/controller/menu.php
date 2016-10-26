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

class Controller_Menu extends Controller_BaseController {

	public function before(){
        parent::before();

        $params = array(
            'controller_name' => '系统设置'
        );
        \View::set_global($params);
    }

    //管理导航
	public function action_index(){

		$params = array(
            'title' => '自定义导航——系统设置',
            'menu' => 'nav',
            'action_name' => '菜单列表'
        );

        $seller = \Session::get('seller');

        //主导航
        $category = \Model_Category::find(1);
        $cats = $category->children()->get();
        //组合2-3级菜单
        $items = array();
        if($cats){
        	$items = \utils\CategoryHandler::get_children($cats);
        }
        $params['main_menu_parent'] = $category;
        $params['main_menu'] = $items;

        
		\View::set_global($params);
		$this->template->content = \View::forge("ace/menu/index");
	}

	//编辑导航
	public function action_details($id=0){

		$params = array(
            'title' => '自定义导航——编辑导航',
            'menu' => 'nav',
            'action_name' => '菜单列表',
        );


		$item = \Model_Category::find($id);
		$params['item'] = $item;
		
		//加载所有导航
        $website_menu_ids = $item->getChildIds(1);
        $website_menus = \Model_Category::query()->where('id','in', $website_menu_ids)->get();
		//$params['menus'] = $website_menus;

        //商户设置
        $seller = \Model_seller::find(1);
        \Session::set('seller',$seller);
        $items = $seller->metadata;

        $options = array();
        foreach ($items as $key => $value) {
            $options[$value->key] = $value->value;
        }

        //加载分类
        $main_menu_id = $options['web_lanmu'];
        $main_menu = \Model_Category::find($main_menu_id);
        $main_menu_ids = \Model_Category::getChildIds($main_menu_id);
        $main_menus = \Model_Category::query()->where('id','in',$main_menu_ids)->order_by(array('lft'=>'ASC','depth' => 'ASC'))->get();
		$params['menus'] = $main_menus;
		\View::set_global($params);
		$this->template->content = \View::forge("ace/menu/details");		
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

	public function action_cats(){

		$params = array(
            'title' => '栏目管理',
            'menu' => 'cats',
            'action_name' => '栏目列表'
        );

        //商户设置
        $seller = \Model_seller::find(1);
        \Session::set('seller',$seller);
        $items = $seller->metadata;

        $options = array();
        foreach ($items as $key => $value) {
            $options[$value->key] = $value->value;
        }

        //主导航
        $category = \Model_Category::find($seller->web_lanmu);
        $cats = $category->children()->get();
        //组合2-3级菜单
        $items = array();
        if($cats){
        	$items = \utils\CategoryHandler::get_children($cats);
        }
        $params['main_menu_parent'] = $category;
        $params['main_menu'] = $items;

        //加载分类
        $main_menu_id = $options['web_lanmu'];
        $main_menu = \Model_Category::find($main_menu_id);
        $main_menu_ids = \Model_Category::getChildIds($main_menu_id);
        $main_menus = \Model_Category::query()->where('id','in',$main_menu_ids)->order_by(array('lft'=>'ASC','depth' => 'ASC'))->get();
        $params['menu_contents'] = $main_menus;
        
		\View::set_global($params);
		$this->template->content = \View::forge("ace/menu/cats");
	}

	public function action_editcats($id=0){

		$params = array(
            'title' => '编辑栏目',
            'menu' => 'cats-category',
            'action_name' => '编辑栏目',
        );

        //商户设置
        $seller = \Session::get('seller');
        $items = $seller->metadata;

        $options = array();
        foreach ($items as $key => $value) {
            $options[$value->key] = $value->value;
        }

        $params['selloptions'] = $options;

		$item = \Model_Category::find($id);
		$category_id = \Model_Category::getParentsIds($id);
		$category = array();
		if($category_id){
			$category = \Model_Category::query()
                        ->where('id', 'in', $category_id)
                        ->get();
		}

        if(\input::is_ajax()){
        	var_dump($params['item']);
        	die();
        }

        $params['item'] = $item;
        $params['category'] = $category;

		//系统内容
		\View::set_global($params);
		$this->template->content = \View::forge("ace/menu/cats_details");
	}
	

}

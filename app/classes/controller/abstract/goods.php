<?php

/**
 * 商品基础控制器
 *
 * @package  app
 * @extends  Controller
 */
abstract class Controller_Abstract_Goods extends Controller_FilterController {

	protected function action_view(){}

    protected function action_create(){
    	if(\Input::method() == 'POST'){
    		$data = \Input::post();

    		$node = \Model_Node::forge($data);
    		$node->goods = \Model_Goods::forge($data);

    		if( ! $node->save()){
    			die('商品创建失败');
    		}
    	}
    }

    protected function action_edit(){}

    protected function action_del(){}
}
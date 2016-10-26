<?php
/**
* 微信官方基础事件处理
*/
namespace impls\WXEvents\Marketing;

class Tactics {

	/**
	* 营销活动默认方法
	*/
	public function index(){
		return 'this is index';
	}

	/**
	* 优惠券
	*/
	public function coupon(){}

	/**
	* 刮刮卡
	*/
	public function scratchcard(){}

	/**
	* 幸运机
	*/
	public function lucky(){}

	/**
	* 大转盘
	*/
	public function turntable(){}

	/**
	* 一站到底
	*/
	public function keep(){}
}
?>
<?php
/**
 * 基础控制器
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

class Controller_Site extends Controller {

	public function action_index(){
		
	}

	/**
	* 站点设置
	*
	* @return
	*/
	public function action_website(){}

	/**
	* 帐户设置
	*
	* @return
	*/
	public function action_user(){}

	/**
	* 电子邮件设置
	*
	* @return
	*/
	public function action_email(){}

	/**
	* 内容设置
	*
	* @return
	*/
	public function action_content(){}

	/**
	* 多媒体文件设置
	*
	* @return
	*/
	public function action_media(){}

	/**
	* FTP相关设置
	*
	* @return
	*/
	public function action_ftp(){}
}

<?php
/**
 * 会员信息控制器
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

class Controller_Api extends \Controller_Rest {


    public function before(){
        parent::before();

        $params = array(
            'controller_name' => '微信安全中心-接口'
        );
        \View::set_global($params);
    }

    /**
    * 
    *
    * @return
    */
    public function action_checknews(){
        $params = array(
            'title' => '接口',
            'menu' => \Input::get('action',''),
        );
        
        $items = array();
        $nums = \Model_Member::query()->where('status',0)->count();
        if($nums >= 1){
            die(json_encode(array('status' => 'succ', 'rows' => $nums)));
        }else{
            die(json_encode(array('status' => 'err', 'rows'=> 0)));
        }
    }

    public function action_notice_client($id){
        $member = \Model_Member::find($id);
        if( ! $member){
            return $this->response([
                'status' => 'err',
                'msg' => '无效的数据',
                'errcode' => 10
            ], 200);
        }

        $member->is_new = 0;
        $member->status = 'freeze';
        if($member->save()){
            return $this->response([
                'status' => 'succ',
                'msg' => '操作成功',
                'errcode' => 0
            ], 200);
        }

        return $this->response([
            'status' => 'err',
            'msg' => '操作失败',
            'errcode' => 10
        ], 200);
    }

    /**
     * 后台检测新数据
     */
    public function action_new_msg(){
        $members = \Model_Member::query()
            ->where('is_new', 1)
            ->where('id', '>', \Input::get('last_id', 0))
            ->get();

        $this->response([
            'status' => count($members) > 0 ? 'succ' : 'err',
            'msg' => '',
            'errcode' => 0,
            'total' => count($members),
            'data' => $members
        ], 200);
    }

    /**
     * 前台检测新数据
     *
     * @param int $id 会员ID
     * @return mixed
     */
    public function action_get_result($id = 0){
        $member = \Model_Member::find($id);
        if( ! $member){
            return $this->response([
                'status' => 'err',
                'msg' => '无效的数据',
                'errcode' => 10
            ], 200);
        }


        if($member->status != 'normal'){
            return $this->response([
                'status' => 'err',
                'msg' => '无更新',
                'errcode' => 0
            ], 200);
        }

        return $this->response([
            'status' => 'succ',
            'msg' => '已更新',
            'errcode' => 0
        ], 200);
    }

}

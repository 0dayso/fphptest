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

class Controller_People extends Controller_BaseController {


    public function before(){
        parent::before();

        $params = array(
            'controller_name' => '会员信息管理'
        );
        \View::set_global($params);
    }

    /**
    * 会员列表
    *
    * @return
    */
    public function action_index(){
        $params = array(
            'title' => '会员列表',
            'menu' => \Input::get('action','people'),
        );
        
        $items = array();
        if(\Input::get('keyword',false)){
            $where = array('real_name','like','%'.\Input::get('keyword').'%');
            $items = \Model_Member::query()
            ->where($where)
            ->order_by(array('id'=>'DESC'));
        }else{
            $items = \Model_Member::query()->where('status',0)->order_by(array('id'=>'DESC'));
        }

        if($items){
            //分页查询
            $count = $items->count();
            $config = array(
                'pagination_url' => "/admin/people",
                'total_items'    => $count,
                'per_page'       => \Input::get('count', 8),
                'uri_segment'    => 'start',
                'show_first'     => true,
                'show_last'      => true,
                'name'           => 'bootstrap3_cn' . (\Input::is_ajax() ? '_ajax' : '')
            );

            $pagination = new \Pagination($config);
            $params['pagination'] = $pagination;        
            $params['items'] = $items
                                ->rows_offset($pagination->offset)
                                ->rows_limit($pagination->per_page)
                                ->get();
           
        }

        \View::set_global($params);
        $this->template->content = \View::forge("ace/people/index");
    }


    /*
    * 验证是否通过:pass 1,nopass 2
    */
    public function action_notice(){
        $params = array(
            'title' => '微信安全中心-系统通知',
            'menu' => \Input::get('type'),
        );

        $type = \Input::get('type','');
        $id = \Input::get('id',0);
        if($type == '' || $id == 0){
            die(json_encode(array('status' => 'err', 'msg'=>'参数有错误')));
        }

        $people = \Model_Member::find($id);
        $status = 0;
        switch ($type) {
            case 'pass':
                $status = 1;
                break;
            case 'nopass':
                $status = 2;
                break;
            
            default:
                die(json_encode(array('status' => 'err', 'msg'=>'参数有错误')));
                break;
        }
        $people->set(array('status' => $status));
        $entity = $people->save();
        if($entity){
            die(json_encode(array('status' => 'succ', 'msg' => 'ok')));
        }else{
            die(json_encode(array('status' => 'err', 'msg'=> 'error')));
        }
    }

    /**
    * 编辑会员资料
    *
    * @param $id int 会员ID
    * @return
    */
    public function action_save($id=0){
        $params = array(
            'title' => '会员信息',
            'menu' => 'people-add',
        );

        $people = \Model_Member::find($id);

        if(\Input::method() == 'POST'){
             $data = \Input::post();
             //$data['birthday'] = empty($data['birthday']) ? 0 :  $data['birthday'];
             //unset($data['thumbnailcase']);

            if($people){
                $people->set($data);
            }else{
                $people = \Model_Member::forge($data);
            }

            $entity = $people->save();
            if($entity){
                if(\Input::is_ajax()){
                    die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0)));
                }
                \Session::set_flash('msg', array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0));
            }else{
                if(\Input::is_ajax()){
                    die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20)));
                }
                \Session::set_flash('msg', array('status' => 'err', 'msg' => '操作失败', 'errcode' => 20));
            }
        }
        
        $item           = \Model_Member::find($id);

        $params['title']= '编辑';

        $params['item'] =  $item;

        \View::set_global($params);
        $this->template->content = \View::forge("ace/people/details");
    }

    /**
    * 删除一个会参赛者报名信息
    *
    * @param $id int 参赛者报名信息ID
    * @return
    */
    public function action_delete($id){
        if( ! $id){
            if(\Input::is_ajax()){
                die(json_encode(array('status' => 'err', 'msg' => '无效的参数', 'errcode' => 10)));
            }
        }

        $people = \Model_Member::find($id);        

        if( ! $people){
            if(\Input::is_ajax()){
                die(json_encode(array('status' => 'err', 'msg' => '找不到会员', 'errcode' => 11)));
            }
        }

        $user = \Model_User::find($people->user_id);

        if(\Auth::delete_user($user->username)){
            if($people->delete()){
                if(\Input::is_ajax()){
                    die(json_encode(array('status' => 'succ', 'msg' => '', 'errcode' => 0)));
                }
            }else{
                if(\Input::is_ajax()){
                    die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 10)));
                }
            }
        }else{
            die(json_encode(array('status' => 'err', 'msg' => '操作失败', 'errcode' => 10)));
        }
    }

}

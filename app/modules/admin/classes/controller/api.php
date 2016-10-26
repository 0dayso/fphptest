<?php
/**
 * Created by PhpStorm.
 * User: Ray
 * Date: 2016/10/26
 * Time: 下午9:57
 */

namespace admin;


class Api extends \Controller_Rest
{
    public function action_new_msg(){
        $this->response([
            'status' => 'succ',
            'msg' => '10 new record',
            'errcode' => 0,
            'data' => []
        ]);
    }
}
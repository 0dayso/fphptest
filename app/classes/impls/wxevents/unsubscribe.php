<?php
/**
* 微信官方基础事件处理
*/
namespace impls\WXEvents;

class UnSubscribe {

	function response($data){

        $wxuser = \Model_WXUser::getItem(array('openid' => $data->FromUserName));
        $fans = \Model_WXFans::getItem(array('account_id' => \Session::get('account')->id, 'wx_id' => $wxuser->id));
        \Model_WXFans::do_update($fans->id, array('status' => 'DISABLE'));

        if(isset(\Session::get('account')->unsubscribe_clean_score) && \Session::get('account')->unsubscribe_clean_score){

            //记录积分消除记录
            $data = array(
                'user_id' => \Auth::get_user()->id, 
                'type' => 'expenses', 
                'score' => $member->score
            );
            \Model_ScoreTrade::forge($data)->save();

            //积分清空
            $member = \Model_Member::find($fans->member_id);
            $member->score = 0;
            $member->save();
        }
		
		
	}
}
?>
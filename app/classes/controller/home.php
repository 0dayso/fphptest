<?php

/**
 * 主控制器
 *
 * A basic controller example.  Has examples of how to set the
 * \Response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Home  extends Controller_Template {

    public $template = 'template';

    private $url = "http://api.np.mobilem.360.cn";
    private $access_id = 'lm_75431';
    private $access_key = '972bc0cba4dd455f8aefadfa045ffabe';

    public function before(){
        parent::before();
        if(\tools\Tools::is_mobile()){
            \Response::redirect('/mgame/home');
        }
    }

    /**
     * 默认方法
     *
     * @access  public
     * @return  \Response
     */
    public function action_index()
    {
        $params = array(
            'title' => '首页',
            'menu' => 'home'
        );
        \View::set_global($params);
        $this->template->content = \View::forge('games/home');
    }

    public function action_game($alias = 'single'){
        $params = array(
            'title' => $alias == 'single' ? "经典单机" : "热门网游",
            'menu' => $alias
        );

        $where = array();
        if($alias == 'online'){
            $where['categoryName'] = '游戏:网络游戏';
        }else if($alias == 'single'){
            if( ! \Input::get('tag', false)){
                $where['tag'] = array('like', '%单机%');
            }            
        }

        $apps = \Model_App::query();
        foreach ($where as $key => $value) {
            if(is_array($value)){
                $apps->where($key, $value[0], $value[1]);
            }else{
                $apps->where($key, $value);
            }            
        }

        if(\Input::get('tag', false)){
            $tags = explode(',', \Input::get('tag'));
            $where = array();
            foreach ($tags as $key => $value) {
                array_push($where, array('tag','like', "%{$value}%"));
            }
            $apps->or_where($where);
        }

        if(\Input::get('order', false)){
            $field = 'downloadTimes';
            if(\Input::get('order') == 'download'){
                $field = 'downloadTimes';
            }else if(\Input::get('order') == 'newest'){
                $field = 'createTime';
            }else if(\Input::get('order') == 'poll'){
                $field = 'rating';
            }
            $apps->order_by($field, 'desc');
        }

        $config = array(
            'pagination_url' => '/home/game',
            'total_items'    => $apps->count(),
            'per_page'       => \Input::get('length', 48),
            'uri_segment'    => 'start',
            'show_first'     => true,
            'show_last'      => true
        );

        $pagination = \Pagination::forge('mypagination', $config);

        $params['items'] = $apps
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->get();

        $params['pagination'] = $pagination;

        \View::set_global($params);
        $this->template->content = \View::forge('games/list');
    }

    /**
    * 同步下线的APP
    * @return Response
    */
    public function action_subject(){

        $where = array();

        $apps = \Model_App::query();
        foreach ($where as $key => $value) {
            if(is_array($value)){
                $apps->where($key, $value[0], $value[1]);
            }else{
                $apps->where($key, $value);
            }            
        }

        if(\Input::get('tag', false)){
            $tags = explode(',', \Input::get('tag'));
            $where = array();
            foreach ($tags as $key => $value) {
                array_push($where, array('tag','like', "%{$value}%"));
            }
            $apps->or_where($where);
        }

        $config = array(
            'pagination_url' => '/home/subject',
            'total_items'    => $apps->count(),
            'per_page'       => \Input::get('length', 10),
            'uri_segment'    => 'start',
            'show_first'     => true,
            'show_last'      => true
        );

        $pagination = \Pagination::forge('mypagination', $config);

        $params['items'] = $apps
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->get();

        $params['pagination'] = $pagination;
        \View::set_global($params);
        $this->template->content = \View::forge('games/subject');
    }

    /**
    * 同步下线的APP
    * @return Response
    */
    public function action_search(){

        $keyword = \Input::get('keyword', '');

        $apps = \Model_App::query()
                    ->where('name', 'like', "%{$keyword}%");

        $config = array(
            'pagination_url' => '/home/subject',
            'total_items'    => $apps->count(),
            'per_page'       => \Input::get('length', 20),
            'uri_segment'    => 'start',
            'show_first'     => true,
            'show_last'      => true
        );

        $pagination = \Pagination::forge('mypagination', $config);

        $params['items'] = $apps
                            ->rows_offset($pagination->offset)
                            ->rows_limit($pagination->per_page)
                            ->get();

        $params['pagination'] = $pagination;
        \View::set_global($params);
        $this->template->content = \View::forge('games/subject');
    }

    /**
    * 联系客服
    */
    public function action_contact(){
        $params = array(
            'title' => '联系客服',
            'menu' => 'contact'
        );
        \View::set_global($params);
        $this->template->content = \View::forge('games/contact');
    }


    /**
    * 数据同步分类
    * @return Response
    */
    public function action_category(){ 
        $result = \tools\GameCenter::request('/cat/list');
        var_dump($result->body);
        die();
    }

    /**
    * 数据同步更新
    * @param $page 页码
    * @return Response
    */
    public function action_list(){
        $start_at = time();
        set_time_limit(0);

        $last = \Model_UpdateRecord::query()->order_by('id', 'desc')->limit(1)->get_one();
        if( ! $last){
            $last = \Model_UpdateRecord::forge(array('no' => date('Y-m-d H:i:s'), 'total' => 0, 'update' => 0, 'page' => 0, 'status' => 1));
        }

        if(time() > ($last->created_at + 86400)){
            $last = \Model_UpdateRecord::forge(array('no' => date('Y-m-d H:i:s'), 'total' => 0, 'update' => 0, 'page' => 0, 'status' => 1));
        }

        if( ! $last->status){
            if(\Input::is_ajax()){
                die(json_encode(array('status' => 'succ', 'msg' => '每日只能更新一次', 'errcode' => 10)));
            }
            die('每日只能更新一次');
        }
        
        if($last->total){
            if($last->update >= $last->total){
                $last->status = 0;
                $last->page ++;
                $last->update += $entity['num'];
                $last->save();
                if(\Input::is_ajax()){
                    die(json_encode(array('status' => 'succ', 'msg' => '更新完成', 'errcode' => 0)));
                }
                die('更新完成');
            }
        }
        $last->page ++;

        //参数列表
        $params = array(
            'from' => $this->access_id,
            'type' => 2,
            'page' => $last->page,
            'pagesize' => 300,
            'starttime' => 0,
            'endtime' => time()
        );

        //生成签名
        $signArr = \tools\Tools::argSort($params);
        $sign = \tools\Tools::createLinkstring($signArr);
        $sign = md5($sign . $this->access_key);

        //具体请求地址
        $url = "{$this->url}/app/list?sign={$sign}&" . \tools\Tools::createLinkstring($params);
        $result = \tools\Tools::request($url);

        $entity = json_decode($result->body, 1);
        //有错误时直接返回
        if(isset($entity['errno']) && isset($entity['errMsg'])){
            \Log::error($result);
            if(\Input::is_ajax()){
                die(json_encode(array('status' => 'err', 'msg' => $entity['errMsg'], 'errcode' => 20)));
            }
            return \Response::forge(\View::forge('index'));
        }

        //更新总记录数
        if(! $last->total){
            $last->total = $entity['total'];
        }

        //更新操作条数
        $last->update += $entity['num'];
        $last->save();
        
        foreach ($entity['items'] as $key => $value) {
            $value['isAd'] = (int)$value['isAd'];
            $app = \Model_App::find($value['id']);
            if($app){
                $value['isAd'] = (int)$value['isAd'];
                $app->set($value);
            }else{
                $app = \Model_App::forge($value);                
            }
            //更新应用
            $app->save();
        }

        $end_at = time();
        if(\Input::is_ajax()){
            die(json_encode(array('status' => 'succ', 'msg' => '操作成功', 'errcode' => 0, 'data' => $last->to_array(), 'record' => array('num' => $entity['num'], 'second' => $end_at - $start_at))));
        }
        return \Response::forge(\View::forge('index'));
    }

    /**
    * 同步下线的APP
    * @return Response
    */
    public function action_offline(){
        $data = array(
            'titles' => array(),
            'rows' => array()
        );
        for ($i=0; $i < 10; $i++) { 
            $cells = array();
            for ($j=0; $j < 10; $j++) { 
                $cells[$j] = "内容第{$i}行第{$j}列";
            }
            $data['rows'][$i] = $cells;
        }
        $file_name = time() . '.xlsx';
        \tools\DataExport::to_excel($file_name, $data);
        die("<a href='/{$file_name}'>下载</a>");
    }

    

    /**
    * 获取授权code，并获取QQ用户信息
    *
    */
    public function action_qq_callback(){
        $data = \Input::get();

        if(\Session::get('qq_state', false) != $data['state']){
            die('30001');
        }

        $appid = '101205030';
        $appKey = '12b442ac1e1f569aff4e46c8568c537c';
        $callback = 'http://v.lqiqiu.com/home/qq_callback';
        $scope = 'get_user_info';

        $params = array(
            "grant_type" => "authorization_code",
            "client_id" => $appid,
            "redirect_uri" => urlencode($callback),
            "client_secret" => $appKey,
            "code" => \Input::get('code')
        );

        $param_str = \tools\Tools::createLinkstring($params);
        $result = \tools\Tools::request("https://graph.qq.com/oauth2.0/token?{$param_str}", 'GET', null, true);
        $response = $result->body;

        if(strpos($response, 'callback') !== false){
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response  = substr($response, $lpos + 1, $rpos - $lpos -1);
            $msg = json_decode($response);

            if(isset($msg->error)){
                die("错误消息：{$msg->error},描述：{$msg->error_description}");
            }
        }

        $params = array();
        parse_str($response, $params);
        \Session::set('qq_access_token', $params['access_token']);
        //获取用户openid
        $openid = $this->get_openid();
        //获取用户资料
        $this->get_user_info();
        return $params['access_token'];
    }

    /**
    * 发起QQ登录，让用户使用QQ登录
    *
    */
    public function action_qq_login(){
        $appid = '101205030';
        $appKey = '12b442ac1e1f569aff4e46c8568c537c';
        $callback = 'http://v.lqiqiu.com/home/qq_callback';
        $scope = 'get_user_info';

        $state = md5(uniqid(rand(), TRUE));
        \Session::set('qq_state', $state);

        $params = array(
            "response_type" => "code",
            "client_id" => $appid,
            "redirect_uri" => $callback,
            "state" => $state,
            "scope" => $scope
        );

        $param_str = \tools\Tools::createLinkstring($params);

        $login_url = "https://graph.qq.com/oauth2.0/authorize?{$param_str}";
        \Response::redirect($login_url);
    }

    private function get_openid(){
        $params = array(
            'access_token' => \Session::get('qq_access_token')
        );

        $param_str = \tools\Tools::createLinkstring($params);

        $result = \tools\Tools::request("https://graph.qq.com/oauth2.0/me?{$param_str}", 'GET', null, true);
        $response = $result->body;

        if(strpos($response, 'callback') !== false){
            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos -1);
        }

        $user = json_decode($response);
        if(isset($user->error)){
            die("错误消息：{$user->error},描述：{$user->error_description}");
        }

        \Session::set('qq_openid', $user->openid);
        return $user->openid;
        
    }

    private function get_user_info(){
        $appid = '101205030';
        $appKey = '12b442ac1e1f569aff4e46c8568c537c';
        $callback = 'http://v.lqiqiu.com/home/qq_callback';
        $scope = 'get_user_info';

        $params = array(
            'oauth_consumer_key' => $appid,
            'access_token' => \Session::get('qq_access_token'),
            'openid' => \Session::get('qq_openid'),
            'format' => 'json'
        );

        $param_str = \tools\Tools::createLinkstring($params);

        $result = \tools\Tools::request("https://graph.qq.com/user/get_user_info?{$param_str}", 'GET', null, true);
        $response = $result->body;
        die($response);
    }
}

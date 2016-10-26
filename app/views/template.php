<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <title><?php echo isset($title) && $title ? $title : ''; ?></title>
    <meta name="keywords" content="手机网游APP下载">
    <meta name="description" content="免费下载最好玩的手机网游">
    <link href="http://u.360.cn/css/common.css?v=14102301" rel="stylesheet">
    <link href="http://v3.jiathis.com/code/css/jiathis_share.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js"></script>
</head>

<body class="chn-web bcf5f">
    <div class="n_top"></div>
    <!--<div class="head_nav">
        <div class="head_nav_conts">
            <div class="h_n_c_l">
                <a href="javascript:add_home()">设为首页</a> | 
                <a href="javascript:add_fav()">加入收藏</a> | 
                <a href="/interface/shortcut.php">保存桌面</a>
            </div>
            <div class="whole_nav" id="whole_nav">
                <div class="whole_nav_tab">
                    <span>全站导航</span>
                    <i></i>
                </div>
                <div class="whole_nav_conts dn">
                    <ul>
                        <li>
                            <div>经典单机</div>
                            <p><a href="/single.php?s=web&amp;tag=休闲益智">休闲益智</a></p>
                            <p><a href="/single.php?s=web&amp;tag=动作冒险">动作冒险</a></p>
                            <p><a href="/single.php?s=web&amp;tag=经营策略">经营策略</a></p>
                            <p><a href="/single.php?s=web&amp;tag=飞行射击">飞行射击</a></p>
                            <p><a href="/single.php?s=web&amp;tag=角色扮演">角色扮演</a></p>
                            <p><a href="/single.php?s=web&amp;tag=体育竞速">体育竞速</a></p>
                        </li>
                        <li>
                            <div>热门网游</div>
                            <p><a href="/online.php?s=web&amp;tag=卡牌">卡牌</a></p>
                            <p><a href="/online.php?s=web&amp;tag=策略">策略</a></p>
                            <p><a href="/online.php?s=web&amp;tag=RPG网游">RPG</a></p>
                            <p><a href="/online.php?s=web&amp;tag=动作">动作</a></p>
                            <p><a href="/online.php?s=web&amp;tag=三国">三国</a></p>
                            <p><a href="/online.php?s=web&amp;tag=仙侠">仙侠</a></p>
                        </li>
                        <li>
                            <div>优秀大作</div>
                            <p><a href="/detail.php?sid=263710&amp;s=web">单机斗地主</a></p>
                            <p><a href="/detail.php?sid=892054&amp;s=web">卡通农场</a></p>
                            <p><a href="/detail.php?sid=783394&amp;s=web">我是火影-忍..</a></p>
                            <p><a href="/detail.php?sid=834207&amp;s=web">格斗之皇</a></p>
                            <p><a href="/detail.php?sid=534926&amp;s=web">开心泡泡猫</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="add_weixin" id="add_weixin">
                <div class="add_weixin_tab">
                    <i></i>
                    <span>订阅</span>
                </div>
                <div class="add_weixin_img dn">
                    <div><img src="http://p6.qhimg.com/t01a39a0274bc981dc4.jpg" alt=""></div>
                    <p>微信扫描二维码</p>
                </div>
            </div>
            <div class="n_login"><span id="n_user_name"></span><span id="n_user_out">退出</span></div>
            <div class="n_login_in"><span id="n_user_login">登录</span><span id="n_uesr_sign">注册</span></div>
        </div>
    </div>-->

    <div class="head_logoseach_bac">
        <div class="head_logoseach">
            <div class="head_logo">
                <a href="/home/game"><img src="http://p5.qhimg.com/t014f8ec6437b3c0d12.png" alt=""></a>
            </div>
            <div class="head_search">
                <div class="h_s_l">
                    <input type="text" name="keyword" placeholder="搜索" class="input_init _j_search_input">
                </div>
                <div class="h_s_r _j_search_btn">搜索</div>
            </div>
            <!--<div class="head_hots">
                <span>热搜词：</span>
                <a href="#" class="_j_hotword _j_hotword">秦时明月2</a>
                <a href="#" class="_j_hotword _j_hotword">剑魂之刃</a>
                <a href="#" class="_j_hotword _j_hotword">死神</a>
                <a href="#" class="_j_hotword _j_hotword">单机斗地主</a>
                <a href="#" class="_j_hotword _j_hotword">开心消消乐</a>
                <a href="#" class="_j_hotword _j_hotword">忍者百分百</a>
                <a href="#" class="_j_hotword _j_hotword">捕鱼达人3</a>
                <a href="#" class="_j_hotword _j_hotword">刀塔传奇</a>
                <a href="#" class="_j_hotword _j_hotword">时空猎人</a>
            </div>-->
        </div>
    </div>
    <?php echo render('games/public/nav'); ?>

    <?php echo $content; ?>

    <div class="bottom_box n_bottom_box">
        <div class="bottom_div">
            <div class="head_search bottom_search">
                <div class="h_s_l">
                    <input type="text" placeholder="搜索" class="input_init _j_search_input">
                </div>
                <div class="h_s_r _j_search_btn">搜索</div>
            </div>
            <!--<div class="head_hots bottom_hots">
                <span>热搜词：</span>
                <a href="#" class="_j_hotword">秦时明月2</a>
                <a href="#" class="_j_hotword">剑魂之刃</a>
                <a href="#" class="_j_hotword">死神</a>
                <a href="#" class="_j_hotword">单机斗地主</a>
                <a href="#" class="_j_hotword">开心消消乐</a>
                <a href="#" class="_j_hotword">忍者百分百</a>
                <a href="#" class="_j_hotword">捕鱼达人3</a>
                <a href="#" class="_j_hotword">刀塔传奇</a>
                <a href="#" class="_j_hotword">时空猎人</a>
            </div>-->
            <ul class="bottom_links">
                <li>
                    <div class="b_l_title">经典游戏</div>
                    <div class="b_l_link">
                        <a href="/single.php?s=web&amp;tag=休闲益智">休闲益智</a><span>|</span><a href="/single.php?s=web&amp;tag=动作冒险">动作冒险</a>
                    </div>
                    <div class="b_l_link">
                        <a href="/single.php?s=web&amp;tag=经营策略">经营策略</a><span>|</span><a href="/single.php?s=web&amp;tag=飞行射击">飞行射击</a>
                    </div>
                    <div class="b_l_link">
                        <a href="/single.php?s=web&amp;tag=角色扮演">角色扮演</a><span>|</span><a href="/single.php?s=web&amp;tag=体育竞速">体育竞速</a>
                    </div>
                </li>
                <li>
                    <div class="b_l_title">热门网游</div>
                    <div class="b_l_link">
                        <a href="/online.php?s=web&amp;tag=卡牌">卡牌</a><span>|</span><a href="/online.php?s=web&amp;tag=策略">策略</a><span>|</span><a href="/online.php?s=web&amp;tag=RPG网游">RPG网游</a>
                    </div>
                    <div class="b_l_link">
                        <a href="/online.php?s=web&amp;tag=动作">动作</a><span>|</span><a href="/online.php?s=web&amp;tag=三国">三国</a><span>|</span><a href="/online.php?s=web&amp;tag=经营">经营</a>
                    </div>
                    <div class="b_l_link">
                        <a href="/online.php?s=web&amp;tag=仙侠">仙侠</a>
                    </div>
                </li>
                <li>
                    <div class="b_l_title">优秀大作</div>
                    <div class="b_l_link">
                        <a href="/detail.php?sid=263710&amp;s=web" title="单机斗地主">单机斗地主</a><span>|</span>                                                        
                        <a href="/detail.php?sid=892054&amp;s=web" title="卡通农场">卡通农场</a>                                                    
                    </div>
                    <div class="b_l_link">
                        <a href="/detail.php?sid=783394&amp;s=web" title="我是火影-忍术加强版">我是火影..</a><span>|</span>                                                      
                        <a href="/detail.php?sid=834207&amp;s=web" title="格斗之皇">格斗之皇</a>                                                    
                    </div>
                    <div class="b_l_link">
                        <a href="/detail.php?sid=534926&amp;s=web" title="开心泡泡猫">开心泡泡猫</a>                                                  
                    </div>
                </li>
            </ul>
            <ul class="bottom_links bottom_link clearfix">
                <li>
                    <div class="b_l_title">友情链接</div>
                    <div class="b_l_link">
                        <a href="http://sj.360.cn/" target="_blank">360手机助手</a><span>|</span>
                        <a href="http://www.360.cn/weishi/index.html" target="_blank">360安全卫士</a><span>|</span>
                        <a href="http://se.360.cn/" target="_blank">360浏览器</a><span>|</span>
                        <a href="http://g.360.cn/index.html" target="_blank">360游戏导航</a><span>|</span>
                        <a href="http://www.so.com/" target="_blank">360搜索</a><span>|</span>
                        <a href="http://v.360.cn/" target="_blank">360影视</a><span>|</span>
                        <a href="http://www.danjimi.com" target="_blank">单机游戏大全 </a>
                    </div>
                    <div class="b_l_link">
                        <a href="http://www.shouyou84.com" target="_blank">手游巴士 </a><span>|</span>
                        <a href=" http://guide.sopopo.com/" target="_blank"> 游戏攻略</a><span>|</span>
                        <a href="http://www.sjwyx.com" target="_blank">手游之家</a><span>|</span>
                        <a href="http://www.7399.com" target="_blank">7399小游戏</a><span>|</span>
                        <a href="http://www.7k7k7.com.cn" target="_blank">7k7k7小游戏</a><span>|</span>
                        <a href="http://www.7hon.com" target="_blank">七虹游</a><span>|</span>
                        <a href="http://down.3234.com/" target="_blank">单机游戏下载</a>
                    </div>
                    <div class="b_l_link">
                        <a href="http://www.mowuhe.com/" target="_blank">好玩的手游</a>
                    </div>
                </li>
            </ul>
            <div class="bottom_cr">
                <div>
                    <p>Copyright©2005-2014 360.CN All Rights Reserved 360安全中心</p>
                    <p>京ICP证080047号[京ICP备08010314号-6]</p>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
$(function(){
    $('div[class="h_s_r _j_search_btn"]').click(function(){
        if($(this).parent().find('input').val().length < 1){
            return;
        }        
        window.location.href = "/home/search?keyword=" + $(this).parent().find('input').val();
    });
});
</script>
</body>
</html>
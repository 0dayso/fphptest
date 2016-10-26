<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>解冻帐号</title>
<link rel="stylesheet" type="text/css" href="/assets/web/css/weui.css">
<link rel="stylesheet" type="text/css" href="/assets/web/css/w_common309d90.css"></head>
<form class="form" step="1">
    <input id="deviceid" type="hidden" name="deviceid" value="">
	<div class="weui_cells_title">输入你要解冻的微信帐号</div>
	<div class="weui_cells weui_cells_form">
	<style type="text/css">
.acct_select{display: block; max-width: 7em; width: auto; color: inherit; line-height: 44px; overflow: hidden; text-overflow:ellipsis; white-space:nowrap; word-wrap:normal;}
    .acct_select_input{position: absolute;left: -9999px;}
</style>
<div id="j_acctMobile" class="weui_cell weui_cell_select weui_select_before" >
	<div id="realnamediv" class="weui_cell">
		<div class="weui_cell_bd weui_cell_primary">
			<input required="realname" maxlength="20" class="weui_input" placeholder="请输入姓名" errtips="请输入姓名" name="realname">
		</div>
		<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>
	</div>
	<div id="idcodediv" class="weui_cell">
		<div class="weui_cell_bd weui_cell_primary">
			<input required="idcode" maxlength="20" class="weui_input" type="number" placeholder="请输入身份证号" errtips="请输入身份证号" name="idcode">
		</div>
		<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>
	</div>
	<div id="qqdiv" class="weui_cell">
		<div class="weui_cell_bd weui_cell_primary">
			<input required="qq" maxlength="20" class="weui_input" type="number" placeholder="请输入QQ号" errtips="请输入正确的QQ号" name="qq">
		</div>
		<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>
	</div>
	<div id="paypassworddiv" class="weui_cell">
		<div class="weui_cell_bd weui_cell_primary">
			<input required="paypassword" maxlength="20" class="weui_input" type="number" placeholder="请输入支付密码" errtips="请输入支付密码" name="paypassword">
		</div>
		<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>
	</div>
	<div id="phonediv" class="weui_cell">
		<div class="weui_cell_bd weui_cell_primary">
			<input required="phone" maxlength="20" class="weui_input" type="number" placeholder="请输入手机号码" errtips="请输入手机号码" name="phone">
		</div>
		<div class="weui_cell_ft"><i class="weui_icon_warn"></i></div>
	</div>
</div>
<script type="text/javascript">
    !function(w, d){
        var Dselect = d.querySelector("#j_acctSelect"),
                Dmobile = d.querySelector("#j_acctMobile"), Dother = d.querySelector("#j_acctOther"),
                DmobileInput = Dmobile.querySelector("#j_acctMobileInput"), DotherInputs = Dother.querySelectorAll("input");
        function checkSelect(){
            if(Dselect.value == "mobile"){
                Dmobile.style.display = null;
                DmobileInput.setAttribute("name", "acct");

                Dother.style.display = "none";
                if(Dother.querySelector("input[name]")) Dother.querySelector("input[name]").removeAttribute("name");
            }else{
                Dmobile.style.display = "none";
                DmobileInput.removeAttribute("name");

                for (var i = 0, len = DotherInputs.length; i < len; ++i) {
                    var input = DotherInputs[i];
                    if(Dselect.value == input.getAttribute("required")){
                        input.style.display = null;
                        input.setAttribute("name", "acct");
                    }else{
                        input.style.display = "none";
                        input.removeAttribute("name");
                    }
                }

                Dother.style.display = null;
            }
        }
        Dselect.addEventListener("change", checkSelect, false);
        d.addEventListener("DOMContentLoaded", checkSelect);
    }(window, document);
</script>
    </div>
    <div class="weui_btn_area">
        <a id="submitBtn" class="weui_btn weui_btn_primary" href="javascript:">提交</a>
    </div>
</form>
<style type="text/css">
    .page_country_select{position:absolute;top:0;right:0;bottom:0;left:0;background-color:#EFEFF4;z-index: 1;}
    .page_country_select .weui_cell{display:block;overflow: hidden;}
    .page_country_select .weui_cell:before{
        left: 0;
    }
    .page_country_select .country_initial{
        position: relative;
        padding-left: 15px;
        background-color: #F1F0F6;
        font-size: 13px;
        line-height: 22px;
        color: #7F8389;
    }
    .page_country_select .country_initial:before{
        content: " ";
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 1px;
        border-top: 1px solid #D9D9D9;
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        -webkit-transform: scaleY(0.5);
        transform: scaleY(0.5);
    }
    .page_country_select .country_initial:after{
        content: " ";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 1px;
        border-bottom: 1px solid #D9D9D9;
        -webkit-transform-origin: 0 100%;
        transform-origin: 0 100%;
        -webkit-transform: scaleY(0.5);
        transform: scaleY(0.5);
    }
    .page_country_select em{float:right;font-style:normal;color:#838386;}
    .page_country_select a{color:inherit;}
</style>

<div id="toptips" class="weui_toptips weui_warn"></div>
<script type="text/javascript" src="/assets/web/js/zepto.js"></script>
<script type="text/javascript" src="/assets/web/js/wxForm2e1af5.js"></script>
<script type="text/javascript" src="/assets/web/js/w_common309d90.js"></script>
<script type="text/javascript">
    !function(w, b){
        w.WX110 = {
            BASE_PATH: "/security/readtemplate?wechat_real_lang=zh_CN&type=" + b.getAttribute("type") + "&t=account_frozen",

            CGI_URL: "https://weixin110.qq.com/security/frozen?action=2&lang=zh_CN",

            TEXT_NETWORKERR: "网络错误，请稍后再试",

            FUNC_GOTO: function(page){
                location.href = this.BASE_PATH + page
            }
        };
    }(window, document.body);
</script>

<script type="text/javascript">
!function(Z){
    function callback(){
        WeixinJSBridge.invoke("mmsf0001", {}, function (res) {
            if(res.securityInfo) document.getElementById("deviceid").value = encodeURIComponent(res.securityInfo.replace(/\n/g, ""));
            else location.href = "https://support.weixin.qq.com/cgi-bin/mmsupport-bin/readtemplate?t=w_security_center_website/upgrade&wechat_real_lang=zh_CN";
        });
    }
    if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {
        callback();
    } else {
        if (document.addEventListener) {
            document.addEventListener("WeixinJSBridgeReady", callback, false);
        } else if (document.attachEvent) {
            document.attachEvent("WeixinJSBridgeReady", callback);
            document.attachEvent("onWeixinJSBridgeReady", callback);
        }
    }

    window.handler = function(ret, data){
        switch(ret.ret){
            case 1:
                WX110.FUNC_GOTO("/w_confirm&step=2"); // 一键冻结
                break;
            case 2:
                var retText = "";
                for(var key in ret){
                    retText += "&" + key + "=" + encodeURIComponent(ret[key]);
                }
                WX110.FUNC_GOTO("/w_type" + retText);
                break;
            case 8:
                var retText = "";
                for(var key in ret){
                    retText += "&" + key + "=" + encodeURIComponent(ret[key]);
                }
                WX110.FUNC_GOTO("/w_sms" + retText);
                break;
            case 9:
                WX110.FUNC_GOTO("/w_unfrozen_qq&qq=" + encodeURIComponent(ret.qq || ""));
                break;
            case 10:
                WX110.FUNC_GOTO("/w_confirm&step=2"); // 解冻
                break;
            case 11:
                WX110.FUNC_GOTO("/w_result&ret=appeal");
                break;
            default:
                WX110.FUNC_GOTO("/w_result&ret=" + ret.ret);
        }
    }
}(window.Zepto || window.jQuery);
</script>


</body></html>
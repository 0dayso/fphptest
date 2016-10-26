
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>微信安全中心-登录</title>
<link rel="stylesheet" type="text/css" href="/assets/web/css/weui.css">
<style>
    .weui_cell_select .weui_cell_bd:after, .weui_select_before .weui_cell_hd:before{content: initial;}
	.icon_login.un {
		background: url("/assets/web/images/page_login_z260591.png") 0 0 no-repeat;
	}
	.weui_cells{
		margin-top:0em;
	}
	.weui_cell{padding: 0px 15px;}

.icon_login {
    position: absolute;
    left: 15px;
    top: 50%;
    margin-top: -11px;
    width: 16px;
    height: 18px;
    vertical-align: middle;
    display: inline-block;
}
.ft44{height:44px;}
.weui_select{padding-left:0px;}
.weui_cell_select .weui_select {
    padding-right: 2px;
}
.we_width84{width:84%}
.pd_lt{padding-right: 11px;}
</style> 
<form class="form" step="1">
    <input id="deviceid" type="hidden" name="deviceid" value="">
        <div class="weui_cells_title"><h3>登录</h3></div>
        <div class="weui_cells weui_cells_form">
		<style type="text/css">
    .acct_select{display: block; max-width: 7em; width: auto; color: inherit; line-height: 44px; overflow: hidden; text-overflow:ellipsis; white-space:nowrap; word-wrap:normal;}
    .acct_select_input{position: absolute;left: -9999px;}
</style>
<div class="weui_cell weui_cell_select we_width84">
	<div class="weui_cell_bd pd_lt">
		<div class="weui_cell_hd pd_lt"><select id="j_acctSelect" class="weui_select" name="accttype" onchange="javascript:checkSelect(this)">
			<option value="mobile" selected="">手机号</option>
			<option value="wxid">微信号</option>
			<option value="qq">QQ号</option>
			<option value="email">Email</option>
		</select></div>
	<div class="weui_cell_bd ">
		<input id="j_acctMobileInput" name="acct" required="tel" maxlength="11" class="weui_input" type="tel" placeholder="请输入手机号" errtips="请输入正确的手机号">
	</div></div>
	
</div>
<div class="weui_cell weui_vcode we_width84">
	<div class="weui_cell_hd pd_lt"><label class="weui_label">密码</label></div>
	<div class="weui_cell_bd">
		<input name="imgcode" maxlength="16" class="weui_input ft44" type="password" placeholder="请输入密码" errtips="请输入正确的密码">
	</div>
</div>
<script type="text/javascript">
    !function(w, d){
        var Dselect = d.querySelector("#j_acctSelect"),		
			DmobileInput = d.querySelector("#j_acctMobileInput");
		var tipStr = "请输入"+Dselect[Dselect.selectedIndex].text;
		var tipStr2 = "请输入正确的"+Dselect[Dselect.selectedIndex].text;
		DmobileInput.setAttribute("placeholder",tipStr);
		DmobileInput.setAttribute("errtips",tipStr2);
    }(window, document);
</script>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd pd_lt"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input name="imgcode" required="vcode" maxlength="4" class="weui_input" type="text" placeholder="点击验证码可更换" errtips="请输入正确的验证码">
            </div>
            <div class="weui_cell_ft weui_vimg_wrp">
                <i class="weui_icon_warn"></i>
                <img src="https://weixin110.qq.com/security/verifycode" onclick="this.src = this.src.replace(/\?t.*/, '') + '?t=' + +new Date()">
            </div>
        </div>
    </div>
    <div class="weui_btn_area">
        <a id="submitBtn" class="weui_btn weui_btn_primary" href="javascript:">登录</a>
    </div>
</form>
<div id="toptips" class="weui_toptips weui_warn"></div>
<script type="text/javascript">
$(function(){
	$("#j_acctSelect").onchange(function(){
		var Dselect = d.querySelector("#j_acctSelect"),				
			DmobileInput = d.querySelector("#j_acctMobileInput");
		var tipStr = "请输入"+Dselect[Dselect.selectedIndex].text;
		var tipStr2 = "请输入正确的"+Dselect[Dselect.selectedIndex].text;
		DmobileInput.setAttribute("placeholder",tipStr);
		DmobileInput.setAttribute("errtips",tipStr2);
	});
	
	$("#submitBtn").click(function(){
		console.log("sss");
	});

})
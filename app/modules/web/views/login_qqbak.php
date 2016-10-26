<html>
 <head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>微信安全中心-登录</title>
 <style>
 body {
    line-height: 1.6;
    font-family: "Helvetica Neue","Hiragino Sans GB","Microsoft YaHei","\9ED1\4F53",Arial,sans-serif;
    color: #222;
    font-size: 14px;background-color: #EFEFF4;

}
.login_input_panel {
    margin-top: 5px;
}
.icon_login.un {
    background: url("/assets/web/images/page_login_z260591.png") 0 0 no-repeat;
}
.icon_login.pwd {
    background: url("/assets/web/images/page_login_z260591.png") 0 -28px no-repeat;
}
div {
    display: block;
}
 .login_frame {
     margin: auto;
    float: none;
    margin-top: 25px;
}
.login_input {
    position: relative;
    padding: 3px 0 3px 54px;
    border: 1px solid #e7e7eb;
    margin-top: -1px;
}
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
.login_input input {
    border: 0;
    outline: 0;
    padding: 11px 0;
    vertical-align: middle;
    width: 100%;
}
.login_frame {
    padding: 25px 35px 20px;
    border-radius: 2px;
	width:80%;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    box-shadow: 3px 3px 5px rgba(0,0,0,0.5);
    -moz-box-shadow: 3px 3px 5px rgba(0,0,0,0.5);
    -webkit-box-shadow: 3px 3px 5px rgba(0,0,0,0.5);
    background-color: #fff;
}
.btn_login {
    display: inline-block;
    overflow: visible;
    vertical-align: middle;
    text-align: center;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-width: 1px;
    border-style: solid;
    cursor: pointer;
    background-color: #44b549;
    background-image: -moz-linear-gradient(top,#44b549 0,#44b549 100%);
    background-image: -webkit-gradient(linear,0 0,0 100%,from(#44b549),to(#44b549));
    background-image: -webkit-linear-gradient(top,#44b549 0,#44b549 100%);
    background-image: -o-linear-gradient(top,#44b549 0,#44b549 100%);
    background-image: linear-gradient(to bottom,#44b549 0,#44b549 100%);
    border-color: #44b549;
    color: #fff;
    height: 33px;
    line-height: 33px;
    width: 120px;
    padding-left: 0;
    padding-right: 0;
}
a {
    color: #459ae9;
    text-decoration: none;
}
h3{text-align: left;}
/*验证码*/
.verifycode {
    margin-top: 10px;
}
.frm_input_box {
    display: inline-block;
    position: relative;
    height: 50px;
    line-height: 50px;
    vertical-align: middle;
    width: 100px;
    font-size: 16px;
    padding: 0 10px;
    border: 1px solid #e7e7eb;
}
.frm_input {
    height: 42px;
    margin: 4px 0;
	width: 100%;
    background-color: transparent;
    border: 0;
    outline: 0;
}
.verifycode img {
    height: 50px;
    vertical-align: middle;
}
.verifycode a {
    margin-left: 3px;
}
 </style>
 </head>
 <body>
  <div class="login_frame"> 
   <h3>登录</h3> 
   <div class="login_err_panel" style="display:none;" id="err"> 
   </div> 
   <form class="login_form" id="loginForm"> 
    <div class="login_input_panel" id="js_mainContent"> 
     <div class="login_input"> 
      <i class="icon_login un"> </i> 
      <input type="text" placeholder="邮箱/微信号/QQ号" id="account" name="account" /> 
     </div> 
     <div class="login_input"> 
      <i class="icon_login pwd"> </i> 
      <input type="password" placeholder="密码" id="pwd" name="password" /> 
     </div> 
    </div> 
    <div class="verifycode"  id="verifyDiv"> 
     <span class="frm_input_box"> <input class="frm_input" type="text" id="verify" name="verify" /> </span> 
     <img id="verifyImg" src="" /> 
     <a href="javascript:;" id="verifyChange">换一张</a> 
    </div> 
    <div class="login_help_panel" style="display:none;"> 
     <label class="frm_checkbox_label" for="rememberCheck"> <i class="icon_checkbox"></i> <input type="checkbox" class="frm_checkbox" id="rememberCheck" /> 记住帐号 </label> 
     <a class="login_forget_pwd" href="/acct/resetpwd?action=send_email_page">忘记密码</a> 
    </div> 
    <div class="login_btn_panel" style="margin-top:22px;"> 
     <a class="btn_login" title="点击登录" href="javascript:" id="loginBt">登录</a> 
    </div> 
   </form> 
  </div>
 </body>
</html>
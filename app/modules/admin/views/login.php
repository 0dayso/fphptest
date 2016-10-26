
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>后台管理登录界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/third-party/font-awesome-4.2.0/css/font-awesome.min.css">
  <style>
  body{
    font-family: 'microsoft yahei',Arial,sans-serif;
    background-color: #222;
  }

  .redborder {
    border:2px solid #f96145;
    border-radius:2px;
  }

  .row {
    padding: 20px 0px;
  }

  .bigicon {
    font-size: 97px;
    color: #f08000;
  }

  .loginpanel {
    text-align: center;
    width: 300px;
    border-radius: 0.5rem;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 10px auto;
    background-color: #555;
    padding: 20px;
  }

  input {
    width: 100%;
    margin-bottom: 17px;
    padding: 15px;
    background-color: #ECF4F4;
    border-radius: 2px;
    border: none;
  }

  h2 {
    margin-bottom: 20px;
    font-weight: normal;
    color: #EFEFEF;
  }

  .btn {
    border-radius: 2px;
    padding: 10px;
  }

  .btn span {
    font-size: 27px;
    color: white;
  }

  .buttonwrapper{
    position:relative;
    overflow:hidden;
    height:50px;
  }

  .lockbutton {
    font-size: 27px;
    color: #f96145;
    padding: 10px;
    width:100%;
    position:absolute;
    top:0;
    left:0;
  }

  .loginbutton {
    background-color: #f08000;
    width: 100%;
    -webkit-border-top-right-radius: 0;
    -webkit-border-bottom-right-radius: 0;
    -moz-border-radius-topright: 0;
    -moz-border-radius-bottomright: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    left: -260px;
    position:absolute;
    top:0;
  }
  </style>
<!--[if IE]>
<style>
 input {
    width: 90%;
    margin-bottom: 17px;
    padding: 15px;
    background-color: #ECF4F4;
    border-radius: 2px;
    border: none;
  }

  .loginbutton {
    background-color: #f08000;
    width: 100%;
    -webkit-border-top-right-radius: 0;
    -webkit-border-bottom-right-radius: 0;
    -moz-border-radius-topright: 0;
    -moz-border-radius-bottomright: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    left: -300px;
    position:absolute;
    top:0;
  }

  .lockbutton {
    font-size: 27px;
    color: #f96145;
    padding: 10px;
    width:90%;
    position:absolute;
    top:0;
    left:0;
  }
  .col-md-10{
    text-align:center;
  }

  .btn span {
    font-size: 27px;
    color: white;
  }
  .row{
    padding-top:1px;
    padding-bottom:1px;
  }
</style>
< ![endif]-->
<!-- left: -260px; -->
</head>
<body>

<!-- Interactive Login - START -->
<div class="container-fluid">
  <form action="/admin/home/login" method="post">
    <div class="row">
        <div class="loginpanel">
      <i id="loading" class="hidden fa fa-spinner fa-spin bigicon"></i>
            <h2>
        <span class="fa fa-quote-left "></span> 登录 <span class="fa fa-quote-right "></span>
      </h2>
            <div>
                <input id="username" name="username" type="text" placeholder="登录账号" onkeypress="check_values();">
                <input id="password" name="password" type="password" placeholder="输入密码" onkeypress="check_values();">

        <div class="buttonwrapper">
          <button id="loginbtn" class="btn btn-warning loginbutton" type="submit">
            <span class="fa" style="font-weight:bold">√</span>
          </button>
          <span id="lockbtn" class="fa fa-lock lockbutton redborder" style="font-weight:bold;color:#ec971f;font-size:27px;"></span>
        </div>
            </div>
        </div>
        <?php $msg = \Session::get_flash('msg', false); ?>
        <?php  if($msg){ ?>
        <div style="text-align: center; color:#f96145; font-size: 15px;">
          <?php echo $msg['msg'];?>
        </div>
        <?php  } ?>
    </div>
    </form>
</div>
<script type="text/javascript" src="/assets/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript">


    function check_values() {
        if ($("#username").val().length != 0 && $("#password").val().length != 0) {
            $("#loginbtn").animate({ left: '0' , duration: 'slow'});;
            $("#lockbtn").animate({ left: '310px' , duration: 'slow'});;
        }
    }

      
  $("#loginbtn").click(function(){
    $('#loading').removeClass('hidden');
    //这里书写登录相关后台处理，例如: Ajax请求用户名和密码验证
    $('#form').submit();
  });

</script>

<!-- Interactive Login - END -->

</div>

<div class="container-fluid">
  <div class="row footerbox">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <footer class="text-center">
      <a href="#"><i class="fa fa-external-link"></i> 精舍度假村</a>
    </footer>
    </div>
    <div class="col-md-1"></div>
  </div>
</div>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="zh-CN" dir="ltr">                        
<head>
	<meta charset="UTF-8">
    <title><?php echo $title ? $title: '';?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <script src="/assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
</head>              
<body>
    <?php echo isset($content) ? $content : ""; ?>
</body>

<script type="text/javascript">
    function iFrameHeight() {

        var ifm = document.getElementById("iframepage");

        var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;

        if(ifm != null && subWeb != null) {

            ifm.height = subWeb.body.scrollHeight;

        }

    }
$(document).ready(function(){
  $(window).resize(function(){
     autoHeight();
  });
  $('.carousel-inner .item img').load(function(){
    autoHeight();
  });
});

var autoHeight=function(){
  var h1=$('#banners').height();
  var h2=$('#the_reg').height();
  var w=$(window).width();
  $('#the_reg .apply_bg').css('height',(h1+5)+'px');
  //  $('#the_reg .apply_bg .right_bg').css('',(w/1280));
  if(h1 == null || h1 == undefined){
    $('#the_reg .apply_bg').css('height',h2+'px');

  }
  //console.log('height=='+h1+"  "+h2);
}
window.onload=autoHeight();
</script>
</html>
<html>
	<head>
		<title><?php echo \Input::get("errTitle","系统错误");?></title>
		<meta name="keywords" content="404" />
		<link href="/statics/plugs/errpage/css/style.css" rel="stylesheet" type="text/css"  media="all" />
		 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	</head>
	<body>
			<div class="header">
				<div class="logo">
					<h1 style="font-size:25px;"><a href="#"></a></h1>
				</div>
			</div>
			<div class="content">
				<img src="/statics/plugs/errpage/images/error-img.png" title="error" />
				<p><span><label></label><?php echo \Input::get("errContent","系统错误");?></span></p>
				<a href="/web/index">回到首页</a>
				<div class="copy-right">
					<p>&#169 All rights Reserved | Designed by Jeremy<a></a></p>
				</div>
   			</div>
		</div>
	</body>
</html>


<?php $global = \Session::get('GLOBAL_PARAMS');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo isset($title) ? $title : ''; ?> - Ace Admin</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/assets/ace/css/bootstrap.css" />
		<link rel="stylesheet" href="/assets/ace/css/font-awesome.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" type="text/css" href="/assets/third-party/font-awesome-4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/assets/ace/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="/assets/ace/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/assets/ace/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="/assets/ace/css/ace-ie.css" />
		<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/assets/ace/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="/assets/ace/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="/assets/ace/js/html5shiv.js"></script>
		<script src="/assets/ace/js/respond.js"></script>
		<![endif]-->
		<!-- basic scripts -->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='/assets/ace/js/jquery1x.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='/assets/ace/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="/assets/ace/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="/assets/ace/js/excanvas.js"></script>
		<![endif]-->
		<script src="/assets/ace/js/jquery-ui.custom.js"></script>
		<script src="/assets/ace/js/jquery.ui.touch-punch.js"></script>
		<script src="/assets/ace/js/jquery.easypiechart.js"></script>
		<script src="/assets/ace/js/jquery.sparkline.js"></script>
		<script src="/assets/ace/js/flot/jquery.flot.js"></script>
		<script src="/assets/ace/js/flot/jquery.flot.pie.js"></script>
		<script src="/assets/ace/js/flot/jquery.flot.resize.js"></script>

		<!-- ace scripts -->
		<script src="/assets/ace/js/ace/elements.scroller.js"></script>
		<script src="/assets/ace/js/ace/elements.colorpicker.js"></script>
		<script src="/assets/ace/js/ace/elements.typeahead.js"></script>
		<script src="/assets/ace/js/ace/elements.wysiwyg.js"></script>
		<script src="/assets/ace/js/ace/elements.spinner.js"></script>
		<script src="/assets/ace/js/ace/elements.treeview.js"></script>
		<script src="/assets/ace/js/ace/elements.wizard.js"></script>
		<script src="/assets/ace/js/ace/elements.aside.js"></script>
		<script src="/assets/ace/js/ace/elements.fileinput.js"></script>
		<script src="/assets/ace/js/ace/ace.js"></script>
		
		<script src="/assets/ace/js/ace/ace.ajax-content.js"></script>
		<script src="/assets/ace/js/ace/ace.touch-drag.js"></script>
		<script src="/assets/ace/js/ace/ace.sidebar.js"></script>
		<script src="/assets/ace/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="/assets/ace/js/ace/ace.submenu-hover.js"></script>
		<script src="/assets/ace/js/ace/ace.widget-box.js"></script>
		<script src="/assets/ace/js/ace/ace.settings.js"></script>
		<script src="/assets/ace/js/ace/ace.settings-rtl.js"></script>
		<script src="/assets/ace/js/ace/ace.settings-skin.js"></script>
		<script src="/assets/ace/js/ace/ace.widget-on-reload.js"></script>
		<script src="/assets/ace/js/ace/ace.searchbox-autocomplete.js"></script>
	</head>

	<body class="no-skin">
		<?php echo render('ace/public/nav'); ?>
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<?php echo render('ace/public/shortcuts'); ?>				

				<?php echo render('ace/public/left_menu'); ?>

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>
			<!-- /section:basics/sidebar -->

			<div class="main-content">
				<div class="main-content-inner">
					<?php echo render('ace/public/breadcrumbs'); ?>
					<div class="page-content">
						<?php echo render('ace/public/style_setting'); ?>

						<?php echo render('ace/public/page_header'); ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
								<?php echo isset($content) ? $content : ''; ?>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php echo render('ace/public/footer'); ?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	</body>
</html>

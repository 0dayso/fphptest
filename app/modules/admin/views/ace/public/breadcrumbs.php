<!-- #section:basics/content.breadcrumbs -->
<div class="breadcrumbs" id="breadcrumbs">
	<script type="text/javascript">
		try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>

	<ul class="breadcrumb">
		<li>
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">首页</a>
		</li>
		<?php if(isset($controller_name) && $controller_name){ ?>
		<li class="active"><?php echo isset($controller_name) ? $controller_name : ''; ?></li>
		<?php } ?>
	</ul><!-- /.breadcrumb -->

	<!-- #section:basics/content.searchbox -->
	<div class="nav-search" id="nav-search">
		<form class="form-search">
			<span class="input-icon">
				欢迎 <?php 
				$display_name = '';
				if(\Auth::check()){
					$display_name = \Auth::get_user()->username."使用 {$GLOBAL_OPTIONS['site_web_short_name']}网站 后台管理系统";
				}
				echo $display_name;
			?>
		</span>
			</span>
		</form>
	</div><!-- /.nav-search -->

	<!-- /section:basics/content.searchbox -->
</div>

<!-- /section:basics/content.breadcrumbs -->
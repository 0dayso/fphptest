<?php 
  $lang_bag = \Session::get('lang','cn');
  include(APPPATH."/lang/{$lang_bag}/public.php");
  //$main_navs
?>

<div id="menuII" class="nav">
	<div class="logo">
		<p class="p1">精舍度假村</p>
		<p class="p2">JINGSHE HOLIDAY RESORT</p>
		<p class="line"></p>
		<p class="p3">快乐*伴您一生</p>
	</div>
  <?php if(isset($left_menus) && $left_menus){?>
  <?php $firstNav = end($left_menus);?>
  <?php }?>
	<ul>
		<li class="list1"><a href="/web/index">首页</a></li>
		<?php if(!empty($main_navs) && $main_navs){ ?>
			<?php foreach ($main_navs as $key => $value) { if($value->depth != 1){continue;}?>
      	<li class=""><a href="<?php echo $value->url;?>"><?php echo strtoupper(\Session::get('lang','cn')) == 'CN' ?  $value->name : $value->alias;?></a>
            	<?php $navs_child = $value->children()->get();?>
            	<?php if($navs_child){?>
			    	<ul>
			    		<li class="menu-item-b" ><span></span></li>
	            <?php foreach ($navs_child as $k => $v) { ?>
		    			<li class="menu-item" ><a href="<?php echo $v->url;?>"><?php echo strtoupper(\Session::get('lang','cn')) == 'CN' ?  $v->name : $v->alias;?></a></li>
	            <?php }?>
		        </ul>
			    <?php }?>
			</li>
			<?php }?>
		<?php }?>
	</ul>
</div>
<?php 
  $lang_bag = \Session::get('lang','cn');
  include(APPPATH."lang/{$lang_bag}/public.php");
?>
<?php $global = \Session::get('GLOBAL_OPTIONS');?>

<!--顶部head区域开始-->
<div class="header">
      <div class="banner">
          <img src="<?php echo isset($header_img) && $header_img ? $header_img->thumbnail: ''; ?>" alt="" onerror="javascript:this.src='/assets/web/images/banner.png'"/>
      </div>
      <?php echo render('public/nav'); ?>
</div>
<!--顶部head区域结束-->
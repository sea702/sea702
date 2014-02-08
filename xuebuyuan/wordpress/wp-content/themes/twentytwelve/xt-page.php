<?php
/*
  Template Name: 新淘客自定义页面
 */
?>

<?php
xt_get_header();
?>
<div id="content">
    <div id="hd">
        <div class="container xt-first-child">
            <?php xt_get_page_header(); ?>		
        </div>
    </div>
    <div id="bd">
        <div class="container xt-first-child">
            <?php xt_get_page_body() ?>
        </div>
    </div>
    <div id="ft">
        <div class="container xt-first-child">
            <?php xt_get_page_footer(); ?>	
        </div>
    </div>
</div>
<?php xt_get_footer(); ?>
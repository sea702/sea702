<div class="clear"></div>
<div class="footer_top">
	<div id="menu">
		<?php 
			$catNav = '';
			if (function_exists('wp_nav_menu')) {
				$catNav = wp_nav_menu( array( 'theme_location' => 'footer-menu',  'echo' => false, 'fallback_cb' => '' ) );};
			if ($catNav == '') { ?>
				<ul id="cat-nav" class="nav">
					<?php wp_list_pages('depth=1&sort_column=menu_order&title_li='); ?>
				</ul>
		<?php } else echo($catNav); ?>
	</div>
	<h2 class="blogtitle">
	<a href="<?php bloginfo('home'); ?>/" title="<?php bloginfo('name'); ?>">返回首页</a></h2>
	<?php wp_reset_query();if ( is_home()){ ?><div class="link_s"></div><?php } ?>
	<big class="lt"></big>
	<big class="rt"></big>
</div>
<!-- 页脚 -->
<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
<div class="footer_bottom_a">
	Copyright <?php echo comicpress_copyright(); ?> <?php bloginfo('name'); ?>&nbsp;&nbsp;保留所有权利.
	<?php echo stripslashes(get_option('swt_track_code')); ?>
	<big class="lb"></big>
	<big class="rb"></big>
</div>
<?php } ?>
<!-- 首页页脚 -->
<?php wp_reset_query();if ( is_home()){ ?>
<div class="link">
        <li id="linkcat-5" class="linkcat"><h2>友情链接</h2>
        <ul class='xoxo blogroll'>
	<?php
		if(function_exists('wp_hot_get_links')){
		wp_hot_get_links();
		}else{
		wp_list_bookmarks('title_li=&categorize=1&category=&orderby=rand&show_images=&limit='.get_option('swt_link'));
		}
	?>
	</ul>
</li>
	<div class="clear"></div>
</div>
<div class="link_b">
	<big class="lb"></big>
	<big class="rb"></big>
</div>
<!-- end: link -->
<div class="footer_bottom">
	Copyright <?php echo comicpress_copyright(); ?> <?php bloginfo('name'); ?>&nbsp;&nbsp;保留所有权利.<br>
	冀ICP备08106218号-27
	<?php echo stripslashes(get_option('swt_track_code')); ?>
</div>
<?php } ?>
 <div class="clear"></div>
</div>
<?php wp_footer(); ?>
</body></html>
<?php if (get_option('swt_bulletin') == '关闭') { ?>
<?php { echo ''; } ?>
<?php } else { include(TEMPLATEPATH . '/includes/bulletin.php'); } ?>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fc0f0742eeb83d6ab6614a81723b00197' type='text/javascript'%3E%3C/script%3E"));
</script>

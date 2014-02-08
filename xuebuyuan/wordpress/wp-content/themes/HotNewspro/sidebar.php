<div id="sidebar">
	<?php wp_reset_query();if ( is_home() ){ ?>
	<?php if (get_option('swt_tab') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/tab_h.php'); } ?>
	<?php } ?>

	<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
	<?php if (get_option('swt_tab') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/tab.php'); } ?>
	<?php } ?>
	<?php wp_reset_query();if ( is_home()){ ?>
	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具1') ) : ?>
		<?php endif; ?>
	</div>
	<?php } ?>

	<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具1') ) : ?>
		<?php endif; ?>
	</div>
	<?php } ?>
	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('全部页面小工具') ) : ?>
		<?php endif; ?>
	</div>

	<?php if (get_option('swt_mimg') == '显示') { ?>
	<?php include('includes/mimg.php'); ?>
	<?php } else { } ?>

	<?php if (get_option('swt_mcat') == '显示') { ?>
	<?php wp_reset_query();if (is_single()) { ?>
		<?php include('includes/mcat.php'); ?>
	<?php } ?>
	<?php } else { } ?>

	<?php if (get_option('swt_wallreaders') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/top_comment.php'); } ?>

	<div class="widget">
		<?php wp_reset_query();if ( is_home() ){ ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('首页小工具2') ) : ?>
		<?php endif; ?>
		<?php } ?>
	</div>

	<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
	<div class="widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('其它页面小工具2') ) : ?>
		<?php endif; ?>
	</div>
	<?php } ?>

	<?php if (get_option('swt_statistics') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/statistics.php'); } ?>
	<div class="clear"></div>

	<?php wp_reset_query();if (is_single() || is_page() || is_archive() || is_search() || is_404()) { ?>
	<?php if (function_exists('zg_recently_viewed')): if (isset($_COOKIE["WP-LastViewedPosts"])) { ?>
	<?php if (get_option('swt_recently') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include('includes/recently.php'); } ?>
	<?php } endif; ?>
	<?php } ?>
</div>
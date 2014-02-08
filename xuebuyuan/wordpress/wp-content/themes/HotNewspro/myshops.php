<?php
/*
Template Name: 我的商铺
*/
?>
<?php get_header(); ?>
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置 ＞<a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞<?php the_title(); ?></div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="entry_box_s_l">
		<IFRAME src="<?php echo get_option('swt_shops'); ?>"  style="margin: 10px 0 0 1px;" width=976  height=1530 scrolling=no ALLOWTRANSPARENCY="no"></IFRAME>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
<?php get_footer(); ?>
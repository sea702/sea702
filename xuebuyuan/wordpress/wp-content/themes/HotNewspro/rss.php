<?php
/*
Template Name: RSS聚合
*/
?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/rss.css" />
<div class="clear"></div>
	<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>	
<div id="rss_content">
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; <?php the_title(); ?></div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="rss_widget">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('RSS聚合') ) : ?>
		<?php endif; ?>
	</div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
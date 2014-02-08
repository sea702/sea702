<?php get_header(); ?>
<title><?php wp_title('',true); ?> | <?php bloginfo('name'); ?></title>
	<!-- menu -->
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在位置 &gt; <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 
			<?php $post = $posts[0]; ?>
			<?php echo get_the_term_list($post->ID,  'genre', '', ', ', ''); ?>
		</div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<!-- end: menu -->
	<div class="clear"></div>
	<?php $posts = query_posts($query_string . '&orderby=date&showposts=12');?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry_box_s_l">
  	<div class="archive_box_z">
  		<div class="archive_box">
  			 <!-- end: archive_title_box -->
			<div class="archive_title_box_b">
				<ul class="date_b">
					<li class="date_m"><?php the_time('m月') ?></li>
					<li class="date_d"><?php the_time('d日') ?></li>
				</ul>
				<div class="archive_title_b">
					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				</div>
				<div class="archive_info_b">
					<span class="category"><?php the_category(', ') ?></span>
					<?php include('includes/source.php'); ?>
					&#8260; <?php echo count_words ($text); ?>
					<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论 1 条', '评论 % 条'); ?></span>
					<?php if(function_exists('the_views')) { print ' &#8260; 阅读 '; the_views(); print ' 次';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
				<div class="clear"></div>
			</div>
 			<!-- end: archive_title_box -->
			<div class="archive_b">
				<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"......"); ?>
				<div class="clear"></div>
				<span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
				<div class="clear"></div>
			</div>
		</div>
		<!-- end: archive_box -->
	</div> 		
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
 	<!-- navigation -->
	<div class="clear12"></div>
	<div id="pagenavi"><?php pagenavi(); ?></div>
 	<!-- end: navigation -->
	<div class="clear"></div>
<?php get_footer(); ?>
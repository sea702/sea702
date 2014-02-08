<?php get_header(); ?>
<div id="content">
	<!-- menu -->
	<div id="map">
		<div class="browse">现在位置： <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt;
			<?php $post = $posts[0]; ?>
			<?php if (is_category()) { ?><?php echo get_category_parents( get_query_var('cat') , true , ' &gt; ' ); ?>文章
			<?php } elseif( is_tag() ) { ?><?php single_tag_title(); ?>
			<?php } elseif (is_day()) { ?>所有<?php the_time('Y年m月d日'); ?>发表的文章
			<?php } elseif (is_month()) { ?>所有<?php the_time('Y年m月'); ?>发表的文章
			<?php } elseif (is_year()) { ?>所有<?php the_time('Y年'); ?>发表的文章
			<?php } elseif (is_author()) { ?><?php wp_title( '');?>发表的所有文章
			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h1>Blog Archives</h1>
			<?php } ?>
		</div>
		<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
	</div>
	<!-- end: menu -->
 	<!-- archive_box -->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry_box">
  		<div class="archive_box">
  			 <!-- end: archive_title_box -->
			<div class="archive_title_box">
				<!-- 分类图标 -->
				<div class="ico"><?php if (get_option('swt_ico') == '显示') { ?><?php include('includes/cat_ico.php'); ?><?php } else { } ?></div>
				<!-- end: 分类图标 -->
				<div class="archive_title">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				</div> 
				<div class="archive_info">
					<span class="date"><?php the_time('Y年m月d日') ?></span>
					<span class="category"> &#8260; <?php the_category(', ') ?></span>
					<?php include('includes/source.php'); ?>
					&#8260; <?php echo count_words ($text); ?>
					<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论 1 条', '评论 % 条'); ?></span>
					<?php if(function_exists('the_views')) { print ' &#8260; 阅读 '; the_views(); print ' 次';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
 			<!-- end: archive_title_box -->
			<!-- thumbnail -->
			<div class="thumbnail_box">
				<?php include('includes/thumbnail.php'); ?>
			</div>
			<div class="archive_c">
				<?php if (has_excerpt()){ ?><?php the_excerpt() ?><?php } else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"..."); } ?>
			</div>
			<div class="clear"></div>
			<span class="posttag"><?php the_tags('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', ', ', ''); ?></span><span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
			<div class="clear"></div>
		</div>
 		<!-- end: archive_box -->
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_box_b">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
 	<!-- end: box_archive --> 
 	<!-- ad -->
	<?php if ($wp_query->current_post == 0) : ?>
	<?php if (get_option('swt_adh') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/ad_h.php'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
	<?php endwhile; else: ?>
	<div class="ad_h">
		<p align="center" style="padding:30px;font-size: 14px;">暂时未录入内容</p>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_box_b">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<?php endif; ?>

 	<!-- navigation -->
	<div id="pagenavi"><?php pagenavi(); ?></div>
 	<!-- end: navigation -->
	<div class="clear"></div>
</div>
<!-- end: content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
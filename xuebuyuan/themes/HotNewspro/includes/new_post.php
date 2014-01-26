<?php
	$scrollcount = get_option('swt_new_post');
 ?>
<?php query_posts('&showposts='.$scrollcount.'&caller_get_posts=10.&cat='.get_option('swt_new_exclude')); while ( have_posts() ) : the_post();$do_not_duplicate[] = $post->ID; ?>
<div class="entry_box">
	<div class="box_entry">
		<div class="box_entry_title">
			<span class="cat_name">
				<?php 
				$category = get_the_category(); 
				if($category[0]){
				echo '<a href='.get_category_link($category[0]->term_id ).'>'.$category[0]->cat_name.'</a>';
				}
				?>
			</span>
			<div class="ico"><?php if (get_option('swt_ico') == '显示') { ?><?php include('cat_ico.php'); ?><?php } else { } ?></div>
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<div class="info">
					<span class="date"><?php the_time('Y年m月d日') ?></span>
					&#8260; <?php echo count_words ($text); ?>
					<?php include('source.php'); ?>
					<span class="comment"> &#8260; <?php comments_popup_link('暂无评论', '评论 1 条', '评论 % 条'); ?></span>
					<?php if(function_exists('the_views')) { print ' &#8260; 阅读 '; the_views(); print ' 次';  } ?>
					<span class="edit"><?php edit_post_link('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '  ', '  '); ?></span>
				</div>
			</div>
			<div class="news"></div>
			<div class="clear"></div>
			<!-- thumbnail -->
			<div class="thumbnail_box">
				<?php include('thumbnail.php'); ?>
			</div>
			<div class="post_entry">
				<?php if (has_excerpt()){ ?><?php the_excerpt() ?><?php } else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 400,"..."); } ?>
				<div class="clear"></div>
				<span class="posttag"><?php the_tags('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', ', ', ''); ?></span><span class="archive_more"><a href="<?php the_permalink() ?>" title="详细阅读 <?php the_title(); ?>" rel="bookmark" class="title">阅读全文</a></span>
				<div class="clear"></div>
		</div>
	</div>
	<i class="lt"></i>
	<i class="rt"></i>
</div>
<div class="entry_box_b">
	<i class="lb"></i>
	<i class="rb"></i>
</div>
 	<!-- ad -->
	<?php if ($wp_query->current_post == 0) : ?>
	<?php if (get_option('swt_adh') == '关闭') { ?>
	<?php { echo ''; } ?>
	<?php } else { include(TEMPLATEPATH . '/includes/ad_h.php'); } ?>
	<?php endif; ?>	
	<!-- end: ad -->
<?php endwhile; ?>
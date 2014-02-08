<div id="hot_n">
	<div id="hot_tag">热点<br/>推荐</div>
	<div class="hot_a">
		<?php
			$args = array(
				'posts_per_page' => 1,
				'post__in'  => get_option('sticky_posts'),
				'caller_get_posts' => 10
			);
			query_posts($args);
			?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读<?php the_title(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 54, '');?></a></h2>
		<p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 140,"..."); ?></p>
		<?php endwhile; ?>
		<?php endif; ?>	
	</div>
	<div class="hot_b">
		<?php
			$args = array(
				'posts_per_page' => 4,
				'offset' => 1,
				'post__in'  => get_option('sticky_posts'),
				'caller_get_posts' => 10
			);
			query_posts($args);
			?>
		<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>
		<ul><li><h2><a href="<?php the_permalink() ?>" rel="bookmark" title="详细阅读<?php the_title(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 36, '');?></a></h2></li></ul>
		<?php endwhile; ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
	<i class="lt"></i>
	<i class="rt"></i>
	<i class="lb"></i>
	<i class="rb"></i>
</div>
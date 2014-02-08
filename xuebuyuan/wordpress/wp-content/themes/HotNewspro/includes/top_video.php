<div id="top_hot">
	<div id="featured">
	<?php 
		$loop = new WP_Query( array( 'post_type' => 'video', 'posts_per_page' => 4, 'orderby' => rand ) );
		while ( $loop->have_posts() ) : $loop->the_post();
	?>
		<div class="item">
			<div class="top_t">
				<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
				<?php $image = get_post_meta($post->ID, 'small', true); ?>
				<?php $img = get_post_meta($post->ID, 'big', true); ?>
				<a class="example6" href="<?php echo $img; ?>" rel="example6" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
				<?php else: endif;?>
			</div>
			<div class="top_box"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">详细内容</a></div>
			<div class="boxCaption">
				<h2><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php echo cut_str($post->post_title,30); ?></a></h2>
			</div>
		</div>
	<?php endwhile; ?>
	<div class="clear"></div>
	</div>
</div>
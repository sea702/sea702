<div class="show_h">
<div class="v_show">
	<div class="v_content">
		<div  class="v_content_list">
			<?php 
				$loop = new WP_Query( array( 'post_type' => 'video', 'posts_per_page' => get_option('swt_rolling_n'), 'orderby' => rand ) );
				while ( $loop->have_posts() ) : $loop->the_post();
			?>
			<ul>
				<li>
					<?php if ( get_post_meta($post->ID, 'small', true) ) : ?>
					<?php $image = get_post_meta($post->ID, 'small', true); ?>
					<?php $img = get_post_meta($post->ID, 'big', true); ?>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/></a>
					<?php else: endif;?>
				</li>
   		     </ul>
		     <?php endwhile; ?>
		</div>
	</div>
	<div class="v_caption">
		<div class="highlight_tip">
			<span class="currents">1</span><span>2</span><span>3</span><span>4</span>
		</div>
		<div class="change_btn">
			<span class="prev" >上一页</span>
			<span class="next">下一页</span>
		</div>
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
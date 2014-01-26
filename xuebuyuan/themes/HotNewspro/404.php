<?php get_header(); ?>
<div id="roll"><div title="回到顶部" id="roll_top"></div><div title="转到底部" id="fall"></div></div>
<div id="content">
	<div id="map">
		<div class="browse">现在位置 ＞<a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> ＞未知页面</div>
		<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
	</div>
	<!-- end: menu -->
	<div class="entry_box_s">
		 <div class="entry">
			<div class="error">
 				 <h2>对不起！这个真没有!</h2>
				<div class="search_c">
					<h3>搜索</h3>
					<?php if (get_option('swt_search') == 'google') { ?>
					<?php include('includes/g_search.php'); ?>
					<?php } else { include(TEMPLATEPATH . '/includes/w_search.php'); } ?>
				</div>
 			</div>
 		  </div>
		<div class="clear"></div>
		<!-- end: entry -->
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script type="text/javascript">
jQuery(function($){
	$('#expand_collapse,.archives-yearmonth').css({cursor:"pointer"});
	$('#archives ul li ul.archives-monthlisting').hide();
	$('#archives ul li ul.archives-monthlisting:first').show();
	$('#archives ul li span.archives-yearmonth').click(function(){$(this).next().slideToggle('fast');return false;});
	//以下是全局的操作
	$('#expand_collapse').toggle(
	function(){
	$('#archives ul li ul.archives-monthlisting').slideDown('fast');
	},
	function(){
	$('#archives ul li ul.archives-monthlisting').slideUp('fast');
	});
	});
</script>

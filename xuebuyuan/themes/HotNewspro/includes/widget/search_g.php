<h3>百度站内搜索</h3>
<div class="box_c">
	<div class="search_k">
		<form action="http://www.baidu.com/baidu" target="_blank">
		<input name=word size="26" maxlength="100" class="swap_value">
		<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" id="go" alt="Search" title="搜索" />
		<input name=tn type=hidden value="bds">
		<input name=cl type=hidden value="3">
		<input name=ct type=hidden value="2097152">
		<input name=si type=hidden value="<?php echo get_option('swt_baidu_s'); ?>">
		<input name=si type=hidden value="">
		</form>
	</div>
</div>
<div class="box-bottom">
	<i class="lb"></i>
	<i class="rb"></i>
</div>
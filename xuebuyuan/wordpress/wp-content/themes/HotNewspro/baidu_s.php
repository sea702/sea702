<?php
/*
Template Name: 百度搜索
*/
?>
<?php get_header(); ?>
<style type="text/css">
.baidu_s_value {
	height: 30px;
	margin: 10px 0 0 10px;
	padding: 2px 8px 2px 8px;
	border: 1px solid #ccc;
}
</style>
	<div id="map_box">
		<div id="map_l">
			<div class="browse">现在的位置: <a title="返回首页" href="<?php echo get_settings('Home'); ?>/">首页</a> &gt; 百度站内搜索</div>
		</div>
		<div id="map_r">
			<div id="feed"><a href="<?php bloginfo('rss2_url'); ?>" title="RSS">RSS</a></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="entry_box_s_g">
	<div class="baidu_s">
		百度站内搜索：
		<input type="text" name="wd" size="110" maxlength="100" class="baidu_s_value"/>
		<input type="image" src="<?php bloginfo('template_directory'); ?>/images/go.gif" onclick="javascript:baidusearch()" value="搜索" />
	</div>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<div class="entry_box_s_g">
			<iframe id="baidusearchFrame" src='' style="" width=920  height=1030 scrolling=no ALLOWTRANSPARENCY="no"></iframe>
		<i class="lt"></i>
		<i class="rt"></i>
	</div>
	<div class="entry_sb_l">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
<?php get_footer(); ?>
<script language="javascript">
function baidusearch () {
	var wd=document.getElementsByName("wd")[0].value;
	var link="http://www.baidu.com/baidu?si=get_option('swt_baidu_s')&cl=3&ct=2097152&tn=baidulocal&word="+wd;
	//window.open(link);
	document.getElementById('baidusearchFrame').src=link;
}
</script>

<div class="recently">
	<div class="box_top">
		<i class="rt"></i>
		<i class="lt"></i>
	</div>
		<div class="share_hot">
			<span class="rss_hot"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="订阅本站"></a></span>
			<!-- Baidu Button BEGIN -->
			<div id="bdshare" class="bdshare_t bds_tools_24 get-codes-bdshare">
				<a class="bds_qzone"></a>
				<a class="bds_tsina"></a>
				<a class="bds_tqq"></a>
				<a class="bds_renren"></a>
				<a class="bds_copy"></a>
				<a class="shareCount"></a>
			</div>
			<!-- Baidu Button END -->
			<div class="clear"></div>
		</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
	<div class="box_top">
		<i class="rt"></i>
		<i class="lt"></i>
	</div>
	<div class="mimg">	
		<h4>最近浏览过的文章：</h4>
		<?php zg_recently_viewed(); ?>
	</div>
	<div class="box-bottom">
		<i class="lb"></i>
		<i class="rb"></i>
	</div>
</div>
<!-- 跟随滚动 -->
<script type="text/javascript">
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top, pos = element.css("position");
        $(window).scroll(function() {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: 10
                    });
                } else {
                    element.css({
                        top: scrolls
                    });
                }
            }else {
                element.css({
                    position: "",
                    top: top
                });
            }
        });
    };
    return $(this).each(function() {
        position($(this));
    });
};
//绑定
$(".recently").smartFloat();
</script>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
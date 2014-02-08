<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/mousewheel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/fancybox.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$("a[rel=example_group]").fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				return '<span id="fancybox-title-over">共 ' + currentArray.length + ' 张图片，当前第 ' + (currentIndex + 1) +' 张 '+ (title.length ? ' &nbsp; ' + title : '') + '</span>';
			}
		});

		$("#various").fancybox({
			'padding'			: 0,
			'autoScale'			: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});
		$("#download").fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});
	});
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<?php include('includes/seo.php'); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/css.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/highlight.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/img.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" />
<?php if (function_exists('wp_enqueue_script') && function_exists('is_singular')) : ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js" ></script>
<?php wp_head(); ?>
<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/reply.js"></script>
<?php } ?>
<?php endif; ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/superfish.js"></script>
<?php if (get_option('swt_pirobox') == '关闭') { ?>
<?php } else { include(TEMPLATEPATH . '/includes/pirobox.php'); } ?>
<script type="text/javascript">
$(function () {
$('.thumbnail img,.thumbnail_t img,.box_comment img,#slideshow img,.cat_ico,.cat_name,.r_comments img,.v_content_list img').hover(
function() {$(this).fadeTo("fast", 0.5);},
function() {$(this).fadeTo("fast", 1);
});
});
</script>
<!-- PNG -->
<!--[if lt IE 7]>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/pngfix.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('.boxCaption,.top_box,.logo,.reply,.imgcat,.banner img,#fancybox-left-ico,#fancybox-right-ico,#fancybox-close');
</script>
<![endif]-->
<!-- 图片延迟加载 -->
<?php include('includes/lazyload.php'); ?>
<!-- IE6菜单 -->
<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
	if (!document.getElementsByTagName) return false;
	var sfEls = document.getElementById("menu").getElementsByTagName("li");

	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}	
	var sfEls = document.getElementById("topnav").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
//--><!]]></script>
<!-- 预加载 -->
</head>
<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="top">
		<div id='topnav'>
			<div class="left_top ">
				<div class="home_h"><a href="<?php echo bloginfo('url'); ?>" title="首  页" class="home_h"></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?> 
			</div>
			<!-- end: left_top --> 
			<div id="searchbar">
				<?php if (get_option('swt_search') == 'google') { ?>
				<?php include('includes/g_search.php'); ?>
				<?php } else { include(TEMPLATEPATH . '/includes/w_search.php'); } ?>
			</div>
			<!-- end: searchbar -->
		</div>
		<!-- end: topnav -->
	</div>
	<!-- end: top -->
	<div id="header">
		<div class="header_c">
			<div class="login_t"><?php include('includes/login.php'); ?></div>
			<?php include('includes/time.php'); ?>
			<?php if (get_option('swt_logo') == '关闭') { ?>
			<h1 class="site_title"><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name'); ?></a></h1>
			<h2 class="site_description"><?php bloginfo('description'); ?></h2>
			<?php { echo ''; } ?>
			<?php } else { include(TEMPLATEPATH . '/includes/logo.php'); } ?>
		</div>
		<div class="clear"></div>
		<!-- end: header_c -->
	</div>
	<!-- end: header -->
	<?php if (get_option('swt_hot') == '关闭') { ?>
		<!-- header_image -->
		<div class="banner">
			<?php
				$header_image = get_header_image();
				if ( ! empty( $header_image ) ) :
			?>
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
			<?php endif;?>
		</div>
		<!-- end:header_image -->
	<?php } else { include(TEMPLATEPATH . '/includes/top_hot_a.php'); } ?>
	<!-- scroll -->
	<?php include('includes/scroll.php'); ?>

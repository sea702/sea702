<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />

<meta name="keywords" content="学步园,it社区,代码,程序,it技术,编程语言" />
<meta name="description" content="学步园为程序员提供全面的技术学习材料，拥有大量的技术文章，是国内领先的IT技术社区" />


<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<link href="http://www.xuebuyuan.com/files/i.css" rel="stylesheet" media="screen" type="text/css">
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<div class="logo"><a href="http://www.xuebuyuan.com/"><img src="/wp-content/uploads/2013/12/xuebuyuan2.png"></a></div>
<div class="nav">
    	<ul>
      	<li class="index"><a href='/'>主页</a></li>
        <li><a href='/category/web%e5%89%8d%e7%ab%af'>web前端</a></li>
      	<li><a href='/category/%e6%95%b0%e6%8d%ae%e5%ba%93'>数据库</a></li>
      	<li><a href='/category/%e7%bc%96%e7%a8%8b%e8%af%ad%e8%a8%80'>编程语言</a></li>
      	<li><a href='/category/%e6%90%9c%e7%b4%a2%e5%bc%95%e6%93%8e'>搜索技术</a></li>
      	<li><a href='/category/%e7%ae%97%e6%b3%95'>算法</a></li>
        <li><a href='/category/uncategorized'>综合</a></li>
        <li><a href='http://bbs.xuebuyuan.com'>论坛</a></li>
    	</ul>
 </div>       

	<div id="main" class="wrapper">

</form>

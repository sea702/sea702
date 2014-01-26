<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title>
<meta name="description" content="在线代码高亮转换" />
<meta name="keywords" content="在线代码高亮转换,代码高亮,代码着色" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/code/css/code.css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/code/css/highlight.css" />
<?php wp_head(); ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/code/js/shCore.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/code/js/rendered.js"></script>
</head>
<body>
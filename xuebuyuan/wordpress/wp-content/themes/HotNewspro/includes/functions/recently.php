<?php
/* 可选参数: */
$zg_cookie_expire = 360; // cookie过期时间，默认值是360天
$zg_number_of_posts = 10; // 显示篇数，默认值是10。
$zg_recognize_pages = true; // 页面应该得到承认和上市？默认值是true

/* 此行后不要编辑 */
function zg_lwp_header() {
	if (is_single()) {
		zg_lw_setcookie();
	} else if (is_page()) {
		global $zg_recognize_pages;
		if ($zg_recognize_pages === true) {
			zg_lw_setcookie();
		}
	}
}

function zg_lw_setcookie() {
	global $wp_query;
	$zg_post_ID = $wp_query->post->ID;
	if (! isset($_COOKIE["WP-LastViewedPosts"])) {
		$zg_cookiearray = array($zg_post_ID);
	} else {
		$zg_cookiearray = unserialize(preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", stripslashes($_COOKIE["WP-LastViewedPosts"])));
		if (! is_array($zg_cookiearray)) {
			$zg_cookiearray = array($zg_post_ID);
		}
	}
  	if (in_array($zg_post_ID, $zg_cookiearray)) {
		$zg_key = array_search($zg_post_ID, $zg_cookiearray);
		array_splice($zg_cookiearray, $zg_key, 1);
	}
	array_unshift($zg_cookiearray, $zg_post_ID);
	global $zg_number_of_posts;
	while (count($zg_cookiearray) > $zg_number_of_posts) {
		array_pop($zg_cookiearray);
	}
	$zg_blog_url_array = parse_url(get_bloginfo('url'));
	$zg_blog_url = $zg_blog_url_array['host'];
	$zg_blog_url = str_replace('www.', '', $zg_blog_url);
	$zg_blog_url_dot = '.';
	$zg_blog_url_dot .= $zg_blog_url;
	$zg_path_url = $zg_blog_url_array['path'];
	$zg_path_url_slash = '/';
	$zg_path_url .= $zg_path_url_slash;
	global $zg_cookie_expire;
	setcookie("WP-LastViewedPosts", serialize($zg_cookiearray), (time()+($zg_cookie_expire*86400)), $zg_path_url, $zg_blog_url_dot, 0);
}

function zg_recently_viewed() {
	echo '<ul class="viewed_posts">';
	if (isset($_COOKIE["WP-LastViewedPosts"])) {
		$zg_post_IDs = unserialize(preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", stripslashes($_COOKIE["WP-LastViewedPosts"])));
		foreach ($zg_post_IDs as $value) {
			global $wpdb;
			$zg_get_title = $wpdb->get_results("SELECT post_title FROM $wpdb->posts WHERE ID = '$value+0' LIMIT 1");
			foreach($zg_get_title as $zg_title_out) {
				echo "<li><a href=\"". get_permalink($value+0) . "\" title=\"". $zg_title_out->post_title . "\">". cut_str($zg_title_out->post_title,30) . "</a></li>\n";
			}
		}
	} else {
	}
	echo '</ul>';
}

add_action('get_header','zg_lwp_header');
?>
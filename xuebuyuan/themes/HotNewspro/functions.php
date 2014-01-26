<?php if (get_option('swt_cut_img') == '关闭') { ?>
<?php { echo ''; } ?>
<?php } else { 
add_image_size('thumbnail', 140, 100, true);
add_image_size('show', 400, 248, true);
add_image_size('hot', 236, 155, true);
 } ?>
<?php
include("includes/theme_options.php");
include("includes/guide.php");
include("includes/functions/Pagenavi.php");
include("includes/functions/types.php");
include("includes/functions/types_gallery.php");
include("includes/functions/types_video.php");
include("includes/functions/cumulus.php");
include("includes/functions/notify.php");
include("includes/functions/filing.php");
include("includes/functions/recently.php");
include("includes/widget.php");
include("includes/functions/banner.php");
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
		'name'			=> '首页小工具1',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    	'after_widget' => '</div>
    	<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '首页小工具2',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    	'after_widget' => '</div>
    	<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '全部页面小工具',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    	'after_widget' => '</div>
    	<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '其它页面小工具1',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    	'after_widget' => '</div>
    	<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '其它页面小工具2',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    	'after_widget' => '</div>
    	<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> '相册、视频和公告模版小工具',
        'before_widget'	=> '',
        'after_widget'	=> '</div>',
        'before_title'	=> '<h3>',
        'after_title'	=> '</h3><div class="box">',
    	'after_widget' => '</div>
    	<div class="box-bottom">
			<i class="lb"></i>
			<i class="rb"></i>
		</div>',
    ));
}
{
    register_sidebar(array(
		'name'			=> 'RSS聚合',
        'before_widget'	=> '',
        'after_widget'	=> '',
        'before_title'	=> '<div class="r_box"><div class="rss"></div><h3>',
        'after_title'	=> '</h3>',
    	'after_widget' => '<i class="lt"></i><i class="rt"></i><i class="lb"></i><i class="rb"></i></div>',
    ));
}
//自定义菜单
   register_nav_menus(
      array(
         'header-menu' => __( '导航自定义菜单' ),
         'footer-menu' => __( '页角自定义菜单' )
      )
   );

//背景
add_custom_background();
//feed
add_theme_support( 'automatic-feed-links' );
//后台预览
add_editor_style('/css/editor-style.css');
//支持外链缩略图
if ( function_exists('add_theme_support') )
 add_theme_support('post-thumbnails');
 /*Catch first image (post-thumbnail fallback) */
 function catch_first_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
		$random = mt_rand(1, 20);
		echo get_bloginfo ( 'stylesheet_directory' );
		echo '/images/random/'.$random.'.jpg';
  }
  return $first_img;
 } 
//标题文字截断
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');
//编辑器增强
 function enable_more_buttons($buttons) {
     $buttons[] = 'hr';
     $buttons[] = 'del';
     $buttons[] = 'sub';
     $buttons[] = 'sup'; 
     $buttons[] = 'fontselect';
     $buttons[] = 'fontsizeselect';
     $buttons[] = 'cleanup';   
     $buttons[] = 'styleselect';
     $buttons[] = 'wp_page';
     $buttons[] = 'anchor';
     $buttons[] = 'backcolor';
     return $buttons;
     }
add_filter("mce_buttons_3", "enable_more_buttons");
//分类文章数
function wt_get_category_count($input = '') {
    global $wpdb;

    if($input == '') {
        $category = get_the_category();
        return $category[0]->category_count;
    }
    elseif(is_numeric($input)) {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
        return $wpdb->get_var($SQL);
    }
    else {
        $SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
        return $wpdb->get_var($SQL);
    }
}
//自定义头像
add_filter( 'avatar_defaults', 'fb_addgravatar' );
function fb_addgravatar( $avatar_defaults ) {
$myavatar = get_bloginfo('template_directory') . '/images/gravatar.png';
  $avatar_defaults[$myavatar] = '自定义头像';
  return $avatar_defaults;
}
// 判断管理员
function is_admin_comment ($comment_ID=0) {
$user_id = get_comment($comment_ID)->user_id;
$user_info = get_userdata($user_id);
return $user_info->user_level == 10;
return $admin_comment;
}
// 评论回复
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$page = get_query_var('cpage')-1;
		$cpp=get_option('comments_per_page');
		$commentcount = $cpp * $page;
	}
    ?>
   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
   <div id="div-comment-<?php comment_ID() ?>">
      <?php $add_below = 'div-comment'; ?>
		<div class="author_box">
			<div class="t" style="display:none;" id="comment-<?php comment_ID(); ?>"></div>
			<span id="avatar">
				<?php if (is_admin_comment($comment->comment_ID)){ ?>
      			 <?php echo get_avatar( $comment, 32 ); ?><br/><span class="admin_w">管理员</span>
				<?php } else { echo get_avatar( $comment, 48 ); } ?>
			</span>
			<span  class="comment-author">
				<strong><?php commentauthor(); ?></strong>：
				<span class="datetime">
					<?php comment_date('Y年m月d日') ?> <?php comment_time('') ?><?php edit_comment_link('编辑','&nbsp;+',''); ?>
					<?php
					if ( is_user_logged_in() ) {
					$url = get_bloginfo('url');
					echo '<a id="delete-'. $comment->comment_ID .'" href="' . wp_nonce_url("$url/wp-admin/comment.php?action=deletecomment&amp;p=" . $comment->comment_post_ID . '&amp;c=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '"" >&nbsp;×删除</a>';
					}
					?>
					<span class="reply_t"><?php comment_reply_link(array_merge( $args, array('reply_text' => '&nbsp;@回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
					<span class="floor"><?php if(!$parent_id = $comment->comment_parent) {printf('&nbsp;&#916;%1$s楼', ++$commentcount);} ?><?php if( $depth > 1){printf('&nbsp;&#8711;地下%1$s层', $depth-1);} ?></span>
				</span>
				<span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '回复', 'add_below' =>$add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
			</span >
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
		您的评论正在等待审核中...
		<br/>
		<?php endif; ?>
		<?php comment_text() ?>
		<i class="lt"></i>
		<i class="rt"></i>
		<i class="lb"></i>
		<i class="rb"></i>
		<div class="clear"></div>
  </div>
<?php
}

function mytheme_end_comment() {
		echo '</li>';
}
//评论链接新窗口
function commentauthor($comment_ID = 0) {
    $url    = get_comment_author_url( $comment_ID );
    $author = get_comment_author( $comment_ID );
    if ( empty( $url ) || 'http://' == $url )
		echo $author;
    else
		echo "<a href='$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
}
//自动生成版权时间
function comicpress_copyright() {
    global $wpdb;
    $output = "&copy; 2013-2014";
    return $output;
}

//评论贴图
function embed_images($content) {
  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
  return $content;
}
add_filter('comment_text', 'embed_images');
//留言信息
function WelcomeCommentAuthorBack($email = ''){
	if(empty($email)){
		return;
	}
	global $wpdb;

	$past_30days = gmdate('Y-m-d H:i:s',((time()-(24*60*60*30))+(get_option('gmt_offset')*3600)));
	$sql = "SELECT count(comment_author_email) AS times FROM $wpdb->comments
					WHERE comment_approved = '1'
					AND comment_author_email = '$email'
					AND comment_date >= '$past_30days'";
	$times = $wpdb->get_results($sql);
	$times = ($times[0]->times) ? $times[0]->times : 0;
	$message = $times ? sprintf(__('过去30天内您有<strong>%1$s</strong>条留言，感谢关注!' ), $times) : '您已很久都没有留言了，这次想说点什么？';
	return $message;
}
//字数统计
function count_words ($text) {
global $post;
if ( '' == $text ) {
   $text = $post->post_content;
   if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '共 ' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') . '字';
   return $output;
}
}
//跳转到设置
if (is_admin() && $_GET['activated'] == 'true') {
header("Location: themes.php?page=theme_options.php");
}
//去掉描述P标签
function deletehtml($description) {
$description = trim($description);
$description = strip_tags($description,"");
return ($description);
}
add_filter('category_description', 'deletehtml');
//屏蔽默认小工具
add_action( 'widgets_init', 'my_unregister_widgets' );
function my_unregister_widgets() {
//近期评论
	unregister_widget( 'WP_Widget_Recent_Comments' );
//近期文章
	unregister_widget( 'WP_Widget_Recent_Posts' );
//搜索
	unregister_widget( 'WP_Widget_Search' );
}
//下载按钮
function button_a($atts, $content = null) {
return '<div id="down"><a id="download" title="下载链接" href="#button_file">下载地址</a></div>';
}
add_shortcode("file", "button_a");
//按时间获得最受欢迎文章
function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400); 
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
			$temp .= "<li><a href=\"".get_permalink()."\">$post_title</a>".__('', 'wp-postviews')."</li>";
		}
	} else {
		$temp = '<li>'.__('N/A', 'wp-postviews').'</li>'."\n";
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}
// 禁止无中文留言
function refused_spam_comments( $comment_data ) {
$pattern = '/[一-龥]/u';  
if(!preg_match($pattern,$comment_data['comment_content'])) {
err('评论必须含中文！');
}
return( $comment_data );
}
add_filter('preprocess_comment','refused_spam_comments');
// 优酷视频
function youku_video($atts, $content=null){
	return '<p style="text-align: center;"><embed src=http://static.youku.com/v1.0.0223/v/swf/loader.swf?VideoIDS='.$content.'ID&winType=adshow quality="high" width="610" height="460" align="middle" wmode="transparent" allowScriptAccess="never" allowNetworking="internal" autostart="0" type="application/x-shockwave-flash"></embed></p>';
}
add_shortcode('youku','youku_video');
// 友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
// 编辑器按钮
add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');
function bolo_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
QTags.addButton( 'file', '下载按钮', "[file]" );
QTags.addButton( 'youku', '优酷视频', "[youku]视频ID[/youku]" );
function bolo_QTnextpage_arg1() {
}
</script>
<?php }
// 导航目录
function article_index($content) {
    $matches = array();
    $ul_li = '';
    $r = "/<h3>([^<]+)<\/h3>/im";
  
    if(preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $num => $title) {
            $content = str_replace($matches[0][$num], '<h4 id="title-'.$num.'">'.$title.'</h4>', $content);
            $ul_li .= '<li><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
        }
        $content = "\n<div id=\"article-index\">
                <strong>文章目录</strong>  
                <ul id=\"index-ul\">\n" . $ul_li . "</ul>
            </div>\n" . $content;
    }
    return $content;
}
add_filter( "the_content", "article_index" ); 
//全部结束
?>

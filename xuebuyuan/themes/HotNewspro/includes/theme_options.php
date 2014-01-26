<?php
$themename = "HotNews Pro";
$shortname = "swt";
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
//Stylesheets Reader
$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

$number_entries = array("选择数量","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array ( 
array( "name" => $themename." Options",
       "type" => "title"),
//选择颜色风格
    array( "name" => "颜色风格",
           "type" => "section"),
    array( "type" => "open"),

	array(	"name" => "选择颜色风格",
			"desc" => "7种导航风格供选择：
						<font color=#818181>1 灰</font>
						<font color=#000>2 黑</font>
						<font color=#ff0000>3 红</font>
						<font color=#1153c0>4 蓝</font>
						<font color=#48a20d>5 绿</font>
						<font color=#b60ea0>6 紫</font>
						<font color=#cccccc>7 白</font>",
			"id" => $shortname."_alt_stylesheet",
			"std" => "Select a CSS skin:",
			"type" => "select",
			"options" => $alt_stylesheets),

//首页设置

    array( "type" => "close"),
    array( "name" => "首页布局",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "选择首页布局",
			"desc" => "说明：默认博客布局，选择杂志布局需设置以下内容",
            "id" => $shortname."_home",
            "type" => "select",
            "std" => "杂志布局",
            "options" => array("博客布局", "杂志布局")),

	array(	"name" => "首页左侧分类ID设置",
			"desc" => "说明：显示更多分类，请用英文逗号＂,＂隔开",
            "id" => $shortname."_catl",
            "type" => "text",
            "std" => "1,2,3,4"),

	array(	"name" => "首页右侧分类ID设置",
			"desc" => "说明：显示更多分类，请用英文逗号＂,＂隔开",
            "id" => $shortname."_catr",
            "type" => "text",
            "std" => "1,2,3,4"),

	array(	"name" => "分类列表显示的篇数",
			"desc" => "说明：默认显示4篇",
			"id" => $shortname."_cat_n",
			"type" => "text",
            "std" => "4"),

	array(  "name" => "横向图片滚动",
			"desc" => "说明：默认不显示。",
            "id" => $shortname."_rolling",
            "type" => "checkbox",
			"std" => "false"),

	array(  "name" => "选择横向滚动内容",
			"desc" => "说明：通过添加自定义栏目，名称：recommend，值：可任意，调用显示指定文章。",
            "id" => $shortname."_rolling_v",
            "type" => "select",
            "std" => "视频",
            "options" => array("自定义", "视频")),

	array(	"name" => "横向图片滚动数量",
			"desc" => "说明：默认显示8篇",
			"id" => $shortname."_rolling_n",
			"std" => "8",
			 "type" => "text",
			"options" => $number_entries),

	array(  "name" => "最新日志",
			"desc" => "说明：默认显示",
            "id" => $shortname."_new_p",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "最新日志显示的篇数",
			"desc" => "说明：默认显示1篇",
			"id" => $shortname."_new_post",
			"std" => "6",
			"type" => "select",
			"options" => $number_entries),

	array(	"name" => "输入最新文章排除的分类ID",
            "desc" => "说明：比如：-1,-2,-3<br/>多个ID用英文逗号隔开",
            "id" => $shortname."_new_exclude",
            "type" => "text",
            "std" => ""),

	array(  "name" => "首页顶部热门标签",
			"desc" => "说明：默认不显示",
            "id" => $shortname."_tag_t",
            "type" => "select",
            "std" => "显示",
            "options" => array("关闭", "显示")),

	array(	"name" => "输入首页顶部热门标签数量",
            "desc" => "说明：默认随机排序显示15个",
            "id" => $shortname."_top_tag",
            "type" => "text",
            "std" => "15"),

//顶部热点文章设置开始

    array( "type" => "close"),
    array( "name" => "热点文章",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "是否显示热点文章",
			"desc" => "说明：选择关闭后，调用WP顶部图像功能，在自定义顶部设置页面，上传图像或者移除顶部图像",
            "id" => $shortname."_hot",
            "type" => "select",
            "std" => "显示",
            "options" => array("显示", "关闭")),

	array(  "name" => "选择调用方法",
			"desc" => "说明：默认显示4篇最新文章，选择自定义后，通过添加自定义栏目,名称：hot，值：可任意，调用指定的文章",
            "id" => $shortname."_hot_img",
            "type" => "select",
            "std" => "最新文章",
            "options" => array("最新文章", "自定义")),

//侧边栏相关设置开始

    array( "type" => "close"),
    array( "name" => "侧边模块",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "侧边TAB菜单",
			"desc" => "说明：默认显示",
            "id" => $shortname."_tab",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "侧边最新文章排除的分类ID",
            "desc" => "说明：比如：-1,-2,-3<br/>多个ID用英文逗号隔开",
            "id" => $shortname."_newr_exclude",
            "type" => "text",
            "std" => ""),

 	array(	"name" => "输入推荐栏目小工具分类ID",
            "desc" => "说明：输入分类ID，显示更多的分类请用英文逗号＂,＂把ID号隔开",
            "id" => $shortname."_cat_h",
            "type" => "text",
            "std" => "1,2,3,4"),

	array(	"name" => "输入侧边推荐文章小工具分类ID",
            "desc" => "多个ID用英文逗号＂,＂隔开",
            "id" => $shortname."_s_cat",
            "type" => "text",
            "std" => "1,2,3"),

	array(	"name" => "输入推荐文章显示的篇数",
            "desc" => "说明：默认20篇",
            "id" => $shortname."_s_cat_n",
            "type" => "text",
            "std" => "20"),

	array(  "name" => "侧边最新图片",
			"desc" => "说明：默认闭关",
            "id" => $shortname."_mimg",
            "type" => "select",
            "std" => "显示",
            "options" => array("关闭", "显示")),

	array(	"name" => "侧边最新图片显示数量",
			"desc" => "说明：默认显示4张",
			"id" => $shortname."_mimg_n",
			"std" => "4",
			 "type" => "text",
			"options" => $number_entries),

	array(  "name" => "侧边同分类最新文章",
			"desc" => "说明：默认闭关",
            "id" => $shortname."_mcat",
            "type" => "select",
            "std" => "显示",
            "options" => array("关闭", "显示")),

	array(	"name" => "同分类最新文章显示篇数",
			"desc" => "说明：默认显示5篇",
			"id" => $shortname."_mcat_n",
			"std" => "5",
			 "type" => "text",
			"options" => $number_entries),

	array(	"name" => "输入从侧边固定分类排除的分类ID",
            "desc" => "说明：比如：-1,-2,-3多个ID用英文逗号＂,＂隔开",
            "id" => $shortname."_cat_exclude",
            "type" => "text",
            "std" => ""),

	array(  "name" => "侧边最活跃读者",
			"desc" => "说明：默认不显示",
            "id" => $shortname."_wallreaders",
            "type" => "select",
            "std" => "关闭",
            "options" => array("关闭", "显示")),

	array(  "name" => "最近浏览过的文章",
			"desc" => "说明：默认显示",
            "id" => $shortname."_recently",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(  "name" => "侧边网站统计",
			"desc" => "说明：默认不显示",
            "id" => $shortname."_statistics",
            "type" => "select",
            "std" => "显示",
            "options" => array("关闭", "显示")),

	array(	"name" => "建站日期",
            "desc" => "说明：日期格式：2008-02-01",
            "id" => $shortname."_builddate",
            "type" => "text",
            "std" => "2008-02-01"),

//综合功能控制

    array( "type" => "close"),
    array( "name" => "综合功能",
           "type" => "section"),
    array( "type" => "open"),

	array(  "name" => "是否显示LOGO",
			"desc" => "说明：默认显示",
            "id" => $shortname."_logo",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(  "name" => "特色图片功能",
			"desc" => "说明：默认闭关。开启后，上传图片会自动生成三张裁剪后的缩略图，选择作为特色图像",
            "id" => $shortname."_cut_img",
            "type" => "select",
            "std" => "开启",
            "options" => array("关闭", "开启")),

	array(  "name" => "暗箱放大特效",
			"desc" => "说明：默认开启",
            "id" => $shortname."_pirobox",
            "type" => "select",
            "std" => "关闭",
            "options" => array("开启", "关闭")),

	array(  "name" => "彩色标签云",
			"desc" => "说明：默认显示",
            "id" => $shortname."_cumulus",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(  "name" => "分类图标",
			"desc" => "说明：默认不显示",
            "id" => $shortname."_ico",
            "type" => "select",
            "std" => "显示",
            "options" => array("关闭", "显示")),

	array(  "name" => "正文底部相关文章",
			"desc" => "说明：默认显示",
            "id" => $shortname."_related",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(  "name" => "是否显示表情",
			"desc" => "说明：默认显示",
            "id" => $shortname."_smiley",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(  "name" => "底部公告栏设置",
			"desc" => "说明：默认显示",
            "id" => $shortname."_bulletin",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "公告显示条数",
			"desc" => "说明：默认显示4条",
			"id" => $shortname."_bulletin_n",
			"std" => "4",
			 "type" => "text",
			"options" => $number_entries),

	array(	"name" => "输入首页底部友情链接数量",
            "desc" => "说明：默认随机排序显示20个",
            "id" => $shortname."_link",
            "type" => "text",
            "std" => "20"),

	array("name" => "全部链接",
            "desc" => "说明：输入友情链接页面地址",
            "id" => $shortname."_link_s",
            "type" => "text",
            "std" => "输入你的友情链接页面地址"),

       array("name" => "输入你的商铺地址",
            "desc" => "说明：用于我的商铺独立模版",
            "id" => $shortname."_shops",
            "type" => "text",
            "std" => "http://wopus.taobao.com/"),

//SEO设置

    array( "type" => "close"),
	array( "name" => "SEO设置",
       "type" => "section"),
	array( "type" => "open"),

	array(	"name" => "首页描述（Description）",
			"desc" => "",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "说明：输入你的网站描述，一般不超过200个字符"),

	array(	"name" => "首页关键词（KeyWords）",
            "desc" => "",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "说明：输入你的网站关键字，一般不超过100个字符"),

	array("name" => "流量统计代码",
            "desc" => "",
            "id" => $shortname."_track_code",
            "type" => "textarea",
            "std" => ""),

//"google自定义搜索

    array( "type" => "close"),
	array( "name" => "搜索设置",
			"type" => "section"),
	array( "type" => "open"),


	array(	"name" => "侧边百度搜索小工具，输入域名",
            "desc" => "",
            "id" => $shortname."_baidu_s",
            "type" => "text",
            "std" => "zmingcx.com"),

	array(  "name" => "导航搜索框，选择搜索方式",
			"desc" => "说明：默认WP程序自带，选择google自定义搜索，需设置以下两项",
            "id" => $shortname."_search",
            "type" => "select",
            "std" => "google",
            "options" => array("wp", "google")),

	array(	"name" => "输入你的Google搜索结果页面链接",
            "desc" => "",
            "id" => $shortname."_search_link",
            "type" => "text",
            "std" => "http://zmingcx.com/search"),

	array(	"name" => "输入你的Google自定义搜索ID",
            "desc" => "",
            "id" => $shortname."_search_ID",
            "type" => "text",
            "std" => "005077649218303215363:ngrflw3nv8m"),

    array( "type" => "close"),
	array( "name" => "广告设置",
			"type" => "section"),
	array( "type" => "open"),

	array(  "name" => "是否显示首页广告",
			"desc" => "说明：默认显示，最大宽度730px",
            "id" => $shortname."_adh",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "输入首页广告代码",
            "desc" => "",
            "id" => $shortname."_adh_c",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="' . get_bloginfo('template_directory') . '/images/ad/ad730.jpg" alt="Wopus问答" /></a>'),

	array(	"name" => "输入侧边广告代码(小工具)",
            "desc" => "",
            "id" => $shortname."_adsc",
            "type" => "textarea",
            "std" => '<a href="http://idc.wopus.org/" target="_blank"><img src="' . get_bloginfo('template_directory') . '/images/ad/ad230.jpg" alt="博客主机" /></a>'),
 
	array(  "name" => "是否显示评论框上方广告",
			"desc" => "说明：默认显示，最大宽度730px",
            "id" => $shortname."_adc",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "输入评论框上方广告代码",
            "desc" => "",
            "id" => $shortname."_ad_c",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="' . get_bloginfo('template_directory') . '/images/ad/ad730.jpg" alt="Wopus问答" /></a>'),

	array(  "name" => "是否显示正文广告",
			"desc" => "说明：默认显示，最大宽度730px",
            "id" => $shortname."_ad_r",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "输入正文广告代码",
            "desc" => "",
            "id" => $shortname."_ad_rc",
            "type" => "textarea",
            "std" => '<a href="http://idc.wopus.org/" target="_blank"><img src="' . get_bloginfo('template_directory') . '/images/ad/ad300.jpg" alt="博客主机" /></a>'),

	array(	"name" => "输入下载弹窗广告",
            "desc" => "",
            "id" => $shortname."_file_ad",
            "type" => "textarea",
            "std" => '<a href="http://idc.wopus.org/" target="_blank"><img src="' . get_bloginfo('template_directory') . '/images/ad/ad500.jpg" alt="博客主机" /></a>'),

	array(  "name" => "是否显示正文底部广告",
			"desc" => "说明：默认显示，最大宽度730px",
            "id" => $shortname."_adt",
            "type" => "select",
            "std" => "关闭",
            "options" => array("显示", "关闭")),

	array(	"name" => "输入正文底部广告代码",
            "desc" => "",
            "id" => $shortname."_adtc",
            "type" => "textarea",
            "std" => '<a href="http://faq.wopus.org/" target="_blank"><img src="' . get_bloginfo('template_directory') . '/images/ad/ad730.jpg" alt="Wopus问答" /></a>'),

	array(	"type" => "close") 
);

function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
} 
add_theme_page($themename." Options", "主题选项", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() { 
global $themename, $shortname, $options;
$i=0; 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?>
<div class="wrap rm_wrap">
<h2><?php echo $themename; ?>主题选项</h2>
<p>当前主题: HotNewspro 2.7.2 Plus版 | 设计者：<a href="http://zmingcx.com" target="_blank">知更鸟</a> <font style="font-size:20px;"color=#ff0000><strong> &hearts; </strong></font> <font color=#000>捐助我，支付宝：<font color=#21759b><strong>zmingcx@gmail.com</strong></font></font> | <a href="http://zmingcx.com/hotnews-pro-theme-27.html" target="_blank">查看更新</a></p>
<div class="rm_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) { 
case "open":
?> 
<?php break; 
case "close":
?> 
</div>
</div>

<?php break; 
case "title":
?> 
<?php break; 
case 'text':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>
<?php
break;
 
case 'textarea':
?>

<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
 	 <div class="clearfix"></div> 
</div>
  
<?php
break;
 
case 'select':
?>

<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
	</select>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>
<?php
break; 
case "checkbox":
?>

<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>	
	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
</div>
<?php break; 
case "section":
$i++;
?>

<div class="rm_section">
	<div class="rm_title">
		<h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt="""><?php echo $value['name']; ?></h3>
		<span class="submit"><input type="submit" class="button-primary" name="save<?php echo $i; ?>" value="保存设置" /></span>
		<div class="clearfix"></div>
	</div>
<div class="rm_options">
<?php break;
}
}
?>
<?php
function show_id() {
	global $wpdb;
	$request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
	$request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
	$request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
	$request .= " ORDER BY term_id asc";
	$categorys = $wpdb->get_results($request);
	foreach ($categorys as $category) { 
		$output = '<ul>'.$category->name."&nbsp;［<font color=#0196e3>".$category->term_id.'</font>］</ul>';
		echo $output;
	}
}
?>
<span class="show_id">
    <h4>分类对应 ID</h4>
    <?php show_id();?>
</span>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
	<p class="submit">
		<input type="submit" class="button-primary" name="reset" value="恢复默认设置" />
		<input type="hidden" name="action" value="reset" />
		提示：此按钮将恢复主题初始状态，您的所有设置将消失！
	</p>
</form>
</div>
<?php }?>
<?php
function mytheme_wp_head() { 
	$stylesheet = get_option('swt_alt_stylesheet');
	if($stylesheet != ''){?>
		<link href="<?php bloginfo('template_directory'); ?>/styles/<?php echo $stylesheet; ?>" rel="stylesheet" type="text/css" />
<?php }
}
add_action('wp_head', 'mytheme_wp_head');
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>
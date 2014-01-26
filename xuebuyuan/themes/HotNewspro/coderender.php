<?php
/*
Template Name: 代码高亮
*/
?>
<?php include('code/header_code.php'); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>	
<div id="wrapper">
	<div id="header">
     <h1>在线代码高亮转换</h1>
     	<div id=usehelp>
			代码高亮转换工具测试版，适用于HotNews Pro主题发表文章或者留言时粘代码之用。复制粘贴代码请用鼠标右键或者快捷键！<!-- 其它主题可以<a title="使用方法" href="http://zmingcx.com/wordpress-code-highlight.html" target="_blank">点此参考方法使用</a> -->
		</div>
	</div>
	<div id="post">
		<div id="main">
			<div id="main_box">	
				<h2>输入源代码</h2>
				<!-- <div id="copypaste">
					<a href="#" onclick="docopy('source')">&nbsp;复制&nbsp;</a>
					|<a href="#" onclick="dopasted('source')">&nbsp;粘贴&nbsp;</a>
					|<a href="#" onclick="doclear('source')">&nbsp;清除&nbsp;</a>
				</div> -->
				<textarea title="输入源代码." class=java id=sourceCode style="width: 100%" name=sourceCode rows=6></textarea>
			</div>
			<div id="main_box">	
				<h2>转换设置</h2>
				<span class="options">选择语言:&nbsp;&nbsp;
				<select onchange="document.getElementById('sourceCode').className=this.value">
					<option value=java selected>java</option>
					<option value=xml>xml</option>
					<option value=sql>sql</option>
					<option value=jscript>jscript</option>
					<option value=groovy>groovy</option>
					<option value=css>css</option>
					<option value=cpp>cpp</option>
					<option value=c#>c#</option>
					<option value=python>python</option
					<option value=vb>vb</option>
					<option value=perl>perl</option>
					<option value=php>php</option>
					<option value=ruby>ruby</option>
					<option value=delphi>delphi</option>
				</select>
				</span>
				<span class="options">选项：&nbsp;
					<input id=showGutter type=checkbox checked> 显示行号
					<input id=firstLine type=checkbox checked> 起始为1
					<span class="options_no">
					<input id=showControls type=checkbox> 工具栏
					<input id=collapseAll type=checkbox> 折叠
					<input id=showColumns type=checkbox> 显示列数
					</span>
				</span>
				<span class="render">
					<button style="width: 80px;height:25px;" onclick=generateCode()>转&nbsp;&nbsp;换</button>
					<button style="width: 80px;height:25px;	margin-left: 10px;" onclick=clearText()>清&nbsp;&nbsp;除</button>
				</span>
			</div>
			<div id="main_box">
				<h2>HTML 代码</h2>
				<textarea id=htmlCode style="width: 100%" name=htmlCode rows=6></textarea>
			</div>

			<div id="main_box">
				<h2>HTML 预览</h2>
				<div id="preview"></div>
			</div>
		</div>
	</div>
	<div id="footer">
		<div id="copyright">
			Copyright <?php echo comicpress_copyright(); ?> <?php bloginfo('name'); ?>&nbsp;&nbsp;保留所有权利.&nbsp;&nbsp;
			<?php echo stripslashes(get_option('swt_track_code')); ?>
			<?php if(function_exists('the_views')) { print '&nbsp;&nbsp;该工具被使用 '; the_views(); print '次';  } ?>
		</div>
	</div>
</div>
	<?php endwhile; else: ?>
	<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
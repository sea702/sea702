<?php
/*
Template Name: search
*/
?>
<?php get_header(); ?>
<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com.hk/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load('search', '1', {language : 'zh-CN'});
  google.setOnLoadCallback(function(){
        var customSearchControl = new google.search.CustomSearchControl('007504628711321185124:w-wufhldrhc');
        customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
        customSearchControl.draw('cse');
        var match = location.search.match(/q=([^&]*)(&|$)/);
        
        if(match && match[1]){
          var search = decodeURIComponent(match[1]);
          customSearchControl.execute(search);
        }
//        customSearchControl.execute("sea");
    });
</script>
<link rel="stylesheet" href="http://www.google.com.hk/cse/style/look/shiny.css" type="text/css" />
<?php get_footer(); ?>

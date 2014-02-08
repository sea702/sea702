<?php
/**
<input type="text" name="q" style="color:#e5e1e1;" value="搜一搜" onfocus="if(value=='搜一搜') {value=''}" onblur="if (value=='') {value='搜一搜'}" />
 */
?>

<form role="search" method="get" id="searchform" action="/search" >
<input style="height: 28px;" type="text" name="q" value=" 搜一搜" onfocus="if(value==' 搜一搜') {value=''}" onblur="if (value=='') {value=' 搜一搜'}" />
<input type="submit" id="searchsubmit" value="搜索一下" />
</form>

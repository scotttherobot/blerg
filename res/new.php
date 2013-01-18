<?php
require_once("../res/Blerg.class.php");
$blerg = new Blerg();
$t = 0;
if(isset($_GET['t'])){
	$t = $_GET['t'];
}
?>
<html>
<head>
<style type="text/css" media="screen">
		@import url(/res/style.css);	
</style>
<title>
<? echo($blerg->returnName()) ?>
</title>
</head>
<body>

<div id="header" onclick="location.href='/';">
<br>
<!-- this is where the site title goes -->
<? echo($blerg->returnName()) ?>
</div>


<div id="nav">
<a href="/"> blog</a> 
<?
$pages = $blerg->returnPages();
foreach($pages as $record){
	echo('| <a href="index.php?id=' . $record['p_id'] . '"> ' . $record['p_title'] . '</a> ');
}
?>
</div>

<!-- Create a new post :) -->
<div class="post">
<div class="title">New <? if($t==1){ echo("Page"); }else{ echo("Post");} ?>
</div>

<form name="newpost" action="post.php" method="get">
<? if($t==1){echo('<input type="hidden" name="typ" value="1">');} ?>
<input type="hidden" name="m" value="c">
Title: <input type="text" name="t"><br>
Author: <input type="text" name="a"><br>
Body: <textarea name="b"></textarea><br>
<input type="submit" value="Post">
</form>
</div>

<div id="footer">
site by scott vanderlind 2013
</div>


</body>
</html>
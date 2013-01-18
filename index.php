<?php
require_once("res/Blerg.class.php");
$blerg = new Blerg();
$p_id = $_GET['id'];
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
$page = 0;
$p_perpage = 5;

///////
// ENABLES THE DELETE FUNCTION FOR POSTS
// NEEDS TO BE SET BY A COOKIE
///////
$auth = $_GET['auth']; 

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

<!--
<a href="/"> blog</a> |
<a href="/projects.php"> projects</a> |
<a href="/about.php"> about</a> |
<a href="/contact.php"> contact</a> 
--> 
<?
if($auth){
	echo(' | <a href="../res/new.php">new post</a> |');
	echo(' <a href="../res/new.php?t=1">new page</a>');
}
?>


</div>

<!-- 
<div class="post">
<div class="title"><!~~ Put the post title here ~~>Title</div>
<div class="byline"><!~~ Put the byline info here ~~>Byline</div>
<!~~ Put the content here ~~>Content goes in here
</div>
 -->

<?
// Show all the posts
if(!$p_id){
	$posts = $blerg->returnPosts($page, $p_perpage);
	foreach($posts as $record){
		echo('<div class="post">');
		echo('<div class="title"><a href="index.php?id='.$record['p_id'].'">' . $record['p_title'] . '</a></div>');
		echo('<div class="byline">' . $record['p_author'] . ' at ' . $record['p_timestamp'] . '</div>');
		echo(substr($record['p_body'], 0, 1000));
		echo('<div class="byline"><a href="index.php?id='.$record['p_id'].'">Continue Reading...</a></div>');
		echo('</div>');
	}
}
// Show a specific, complete post.
else{
	$record = $blerg->returnPost($p_id);
	echo('<div class="post">');
	echo('<div class="title"><a href="index.php?id='.$record['p_id'].'">' . $record['p_title'] . '</a></div>');
	echo('<div class="byline">' . $record['p_author'] . ' at ' . $record['p_timestamp'] . '</div>');
	echo($record['p_body']);
	if($auth){
		echo('<br><br><a href="../res/post.php?m=d&id=' . $record['p_id'] . '">Delete post</a>');
	}
	echo('</div>');
}
?>
<!-- Printing the page numbers -->
<?
$pg = $blerg->pageCount($p_perpage);
if($p_id || $pg == 1) echo("<!-- "); 

?>
<div class="post">
<?

if($page > 0){
	echo('<a href="?page='. ($page - 1) .'"> <- </a> ');
}
for($i = 0; $i < $pg; $i++){
	if($i == $page){
		echo('<big><a href="?page='.$i.'">['. ($i+1) .']</a></big> ');
	} else {
		echo('<a href="?page='.$i.'">'. ($i+1) .'</a> ');

	}
}
if($page < ($pg - 1)){
	echo('<a href="?page='. ($page + 1) .'"> -> </a> ');
}
?></div>
<? if($p_id || $pg == 1) echo(" -->"); ?>

<div id="footer">
<a href="../res/login.php">login</a> | site by scott vanderlind 2013
</div>


</body>
</html>
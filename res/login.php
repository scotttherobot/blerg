<?php
require_once("../res/Blerg.class.php");
$blerg = new Blerg();
$username = $_POST['u'];
$password = $_POST['p'];
///////
// ENABLES THE DELETE FUNCTION FOR POSTS
// NEEDS TO BE SET BY A COOKIE
// THIS IS WHERE THE LOGIN ACTUALLY HAPPENS
///////
if(isset($_POST['u'])){
	$auth = (($_POST['u'] == 'scott') && ($_POST['p'] == 'secret'));
}
if($auth){
echo('<meta http-equiv="REFRESH" content="0;url=../?auth=1">');
}
?>

<html>
<head>
<style type="text/css" media="screen">
		@import url(/res/style.css);	
</style>
<title>
shiterblog
</title>
</head>
<body>

<div id="header" onclick="location.href='/';">
<br>
<!-- this is where the site title goes -->
shiternetexplorer
</div>

<div id="nav">
<a href="/"> blog</a> |
<a href=""> projects</a> |
<a href="/about.html"> about</a> |
<a href="/contact.html"> contact</a> 
</div>

<? if($auth) echo('<!-- '); ?>

<div class="post">
<div class="title">Login</div>
<br>
<form name="newpost" action="../res/login.php" method="post">
Username: <input type="text" name="u"><br>
Password: <input type="password" name="p"><br>
<input type="submit" value="Login">
</form>
</div>

<? 
if($auth){ 
	echo('<div class="post">You are logged in. Redirecting.</div>');
}
?>

<div id="footer">
<a href="../res/login.php">login</a> | site by scott vanderlind 2013
</div>


</body>
</html>
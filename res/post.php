<?php
require_once("Blerg.class.php");
$mode = $_GET['m'];
$title = $_GET['t'];
$author = $_GET['a'];
$pre = $_GET['p'];
$bod = $_GET['b'];
$p_id = $_GET['id'];
$typ = 0;
if(isset($_GET['typ'])){
	$t = $_GET['typ'];
}

$blerg = new Blerg();

if($mode == 'init'){	
	echo("Creating tables...\n");
	$blerg->createTables();
	echo("Apparent success.");
}
if($mode == 'c' && $t == 0){
	$blerg->createPost($title, $author, $bod);
	// setup.php?m=c&t=Hello,%20World!&a=Scott&p=Test,%201,%202,%203!
	echo('Inserted Post.');
}
if($mode == 'c' && $t == 1){
	$blerg->createPage($title, $author, $bod);
	// setup.php?m=c&t=Hello,%20World!&a=Scott&p=Test,%201,%202,%203!
	echo('Inserted Page.');
}
if($mode == 'd'){
	$blerg->deletePost($p_id);
	echo('Post deleted.');
}

?>
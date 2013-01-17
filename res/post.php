<?php
require_once("Blerg.class.php");
$mode = $_GET['m'];
$title = $_GET['t'];
$author = $_GET['a'];
$pre = $_GET['p'];
$bod = $_GET['b'];
$p_id = $_GET['id'];

$blerg = new Blerg();

if($mode == 'init'){	
	echo("Creating tables...\n");
	$blerg->createTables();
	echo("Apparent success.");
}
if($mode == 'c'){
	$blerg->createPost($title, $author, $pre, $bod);
	// setup.php?m=c&t=Hello,%20World!&a=Scott&p=Test,%201,%202,%203!
	echo('Inserted.');
}
if($mode == 'd'){
	$blerg->deletePost($p_id);
	echo('Post deleted.');
}

?>
<?php
require_once("Database.class.php");

class Blerg{
	var $db;
	
	function __construct(){
		$this->db = new Database();
	}
	
	function createTables(){
		$db = $this->db;
		$sql = 
		"CREATE TABLE Posts
		(
		p_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		p_title VARCHAR(140),
		p_timestamp TIMESTAMP,
		p_author VARCHAR(140),
		p_body VARCHAR(10000),
		p_type VARCHAR(10) NOT NULL DEFAULT 'post'
		)";
		$db->query($sql);
	}
	function createUserTable(){
		$db = $this->db;
		$sql = 
		"CREATE TABLE Users
		(
		u_id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		u_name VARCHAR(140),
		u_password VARCHAR(140),
		u_session VARCHAR(140)
		)";
		$db->query($sql);
	}
	function createConfigTable(){
		$db = $this->db;
		$sql = 
		"CREATE TABLE Config
		(
		id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
		site_name VARCHAR(140)
		)";
		$db->query($sql);
	}
	
	
	// RETURNS ALL POSTS
	function returnPosts($page, $ppp){
		$offset = $page * $ppp;
		$posts = array();
		$db = $this->db;
		$sql = 
		"SELECT * FROM Posts WHERE p_type='post' ORDER BY p_id DESC LIMIT ".$ppp." OFFSET ".$offset.";";
		$db->query($sql);
		while($db->nextRecord()){
			array_push($posts, $db->Record);
		}
		return $posts;
	}
	
	// RETURNS ALL PAGES
	function returnPages(){
		$pages = array();
		$db = $this->db;
		$sql = 
		"SELECT * FROM Posts WHERE p_type='page' ORDER BY p_title ASC;";
		$db->query($sql);
		while($db->nextRecord()){
			array_push($pages, $db->Record);
		}
		return $pages;
	}
	
	// Returns the page count. Parameter is number of posts per page.
	function pageCount($ppp){
		$count = 0;
		$db = $this->db;
		$sql = "SELECT * FROM Posts WHERE p_type='post';";
		$db->query($sql);
		while($db->nextRecord()){
			$count++;
		}
		return ceil($count / $ppp);
	}
	
	// RETURNS A SPECIFIC POST
	function returnPost($p_id){
		$db = $this->db;
		$sql = 
		"SELECT * FROM Posts WHERE p_id='".$p_id."';";
		$db->query($sql);
		while($db->nextRecord()){
			return $db->Record;
		}
	}
	function returnName(){
		$db = $this->db;
		$sql = 
		"SELECT * FROM Config;";
		$db->query($sql);
		while($db->nextRecord()){
			return $db->Record['site_name'];
		}
	}
	
	function createPost($t, $a, $bod){
		$posts = array();
		$db = $this->db;
		$a = $db->mysql_escape_mimic($a);
		$bod = $db->mysql_escape_mimic($bod);
		$t = $db->mysql_escape_mimic($t);
		$sql =
		"INSERT INTO 
		Posts (p_title, p_author,  p_body) 
		VALUES ('". $t ."','". $a ."','" . $bod ."');";
		$db->query($sql);
	}
	function createPage($t, $a, $bod){
		$posts = array();
		$db = $this->db;
		$a = $db->mysql_escape_mimic($a);
		$bod = $db->mysql_escape_mimic($bod);
		$sql =
		"INSERT INTO 
		Posts (p_title, p_author,  p_body, p_type) 
		VALUES ('". $t ."','". $a ."','" . $bod ."','page');";
		$db->query($sql);
	}
	
	function deletePost($p_id){
		$db = $this->db;
		$sql =
		"DELETE FROM Posts WHERE p_id='".$p_id."';";
		$db->query($sql);
	}


}
	
	
	
?>
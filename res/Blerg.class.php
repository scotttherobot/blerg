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
		p_preview VARCHAR(1000),
		p_body VARCHAR(10000)
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
	
	// RETURNS ALL POSTS
	function returnPosts($page, $ppp){
		$offset = $page * $ppp;
		$posts = array();
		$db = $this->db;
		$sql = 
		"SELECT * FROM Posts ORDER BY p_id DESC LIMIT ".$ppp." OFFSET ".$offset.";";
		$db->query($sql);
		while($db->nextRecord()){
			array_push($posts, $db->Record);
		}
		return $posts;
	}
	
	// Returns the page count. Parameter is number of posts per page.
	function pageCount($ppp){
		$count = 0;
		$db = $this->db;
		$sql = "SELECT * FROM Posts";
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
	
	function createPost($t, $a, $pre, $bod){
		$posts = array();
		$db = $this->db;
		$sql =
		"INSERT INTO 
		Posts (p_title, p_author, p_preview, p_body) 
		VALUES ('". $t ."','". $a ."','". $pre . "','" . $bod ."');";
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
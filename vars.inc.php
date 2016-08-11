<?php
ob_start();
session_start();
error_reporting(0);

if(isset($_SERVER['HTTP_REFERER'])) {
	$prev_add = $_SERVER['HTTP_REFERER'];
}

function isLoggedIn() {
	
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
		if($_SESSION['user_id']==1){
			return 2;
		}else{
			return true;
			}
		
	} else{
		return false;
	}
}

function getInfo($data) {
	$query = "SELECT `$data` FROM `login` WHERE `id`='".$_SESSION['user_id']."'";
	if($query_r = mysql_query($query)){
	
	return mysql_result($query_r, 0, $data);
	}
}

function insert() {
	
}

?>
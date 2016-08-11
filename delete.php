<?php
require 'vars.inc.php';
require 'connect.inc.php';
include 'table.inc.php';

if(!isLoggedIn()){
	header("Location: index.php");	
}


if(!empty($_GET)){	
	$sid = htmlentities($_GET['id']);
	$query = " DELETE FROM `student` WHERE `sid` = '".$_GET['id']."'";
	$query_r = mysql_query($query);
	header("Location: index.php");
}

?>
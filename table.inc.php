<?php

require 'connect.inc.php';

function display($user){
	
	$query ="SELECT * FROM `login` WHERE `id`='$user'";
	$query_r = mysql_query($query);
	$rows = mysql_fetch_row($query_r);
	
	echo ''.$rows[3].' '.$rows[4].':';
	
	$query = "SELECT * FROM `student` WHERE `id` = '$user'";
	$query_r = mysql_query($query);
	$num = mysql_num_rows($query_r);
	
	if($num==0){
		echo 'Sorry you have no students in your project.</br>';
	}
	else{	
		echo '<table>';
		echo '<tr><th>First Name</th><th>Last Name</th><th>Roll No.</th></tr>';
		while( $row = mysql_fetch_array($query_r) ) {
			
			echo '<tr><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td>'."<td><a href=\"edit.php?id=$row[0]\">Edit</a></td>"."<td><a href=\"delete.php?id=$row[0]\" onclick=\"return confirm('Are you sure?')\">Delete</a></td>".'</tr>';
		}
		echo '</table></br></br>';
	}
}

function display_al($user){
	
	$query ="SELECT * FROM `login` WHERE `id`='$user'";
	$query_r = mysql_query($query);
	$rows = mysql_fetch_row($query_r);
	
	echo '<div><div class="name">'.$rows[3].' '.$rows[4].':&nbsp</div>';
	echo "<a id=\"add_l\" href=\"$_SERVER[PHP_SELF]?id=$rows[0]\">Add</a>".' ';
	echo "<a href=\"$_SERVER[PHP_SELF]?did=$rows[0]\" onclick=\"return confirm('Are you sure?')\">Remove Account</a></br></br>";
	
	$query = "SELECT * FROM `student` WHERE `id` = '$user'";
	$query_r = mysql_query($query);
	$num = mysql_num_rows($query_r);
	
	if($num==0){
		echo '
		Sorry you have no students in your project.</br>';
	}
	else{	
		echo '<table>';
		echo '<tr><th>First Name</th><th>Last Name</th><th>Roll No.</th></tr>';
		while( $row = mysql_fetch_array($query_r) ) {
			
			echo '<tr><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td>'."<td><a href=\"edit.php?id=$row[0]\">Edit</a></td>"."<td><a href=\"delete.php?id=$row[0]\" onclick=\"return confirm('Are you sure?')\">Delete</a></td>".'</tr>';
		}
		echo '</table></div>';
	}
}

function display_all(){
	$query="SELECT `id` FROM `login`";
	$query_r = mysql_query($query);
	$num = mysql_num_rows($query_r);
	$i=1;
	$k=array();
	while($c = mysql_fetch_array($query_r)){
		array_push($k,$c["id"]);
	}
	while($i<$num){
		display_al($k[$i]);
		$i++;
	}
	
}
?>
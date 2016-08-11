<?php
require 'vars.inc.php';
require 'connect.inc.php';
include 'table.inc.php';

if(!isLoggedIn()){
	header("Location: index.php");	
}



if(!empty($_GET)){	
	$sid = htmlentities($_GET['id']);
	$query = "SELECT * FROM `student` WHERE `sid`='$sid'";
	$query_r = mysql_query($query);
	
	$row = mysql_fetch_row($query_r);
	
	$firstname = $row[1];
	$lastname = $row[2];
	$roll = $row[3];
	
	
	if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['roll'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$roll = $_POST['roll'];
		if( !empty($firstname) && !empty($lastname) && !empty($roll)){
	
			$query="UPDATE `student` SET `firstname` = '$firstname', `lastname` = '$lastname', `roll` = '$roll' WHERE `sid` = '$sid'";
			$query_r = mysql_query($query);
			echo 'Helloo';
			header("Location: index.php");	
		}
	}
}

?>

<html>

<head>
	<title>Login or Register!</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="home.css"> 
	<link rel="stylesheet" type="text/css" href="loggedin.css"> 
</head>

<body>
	
	
	<div id="container_main">
		<div id="loggedin">Hello! <?php  echo getInfo('firstname');  ?> </br>
		<form id="add" action="" method="post" >
			<input type="text" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>"></input>
			<input type="text" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>"></input>
			<input type="text" name="roll" placeholder="Roll No." value="<?php echo $roll; ?>"></input>
			<input type="submit" value="DONE" />
		</form>
		<a href="index.php">Back</a>
		</div>
	</div>
	
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>




</html>
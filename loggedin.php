<?php
require 'vars.inc.php';
require 'connect.inc.php';
include 'table.inc.php';
$error='';
if(!isLoggedIn()){
	header("Location: index.php");	
}

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['roll'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$roll = $_POST['roll'];
	if( !empty($firstname) && !empty($lastname) && !empty($roll)){
		$query="SELECT * FROM `student` WHERE `id`='".$_SESSION['user_id']."' AND `roll` = '$roll'";
		$query_r = mysql_query($query);
		if($num = mysql_num_rows($query_r)){
			$error='Student is already enrolled';
		}
		else{
			$query = "INSERT INTO `student` VALUES('', '".$firstname."', '".$lastname."', '".$roll."', '".$_SESSION['user_id']."')";
			$query_r = mysql_query($query);
		}			
	}
}




?>

<html>
-
<head>
	<title>Login or Register!</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="home.css"> 
	<link rel="stylesheet" type="text/css" href="loggedin.css"> 
</head>

<body>
	
	
	<div id="container_main">
		<a href="index.php" style="text-decoration:none"><div id="home">Home</div></a>
		<a href="logout.php" style="text-decoration:none"><div id="logout">Logout</div></a>
		<a href="pass_reset.php" style="text-decoration:none"><div id="pass_reset">Password Reset</div></a>
		<div id="loggedin">Hello! <?php  echo getInfo('firstname');  ?> </br>
		<form id="add" action="" method="post" >
			<input type="text" name="firstname" placeholder="First Name"></input>
			<input type="text" name="lastname" placeholder="Last Name"></input>
			<input type="text" name="roll" placeholder="Roll No."></input></br></br>
			<input type="submit" value="ADD"></input>
			<div id="error"><?php echo $error; ?></div>
		</form>
		<div id="table_div"><?php display($_SESSION['user_id']);?></div>
		</div>
	</div>
	
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script src="jquery.js"></script>



</html>
<?php
require 'vars.inc.php';
require 'connect.inc.php';
include 'table.inc.php';

$error = '';

if(!isLoggedIn()){
	header("Location: index.php");	
}

if(empty($_GET['id']) ){
	$message ='Select a professor to add student.';
}
else {
	$query="SELECT * FROM `login` WHERE `id`='".$_GET['id']."'";
	$query_r = mysql_query($query);
	$row = mysql_fetch_array($query_r);
	$message = 'Student will be added to '.$row[3].' '.$row[4]; 
}


if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['roll'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$roll = $_POST['roll'];
	if( !empty($firstname) && !empty($lastname) && !empty($roll)){
		
		$query="SELECT * FROM `student` WHERE `id`='".$_GET['id']."' AND `roll` = '$roll'";
		$query_r = mysql_query($query);
		if($num = mysql_num_rows($query_r)){
			$error='Student is already enrolled under the selected professor.';
		}
		else{
			$query = "INSERT INTO `student` VALUES('', '".$firstname."', '".$lastname."', '".$roll."', '".$_GET['id']."')";
			$query_r = mysql_query($query);
		}
		
	}
}

if( isset($_GET['did']) && !empty($_GET['did']) ){
	$query = " DELETE FROM `login` WHERE `id` = '".$_GET['did']."'";
	$query_r = mysql_query($query);
	$query = " DELETE FROM `student` WHERE `id` = '".$_GET['did']."'";
	$query_r = mysql_query($query);
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
		<a href="index.php" style="text-decoration:none"><div id="home">Home</div></a>
		<a href="logout.php" style="text-decoration:none"><div id="logout">Logout</div></a>
		<a href="pass_reset.php" style="text-decoration:none"><div id="pass_reset">Password Reset</div></a>
		<div id="loggedin">Hello! <?php  echo getInfo('firstname');  ?> </br>
		<div><?php echo $message; ?></div>
		<form id="add" action="" method="post" >
			<input type="text" name="firstname" placeholder="First Name"></input>
			<input type="text" name="lastname" placeholder="Last Name"></input>
			<input type="text" name="roll" placeholder="Roll No."></input></br></br>
			<input id="add_b" type="submit" value="ADD"></input>
			<div id="error"><?php echo $error; ?></div>
		</form>
		<div id="table_div"><?php display_all();?></div>
		</div>
	</div>
	
</body>

<script src="jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){
    $(".name").click(function(){
        $(this).siblings("table").toggle();
    });
});
</script>



</html>
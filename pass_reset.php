<?php
require 'vars.inc.php';
require 'connect.inc.php';

if(!isLoggedIn()){
	header("Location: index.php");	
}

$error = '';

if( isset($_POST['current']) && isset($_POST['new']) && isset($_POST['new_again'])){
	$current = $_POST['current'];
	$new = $_POST['new'];
	$new_again = $_POST['new_again'];
	
	if( !empty($current) && !empty($new) && !empty($new_again)){
		
		$query = "SELECT `password` FROM `login` WHERE `id` = '".$_SESSION['user_id']."'";
		$query_r = mysql_query($query);
		$password_r = mysql_result($query_r, 0, 'password');
		
		if($current != $password_r){
			$error = 'Entered password is incorrect';
		}
		else if($new != $new_again){
			$error = 'Passwords don\'t match.';
		}
		else {
			$query = "UPDATE login SET `password` = '$new' WHERE `id` = '".$_SESSION['user_id']."'";
			$query_r = mysql_query($query);
			header("Location: index.php");
		}
		
		
	}else{
		$error = 'All fields are required.';
	}
} 

?>

<html>

<head>
	<title>Login or Register!</title>
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="home.css"> 
</head>

<body>
	
	
	<div id="container_main">
			<a href="index.php" style="text-decoration:none"><div id="home">Home</div></a>
		<a href="logout.php" style="text-decoration:none"><div id="logout">Logout</div></a>
			<form action="" method="post">
				<input type="password" name="current" placeholder="Current Password"></input>
				<input type="password" name="new" placeholder="New Password"></input>
				<input type="password" name="new_again" placeholder="New Password Again"></input>
				
			
			<div id="button">
				<input type="submit" value="Reset"></input>
			</div>
			</form>
			<div id="error"><?php echo $error; ?></div>
		</div>
		
	</div>
	</div>

	
</body>

</html>
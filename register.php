<?php
require 'vars.inc.php';
require 'connect.inc.php';

if(isLoggedIn()){
	header("Location: index.php");	
}



$error = '';
$firstname ='';
$lastname ='';
$city = '';
$username = '';
$email ='';

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordagain'])){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$date = $_POST['date'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordagain = $_POST['passwordagain'];
		
		
	if(!empty($_POST['firstname']) && !empty($date) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstname']) ){
		
		$query = "SELECT `id` FROM `login` WHERE `username` = '$username' || `email` = '$email'";
		$query_r = mysql_query($query);
		$query_row = mysql_num_rows($query_r);
		
		if( $password!= $passwordagain ) {
			$error = 'Password don\'t match.';
		}
		else if($query_row==1) {
			$error = 'Username/E-mail already registered.';
		}
		else {
			$query = "INSERT INTO `login` VALUES('','".$username."','".$password."','".$firstname."','".$lastname."','".$email."','".$city."','".$date."')";
			if($query_r = mysql_query($query)){
				header("Location: index.php?success=y");
			}
			else {
				$error = 'Sorry we are unable to register you right now. Please try again later. ';
			}
		}
		
	}
	else {
		$error = '*marked fields are mandatory';
	}	
}



?>

<html>

<head>
	<title>Login or Register!</title>
	<link rel="stylesheet" type="text/css" href="home.css"> 
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="register.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

</head>

<body>
	
	<div id="container_main">
		<a href="index.php" style="text-decoration:none"><div id="home">Home</div></a>
		<div id="login_form">
			
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
				First Name:<span>*</span> </br> <input type="text" name="firstname" id="firstname" placeholder="First name." value="<?php echo $firstname; ?>"></input> </br></br>
				Lastname:<span>*</span> </br> <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="<?php echo $lastname; ?>"></input></br></br>
				E-mail:<span>*</span> </br> <input type="email" name="email" placeholder="E-mail address" value="<?php echo $email; ?>"></input></br></br>
				City: </br> <input type="text" name="city" placeholder="City" value="<?php echo $city; ?>"></input></br></br>
				DOB:<span>*</span> </br>  <input id="datepicker" name="date" /></br></br>
				Username:<span>*</span> </br> <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" ></input></br></br>
				Password:<span>*</span> </br> <input id="pass" type="password" name="password" placeholder="Password"></input></br></br>
				Password again:<span>*</span> <div id="error_j"></div> </br> <input id="passa" type="password" name="passwordagain" placeholder="Again Password"></input></br>
				<div id="error_j"></div>
			<div id="button">
			<input type="submit" value="Register"></input> <div id="error"><?php echo $error;?></div>
		</div>
		
		<div id="signup">
			Already a user <a href="index.php">Login</a> here.
		</div>
		</form>
	</div>
	</div>
	
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <script>
	$(document).ready(function() {
		$("#datepicker").datepicker();
	});
	
	$("#passa").focusout(function (){
		if( $("#pass").val() != $("#passa").val()){
			$("#error_j").html("Passwords dont match.");
		}
	});
  </script>

</html>

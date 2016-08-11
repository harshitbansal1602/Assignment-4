<?php
require 'vars.inc.php';
require 'connect.inc.php';

if(isLoggedIn()===2){
	header("Location: loggedin_admin.php");		
}
else if(isLoggedIn()){
	header("Location: loggedin.php?id=".$_SESSION['user_id']."");	
}
else {
	include 'login.inc.php';

}

$register = '';

if(!empty($_GET) && $_GET['success'] == 'y'){ $register = 'Congratulations you have successfully registered.'; }


?>


<html>

<head>
	<title>Login or Register!</title>
	<link rel="icon" href="favicon.jpg" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="home.css"> 
</head>

<body>
	<div id="header">
	Hello! Welcome to my site. You can either login or signup. 
	</div>
	
	<div id="container_main">
		<div id="register"><?php echo $register; ?></div>
		<div id="login_form">
			
			<form action="" method="post">
				<input type="text" name="username" placeholder="Username/E-mail" value="<?php if( isset($_POST['username']) ){ echo $_POST['username']; } ?>"></input>
				<input type="password" name="password" placeholder="Password"></input>
				
			
		<div id="button">
			<input type="submit" value="Login"></input>
		</div>
		</form>
		<div id="error"><?php echo $error; ?></div>
		</div>
		
		
		
		<div id="signup">
		New user <a href="register.php">Signup</a> here.
		</div>
	</div>
	
</body>

</html>
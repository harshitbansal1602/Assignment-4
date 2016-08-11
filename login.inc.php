<?php
$error = '';
if(isset($_POST['username'])&& isset($_POST['password'])){
	
	$username = ($_POST['username']);
	$password = ($_POST['password']);
	
	if(!empty($username) && !empty($password)){
		
		$query = "SELECT `id` FROM `login` WHERE `username` = '$username' || `email` = '$username' AND `password` = '$password'";
		
		if($query_r = mysql_query($query)){
			$query_rows = mysql_num_rows($query_r);
			
			if($query_rows == 0){
				$error = 'Invalid Username/Password.';
			} 
			else {
				$user_id = mysql_result($query_r, 0, 'id');
				$_SESSION['user_id'] = $user_id;
				header('Location: index.php');
			}
			
		}		
	}
	else {
		$error = 'Enter username and password.';
	}
}
?>


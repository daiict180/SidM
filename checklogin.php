<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>


<?php

if(isset($_POST['submit'])){
	if (empty($_POST['uname']) || empty($_POST['pwd'])) {
		$error = "Username or Password is invalid";
		//echo "not set";
	}
	else{
		
		$username = $_POST['uname']; 
		$password = $_POST['pwd']; 
		echo "set";
		
		$query = mysqli_query($connection,"SELECT * from users where Password='$password' AND Email='$username'");
		if($query == FALSE){
			$error = "Username or Password is invalid";
			echo $error;
			echo mysqli_error($connection);
			die(mysql_error());
		}
		
		$rows = mysqli_num_rows($query);
		
			if ($rows != 1) {
				$error = "Username or Password is invalid";
				echo $error;
			} else {
				$_SESSION['login_user'] = $username; // Initializing Session
				echo "Logged in";
				redirect_to("profile.php"); // Redirecting To Other Page
			}
			
		
		}
}

?>


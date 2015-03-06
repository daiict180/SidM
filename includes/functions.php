<?php
	
	function mysql_prep($value, $connection)
	{
		$magic_quote_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysqli_real_escape_string");
		if($new_enough_php)
		{
			if($magic_quote_active)
			{
				$value = stripslashes($value);
			}
			$value = mysqli_real_escape_string($connection, $value);
		}
		else
		{
			if(!$magic_quote_active)
			{
				$value=addslashes($value);
			}
		}
		return $value;
	}
	
	//function to redirect to a page
	function redirect_to($url, $permanent = false) {
	if($permanent) {
		header('HTTP/1.1 301 Moved Permanently');
	}
	header('Location: '.$url);
	exit();
	}
	
	// This file is place to store all basic functions
	function confirm_query($result_set)
	{
		if(!$result_set)
		{
			die("Database query failed ".mysql_error());
		}
	}
	
	function getbranchbyid($id, $connection){
		$query = mysqli_query($connection,"SELECT Branch FROM users WHERE Email='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}

	function getdesignationbyid($id, $connection){
		$query = mysqli_query($connection,"SELECT Role FROM users WHERE Email='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}
	
	function getnamebyid($id, $connection){
		$query = mysqli_query($connection,"SELECT fullname FROM users WHERE Email='$id'");
		if($query == FALSE){
			$error = "Invalid ID";
			echo $error;
		}
		
		$result = mysqli_fetch_array($query);
		
			return $result[0];		
	}
	
?>
<?php
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

	
?>
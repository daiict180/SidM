<?php require("constants.php"); ?>
<?php
	// Creating a database connection
	//$conn = new mysqli($servername, $username, $password);
	$connection= mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
	if(!$connection)
	{
		die("database connection failed ".mysql_error());
	}

	// Selecting a database to use
	$db_select=mysqli_select_db($connection,DB_NAME);
	if(!$db_select)
	{
		die("Database connection failed ".mysql_error());
	}
?>
<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>
<?php include("includes/toggle.php"); ?>

<?php
	$query = mysqli_query($connection, "SELECT * FROM machines");
	$rows = mysqli_num_rows($query);
	for($i = 0 ; $i<$rows; $i++){
		$result = mysqli_fetch_array($query);
		echo nl2br($result[0] . " " . $result[1] . " " . $result[2] . " " . $result[3] . "\n");
	}
?>

<?php include("includes/footer.php"); ?>
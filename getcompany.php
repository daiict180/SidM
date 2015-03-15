<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<!DOCTYPE html>
<html lang="en">
<body>
<?php $comp = $_GET['q']; ?>

<select class="form-control" id="OpportunityForm" name="lead" required>
	<?php
		$query = mysqli_query($connection, "SELECT datetime FROM leads WHERE customer='$comp'");
		$rows = 10;
		if($query != false)
			$rows = mysqli_num_rows($query);
		for($i = 0; $i < $rows ; $i++){
			$result = mysqli_fetch_array($query);
	?>
		<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
	<?php } ?>
</select>
</body>
</html>
<?php require_once("includes/footer.php"); ?>
<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<!DOCTYPE html>
<html lang="en">
<body>
<?php $comp = $_GET['q']; ?>

<div id="targetid">
	<div class="form-group ">
        <label for="clead" class="control-label col-lg-3">Lead</label>
        <div class="col-lg-6">
            <select class="form-control" name="lead" id="lead" required>
                <?php
					$query = mysqli_query($connection, "SELECT datetime FROM leads WHERE customer='$comp'");
					$rows = mysqli_num_rows($query);
					for($i = 0; $i < $rows ; $i++){
						$result = mysqli_fetch_array($query);
				?>
                	<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
            	<?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group ">
        <label for="copp" class="control-label col-lg-3">Opportunity</label>
        <div class="col-lg-6">
            <select class="form-control" id="opportunity" name="opportunity" required>
                <?php
					$query = mysqli_query($connection, "SELECT opportunityname FROM opportunities WHERE customer='$comp'");
					$rows = mysqli_num_rows($query);
					for($i = 0; $i < $rows ; $i++){
						$result = mysqli_fetch_array($query);
				?>
                	<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
            	<?php } ?>
            </select>
        </div>
    </div>
</div>
</body>
</html>
<?php require_once("includes/footer.php"); ?>
<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

$days = $_GET['days'];

$query = mysqli_query($connection, "SELECT DISTINCT lead FROM calls WHERE 'calldate' >= DATE_SUB(CURDATE(), INTERVAL $days DAY)");
$result = mysqli_num_rows($query);
$query2 = mysqli_query($connection, "SELECT DISTINCT opportunity FROM calls WHERE 'calldate' >= DATE_SUB(CURDATE(), INTERVAL $days DAY)");
$result2 = mysqli_num_rows($query2);


?>

<div class="row" id="target">
  <div class="col-md-6">
      <div class="mini-stat clearfix" style="padding-top: 36px;">
        <span class="mini-stat-icon" style="background:blue;"><i class="fa fa-chevron-down"></i></span>
        <div class="mini-stat-info" style="margin-bottom: 27px;">
          <span><?php echo $result ; ?></span>
          Leads not contacted in last <?php echo $days ; ?> days
        </div>
    </div>
       
  </div>
  <div class="col-md-6">
      <div class="mini-stat clearfix" style="padding-top: 36px;">
        <span class="mini-stat-icon" style="background:crimson;"><i class="fa fa-chevron-down"></i></span>
        <div class="mini-stat-info" style="margin-bottom: 27px;">
          <span><?php echo $result2 ; ?></span>
          Opportunities not contacted in last <?php echo $days ; ?> days
        </div>
      </div>
      
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
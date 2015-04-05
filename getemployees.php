<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
$branch = $_GET['branch'];

?>

<select class="form-control" id="employee">
  <optgroup label="">
    <?php
        $query = mysqli_query($connection, "SELECT * FROM users WHERE branch='$branch'");
        $rows = mysqli_num_rows($query);
        for($i = 0; $i < $rows ; $i++){
            $result = mysqli_fetch_array($query);
    ?>
        <option value="<?php echo $result['userid'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
    <?php } ?>
  </optgroup>
</select>

<?php require_once("includes/footer.php"); ?>
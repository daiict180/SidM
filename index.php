<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("checklogin.php"); ?>

<html>
<body>

<form method="post" action="">
  User name: <input type="text" name="uname"><br>
  Password: <input type="password" name="pwd"><br>
  <input name="submit" type="submit" value=" Login ">
</form>

</body>
</html>

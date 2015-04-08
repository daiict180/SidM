<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<html>
<body>

<?php
session_start();
session_unset();
session_destroy();
	redirect_to("index.php"); // Redirecting To Home Page
?>

</body>
</html>

<?php require_once("includes/footer.php"); ?>
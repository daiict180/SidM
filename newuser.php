<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if($_SESSION['role']=='SAE')
    redirect_to("dashboard.php");

if(isset($_POST['submit']) && ($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH')){
	$FullName = mysql_prep($_POST['FullName'], $connection);
	$useremail = mysql_prep($_POST['useremail'], $connection);
	$password = md5(mysql_prep($_POST['password'], $connection));
	$confirmPassword = md5(mysql_prep($_POST['confirmPassword'], $connection));
	$umobile = mysql_prep($_POST['umobile'], $connection);
	$active = mysql_prep($_POST['active'], $connection);
	$role = mysql_prep($_POST['role'], $connection);
	$branch = mysql_prep($_POST['branch'], $connection);
    $target_path = "images/default_pic.jpg";
	
	if($password == $confirmPassword && $_SESSION['role']!='BRH')
		$query = mysqli_query($connection, "INSERT INTO users VALUES ('','$FullName', '$useremail', '$umobile', '$role', '$active', '$password', '$branch', '$target_path')");
	if($password == $confirmPassword && $_SESSION['role']=='BRH' && getbranchbyid($_SESSION['user'],$connection)==$branch)
        $query = mysqli_query($connection, "INSERT INTO users VALUES ('','$FullName', '$useremail', '$umobile', '$role', '$active', '$password', '$branch', '$target_path')");

}

?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sidharth Machinaries">
    <link rel="shortcut icon" href="images/favicon.html">
    <title>Users</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4><b>Add User</b></h4>
                            
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" action="#">
                                    <div class="form-group ">
                                        <label for="UserName" class="control-label col-lg-3">Full Name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="UserName" type="text" name="FullName" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="uemail" class="control-label col-lg-3">Email-Id</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="uemail" type="email" name="useremail" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="pass" class="control-label col-lg-3">Password</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="pass" type="password" name="password" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cpass" class="control-label col-lg-3">Confirm Password</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="cpass" type="password" name="confirmPassword" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="umobile" class="control-label col-lg-3">Mobile</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="umobile" type="text" name="umobile"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="uactive" class="control-label col-lg-3">Active</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="uactive" name="active" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="urole" class="control-label col-lg-3">Role</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="urole" name="role" required>
                                            <?php if($_SESSION['role'] == 'BRH'){ ?>
                                            <option value="SAE">SAE</option>
                                            <?php } else { ?>
                                                <option value="SAE">SAE</option>
                                                <option value="BRH">BRH</option>
                                                <option value="COH">COH</option>
                                                <option value="ADM">ADM</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ubranch" class="control-label col-lg-3">Branch</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="ubranch" name="branch" required>
                                                <?php
                                                    $exec = "SELECT branchname FROM branches ";
                                                    if($_SESSION['role']=='BRH'){
                                                        $br = getbranchbyid($_SESSION['user'],$connection);
                                                        $exec = $exec."WHERE branchname='$br'";
                                                    }
													$query = mysqli_query($connection, $exec);
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"><?php echo $result[0] ; ?></option>
                                            	<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                            <a href="users.php"><button class="btn btn-default" type="button">Cancel</button><a/>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="js/jquery.js"></script>
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
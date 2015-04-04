<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if($_SESSION['role'] == 'SAE'){
    redirect_to("dashboard.php");
}

if(isset($_POST['submit']) && ($_SESSION['role'] == 'BRH'||$_SESSION['role'] == 'ADM'||$_SESSION['role'] == 'COH')){
	$company = mysql_prep($_POST['company'], $connection);
	$user = mysql_prep($_POST['user'], $connection);
	$status = mysql_prep($_POST['status'], $connection);
	$branch = mysql_prep($_POST['branch'], $connection);
	$source = mysql_prep($_POST['source'], $connection);
	$mremarks = mysql_prep($_POST['mremarks'], $connection);
    $by = $_SESSION['user'];

    if($_SESSION['role'] == 'BRH' && getbranchbyid($_SESSION['user'], $connection)==$branch)
	   $query = mysqli_query($connection, "INSERT INTO leads VALUES ('','$company', '$user', '$status', '$branch', '$source', '$mremarks', now(), '$by')");
    if($_SESSION['role'] == 'COH' || $_SESSION['role'] == 'ADM')
        $query = mysqli_query($connection, "INSERT INTO leads VALUES ('','$company', '$user', '$status', '$branch', '$source', '$mremarks', now(), '$by')");
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
    <title>Leads</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- main section end -->

    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    
    <link href="css/style-responsive.css" rel="stylesheet"/>
</head>
<?php include("includes/sidebar.php"); ?>
    </div>
</aside>
<!--sidebar end-->
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4><b>Add Lead</b></h4>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" action="#">
                                    <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="company" id="contactCompany" required>
                                                <?php
													$exec = "SELECT * FROM companies ";
                                                    if($_SESSION['role'] == 'BRH'){
                                                        $branch = getbranchbyid($_SESSION['user'], $connection);
                                                        $exec = $exec."WHERE branch='$branch'";
                                                    }
                                                    $query = mysqli_query($connection, $exec);
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"> <?php echo $result[1] ; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="assigned" class="control-label col-lg-3">Assigned To</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="assigned" name="user" required>
                                                <?php
													$exec = "SELECT * FROM users ";
                                                    if($_SESSION['role'] == 'BRH'){
                                                        $branch = getbranchbyid($_SESSION['user'], $connection);
                                                        $exec = $exec."WHERE branch='$branch'";
                                                    }
                                                    $query = mysqli_query($connection, $exec);
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result['userid'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="status" class="control-label col-lg-3">Status</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="status" name="status" required>
                                                <option value="New">New</option>
                                                <option value="Active">Active</option>
                                                <option value="Closed">Closed</option>
                                                <option value="Converted">Converted</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="branch" class="control-label col-lg-3">Branch</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="branch" name="branch" required>
                                                <?php
													$exec = "SELECT branchname FROM branches ";
                                                    if($_SESSION['role'] == 'BRH'){
                                                        $branch = getbranchbyid($_SESSION['user'], $connection);
                                                        $exec = $exec."WHERE branchname='$branch'";
                                                    }
                                                    $query = mysqli_query($connection, $exec);
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"> <?php echo $result[0] ; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lsource" class="control-label col-lg-3">Source</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="lsource" name="source" required>
                                                <?php
													$query = mysqli_query($connection, "SELECT value FROM sources");
													$rows = mysqli_num_rows($query);
													for($i = 0; $i < $rows ; $i++){
														$result = mysqli_fetch_array($query);
												?>
                                                	<option value="<?php echo $result[0] ; ?>"> <?php echo $result[0] ; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mremarks" class="control-label col-lg-3">Remarks</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="mremarks" name="mremarks"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                            <a href="leads.php"><button class="btn btn-default" type="button">Cancel</button></a>
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
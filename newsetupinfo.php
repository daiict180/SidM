<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if($_SESSION['role'] == 'SAE')
    redirect_to("dashboard.php");

if(isset($_POST['submit']) && $_SESSION['role'] != 'SAE'){
	$company = mysql_prep($_POST['company'], $connection);
	$manufacturer = mysql_prep($_POST['manufacturer'], $connection);
	$place = mysql_prep($_POST['place'], $connection);
	$date = mysql_prep($_POST['date'], $connection);
	$machine = mysql_prep($_POST['machine'], $connection);
	$model = mysql_prep($_POST['model'], $connection);
	$size = mysql_prep($_POST['size'], $connection);
	$head = mysql_prep($_POST['head'], $connection);
	$mnumber = mysql_prep($_POST['mnumber'], $connection);
	$warranty = mysql_prep($_POST['warranty'], $connection);
	$ink = mysql_prep($_POST['ink'], $connection);
	$software = mysql_prep($_POST['software'], $connection);
	$mremarks = mysql_prep($_POST['mremarks'], $connection);
	$branch = getbranchbyid($_SESSION['user'], $connection);
		
	$query = mysqli_query($connection, "INSERT INTO setupinformation VALUES ('','$company', '$manufacturer', STR_TO_DATE('$date', '%m-%d-%Y'), '$place', '$machine', '$model', '$size', '$head', '$mnumber', '$warranty', '$ink', '$software', '$mremarks', '$branch')");	
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
    <title>Setup Information</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" type="text/css" href="js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="js/bootstrap-datetimepicker/css/datetimepicker.css" />

    <link rel="stylesheet" type="text/css" href="js/jquery-multi-select/css/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="js/jquery-tags-input/jquery.tagsinput.css" />

    <link rel="stylesheet" type="text/css" href="js/select2/select2.css" />
    <link href="css/style1.css" rel="stylesheet">
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
                            <h4><b>Add Setup Information</b></h4>
                            
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal " id="commentForm" method="post" action="#">
                                    <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="company"  id="contactCompany" required>
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
                                        <label for="manufacturer" class="control-label col-lg-3">Manufacturer</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="manufacturer" type="text" name="manufacturer" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="place" class="control-label col-lg-3">Place</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="place" type="text" name="place" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Installation Date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker"  size="16" type="text" name="date" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mname" class="control-label col-lg-3">Machine Name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mname" type="text" name="machine" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mmodel" class="control-label col-lg-3">Model</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mmodel" type="text" name="model"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="msize" class="control-label col-lg-3">Size</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="msize" type="text" name="size"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mhead" class="control-label col-lg-3">Head</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mhead" type="text" name="head"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mno" class="control-label col-lg-3">Machine Number</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mno" type="text" name="mnumber"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="warranty" class="control-label col-lg-3">Warranty Status</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="warranty" type="text" name="warranty"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mink" class="control-label col-lg-3">Ink</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mink" type="text" name="ink"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="msoftware" class="control-label col-lg-3">Software</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="msoftware" type="text" name="software"/>
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
                                            <a href="setupinfo.php"><button class="btn btn-default" type="button">Cancel</button></a>
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
<script src="js/jquery-1.8.3.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>

<script src="js/bootstrap-switch.js"></script>

<script type="text/javascript" src="js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<script src="js/toggle-init.js"></script>

<script src="js/advanced-form.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
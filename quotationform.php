<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['oppid']) && isset($_GET['mnumber']) && $_GET['oppid']!="" && $_GET['mnumber']!=""){
	$oppid = $_GET['oppid'];
	$mnumber = $_GET['mnumber'];
    $query = mysqli_query($connection, "SELECT customer FROM opportunities WHERE opportunityid='$oppid'");
	$result = mysqli_fetch_array($query);
}
else{
	redirect_to("opportunities.php");
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
    <title>Quotation</title>
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
                            <h4><b>Add Quotation Information</b></h4>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="cmxform form-horizontal" target="_blank" id="commentForm" method="post" action="quotation_print.php">
                                    <div class="form-group ">
                                        <label for="qCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="qcompany" type="text" name="qcompany" readonly="readonly" value=<?php echo $result[0]; ?> placeholder=<?php echo $result[0]; ?>>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="mNumber" class="control-label col-lg-3">Number of machines</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="mnumber" type="text" name="mnumber" readonly="readonly" value=<?php echo $mnumber; ?> placeholder=<?php echo $mnumber; ?>>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="control-label col-md-3">Quotation Date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" name="date"  size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
									<?php for($i = 0 ; $i < $mnumber ; $i++){ ?>
                                    <div class="form-group ">
                                        <label for="machine1" class="control-label col-lg-3">Name of Machine <?php echo $i+1 ; ?></label>
                                        <div class="col-lg-6">
											<select class="form-control" id="machine1" name="machine<?php echo $i+1 ; ?>" required>
                                                <?php
													$query = mysqli_query($connection, "SELECT machinename FROM machines");
													$rows = mysqli_num_rows($query);
													for($j = 0; $j < $rows ; $j++){
														$result = mysqli_fetch_array($query);
												?>
												<option value="<?php echo $result[0]; ?>"><?php echo $result[0]; ?></option>
												<?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="price1" class="control-label col-lg-3">Price of Machine <?php echo $i+1 ; ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="price1" type="number" name="price<?php echo $i+1 ; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="quantity1" class="control-label col-lg-3">Quantity of Machine <?php echo $i+1 ; ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="quantity1" type="number" name="quantity<?php echo $i+1 ; ?>" />
                                        </div>
                                    </div>
									<?php } ?>
                                    <div class="form-group ">
                                        <label for="discount" class="control-label col-lg-3">Discount Percentage</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="discount" type="text" name="discount" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="tax" class="control-label col-lg-3">Tax Percentage</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="tax" type="text" name="tax" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
											
                                            <button class="btn btn-primary" name="submit" type="submit"><i class="fa fa-download"></i> Download PDF</button>
                                            <button class="btn btn-default" type="button">Cancel</button>
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
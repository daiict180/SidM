<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if($_SESSION['role'] == 'SAE')
    redirect_to("dashboard.php");
if(isset($_POST['submit']) && ($_SESSION['role'] == 'COH'||$_SESSION['role'] == 'ADM'||$_SESSION['role'] == 'BRH')){
    $oppname = mysql_prep($_POST['oppName'], $connection);
    $company = mysql_prep($_POST['company'], $connection);
    $lead = mysql_prep($_POST['lead'], $connection);
    $crdate = mysql_prep($_POST['crdate'], $connection);
    $user = mysql_prep($_POST['user'], $connection);
    $assignedto = mysql_prep($_POST['assignedto'], $connection);
    $status = mysql_prep($_POST['status'], $connection);
    $stage = mysql_prep($_POST['stage'], $connection);
    $source = mysql_prep($_POST['source'], $connection);
    $amount = intval($_POST['amount']);
    $interest = mysql_prep($_POST['interest'], $connection);
    $cdate = mysql_prep($_POST['cdate'], $connection);
    $oremarks = mysql_prep($_POST['oremarks'], $connection);
    $branch = getbranchbyid($assignedto, $connection);
    $query = mysqli_query($connection, "INSERT INTO opportunities VALUES ('','$oppname', '$company', '$lead', '$branch', STR_TO_DATE('$crdate', '%m-%d-%Y'), '$user', '$assignedto', '$status', '$stage', '$source', $amount, '$interest', STR_TO_DATE('$cdate', '%m-%d-%Y'), '$oremarks')");   
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
    <title>Opportunities</title>
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
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <script>
        function show(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else { 
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("targetDiv").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","getcompany.php?q="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<?php include("includes/sidebar.php"); ?><!-- <div id = "OpportunityForm"> -->
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h4><b>Add Opportunity</b></h4>
                        </header>
                        <div class="panel-body">
                            <div class=" form" >
                                <form class="cmxform form-horizontal " id = "Opportunity" method="post" action="#">
                                    <div class="form-group ">
                                        <label for="oppName" class="control-label col-lg-3">Opportunity Name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="oppName" type="text" name="oppName" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                             <select class="form-control" id="contactCompany" name="company" onchange="show(this.value)" required>
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
                                                        if($i == 0)
                                                            $req_company = $result[0];
                                                ?>
                                                    <option value="<?php echo $result[0] ; ?>"> <?php echo $result[1] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="OpportunityForm" class="control-label col-lg-3">Lead</label>
                                        <div class="col-lg-6" id = "targetDiv">
                                            <select class="form-control" id="OpportunityForm" name="lead" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM leads WHERE customer='$req_company'");
                                                    $rows = 0;
                                                    if($query != false)
                                                       $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result[0] ; ?>"><?php echo $result[7] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Creation Date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" name="crdate" size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="suser" class="control-label col-lg-3">Sourced By</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="user" id="suser" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM users");
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
                                        <label for="suser" class="control-label col-lg-3">Assigned To</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="assignedto" id="assignedto" required>
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
                                        <label for="oppstatus" class="control-label col-lg-3">Status</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="status" id="oppstatus" required>
                                                <option value="Initial">Initial</option>
                                                <option value="Quoted">Quoted</option>
                                                <option value="Negotiation">Negotiation</option>
                                                <option value="Order Received">Order Received</option>
                                                <option value="Order Lost">Order Lost</option>
                                                <option value="Dead">Dead</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oppstage" class="control-label col-lg-3">Stage</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="oppstage" name="stage" required>
                                                <option value="Hot">Hot</option>
                                                <option value="Warm">Warm</option>
                                                <option value="Cold">Cold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lsource" class="control-label col-lg-3">Source</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="source"  id="lsource" required>
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
                                        <label for="amt" class="control-label col-lg-3">Total Amount</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="amt" type="number" name="amount" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="poi" class="control-label col-lg-3">Product of Interest</label>
                                        <div class="col-lg-6">
                                            <select class="form-control"  id="poi" name="interest" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM machines");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0 ;$i <$rows ; $i++){
                                                      $result = mysqli_fetch_array($query);
                                                  ?>
                                                    <option value="<?php echo $result[1]; ?>"><?php echo $result[1]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Approx. Closing date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" name="cdate" size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oremarks" class="control-label col-lg-3">Remarks</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="oremarks" name="oremarks"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit" name="submit">Save</button>
                                            <a href="opportunities.php"><button class="btn btn-default" type="button">Cancel</button></a>
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
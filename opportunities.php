<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['oid'])){
	$oid = $_GET['oid'];
    $query = mysqli_query($connection, "DELETE FROM opportunities WHERE opportunityid='$oid'");
}

?>

<?php

if(isset($_POST['editsubmit'])){
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
    $branch = getbranchbyid($assignedto , $connection);
    $oppid = intval($_POST['oppid']);

    $prequery = mysqli_query($connection, "DELETE FROM opportunities WHERE opportunityid='$oppid'");
    $query = mysqli_query($connection, "INSERT INTO opportunities VALUES ('','$oppname', '$company', '$lead', '$branch', STR_TO_DATE('$crdate', '%Y-%m-%d'), '$user', '$assignedto', '$status', '$stage', '$source', $amount, '$interest', STR_TO_DATE('$cdate', '%Y-%m-%d'), '$oremarks')");

}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Opportunities</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
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

    <!--dynamic table-->
    <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <script type="text/javascript">
        function populateForm(id) {
            var values = [];
            for(var i = 0; i < 15; i++) {
                values[i] = document.getElementById("row"+id).cells[i].innerHTML; 
            }

            document.getElementById("oppid").value = id;
            document.getElementById("oppName").value = values[0];
            document.getElementById("contactCompany").value = values[1];
            document.getElementById("crdate").value = values[3];
            document.getElementById("assignedto").value = values[14];
            document.getElementById("status").value = values[5];
            document.getElementById("cdate").value = values[6];
            document.getElementById("lead").value = values[7];
            document.getElementById("user").value = values[8];
            document.getElementById("stage").value = values[9];
            document.getElementById("source").value = values[10];
            document.getElementById("amount").value = values[11];
            document.getElementById("interest").value = values[12];
            document.getElementById("oremarks").value = values[13];
            
            
        } 
    </script>
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
                        document.getElementById("lead").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","getcompany.php?q="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="dashboard.php" class="logo">
        <img src="images/logo1.png" alt="">
    </a>
    <div class="sidebar-toggle-box">
        <!--<i class="fa fa-angle-left fa-2x" style="margin-left:9px; margin-top:3px"></i> -->
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/avatar1_small.jpg">
                <span class="username"><?php echo getnamebyid($_SESSION['user'], $connection) ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class="fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
                <li><a href="logout.php"><i class="fa fa-key"></i>Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="companies.php">
                        <i class="fa fa-university"></i>
                        <span>Companies</span>
                    </a>
                </li>
                <li>
                    <a href="companycontacts.php">
                        <i class="fa fa-info"></i>
                        <span>Company Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="setupinfo.php">
                        <i class="fa fa-cog"></i>
                        <span>Setup Information</span>
                    </a>
                </li>
                <li>
                    <a href="leads.php">
                        <i class="fa fa-magnet"></i>
                        <span>Leads</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="opportunities.php">
                        <i class="fa fa-level-up"></i>
                        <span>Opportunities</span>
                    </a>
                </li>
                <li>
                    <a href="calls.php">
                        <i class="fa fa-mobile"></i>
                        <span>Calls</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-bar-chart"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub">
                        <li><a href="general.html">Monthly Sales</a></li>
                        <li><a href="buttons.html">Open Opportunities</a></li>
                        <li><a href="widget.html">Upcoming calls</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Masters</span>
                    </a>
                    <ul class="sub">
                        <li><a href="machines.php">Machines</a></li>
                        <li><a href="users.php">Users</a></li>
                        <li><a href="segments.php">Segments</a></li>
                        <li><a href="branches.php">Branches</a></li>
                        <li><a href="sources.php">Sources</a></li>
                        <li><a href="callmodes.php">Call Modes</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Utilities</span>
                    </a>
                    <ul class="sub">
                        <li><a href="basic_table.html">Group Email/Labels</a></li>
                    </ul>
                </li>
            </ul>            
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!--sidebar end-->
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Opportunities
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="btn-group">
					<a href="newopportunity.php">
                        <button id="editable-sample_new" class="btn btn-primary">
                            Add New Opportunity <i class="fa fa-plus"></i>
                        </button>
                    </a>
					</div>
                    <br><br>
                    <div class="text-left">
                            <a href="#myModal" data-toggle="modal" class="btn btn-success">
                                Generate Quotation
                            </a>
					</div>
					<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Generate Quotation</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="get" action="quotationform.php">
                                            <div class="form-group">
                                                <label for="OpportunityNames">Select Opportunity Name for which Quotation is to be generated</label>
                                                <select class="form-control" id="OpportunityNames" name="oppid" required>
                                                    <?php
														$query = mysqli_query($connection, "SELECT * FROM opportunities");
														$rows = mysqli_num_rows($query);
														for($i = 0; $i < $rows ; $i++){
															$result = mysqli_fetch_array($query);
													?>
													<option value="<?php echo $result[0] ; ?>"><?php echo $result[1] ; ?></option>
                                                <?php } ?>
												</select>
                                            </div>
                                            <div class="form-group">
                                                <label for="machineNos">Number of machines</label>
                                                <input type="number" class="form-control" id="machineNos" name="mnumber" placeholder="Enter the number of machines">
                                            </div>
                                            <button type="submit" name="editsubmit" class="btn btn-default">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Opportunity Name</th> 
                        <th>Company</th>
                        <th>Branch</th>
                        <th>Creation Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Closing Date</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						$query = mysqli_query($connection, "SELECT * FROM opportunities");
						$rows = mysqli_num_rows($query);
						for($i=0 ; $i<$rows ; $i++){
							$result = mysqli_fetch_array($query);
					?>
                    <tr class="gradeX" id="<?php echo 'row'.$result[0]; ?>">
                        <td><?php echo $result[1]; ?></td>
                        <td><?php echo $result[2]; ?></td>
                        <td><?php echo $result[4]; ?></td>
                        <td><?php echo $result[5]; ?></td>
                        <td><?php echo getnamebyid($result[7], $connection); ?></td>
                        <td><?php echo $result[8]; ?></td>
                        <td><?php echo $result[13]; ?></td>
                        <td hidden><?php echo $result[3]; ?></td>
                        <td hidden><?php echo $result[6]; ?></td>
                        <td hidden><?php echo $result[9]; ?></td>
                        <td hidden><?php echo $result[10]; ?></td>
                        <td hidden><?php echo $result[11]; ?></td>
                        <td hidden><?php echo $result[12]; ?></td>
                        <td hidden><?php echo $result[14]; ?></td>
                        <td hidden><?php echo $result[7]; ?></td>
                        <td><a class="edit" href="#myModal-1" data-toggle="modal" id = "<?php echo $result[0]; ?>" onclick="populateForm(this.id)">Edit</a></td>
                        <td><a class="delete" href="opportunities.php?oid=<?php echo $result[0] ; ?>" onclick="return confirm('Delete Opportunity?')">Delete</a></td>
                    </tr>
					<?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Opportunity Name</th> 
                        <th>Company</th>
                        <th>Branch</th>
                        <th>Creation Date</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Closing Date</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>
                    </table>
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Edit Opportunity</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal" method="post" role="form">
                                            <div class="form-group ">
                                        <label for="oppName" class="control-label col-lg-3">Opportunity Name</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="oppName" type="text" name="oppName" required/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="contactCompany" onchange="show(this.value)" name="company" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT companyname FROM companies");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                        if($i == 0)
                                                            $req_company = $result[0];
                                                ?>
                                                    <option value="<?php echo $result[0] ; ?>"> <?php echo $result[0] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="OpportunityForm" class="control-label col-lg-3">Lead</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="lead" name="lead" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT datetime FROM leads WHERE customer='$req_company'");
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
                                        <label class="control-label col-md-3">Creation Date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" name="crdate" id="crdate" size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="suser" class="control-label col-lg-3">Sourced By</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="user" name="user" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM users");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result['email'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="suser" class="control-label col-lg-3">Assigned To</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="assignedto" id="assignedto" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM users");
                                                    $rows = mysqli_num_rows($query);
                                                    for($i = 0; $i < $rows ; $i++){
                                                        $result = mysqli_fetch_array($query);
                                                ?>
                                                    <option value="<?php echo $result['email'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oppstatus" class="control-label col-lg-3">Status</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" id="status" name="status" required>
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
                                            <select class="form-control"  id="stage" name="stage" required>
                                                <option value="Hot">Hot</option>
                                                <option value="Warm">Warm</option>
                                                <option value="Cold">Cold</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lsource" class="control-label col-lg-3">Source</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="source"  id="source" required>
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
                                            <input class="form-control " id="amount" type="number" name="amount" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="poi" class="control-label col-lg-3">Product of Interest</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="interest" type="text" name="interest" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Approx. Closing date</label>
                                        <div class="col-md-6 col-xs-11">
                                            <input class="form-control form-control-inline input-medium default-date-picker" id="cdate" name="cdate"  size="16" type="text" value="" />
                                            <!-- <span class="help-block">Select date</span> -->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="oremarks" class="control-label col-lg-3">Remarks</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control " id="oremarks" name="oremarks"></textarea>
                                        </div>
                                        <div class="col-lg-3">
                                            <input class="form-control" id="oppid" type="hidden" name="oppid" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" name="editsubmit" type="submit">Save</button>
                                        </div>
                                    </div>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>
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

<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<script src="js/bootstrap-switch.js"></script>

<script type="text/javascript" src="js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>
<script src="js/toggle-init.js"></script>

<script src="js/advanced-form.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
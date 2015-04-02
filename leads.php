<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['lid'])){
	$lid = $_GET['lid'];
    $query = mysqli_query($connection, "DELETE FROM leads WHERE leadid='$lid'");
}

?>

<?php

if(isset($_POST['editsubmit'])){
    $company = mysql_prep($_POST['company'], $connection);
    $user = mysql_prep($_POST['user'], $connection);
    $status = mysql_prep($_POST['status'], $connection);
    $branch = mysql_prep($_POST['branch'], $connection);
    $source = mysql_prep($_POST['source'], $connection);
    $mremarks = mysql_prep($_POST['mremarks'], $connection);
    $leadid = intval($_POST['leadid']);
    
    $pquery = mysqli_query($connection, "SELECT createdby FROM leads WHERE leadid='$leadid'");
    $result = $mysqli_fetch_array($pquery);
    $by = $result[0];

    $prequery = mysqli_query($connection, "DELETE FROM leads WHERE leadid='$leadid'");
    $query = mysqli_query($connection, "INSERT INTO leads VALUES ('$leadid','$company', '$user', '$status', '$branch', '$source', '$mremarks', now()), '$by'");
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

    <title>Leads</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

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
            for(var i = 0; i < 9; i++) {
                values[i] = document.getElementById("row"+id).cells[i].innerHTML; 
            }
            document.getElementById("contactCompany").value = values[8];
            document.getElementById("status").value = values[1];
            document.getElementById("assignedto").value = values[7];
            document.getElementById("branch").value = values[4];
            document.getElementById("lsource").value = values[5];
            document.getElementById("mremarks").value = values[6];
            document.getElementById("leadid").value = id;

            }
        function searchRows(tblId) {
            var tbl = document.getElementById(tblId);
            var headRow = tbl.rows[1];
            var arrayOfHTxt = new Array();
            var arrayOfHtxtCellIndex = new Array();

            for (var v = 0; v < headRow.cells.length-2; v++) {
             if (headRow.cells[v].getElementsByTagName('input')[0]) {
             var Htxtbox = headRow.cells[v].getElementsByTagName('input')[0];
              if (Htxtbox.value.replace(/^\s+|\s+$/g, '') != '') {
                arrayOfHTxt.push(Htxtbox.value.replace(/^\s+|\s+$/g, ''));
                arrayOfHtxtCellIndex.push(v);
              }
             }
            }

            for (var i = 2; i < tbl.rows.length; i++) {
             
                tbl.rows[i].style.display = 'table-row';
             
                for (var v = 0; v < arrayOfHTxt.length; v++) {
             
                    var CurCell = tbl.rows[i].cells[arrayOfHtxtCellIndex[v]];
             
                    var CurCont = CurCell.innerHTML.replace(/<[^>]+>/g, "");
             
                    var reg = new RegExp(arrayOfHTxt[v] + ".*", "i");
             
                    if (CurCont.match(reg) == null) {
             
                        tbl.rows[i].style.display = 'none';
             
                    }
             
                }
             
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
                    <a class="active" href="leads.php">
                        <i class="fa fa-magnet"></i>
                        <span>Leads</span>
                    </a>
                </li>
                <li>
                    <a href="opportunities.php">
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
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Leads
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="btn-group">
					<a href="newlead.php">
                        <button id="editable-sample_new" class="btn btn-primary">
                            Add New Lead <i class="fa fa-plus"></i>
                        </button>
                    </a>
					</div>
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Creation Date</th>
                        <th>Assigned To</th>
                        <th>Branch</th>
                        <th>Source</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <thead>
                        <tr class="gradeX">
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td><input class="form-control input-sm m-bot15" type="text" style="width: 100%" onkeyup="searchRows('dynamic-table')"></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						$query = mysqli_query($connection, "SELECT * FROM leads");
						$rows = mysqli_num_rows($query);
						for($i=0 ; $i<$rows ; $i++){
							$result = mysqli_fetch_array($query);
                            $q2 = mysqli_query($connection, "SELECT companyname FROM companies WHERE companyid='$result[1]'");
                            $r2 = mysqli_fetch_array($q2);
					?>
                    <tr id="<?php echo "row".$result[0] ; ?>" class="gradeX">
                        <td><?php echo $r2[0]; ?></td>
                        <td><?php echo $result[3]; ?></td>
                        <td><?php echo $result[7]; ?></td>
                        <td><?php echo getnamebyid($result[2], $connection); ?></td>
                        <td><?php echo $result[4]; ?></td>
                        <td><?php echo $result[5]; ?></td>
                        <td hidden><?php echo $result[6]; ?></td>
                        <td hidden><?php echo $result[2]; ?></td>
                        <td hidden><?php echo $result[1]; ?></td>
                        <td><a class="edit" href="#myModal-1" data-toggle="modal"  id = "<?php echo $result[0]; ?>" onclick="populateForm(this.id)">Edit</a></td>
                        <td><a class="delete" href="leads.php?lid=<?php echo $result[0] ; ?>" onclick="return confirm('Delete Lead?')">Delete</a></td>
                    </tr>
					<?php  } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Creation Date</th>
                        <th>Assigned To</th>
                        <th>Branch</th>
                        <th>Source</th>
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
                                        <h4 class="modal-title">Edit Lead</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal" method="post" role="form">
                                            <div class="form-group ">
                                        <label for="contactCompany" class="control-label col-lg-3">Company</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="company" id="contactCompany" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT * FROM companies");
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
                                            <select class="form-control" name="user" id="assignedto" required>
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
                                        <label for="status" class="control-label col-lg-3">Status</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="status" id="status" required>
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
                                            <select class="form-control" name="branch" id="branch" required>
                                                <?php
                                                    $query = mysqli_query($connection, "SELECT branchname FROM branches");
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
                                            <select class="form-control" name="source" id="lsource" required>
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
                                        <div class="col-lg-3">
                                            <input class="form-control" id="leadid" type="hidden" name="leadid" />
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
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
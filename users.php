<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
if(isset($_GET['uid']) && ($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH')){
	$uid = $_GET['uid'];
    $prequery = mysqli_query($connection, "SELECT branch FROM users WHERE userid='$uid'");
    $result = mysqli_fetch_array($prequery);
    if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||($_SESSION['role']=='BRH'&&getbranchbyid($_SESSION['user'],$connection)==$result[0])){
    $query = mysqli_query($connection, "DELETE FROM users WHERE userid='$uid'");
    }
}

?>
<?php

if(isset($_POST['editsubmit']) && ($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH')){
    $FullName = mysql_prep($_POST['FullName'], $connection);
    $useremail = mysql_prep($_POST['useremail'], $connection);
    $umobile = mysql_prep($_POST['umobile'], $connection);
    $active = mysql_prep($_POST['active'], $connection);
    $role = mysql_prep($_POST['role'], $connection);
    $branch = mysql_prep($_POST['branch'], $connection);
    
    if($_SESSION['role']!='BRH')
        $query = mysqli_query($connection, "INSERT INTO users VALUES ('','$FullName', '$useremail', '$umobile', '$role', '$active', '', '$branch')");
    if($_SESSION['role']=='BRH' && getbranchbyid($_SESSION['user'],$connection)==$branch)
        $query = mysqli_query($connection, "INSERT INTO users VALUES ('','$FullName', '$useremail', '$umobile', '$role', '$active', '', '$branch')");

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

    <title>Users</title>

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
                        Users
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <div class="btn-group">
					<?php if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH'){ ?>
                    <a href="newuser.php">
                        <button id="editable-sample_new" class="btn btn-primary">
                            Add New User <i class="fa fa-plus"></i>
                        </button>
                    </a>
                    <?php } ?>
					</div>
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email-Id</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>Active</th>
                        <?php if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH'){ ?>
                        <th>Edit</th>
                        <th>Delete</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
					<?php
                        $exec = "SELECT * FROM users ";
                        if($_SESSION['role']=='BRH'||$_SESSION['role']=='SAE')
                            {
                                $br = getbranchbyid($_SESSION['user'],$connection);
                                $exec = $exec."WHERE branch='$br'";
                            }
						$query = mysqli_query($connection, $exec);
                        $rows = 0;
                        if($query!=false){
						  $rows = mysqli_num_rows($query);
                        }
						for($i=0 ; $i<$rows ; $i++){
							$result = mysqli_fetch_array($query);
					?>
                    <tr class="gradeX">
                        <td><?php echo $result[1] ; ?></td>
                        <td><?php echo $result[2] ; ?></td>
                        <td><?php echo $result[3] ; ?></td>
                        <td><?php echo $result[4] ; ?></td>
                        <td><?php echo $result[5] ; ?></td>
                        <?php if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH'){ ?>
                        <td><a class="edit" href="#myModal-1" data-toggle="modal">Edit</a></td>
                        <td><a class="delete" href="users.php?uid=<?php echo $result[0] ; ?>" onclick="return confirm('Delete User?')">Delete</a></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
					</tbody>
                    <tfoot>
                    <tr>
                        <th>Full Name</th>
                        <th>Email-Id</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>Active</th>
                        <?php if($_SESSION['role']=='ADM'||$_SESSION['role']=='COH'||$_SESSION['role']=='BRH'){ ?>
                        <th>Edit</th>
                        <th>Delete</th>
                        <?php } ?>
                    </tr>
                    </tfoot>
                    </table>
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                        <h4 class="modal-title">Edit User</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form class="form-horizontal" method="post" role="form">
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
                                    <!-- <div class="form-group ">
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
                                    </div> -->
                                    <div class="form-group ">
                                        <label for="umobile" class="control-label col-lg-3">Mobile</label>
                                        <div class="col-lg-6">
                                            <input class="form-control " id="umobile" type="number" name="umobile"/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="uactive" class="control-label col-lg-3">Active</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="active" id="uactive" required>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="urole" class="control-label col-lg-3">Role</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="role" id="urole" required>
                                                <option value="SAE">SAE</option>
                                                <option value="BRH">BRH</option>
                                                <option value="COH">COH</option>
                                                <option value="ADM">ADM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ubranch" class="control-label col-lg-3">Branch</label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="branch" id="ubranch" required>
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
                                            <button class="btn btn-primary" name="editsubmit" type="submit">Save</button>
                                            <button class="btn btn-default" type="button">Cancel</button>
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
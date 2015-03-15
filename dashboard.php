<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Welcome  </title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="css/clndr.css" rel="stylesheet">
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="js/morris-chart/morris.css">
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
                <li><a href="#"><i class="fa fa-suitcase"></i>Edit Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>Change Password</a></li>
                <li><a href="logout.php"><i class="fa fa-key"></i>Log Out</a></li>
                <li><a href="lock_screen.php"><i class="fa fa-lock"></i>Lock Screen</a></li>
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
                    <a class="active" href="dashboard.php">
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
                <div class="col-md-3">
                    <section class="panel1" style="margin-left:-45px">
                        <div class="panel-body">
                            <div class="top-stats-panel">
                                <div class="gauge-canvas">
                                    <h4 class="widget-h">Leads Converted to Opportunities</h4>
                                    <div align="center">
                                        <canvas width=210 height=150 id="gauge" ></canvas>
                                    </div>
                                </div>
                                <ul class="gauge-meta clearfix">
                                    <li id="gauge-textfield" class="pull-left gauge-value">0</li>
                                    <?php
                                        $exec = "SELECT * FROM leads ";
                                        if($_SESSION['role'] == 'BRH'){
                                            $bname = getbranchbyid($_SESSION['user'], $connection);
                                            $exec = $exec."WHERE branch='$bname'";
                                        }
                                        if($_SESSION['role'] == 'SAE'){
                                            $bname = getbranchbyid($_SESSION['user'], $connection);
                                            $me = $_SESSION['user'];
                                            $exec = $exec."WHERE branch='$bname' AND assignedto='$me'";
                                        }
                                        $query = mysqli_query($connection, $exec);
                                        $rows = 0;
                                        if($query != false)
                                            $rows = mysqli_num_rows($query);
                                    ?>
                                    <li class="pull-right gauge-title">Out of <?php echo $rows ; ?></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-3">
                    <section class="panel1" style="margin-left:0px;margin-right:-70px" >
                        <div class="panel-body">
                            <div class="top-stats-panel">
                            <?php
                                $exec = "SELECT * FROM opportunities ";
                                if($_SESSION['role'] == 'BRH')
                                    {
                                        $mybranch = getbranchbyid($_SESSION['user'], $connection);
                                        $exec = $exec."WHERE branch='$mybranch'";
                                    }
                                if($_SESSION['role'] == 'SAE')
                                    {
                                        $mybranch = getbranchbyid($_SESSION['user'], $connection);
                                        $me = $_SESSION['user'];
                                        $exec = $exec."WHERE branch='$mybranch' AND assignedto='$me'";
                                    }
                                $q0 = mysqli_query($connection, $exec);
                                $r0 = mysqli_num_rows($q0);
                            ?> 
                                <h4 class="widget-h">Total Opportunities: <?php echo $r0; ?></h4>
                                <div class="span6 chart">
                                    <div id="hero-bar" style="height:150px;"></div>
                                    <ul class="list-inline">
                                        <li>
                                            1. IN: Initial
                                        </li>
                                        <li>
                                            2. NG: Negotiation
                                        </li>
                                        <li>
                                            3. QT: Quoted
                                        </li>
                                        <li>
                                            4. OR: Order Received
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>      
                </div>
                <div class="col-md-6" style="margin-left:84px;width:42%">
                    <div class="row" style="margin-right: 0px;">
                        <div class="mini-stat clearfix" style="padding-top: 36px;">
                        <span class="mini-stat-icon" style="background:#A9D86E;"><i class="fa fa-rupee"></i></span>
                            <div class="mini-stat-info" style="margin-bottom: 27px;">
                            <?php
                                $e = "SELECT SUM(totalamount) FROM opportunities WHERE status='Order Received' ";
                                if($_SESSION['role'] == 'BRH')
                                {
                                    $mybranch = getbranchbyid($_SESSION['user'], $connection);
                                    $e = $e."AND branch='$mybranch'";
                                }
                                if($_SESSION['role'] == 'SAE')
                                {
                                    $mybranch = getbranchbyid($_SESSION['user'], $connection);
                                    $me = $_SESSION['user'];
                                    $e = $e."AND branch='$mybranch' AND assignedto='$me'";
                                }
                                $sales = mysqli_query($connection, $e);
                                $totalsale = 0;
                                if($sales == true)
                                    $totalsale = mysqli_fetch_array($sales);
                            ?>
                                <span>Rs. <?php echo $totalsale['SUM(totalamount)'] ?></span>
                                Total Sales
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left: -29px;padding-top: 0px;"> 
                        <div class="col-md-5" style="width:50%">               
                            <div class="mini-stat clearfix">
                                <span class="mini-stat-icon" style="background:crimson"><i class="fa fa-chevron-up"></i></span>
                                <div class="mini-stat-info">
                                    <?php
                                        $actleads = mysqli_query($connection, "SELECT COUNT(*) FROM leads WHERE status='Active'");
                                        $aleads = 0;
                                        if($actleads == true)
                                            $aleads = mysqli_fetch_array($actleads);
                                    ?>
                                    <span><?php echo $aleads['COUNT(*)'] ?></span>
                                    Active Leads
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5" style="width:50%">               
                            <div class="mini-stat clearfix">
                                <span class="mini-stat-icon tar"><i class="fa fa-chevron-down"></i></span>
                                <div class="mini-stat-info">
                                    <?php
                                        $inactleads = mysqli_query($connection, "SELECT COUNT(*) FROM leads WHERE status='Active'");
                                        $inaleads = 0;
                                        if($inactleads == true)
                                            $inaleads = mysqli_fetch_array($inactleads);
                                    ?>
                                    <span><?php echo $inaleads['COUNT(*)'] ?></span>
                                    Inactive Leads
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Calls Due Since last 15 days
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <!-- <div class="btn-group">
                        <button id="editable-sample_new" class="btn btn-primary">
                            Add Call <i class="fa fa-plus"></i>
                        </button>
                    </div> -->
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Date</th> 
                        <th>Mode</th>
                        <th>For</th>
                        <th>Company</th>
                        <th>Opportunity Name</th>
                        <th>By</th>
                        <th>Notes</th>
                        <th>Branch</th>
                        <th>Next Follow Up</th>
                        <th>Followed Up</th>  
                        <th>Follow Up</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
									$query = mysqli_query($connection, "SELECT * FROM calls WHERE followed='No' AND nextfollowup > DATE_ADD(CURDATE(), INTERVAL -15 DAY) AND nextfollowup < DATE_ADD(CURDATE(), INTERVAL 1 DAY)");
									$rows = 0;
									if($query != false)
										$rows = mysqli_num_rows($query);
									for($i=0 ; $i<$rows ; $i++){
										$result = mysqli_fetch_array($query);
					?>
                    <tr class="gradeX">
                        <td><?php echo $result[1]; ?></td>
                        <td><?php echo $result[2]; ?></td>
                        <td><?php echo $result[4]; ?></td>
                        <td><?php echo $result[5]; ?></td>
                        <td><?php echo $result[7]; ?></td>
                        <td><?php echo $result[3]; ?></td>
                        <td><?php echo $result[8]; ?></td>
                        <td><?php echo $result[11]; ?></td>
                        <td><?php echo $result[9]; ?></td>
						<?php if($result[10] == "Yes") {?>
						<td><span class="label label-success">Yes</span></td>
						<?php } else if($result[10] == "No"){ ?>
                        <td><span class="label label-danger">No</span></td>
						<?php } ?>
						<td><a class="edit" href="">Follow Up</a></td>
                    </tr>
					<?php  } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Date</th> 
                        <th>Mode</th>
                        <th>For</th>
                        <th>Company</th>
                        <th>Opportunity Name</th>
                        <th>By</th>
                        <th>Notes</th>
                        <th>Branch</th>
                        <th>Next Follow Up</th>  
                        <th>Followed Up</th>
                        <th>Follow Up</th>
                    </tr>
                    </tfoot>
                    </table>
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
<?php
$e1 = "SELECT * FROM opportunities WHERE status='Initial' ";
if($_SESSION['role'] == 'BRH')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $e1 = $e1."AND branch='$mybranch'";
    }
if($_SESSION['role'] == 'SAE')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $me = $_SESSION['user'];
        $e1 = $e1."AND branch='$mybranch' AND assignedto='$me'";
    }
$q1 = mysqli_query($connection, $e1);
$r1 = mysqli_num_rows($q1);
$e2 = "SELECT * FROM opportunities WHERE status='Negotiation' ";
if($_SESSION['role'] == 'BRH')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $e2 = $e2."AND branch='$mybranch'";
    }
if($_SESSION['role'] == 'SAE')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $me = $_SESSION['user'];
        $e2 = $e2."AND branch='$mybranch' AND assignedto='$me'";
    }
$q2 = mysqli_query($connection, $e2);
$r2 = mysqli_num_rows($q2);
$e3 = "SELECT * FROM opportunities WHERE status='Quoted' ";
if($_SESSION['role'] == 'BRH')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $exec = $exec."AND branch='$mybranch'";
    }
if($_SESSION['role'] == 'SAE')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $me = $_SESSION['user'];
        $e3 = $e3."AND branch='$mybranch' AND assignedto='$me'";
    }
$q3 = mysqli_query($connection, $e3);
$r3 = mysqli_num_rows($q3);
$e4 = "SELECT * FROM opportunities WHERE status='Order Received' ";
if($_SESSION['role'] == 'BRH')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $e4 = $e4."AND branch='$mybranch'";
    }
if($_SESSION['role'] == 'SAE')
    {
        $mybranch = getbranchbyid($_SESSION['user'], $connection);
        $me = $_SESSION['user'];
        $e4 = $e4."AND branch='$mybranch' AND assignedto='$me'";
    }
$q4 = mysqli_query($connection, $e4);
$r4 = mysqli_num_rows($q4);    
?>

<script type="text/javascript">var n1 = "<?php echo $r1; ?>";</script>
<script type="text/javascript">var n2 = "<?php echo $r2; ?>";</script>
<script type="text/javascript">var n3 = "<?php echo $r3; ?>";</script>
<script type="text/javascript">var n4 = "<?php echo $r4; ?>";</script>

<link rel="stylesheet" href="vendors/morris/morris.css">
<script src="vendors/jquery-1.9.1.min.js"></script>
        <!-- <script src="vendors/jquery.knob.js"></script> -->
         <script src="vendors/raphael-min.js"></script> 
        <script src="vendors/morris/morris.min.js"></script>
        <script>

        // Morris Bar Chart
        Morris.Bar({
            element: 'hero-bar',
            data: [
                {status: 'IN', opp: Number(n1)},
                {status: 'QT', opp: Number(n2)},
                {status: 'NG', opp: Number(n3)},
                {status: 'OR', opp: Number(n4)},
            ],
            xkey: 'status',
            ykeys: ['opp'],
            labels: ['Opportunities'],
            barRatio: 0.4,
            xLabelMargin: 10,
            hideHover: 'auto',
            barColors: ["#3d88ba"]
        });


        </script>
<script src="js/skycons/skycons.js"></script>
<script src="js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="js/gauge/gauge.js"></script>
<script src="js/css3clock/js/css3clock.js"></script>
<?php
$exec = "SELECT * FROM leads ";
if($_SESSION['role'] == 'BRH'){
    $bname = getbranchbyid($_SESSION['user'], $connection);
    $exec = $exec."WHERE branch='$bname'";
}
if($_SESSION['role'] == 'SAE'){
    $bname = getbranchbyid($_SESSION['user'], $connection);
    $me = $_SESSION['user'];
    $exec = $exec."WHERE branch='$bname' AND assignedto='$me'";
}
$query = mysqli_query($connection, $exec);
$rows = 0;
if($query != false)
    $rows = mysqli_num_rows($query);


$exec2 = "SELECT * FROM leads WHERE status='Converted' ";
if($_SESSION['role'] == 'BRH'){
    $bname = getbranchbyid($_SESSION['user'], $connection);
    $exec2 = $exec2."AND branch='$bname'";
}
if($_SESSION['role'] == 'SAE'){
    $bname = getbranchbyid($_SESSION['user'], $connection);
    $me = $_SESSION['user'];
    $exec2 = $exec2."AND branch='$bname' AND assignedto='$me'";
}
$query2 = mysqli_query($connection, $exec2);
$rows2 = 0;
if($query2 != false)
    $rows2 = mysqli_num_rows($query2);

?>

 <script type="text/javascript">var totalleads = Number("<?php echo $rows; ?>");</script>
 <script type="text/javascript">var conleads = Number("<?php echo $rows2; ?>");</script>

 <script type="text/javascript" src="js/dashboard.js"></script>
<!-- <script src="js/jquery.customSelect.min.js" ></script> -->
<!--common script init for all pages-->
 
<script src="js/jquery.js"></script>
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
 <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif] -->

<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!-- <!common script init for all pages--> -->
<script src="js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>
<script src="js/toggle-init.js"></script>

        
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>

<?php require_once("includes/footer.php"); ?>
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
    <meta name="author" content="Sidharth Machinaries">
    <link rel="shortcut icon" href="images/favicon.html">
    <title>Comparison Chart</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href="js/c3-chart/c3.css" rel="stylesheet"/>
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
    <div class="form-group" style="margin-top:-1.5%">
        <div class="col-lg-6" style="margin-top:10%; width:17%;margin-left:-2.8%">
            <select class="form-control" required>
                <option value="L1">Ahmedabad</option>
                <option value="L2">Vadodara</option>
                <option value="L3">Mumbai</option>
            </select>
        </div>
    </div>
    <div class="form-group" style="margin-top:-1.5%">
        <div class="col-lg-6" style="margin-top:10%; width:17%;margin-left:-0.8%">
            <select class="form-control" required>
                <option value="L1">2012-13</option>
                <option value="L2">2013-14</option>
                <option value="L3">2014-15</option>
            </select>
        </div>
    </div>
    <section class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel" style="margin-top:-5%">
                    <header class="panel-heading" style="margin-left:38%">
                       Comparison Chart - Branch 
                    </header>
                    <div class="panel-body">

                        <div class="chart">
                            <div id="chart">
                            </div>
                        </div>
                        <div style="margin-left:20px">
                            0 - January, 1- February, 2 - March, 3 - April, 4 - May, 5 - June, 6 - July, 7 - August, 8 - September, 9 - October, 10 - November, 11 - December
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
<!-- <script src="js/easypiechart/jquery.easypiechart.js"></script>
<script src="js/sparkline/jquery.sparkline.js"></script> -->
<!--jQuery Flot Chart-->
<!--Chart JS-->

<!--C3 Chart-->
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="js/c3-chart/c3.js"></script>
<script src="js/c3-chart.init.js"></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>

<?php require_once("includes/footer.php"); ?>
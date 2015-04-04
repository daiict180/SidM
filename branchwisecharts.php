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
    <title>Branchwise Reports</title>
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
    <!-- <div class="dropdown" style="z-index:1;margin-left:-30%">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true" style="width:11%;margin-top:6.6%;margin-left:50%">
        Branch
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="margin-left:50%;margin-top:0%">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Branch 1</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Branch 2</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Branch 3</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Branch 4</a></li>
      </ul>
    </div> -->
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
      <section class="wrapper" style="width:100%">
           <!-- page start-->
               <div class="row" style="margin-top:8%;margin-left:3%">
               <div class="col-sm-12" style="margin-left:-35px;margin-top:-156px;z-index:-1000">
                   <section class="panel">
                       <header class="panel-heading">
                          Opportnity vs Leads - Branch
                       </header>
                       <div class="panel-body">
                           <div>
                               
                                   <div class="legendColorBox" style="margin-top:0.2%;margin-left:43%;">
                                       <div style="border:1px solid #ccc;padding:1px;width:14px">
                                           <div style="width:4px;height:0;border:5px solid #E67A77 ;overflow:hidden">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="legendLabel" style="margin-top:-17px;margin-left:45%">Opportunities</div>
                               
                               
                                   <div class="legendColorBox" style="margin-top:1%;margin-left:43%">
                                       <div style="border:1px solid #ccc;padding:1px;width:14px">
                                           <div style="width:4px;height:0;border:5px solid #79D1CF ;overflow:hidden">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="legendLabel" style="margin-top:-1.7%;margin-left:45%">Leads</div> 
                               
                           </div>
                           <div class="chartJS">
                               <canvas id="bar-chart-js" height="250" width="800" ></canvas>
                           </div>
                       </div>
                   </section>
               </div>
           </div>
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
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<!--Chart JS-->
<script src="js/chart-js/Chart.js"></script>
<script src="js/chartjs.init.js"></script>
<!-- morris chart js -->
<script src="js/morris-chart/morris.js"></script>
<script src="js/morris-chart/raphael-min.js"></script>
<script src="js/morris.init.js"></script>
<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
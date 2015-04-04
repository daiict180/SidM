<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sidharth Machinaries">
    <link rel="shortcut icon" href="images/favicon.html">
    <title>Companies</title>
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
<body>
<?php $branch = $_GET['q']; ?>

<section class="panel">
   <header class="panel-heading">
      Opportnity vs Leads - Mohit
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
</body>
</html>
<?php require_once("includes/footer.php"); ?>
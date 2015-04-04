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
    <title>Machine-wise Report</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
          <style type="text/css">
       #chart, #sliders {
        min-width: 310px; 
        max-width: 800px;
        margin: 0 auto;
       }
       #chart {
        height: 400px; 
       }
          </style>
          <script type="text/javascript">
       $(function () {
           // Set up the chart
           var chart = new Highcharts.Chart({
               chart: {
                   renderTo: 'chart',
                   type: 'column',
                   margin: 75,
                   options3d: {
                       enabled: true,
                       alpha: 15,
                       beta: 15,
                       depth: 50,
                       viewDistance: 25
                   }
               },
               title: {
                   text: 'Amount wise Graph'
               },
               subtitle: {
               },
               plotOptions: {
                   column: {
                       depth: 25
                   }
               },
               xAxis: [{
                   categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                       'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                   crosshair: true
               }],
               series: [{
                   name: 'Machines',
                   data: [29, 71, 106, 129.2, 144, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
               }]
           });

           function showValues() {
               $('#R0-value').html(chart.options.chart.options3d.alpha);
               $('#R1-value').html(chart.options.chart.options3d.beta);
           }

           // Activate the sliders
           $('#R0').on('change', function () {
               chart.options.chart.options3d.alpha = this.value;
               showValues();
               chart.redraw(false);
           });
           $('#R1').on('change', function () {
               chart.options.chart.options3d.beta = this.value;
               showValues();
               chart.redraw(false);
           });

           showValues();
       });
          </script>
</head>
<?php include("includes/sidebar.php"); ?>
 <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-2">
           <div class="form-group">
            <select class="form-control" id="source">
              <optgroup label="">
                <option value="CT">Vadodara</option>
                <option value="DE">Ahmedabad</option>
                <option value="FL">Mumbai</option>
                <option value="GA">Georgia</option>
              </optgroup>
            </select>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control" id="source">
              <optgroup label="">
                <option value="CT">5k-10k</option>
                <option value="DE">10k-15k</option>
                <option value="FL">15k-20k</option>
              </optgroup>
            </select>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control" id="source">
              <optgroup label="">
                <option value="CT">2013-2014</option>
                <option value="DE">2014-2015</option>
                <option value="FL">2015-2016</option>
              </optgroup>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <section class="panel">
            <div class="panel-body">
                <div id="chart"></div>
                <div id="sliders">
                  <table>
                    <tr><td>Alpha Angle</td><td><input id="R0" type="range" min="0" max="45" value="15"/> <span id="R0-value" class="value"></span></td></tr>
                      <tr><td>Beta Angle</td><td><input id="R1" type="range" min="0" max="45" value="15"/> <span id="R1-value" class="value"></span></td></tr>
                  </table>
                </div>
            </div>
          </section>
        </div>
      </div>
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
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/exporting.js"></script>

</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
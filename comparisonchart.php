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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
            
    <script type="text/javascript">
    $(function () {
        $('#comparisonChart').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Monthly comparison chart'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: ''
                },
                labels: {
                    formatter: function () {
                        return this.value + '°';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
            name: 'Live Opportunities',
            marker: {
                symbol: 'square'
            },
            data: [7, 6, 9, 14, 18, 21, 25, {
                y: 26,
            }, 23, 18, 13, 9]

        }, {
            name: 'Dead Opportunities',
            marker: {
                symbol: 'diamond'
            },
            data: [{
                y: 3.9,
            }, 4, 5, 8, 11, 15, 17, 16, 14, 10, 6, 4]
        }]
        });
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
                    <div id="comparisonChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
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
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
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
  <title>Live vs Dead Leads</title>
  <!--Core CSS -->
  <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  <!--clock css-->
  <link href="js/css3clock/css/style.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/table-responsive.css" rel="stylesheet" />
  <link href="css/style1.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet"/>
  <?php
    $query = mysqli_query($connection, "SELECT * FROM sources");
    $snumber = mysqli_num_rows($query);
    $sources = array($snumber);
    $liveleads = array($snumber);
    $deadleads = array($snumber);

    for($i = 0 ;$i < $snumber ; $i++){
      $result = mysqli_fetch_array($query);
      $sources[$i] = $result[1];
      $e1 = "SELECT * FROM leads WHERE source='$result[1]' AND (status='New' OR status='Active') ";
      if($_SESSION['role'] == 'SAE'){
          $id = $_SESSION['user'];
          $e1 = $e1."AND assignedto='$id'";
        }
        if($_SESSION['role'] == 'BRH'){
          $branch = getbranchbyid($_SESSION['user'], $connection);
          $e1 = $e1."AND branch='$branch'";
        }
      $q = mysqli_query($connection, $e1);

      $liveleads[$i] = mysqli_num_rows($q);
      $e2 = "SELECT * FROM leads WHERE source='$result[1]' AND status='Closed' ";
      if($_SESSION['role'] == 'SAE'){
          $id = $_SESSION['user'];
          $e2 = $e2."AND assignedto='$id'";
        }
        if($_SESSION['role'] == 'BRH'){
          $branch = getbranchbyid($_SESSION['user'], $connection);
          $e2 = $e2."AND branch='$branch'";
        }
      $q2 = mysqli_query($connection, $e2);
      $deadleads[$i] = mysqli_num_rows($q2);
    }
  ?>
  <script type="text/javascript">
    var sources = <?php echo json_encode($sources); ?>;
    var liveleads = <?php echo json_encode($liveleads); ?>;
    var deadleads = <?php echo json_encode($deadleads); ?>;
    </script>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      <style type="text/css">
  ${demo.css}
      </style>
      <script type="text/javascript">
  $(function () {
      $('#chart').highcharts({
          chart: {
              type: 'bar'
          },
          title: {
              text: 'Live vs Dead Leads - Sourcewise'
          },
          xAxis: {
              categories: sources
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Live vs Dead Leads'
              }
          },
          legend: {
              reversed: true
          },
          plotOptions: {
              series: {
                  stacking: 'normal'
              }
          },
          series: [{
              name: 'Live Leads',
              data: liveleads
          }, {
              name: 'Dead Leads',
              data: deadleads
          }]
      });
  });
      </script>
             <?php
                $query = mysqli_query($connection, "SELECT * FROM branches");
                $bnumber = mysqli_num_rows($query);
                $branches = array($bnumber);
                $livebranchleads = array($bnumber);
                $deadbranchleads = array($bnumber);

                for($i = 0 ;$i < $bnumber ; $i++){
                  $result = mysqli_fetch_array($query);
                  $branches[$i] = $result[1];
                  $q = mysqli_query($connection, "SELECT * FROM leads WHERE branch='$result[1]' AND (status='New' OR status='Active')");
                  $livebranchleads[$i] = mysqli_num_rows($q);
                  $q2 = mysqli_query($connection, "SELECT * FROM leads WHERE branch='$result[1]' AND status='Closed'");
                  $deadbranchleads[$i] = mysqli_num_rows($q2);
                }
              ?>
              <script type="text/javascript">
                var branches = <?php echo json_encode($branches); ?>;
                var livebranchleads = <?php echo json_encode($livebranchleads); ?>;
                var deadbranchleads = <?php echo json_encode($deadbranchleads); ?>;
                </script>

          <script type="text/javascript">
          $(function () {
              $('#comparisonChart').highcharts({
                  chart: {
                      type: 'spline'
                  },
                  title: {
                      text: 'Live vs Dead Leads - Branchwise'
                  },
                  xAxis: {
                      categories: branches
                  },
                  yAxis: {
                      title: {
                          text: ''
                      },
                      labels: {
                          formatter: function () {
                              return this.value;
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
                  name: 'Live Leads',
                  marker: {
                      symbol: 'square'
                  },
                  data: livebranchleads

              }, {
                  name: 'Dead Leads',
                  marker: {
                      symbol: 'diamond'
                  },
                  data: deadbranchleads
              }]
              });
          });
      </script>
</head>
<?php include("includes/sidebar.php"); ?>
    <section id="main-content">
          <section class="wrapper">
          <div class="row">
            <div class="col-md-12">
              <section class="panel">
                <div class="panel-body">
                  <div id="chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                </div>
              </section>
            </div>
          </div>
        </section>
          <section class="wrapper">
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


    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>
    <script src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

    <!--clock init-->
    <!--common script init for all pages-->
    <script src="js/highcharts.js"></script>
    <script src="js/exporting.js"></script>
    <script src="js/scripts.js"></script>
    <!--script for this page-->
  </body>

  <!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
  </html>
  <?php require_once("includes/footer.php"); ?>
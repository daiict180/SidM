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
  <title>Open Opportunities</title>
  <!--Core CSS -->
  <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  <!--clock css-->
  <link href="js/css3clock/css/style.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/table-responsive.css" rel="stylesheet" />
  <link href="css/style1.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet"/>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
      <?php
        $query1 = mysqli_query($connection, "SELECT MIN(totalamount) FROM opportunities");
        $res = mysqli_fetch_array($query1);
        $minamount = $res['MIN(totalamount)'];
        $query2 = mysqli_query($connection, "SELECT MAX(totalamount) FROM opportunities");
        $res = mysqli_fetch_array($query2);
        $maxamount = $res['MAX(totalamount)'] +1;

        $section = ($maxamount - $minamount)/10;

        $amountopp = array(10);
        for($i = 0 ; $i < 10 ; $i++){
          $start = $minamount+($section*($i));
          $end = $minamount+($section*($i+1));
          $query = mysqli_query($connection, "SELECT * FROM opportunities WHERE (status='Initial' OR status='Quoted' OR status='Negotiation') AND totalamount>='$start' AND totalamount<'$end'");
          $amountopp[$i] = mysqli_num_rows($query);
        }

      ?>

      <script type="text/javascript">
      var amountopp = <?php echo json_encode($amountopp); ?>;
      var minamount = <?php echo json_encode($minamount); ?>;
      var section = <?php echo json_encode($section); ?>;

      $(document).ready(function() {
        $('#branch').change(function(){
              var branch = document.getElementById("branch").value;
              //var year = document.getElementById("year").value;
            $.ajax({

                type: "GET",
                url: "getopenopportunity.php",
                data: 'branch='+branch,
                success: function(msg){
                    $('#barChart').html(msg);
                    
                }

            }); // Ajax Call
        }); //event handler
    }); //document.ready
  $(function () {
      $('#amountChart').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'Amountwise Open Opportunities'
          },
          subtitle: {
              text: ''
          },
          xAxis: {
              type: 'category',
              labels: {
                  rotation: -45,
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Open Opportunities'
              }
          },
          legend: {
              enabled: false
          },
          tooltip: {
              pointFormat: 'Open Opportunities: <b>{point.y:.0f}</b>'
          },
          series: [{
              name: 'Population',
              data: [
                  [Math.floor(Number(minamount))+'-'+(Math.floor(Number(minamount)+Number(section))), amountopp[0]],
                  [(Math.floor(Number(minamount)+(Number(section)*1)))+'-'+(Math.floor(Number(minamount)+(Number(section)*2))), amountopp[1]],
                  [(Math.floor(Number(minamount)+(Number(section)*2)))+'-'+(Math.floor(Number(minamount)+(Number(section)*3))), amountopp[2]],
                  [(Math.floor(Number(minamount)+(Number(section)*3)))+'-'+(Math.floor(Number(minamount)+(Number(section)*4))), amountopp[3]],
                  [(Math.floor(Number(minamount)+(Number(section)*4)))+'-'+(Math.floor(Number(minamount)+(Number(section)*5))), amountopp[4]],
                  [(Math.floor(Number(minamount)+(Number(section)*5)))+'-'+(Math.floor(Number(minamount)+(Number(section)*6))), amountopp[5]],
                  [(Math.floor(Number(minamount)+(Number(section)*6)))+'-'+(Math.floor(Number(minamount)+(Number(section)*7))), amountopp[6]],
                  [(Math.floor(Number(minamount)+(Number(section)*7)))+'-'+(Math.floor(Number(minamount)+(Number(section)*8))), amountopp[7]],
                  [(Math.floor(Number(minamount)+(Number(section)*8)))+'-'+(Math.floor(Number(minamount)+(Number(section)*9))), amountopp[8]],
                  [(Math.floor(Number(minamount)+(Number(section)*9)))+'-'+(Math.floor(Number(minamount)+(Number(section)*10))), amountopp[9]],
                  ],
              dataLabels: {
                  enabled: true,
                  rotation: -90,
                  color: '#FFFFFF',
                  align: 'right',
                  format: '{point.y:.0f}', // one decimal
                  y: 10, // 10 pixels down from the top
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          }]
      });
  });
      </script>
       <?php
        $query = mysqli_query($connection, "SELECT * FROM machines");
        $totalmachines = mysqli_num_rows($query);
        $machines = array($totalmachines);
        $machineopp = array($totalmachines);
        for($i = 0;  $i < $totalmachines ; $i++){
          $res = mysqli_fetch_array($query);
          $machines[$i] = $res[1];
          $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE productofinterest='$res[1]' AND (status='Initial' OR status='Quoted' OR status='Negotiation')");
          $machinesopp[$i] = mysqli_num_rows($q);
        }
       ?>
       <script type="text/javascript">
       var machines = <?php echo json_encode($machines); ?>;
        var machinesopp = <?php echo json_encode($machinesopp); ?>;
  $(function () {
      $('#chart').highcharts({
          chart: {
              zoomType: 'xy'
          },
          title: {
              text: 'Machinewise Open Opportunities'
          },
          subtitle: {
              
          },
          xAxis: [{
              categories: machines,
              crosshair: true
          }],
          yAxis: [{ // Primary yAxis
              labels: {
                  format: '',
                  style: {
                      color: Highcharts.getOptions().colors[1]
                  }
              },
              title: {
                  text: '',
                  style: {
                      color: Highcharts.getOptions().colors[1]
                  }
              }
          }, { // Secondary yAxis
              title: {
                  text: '',
                  style: {
                      color: Highcharts.getOptions().colors[0]
                  }
              },
              labels: {
                  format: '{value}',
                  style: {
                      color: Highcharts.getOptions().colors[0]
                  }
              },
              opposite: true
          }],
          tooltip: {
              shared: true
          },
          legend: {
              layout: 'vertical',
              align: 'left',
              x: 120,
              verticalAlign: 'top',
              y: 100,
              floating: true,
              backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
          },
          series: [{
              name: 'Open Opportunities',
              type: 'spline',
              data: machinesopp,
              tooltip: {
                  valueSuffix: ''
              }
          }]
      });
  });
       </script>

       <?php
        $query = mysqli_query($connection, "SELECT * FROM branches");
        $totalbranches = mysqli_num_rows($query); 
        $branches = array($totalbranches);
        $branchopp = array($totalbranches);
        for($i = 0; $i < $totalbranches ; $i++){
          $result = mysqli_fetch_array($query);
          $branches[$i] = $result[1];
          $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$result[1]' AND(status='Initial' OR status='Quoted' OR status='Negotiation')");
          $branchopp[$i] = mysqli_num_rows($q);
        }
       ?>
       

      <script type="text/javascript">
      var branchopp = <?php echo json_encode($branchopp); ?>;
        var branches = <?php echo json_encode($branches); ?>;

  $(function () {
      $('#branchChart').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'Branchwise Open Opportunities'
          },
          xAxis: {
              categories: branches,
              crosshair: true
          },
          yAxis: {
              min: 0,
              title: {
                  text: ''
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                  '<td style="padding:0"><b>{point.y:0f}</b></td></tr>',
              footerFormat: '</table>',
              shared: true,
              useHTML: true
          },
          plotOptions: {
              column: {
                  pointPadding: 0.2,
                  borderWidth: 0
              }
          },
          series: [{
              name: 'Open Opportunities',
              data: branchopp

          }]
      });
  });
      </script>

      <script type="text/javascript">
  $(function () {
      $('#barChart').highcharts({
          chart: {
              type: 'bar'
          },
          title: {
              text: 'Sales-person Wise Chart'
          },
          xAxis: {
              categories: emp
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Total Open Opportunities'
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
              name: 'Open Opportunities',
              data: empopp
          }]
      });
  });
      </script>
</head>
<?php include("includes/sidebar.php"); ?>
    <section id="main-content">
          <section class="wrapper">
              <div class="mini-stat clearfix" style="padding-top: 36px;">
                <span class="mini-stat-icon" style="background:crimson;"><i class="fa fa-chevron-up"></i></span>
                <div class="mini-stat-info" style="margin-bottom: 27px;">
                <?php
                  $query = mysqli_query($connection, "SELECT * FROM opportunities WHERE (status='Initial' OR status='quoted' OR status='Negotiation')");
                  $rows = mysqli_num_rows($query);
                ?>
                  <span><?php echo $rows; ?></span>
                  Total Open Opportunities
              </div>
            </div>
            <div class="row">
              <div class="col-lg-2">
               <div class="form-group">
                <select class="form-control" id="branch">
                  <optgroup label="">
                    <?php 
                $query = mysqli_query($connection, "SELECT * FROM branches");
                $rows = mysqli_num_rows($query);
                for($i =0 ; $i < $rows ; $i++){
                  $res = mysqli_fetch_array($query);
                  if($i == 0)
                    $requiredbranch = $res[1];
                ?>
                      <option value="<?php echo $res[1]; ?>"><?php echo $res[1]; ?></option>
                <?php } ?>
                  </optgroup>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <section class="panel">
                <div class="panel-body">
                  <div id="barChart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                </div>
              </section>
            </div>
          </div>
        
            
          <div class="row">
            <div class="col-md-6">
              <section class="panel">
                <div class="panel-body">
                    <div id="branchChart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
              </section>
            </div>
             <div class="col-md-6">
              <section class="panel">
                <div class="panel-body">
                  <div id="amountChart" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
                </div>
              </section>
            </div>
          </div>
            
          <div class="row">
            <div class="col-md-12">
              <section class="panel">
                <div class="panel-body">
                     <div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                </div>
              </section>
            </div>
          </div>
        </section>
      </section>
        
    </section>

<?php
        $query = mysqli_query($connection, "SELECT * FROM users WHERE branch='$requiredbranch'");
        $totalemp = mysqli_num_rows($query);
        $empid = array($totalemp);
        $emp = array($totalemp);
        $empopp = array($totalemp);
        for($i=0; $i < $totalemp ; $i++){
            $result = mysqli_fetch_array($query);
            $empid[$i] = $result[0];
            $emp[$i] = $result[1];
            $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE assignedto='$result[0]' AND (status='Initial' OR status='Quoted' OR status='Negotiation')");
            $empopp[$i] = mysqli_num_rows($q);
        }
      ?>

      <script type="text/javascript">
      var emp = <?php echo json_encode($emp); ?>;
        var empopp = <?php echo json_encode($empopp); ?>;
        </script>

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
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
  <title>Leads Report</title>
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
      
      $exec = "SELECT * FROM branches ";
      if($_SESSION['role'] == 'SAE' || $_SESSION['role'] == 'BRH'){
        $branch = getbranchbyid($_SESSION['user'], $connection);
        $exec = $exec."WHERE branchname='$branch'";
      }
      $query = mysqli_query($connection, $exec);
      $rows = mysqli_num_rows($query);
      $branches = array($rows);
      $branchleads = array($rows);
      for($i = 0 ; $i < $rows ;$i++){
        $res = mysqli_fetch_array($query);
        $branches[$i] = $res['1'];

        $q = mysqli_query($connection, "SELECT * FROM leads WHERE branch='$branches[$i]'");
        $branchleads[$i] = mysqli_num_rows($q);
      }

    ?>
    
    <script type="text/javascript">
    var branches = <?php echo json_encode($branches); ?>;
    var branchleads = <?php echo json_encode($branchleads); ?>;
    </script>
      <script type="text/javascript">
      $(document).ready(function() {
        $('#branch').change(function(){
              var branch = document.getElementById("branch").value;
            $.ajax({

                type: "GET",
                url: "getleadsreports.php",
                data: 'branch='+branch ,
                success: function(msg){
                    //alert(msg);
                    $('#barChart').html(msg);
                }

            }); // Ajax Call
        }); //event handler
    }); //document.ready

  $(function () {
      $('#branchChart').highcharts({
          chart: {
              type: 'column'
          },
          title: {
              text: 'Branchwise Leads'
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
              name: 'Leads',
              data: branchleads

          }]
      });
  });
      </script>
           
               <!-- // <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
          
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
                           text: 'Total Open Leads'
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
                       name: 'Open Leads',
                       data: onumber
                   }]
               });
           });
               </script>
</head>
<?php include("includes/sidebar.php"); ?>
    <section id="main-content">
          <section class="wrapper">
              
            <div class="row">
            <div class="col-md-6">
              <div class="panel">
              <section class = "panel-body"> 
              <select class="form-control" id="branch">
              <optgroup label="">
              <?php
                $exec = "SELECT * FROM branches ";
                if($_SESSION['role'] == 'BRH' || $_SESSION['role'] == 'SAE'){
                  $branch = getbranchbyid($_SESSION['user'], $connection);
                  $exec = $exec."WHERE branchname='$branch'";
                }
                $query = mysqli_query($connection, $exec);
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
              </section>
              </div>
              </div>
            <div class="col-md-6">
              <div class="mini-stat clearfix" >
                <span class="mini-stat-icon" style="background:crimson;"><i class="fa fa-chevron-up"></i></span>
                <div class="mini-stat-info" >
                <?php
                  $exec = "SELECT * FROM leads ";
                  if($_SESSION['role']=='BRH'){
                    $branch = getbranchbyid($_SESSION['user'], $connection);
                    $exec = $exec."WHERE branch='$branch'";
                  }
                  if($_SESSION['role']=='SAE'){
                    $id = $_SESSION['user'];
                    $exec = $exec."WHERE assignedto=$id";
                  }
                  $query = mysqli_query($connection, $exec);
                  $rows = mysqli_num_rows($query);
                ?>
                  <span><?php echo $rows; ?></span>
                  Total Leads
              </div>
            </div>
            </div>
            </div>
          <div class="row">
          <?php if($_SESSION['role']!='SAE'){ ?>
            <div class="col-md-6">
              <?php } else {?>
              <div class="col-md-12">
              <?php } ?>
              <section class="panel">
                  <div class="panel-body">
                    <div id="barChart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
                  </div>
              </section>
            </div>
            <div class="col-md-6">
              <?php if($_SESSION['role']!='SAE'){ ?>
              <section class="panel">
                <div class="panel-body">
                
                  <div id="branchChart" style="width:100%"></div>
                </div>
              </section>
              <?php } ?>
            </div>
          </div>
        </section>
 
        
    </section>
    <?php
      $ex = "SELECT * FROM users WHERE branch='$requiredbranch' ";
      if($_SESSION['role'] == 'SAE'){
        $id = $_SESSION['user'];
        $ex = $ex."AND userid='$id'";
      }
      $query = mysqli_query($connection, $ex);
      $totalemp = mysqli_num_rows($query);
      $emp = array($totalemp);
      $onumber = array($totalemp);

      for($i = 0 ; $i < $totalemp ; $i++){
          $result = mysqli_fetch_array($query);
          $emp[$i] = $result[1];
          $q = mysqli_query($connection, "SELECT * FROM leads WHERE assignedto='$result[0]' AND (status='New' OR status='Active')");
          $onumber[$i] = mysqli_num_rows($q);
      }
    ?>

    <script type="text/javascript">
    var emp = <?php echo json_encode($emp); ?>;
    var onumber = <?php echo json_encode($onumber); ?>;
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
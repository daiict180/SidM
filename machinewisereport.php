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
    <title>Machine Sales</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
        $('#button').click(function(){
              var branch = document.getElementById("branch").value;
              var year = document.getElementById("year").value;
              var machine = document.getElementById("machine").value;
            $.ajax({

                type: "GET",
                url: "getmachinewisereport.php",
                data: 'branch='+branch+'&year='+year+'&machine='+machine,
                success: function(msg){
                    $('#chart').html(msg);
                    
                }

            }); // Ajax Call
        }); //event handler
    }); //document.ready
   $(function () {
       $('#chart').highcharts({
           chart: {
               zoomType: 'xy'
           },
           title: {
               text: 'Machinewise Sales'
           },
           subtitle: {
               
           },
           xAxis: [{
               categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                   'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
                   text: 'Machines',
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
               name: machine,
               type: 'spline',
               data: machineresult,
               tooltip: {
                   valueSuffix: ''
               }
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
            <select class="form-control" id="branch">
              <optgroup label="">
              <?php
                $query = mysqli_query($connection, "SELECT * FROM branches");
                $rows = mysqli_num_rows($query);
                for($i = 0 ;$i <$rows ; $i++){
                  $result = mysqli_fetch_array($query);
                  if($i == 0)
                    $reqbranch = $result[1];
              ?>
                <option value="<?php echo $result[1]; ?>"><?php echo $result[1]; ?></option>
                <?php } ?>
              </optgroup>
            </select>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control" id="machine">
              <optgroup label="">
                <?php
                $query = mysqli_query($connection, "SELECT * FROM machines");
                $rows = mysqli_num_rows($query);
                for($i = 0 ;$i <$rows ; $i++){
                  $result = mysqli_fetch_array($query);
                  if($i == 0)
                    $reqmachine = $result[1];
              ?>
                <option value="<?php echo $result[1]; ?>"><?php echo $result[1]; ?></option>
                <?php } ?>
              </optgroup>
            </select>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="form-group">
            <select class="form-control" id="year">
              <optgroup label="">
                <?php
                $query = mysqli_query($connection, "SELECT YEAR(closingdate) FROM opportunities ORDER BY closingdate ASC");
                $rows = mysqli_num_rows($query);
                for($i = 0 ;$i <$rows ; $i++){
                  $result = mysqli_fetch_array($query);
                  if($i == 0)
                    $reqyear = $result[1];
              ?>
                <option value="<?php echo $result[0]; ?>"><?php echo $result[0]."-".($result[0]+1) ; ?></option>
                <?php } ?>
              </optgroup>
            </select>
          </div>
        </div>
   
      <div class="col-lg-2">
          <div class="form-group">
            <button class="btn btn-primary" id="button">Generate</button>
          </div>
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

<?php
$branch = $reqbranch;
$year = $reqyear;
$machine = $reqmachine;

$machineresult = array(12);
for($i = 0; $i < 12 ; $i++){
$m = $i+1;
$query = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$branch' AND productofinterest='$machine' AND YEAR(closingdate)='$year' AND MONTH(closingdate)='$m'");
$machineresult[$i] = mysqli_num_rows($query);
}
?>

<script type="text/javascript">
    var machineresult = <?php echo json_encode($machineresult); ?>;
    var machine = <?php echo json_encode($machine); ?>;
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
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
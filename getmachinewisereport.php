<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

$branch = $_GET['branch'];
$year = $_GET['year'];
$machine = $_GET['machine'];

$machineresult = array(12);
for($i = 0; $i < 12 ; $i++){
$m = $i+1;
$query = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$branch' AND productofinterest='$machine' AND YEAR(closingdate)='$year' AND MONTH(closingdate)='$m'");
$machineresult[$i] = mysqli_num_rows($query);
}

?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->
<script type="text/javascript">
    
    var machineresult = <?php echo json_encode($machineresult); ?>;
    var machine = <?php echo json_encode($machine); ?>;
    </script>

<script type="text/javascript">
        
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
        <div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


<?php require_once("includes/footer.php"); ?>

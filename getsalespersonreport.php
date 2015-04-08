<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

$branch = $_GET['branch'];
$year = $_GET['year'];
$employee = $_GET['employee'];

$months = array(12);

for($i = 0 ; $i < 12 ; $i++){
$m = ($i+1);
$query = mysqli_query($connection, "SELECT SUM(totalamount) FROM opportunities WHERE status='Order Received' AND assignedto='$employee' AND YEAR(closingdate)='$year' AND MONTH(closingdate)='$m'");
$r = mysqli_fetch_array($query);
$months[$i] = intval($r['SUM(totalamount)']);
}

?>

<script type="text/javascript">
      var months = <?php echo json_encode($months); ?>;
</script>

<script type="text/javascript">
 $(function () {
   $('#branchChart2').highcharts({
     chart: {
       type: 'column'
     },
     title: {
       text: 'Salesperson-wise Report'
     },
     xAxis: {
       categories: [
       'Jan',
       'Feb',
       'Mar',
       'Apr',
       'May',
       'Jun',
       'Jul',
       'Aug',
       'Sep',
       'Oct',
       'Nov',
       'Dec'
       ],
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
       name: 'Sales',
       data: months

     }]
   });
 });
</script>
<div id="branchChart2" style="width:100%"></div>

<?php require_once("includes/footer.php"); ?>
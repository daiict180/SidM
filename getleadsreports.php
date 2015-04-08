<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
$branch = $_GET['branch'];

$query = mysqli_query($connection, "SELECT * FROM users WHERE branch='$branch'");
$totalemp = mysqli_num_rows($query);
$emp = array($totalemp);
$onumber = array($totalemp);

for($i = 0 ; $i < $totalemp ; $i++){
    $result = mysqli_fetch_array($query);
    $emp[$i] = $result[1];
    $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE assignedto='$result[0]' AND (status='Initial' OR status='Quoted' OR status='Negotiated')");
    $onumber[$i] = mysqli_num_rows($q);
}


?>

<script type="text/javascript">
    var emp = <?php echo json_encode($emp); ?>;
    var onumber = <?php echo json_encode($onumber); ?>;

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
                       data: onumber
                   }]
               });
           });
</script>
<div id="barChart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<?php require_once("includes/footer.php"); ?>
<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php 
$branch = $_GET['branch']; 
$year = $_GET['year'];

$leads = array(12);

for($i = 0; $i <12 ; $i++){
	$m = $i+1;
	$query = mysqli_query($connection, "SELECT * FROM leads WHERE branch='$branch' AND YEAR(datetime)='$year' AND MONTH(datetime)='$m'");
	$leads[$i] = mysqli_num_rows($query);
}

$opportunities = array(12);

for($i = 0; $i <12 ; $i++){
	$m = $i+1;
	$query = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$branch' AND YEAR(createddate)='$year' AND MONTH(createddate)=$m");
	$opportunities[$i] = mysqli_num_rows($query);
}

?>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
<script type="text/javascript">
    var leads = <?php echo json_encode($leads); ?>;
    var opportunities = <?php echo json_encode($opportunities); ?>;
$(function () {
    $('#branchch').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Branchwise Chart'
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
            name: 'Opportunities',
            data: [Number(opportunities[0]),Number(opportunities[1]),Number(opportunities[2]),Number(opportunities[3]),Number(opportunities[4]),Number(opportunities[5]),Number(opportunities[6]),Number(opportunities[7]),Number(opportunities[8]),Number(opportunities[9]),Number(opportunities[10]),Number(opportunities[11])]
        }, {
            name: 'Leads',
            data: [Number(leads[0]), Number(leads[1]), Number(leads[2]), Number(leads[3]), Number(leads[4]), Number(leads[5]), Number(leads[6]), Number(leads[7]), Number(leads[8]), Number(leads[9]), Number(leads[10]), Number(leads[11])]
        }]
    });
});
     </script>


<div id="branchch" style="width:100%"></div>
<!-- <script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
 --><!-- <script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script> -->
<!-- <script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
 -->
<?php require_once("includes/footer.php"); ?>
<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if($_SESSION['role'] == 'SAE'){
  redirect_to("dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Sidharth Machinaries">
  <link rel="shortcut icon" href="images/favicon.html">
  <title>Branchwise Reports</title>
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
            $.ajax({

                type: "GET",
                url: "getbranchwisechart.php",
                data: 'branch='+branch+'&year='+year ,
                success: function(msg){
                    $('#branchChart').html(msg);
                    
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
            data: [opportunities[0],opportunities[1],opportunities[2],opportunities[3],opportunities[4],opportunities[5],opportunities[6],opportunities[7],opportunities[8],opportunities[9],opportunities[10],opportunities[11]]

        }, {
            name: 'Leads',
            data: [leads[0], leads[1], leads[2], leads[3], leads[4], leads[5], leads[6], leads[7], leads[8], leads[9], leads[10], leads[11]]

        }]
    });
});
     </script>
    <script>
        function show() {
                var branch = document.getElementById("branch").value;
              var year = document.getElementById("year").value;
            
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        //alert(xmlhttp.responseText);
                        document.getElementById("branchChart").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","getbranchwisechart.php?branch="+branch+"&year="+year,true);
                xmlhttp.send();
        }
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
                      $exec = "SELECT * FROM branches ";
                      if($_SESSION['role'] == 'BRH' || $_SESSION['role'] == 'SAE'){
                        $id = $_SESSION['user'];
                        $branch = getbranchbyid($id, $connection);
                        $exec = $exec."WHERE branchname='$branch'";
                      }
                      $query = mysqli_query($connection, $exec); 
                      $rows = mysqli_num_rows($query);
                      for($i=0; $i<$rows; $i++){
                        $result = mysqli_fetch_array($query);
                        if($i == 0)
                          $requiredbranch = $result[1];
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
              <?php $query = mysqli_query($connection, "SELECT DISTINCT YEAR(createddate) FROM opportunities ORDER BY YEAR(createddate) ASC"); 
                      $rows = mysqli_num_rows($query);
                      for($i=0; $i<$rows; $i++){
                        $result = mysqli_fetch_array($query);
                        if($i == 0)
                          $requiredyear = $result[0];
                ?>
                <option value="<?php echo $result[0]; ?>"><?php echo $result[0]."-".($result[0]+1); ?></option>
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
            <div class="panel-body" id="target">
              <div id="branchChart" style="width:100%"></div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </section>
</section>
<?php

$leads = array(12);

for($i = 0; $i <12 ; $i++){
  $m = $i+1;
  $query = mysqli_query($connection, "SELECT * FROM leads WHERE branch='$requiredbranch' AND YEAR(datetime)='$requiredyear' AND MONTH(datetime)='$m'");
  $leads[$i] = mysqli_num_rows($query);
}

$opportunities = array(12);

for($i = 0; $i <12 ; $i++){
  $m = $i+1;
  $query = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$requiredbranch' AND YEAR(createddate)='$requiredyear' AND MONTH(createddate)=$m");
  $opportunities[$i] = mysqli_num_rows($query);
}

?>

<script type="text/javascript">
    var leads = <?php echo json_encode($leads); ?>;
    var opportunities = <?php echo json_encode($opportunities); ?>;
</script>

<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script src="js/jquery.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<!-- <script src="js/easypiechart/jquery.easypiechart.js"></script> -->
<!--Sparkline Chart-->
<!-- <script src="js/sparkline/jquery.sparkline.js"></script> -->
<!--jQuery Flot Chart-->
<!--Chart JS-->
<!-- <script src="js/chart-js/Chart.js"></script>
<script src="js/chartjs.init.js"></script>
 morris chart js
<script src="js/morris-chart/morris.js"></script>
<script src="js/morris-chart/raphael-min.js"></script>
<script src="js/morris.init.js"></script> -->
<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--script for this page-->

</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
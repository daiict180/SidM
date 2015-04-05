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
    <title>Sales report</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!-- <link href="js/c3-chart/c3.css" rel="stylesheet"/> -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

      <?php
          $query = mysqli_query($connection, "SELECT * FROM branches");
          $totalbranches = mysqli_num_rows($query);
          $branches = array($totalbranches);
          $branchsale = array($totalbranches);

          for($i = 0 ;$i < $totalbranches ; $i++){
            $result = mysqli_fetch_array($query);
            $branches[$i] = $result[1];
            $q = mysqli_query($connection, "SELECT SUM(totalamount) FROM opportunities WHERE branch='$result[1]' AND status = 'Order Received'");
            $r = mysqli_fetch_array($q);
            if($r['SUM(totalamount)'] == 0)
              $branchsale[$i] = 0 ;
            else
              $branchsale[$i] = intval($r['SUM(totalamount)']);
          }

      ?>
    <script type="text/javascript">
          var branches = <?php echo json_encode($branches); ?>;
          var branchs = <?php echo json_encode($branchsale); ?>;

    $(document).ready(function() {
        $('#button1').click(function(){
              var branch1 = document.getElementById("branch1").value;
              var year1 = document.getElementById("year1").value;
            $.ajax({

                type: "GET",
                url: "getbranchwisemonthlysales.php",
                data: 'branch='+branch1+'&year='+year1 ,
                success: function(msg){
                    $('#branchChart').html(msg);
                }

            }); // Ajax Call
        }); //event handler
        $('#button2').click(function(){
              var branch2 = document.getElementById("branch2").value;
              var year2 = document.getElementById("year2").value;
              var employee = document.getElementById("employee").value;
            $.ajax({

                type: "GET",
                url: "getsalespersonreport.php",
                data: 'branch='+branch2+'&year='+year2+'&employee='+employee,
                success: function(msg){
                    $('#branchChart2').html(msg);
                }

            }); // Ajax Call
        }); //event handler
        $('#branch2').change(function(){
              var branch2 = document.getElementById("branch2").value;
              // var year2 = document.getElementById("year2").value;
              // var employee = document.getElementById("employee").value;
            $.ajax({

                type: "GET",
                url: "getemployees.php",
                data: 'branch='+branch2,
                success: function(msg){
                    $('#target').html(msg);
                    
                }

            }); // Ajax Call
        }); //event handler
    }); //document.ready
     
      $(function () {
               $('#branchReport').highcharts({
                   chart: {
                       type: 'bar'
                   },
                   title: {
                       text: 'Branchwise Sales'
                   },
                   xAxis: {
                       categories: branches
                   },
                   yAxis: {
                       min: 0,
                       title: {
                           text: 'Total Sales'
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
                       name: 'Sales',
                       data: branchs
                   }]
               });
           });
      $(function () {
       $('#branchChart').highcharts({
         chart: {
           type: 'column'
         },
         title: {
           text: 'Branchwise Monthly Sales'
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
           data: monthsales

         }]
       });
});
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
</head>
<?php include("includes/sidebar.php"); ?>
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-md-3">
            <div class="mini-stat clearfix">
             <span class="mini-stat-icon" style="background:crimson"><i class="fa fa-chevron-up"></i></span>
             <div class="mini-stat-info">
             <?php
                $query = mysqli_query($connection, "SELECT * FROM opportunities WHERE status='Order Received'");
                $machinessold = mysqli_num_rows($query);
                $query2 = mysqli_query($connection, "SELECT SUM(totalamount) FROM opportunities WHERE status='Order Received'");
                $r = mysqli_fetch_array($query2);
                $moneyearned = $r['SUM(totalamount)'];
             ?>
              <span><?php echo $machinessold; ?></span>
              Total machines sold
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="mini-stat clearfix">
            <span class="mini-stat-icon" style="background:#A9D86E;"><i class="fa fa-rupee"></i></span>
            <div class="mini-stat-info">
              <span><?php echo $moneyearned; ?></span>
              Total money earned
            </div>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
        <section class="panel">
          <div class="panel-body">
            <div id="branchReport" style="width:100%"></div>
          </div>
        </section>
      </div>
    </div>
      <div class="row">
        <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-4">
         <div class="form-group">
          <select class="form-control" id="branch1">
            <optgroup label="">
            <?php $query = mysqli_query($connection, "SELECT * FROM branches"); 
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
      <div class="col-lg-4">
        <div class="form-group">
          <select class="form-control" id="year1">
            <optgroup label="">
              <?php $query = mysqli_query($connection, "SELECT DISTINCT YEAR(closingdate) FROM opportunities ORDER BY YEAR(closingdate) ASC"); 
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
        </div>
        
      <div class="row">
      <div class="col-lg-2">
          <div class="form-group">
            <button class="btn btn-primary" id="button1">Generate</button>
          </div>
      </div>
      <?php

          $branch = $requiredbranch;
          $year = $requiredyear;
          $monthsales = array(12);

          for($i = 0 ; $i < 12 ; $i++){
          $m = ($i+1);
          $query = mysqli_query($connection, "SELECT SUM(totalamount) FROM opportunities WHERE status='Order Received' AND branch='$branch' AND YEAR(closingdate)='$year' AND MONTH(closingdate)='$m'");
          $r = mysqli_fetch_array($query);
          $monthsales[$i] = intval($r['SUM(totalamount)']);
          }

      ?>

          <script type="text/javascript">
                    var monthsales = <?php echo json_encode($monthsales); ?>;
          </script>
      </div>
      <div class="row">
      <div class="col-md-12">
        <section class="panel">
          <div class="panel-body">
            <div id="branchChart" style="width:100%"></div>
          </div>
        </section>
      </div>
    </div>
    </div>
    <div class="col-lg-6">
    <div class="row">
    <div class="col-lg-4">
       <div class="form-group">
        <select class="form-control" id="branch2">
          <optgroup label="">
            <?php $query = mysqli_query($connection, "SELECT * FROM branches"); 
                      $rows = mysqli_num_rows($query);
                      for($i=0; $i<$rows; $i++){
                        $result = mysqli_fetch_array($query);
                        if($i == 0)
                          $rbranch = $result[1];
                ?>
                <option value="<?php echo $result[1]; ?>"><?php echo $result[1]; ?></option>
                <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
          <div class="col-lg-4">
      <div class="form-group" id="target">
        <select class="form-control" id="employee">
          <optgroup label="">
            <?php
                  $query = mysqli_query($connection, "SELECT * FROM users WHERE branch='$branch'");
                  $rows = mysqli_num_rows($query);
                  for($i = 0; $i < $rows ; $i++){
                      $result = mysqli_fetch_array($query);
                      if($i == 0)
                          $ruser = $result['userid'];
              ?>
                  <option value="<?php echo $result['userid'] ; ?>"> <?php echo $result['fullname'] ; ?></option>
              <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <select class="form-control" id="year2">
          <optgroup label="">
            <?php $query = mysqli_query($connection, "SELECT DISTINCT YEAR(createddate) FROM opportunities ORDER BY YEAR(createddate) ASC"); 
                      $rows = mysqli_num_rows($query);
                      for($i=0; $i<$rows; $i++){
                        $result = mysqli_fetch_array($query);
                        if($i == 0)
                          $ryear = $result[0];
                ?>
                <option value="<?php echo $result[0]; ?>"><?php echo $result[0]."-".($result[0]+1); ?></option>
                <?php } ?>
          </optgroup>
        </select>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-lg-2">
          <div class="form-group">
            <button class="btn btn-primary" id="button2">Generate</button>
          </div>
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <section class="panel">
          <div class="panel-body">
            <div id="branchChart2" style="width:100%"></div>
          </div>
        </section>
      </div>
    </div>
    </div>
    </div>
    <?php

        $branch = $rbranch;
        $year = $ryear;
        $employee = $ruser;

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
    <!-- <div class="row">
      <div class="col-md-12">
        <section class="panel">
          <div class="panel-body">
            <div id="branchChart" style="width:100%"></div>
          </div>
        </section>
      </div>
    </div> -->
    <!-- <div class="row">
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
    </div> -->
<!--     <div class="col-lg-2">
      <div class="form-group">
        <select class="form-control" id="source">
          <optgroup label="">
            <option value="CT">Employee 1</option>
            <option value="DE">Employee 2</option>
            <option value="FL">Employee 3</option>
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
    </div> -->
  


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
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<!--Chart JS-->
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<!--script for this page-->
<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
<!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>

<?php require_once("includes/footer.php"); ?>
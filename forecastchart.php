<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php
$days = 7;
if(isset($_POST['days']) && isset($_POST['branch'])){
  $days = $_POST['days'];
  $branch = $_POST['branch'];
}

?>

  <!DOCTYPE html>
  <html lang="en">

  <!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:06 GMT -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Sidharth Machinaries">
    <link rel="shortcut icon" href="images/favicon.html">
    <title>Forecast</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link href="js/c3-chart/c3.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
    <script type="text/javascript">
    $(document).ready(function() {
        $('#button').click(function(){
              var days = document.getElementById("days").value;
              //var year = document.getElementById("year").value;
            $.ajax({

                type: "GET",
                url: "getexceptionreports.php",
                data: 'days='+days,
                success: function(msg){
                    $('#target').html(msg);
                    
                }

            }); // Ajax Call
        }); //event handler
    }); //document.ready
  </script>
  </head>
  
 <?php include("includes/sidebar.php"); ?>
      <section id="main-content">
        <section class="wrapper">
          
           <div class="row">
            <div class="col-md-6">
            <section class="panel">
            <div class="panel-body">
            <form method="post" href="#" role="form" class="form-inline">
                     <div class="form-group">
                         <input type="text" name="days" class="form-control" id = "days" placeholder="Enter the number of days">
                     </div>
                     <div class="form-group">
                        <select class="form-control" id="branch1" name="branch">
                <optgroup label="">
                  <?php
                $query = mysqli_query($connection, "SELECT * FROM branches");
                $rows = mysqli_num_rows($query);
                for($i = 0 ;$i <$rows ; $i++){
                  $result = mysqli_fetch_array($query);
                  if($i == 0)
                    $reqbranch = $result[1];
              ?>
                <option value="<?php echo $result[1]; ?>" <?php if(isset($branch) && $branch==$result[1]) {echo "selected";} ?> ><?php echo $result[1]; ?></option>
                <?php } ?>
                </optgroup>
              </select>        
                      </div>     
            <button type="submit" class="btn btn-primary">GO!</button>
            </form>  
            </div>
            </section>
            
              
            
          </div>
          </div>
          <?php

            
            $query = mysqli_query($connection, "SELECT DISTINCT lead FROM calls WHERE 'calldate' >= DATE_SUB(CURDATE(), INTERVAL $days DAY)");
            $result = mysqli_num_rows($query);
            $query2 = mysqli_query($connection, "SELECT DISTINCT opportunity FROM calls WHERE 'calldate' >= DATE_SUB(CURDATE(), INTERVAL $days DAY)");
            $result2 = mysqli_num_rows($query2);
          ?>

          <!-- <div class="row" id="target">
            <div class="col-md-6">
                <div class="mini-stat clearfix" style="padding-top: 36px;">
                  <span class="mini-stat-icon" style="background:blue;"><i class="fa fa-chevron-down"></i></span>
                  <div class="mini-stat-info" style="margin-bottom: 27px;">
                    <span><?php //echo $result; ?></span>
                    Leads not contacted in last <?php //echo $days; ?> days
                  </div>
              </div>
                 
            </div>
            <div class="col-md-6">
                <div class="mini-stat clearfix" style="padding-top: 36px;">
                  <span class="mini-stat-icon" style="background:crimson;"><i class="fa fa-chevron-down"></i></span>
                  <div class="mini-stat-info" style="margin-bottom: 27px;">
                    <span><?php //echo $result2; ?></span>
                    Opportunities not contacted in last <?php// echo $days; ?> days
                  </div>
                </div>
                
              </div>
          </div> -->
          <div class="row">
            <div class="col-lg-12">
            <section class="panel">
            <header class="panel-heading">
                <p class="text-muted"><h4>
                    Forecast Bar for next <?php echo $days; ?> days
                  </h4></p>
            </header>
            <?php
              if(!isset($branch))
                $branch = $reqbranch;
              $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$branch' AND stage='Hot' AND closingdate <= DATE_SUB(CURDATE(), INTERVAL -'$days' DAY) AND closingdate >= CURDATE()");
              $hot = mysqli_num_rows($q);
              $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$branch' AND stage='Cold' AND closingdate <= DATE_SUB(CURDATE(), INTERVAL -'$days' DAY) AND closingdate >= CURDATE()");
              $cold = mysqli_num_rows($q);
              $q = mysqli_query($connection, "SELECT * FROM opportunities WHERE branch='$branch' AND stage='Warm' AND closingdate <= DATE_SUB(CURDATE(), INTERVAL -'$days' DAY) AND closingdate >= CURDATE()");
              $warm = mysqli_num_rows($q);
            ?>
            <div  class="panel-body">
                  <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-success" style="width: <?php echo $cold.'%'; ?>" data-toggle="tooltip" data-placement="bottom" title="Cold opportunities = 35">
                      <span class="sr-only">35% Complete (success)</span>
                    </div>
                    <div class="progress-bar progress-bar-warning" style="width: <?php echo $warm.'%' ; ?>" data-toggle="tooltip" data-placement="bottom" title="Warm opportunities = 35">
                      <span class="sr-only">20% Complete (warning)</span>
                    </div>
                    <div class="progress-bar progress-bar-danger" style="width: <?php echo $hot.'%' ; ?>" data-toggle="tooltip" data-placement="bottom" title="Hot opportunities = 35">
                      <span class="sr-only">10% Complete (danger)</span>
                    </div>
                  </div>
            </div>
                  </section>
                  </div>
          </div>
          </section>
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
  <!--Chart JS-->
  <!-- morris chart js -->

  <!--clock init-->
  <!--Chart JS-->


<script type="text/javascript">
      var result = <?php echo json_encode($result); ?>;
      var result2 = <?php echo json_encode($result2); ?>;
</script>

  <!--clock init-->
  <!--common script init for all pages-->
  <script src="js/scripts.js"></script>
  <!--script for this page-->

  <script type="text/javascript">
    $( document ).ready(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
  </script>

</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
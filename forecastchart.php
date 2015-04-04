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
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
 <div class="col-lg-6" style="margin-top:9%%">
 <!--tab nav start-->
 <section class="panel" style="width:213%">
     <header class="panel-heading tab-bg-dark-navy-blue ">
         <ul class="nav nav-tabs">
             <li class="active">
                 <a data-toggle="tab" href="#home">Home</a>
             </li>
             <li class="">
                 <a data-toggle="tab" href="#about">About</a>
             </li>
             <li class="">
                 <a data-toggle="tab" href="#profile">Profile</a>
             </li>
             <li class="">
                 <a data-toggle="tab" href="#contact">Contact</a>
             </li>
         </ul>
     </header>
     <div class="panel-body">
         <div class="tab-content">
             <div id="home" class="tab-pane active">
                <p class="text-muted">
                    Forecast Bar for next 15 days
                </p>
                <div class="progress progress-sm">
                    <div class="progress-bar progress-bar-success" style="width: 35%" data-toggle="tooltip" data-placement="bottom" title="Cold opportunities = 35">
                        <span class="sr-only">35% Complete (success)</span>
                    </div>
                    <div class="progress-bar progress-bar-warning" style="width: 20%" data-toggle="tooltip" data-placement="bottom" title="Warm opportunities = 35">
                        <span class="sr-only">20% Complete (warning)</span>
                    </div>
                    <div class="progress-bar progress-bar-danger" style="width: 10%" data-toggle="tooltip" data-placement="bottom" title="Hot opportunities = 35">
                        <span class="sr-only">10% Complete (danger)</span>
                    </div>
                </div> 
             </div>
             <div id="about" class="tab-pane">About</div>
             <div id="profile" class="tab-pane">Profile</div>
             <div id="contact" class="tab-pane">Contact</div>
         </div>
     </div>



  </section>
  <form method="post" style="margin-top:40%;margin-right:-80%">
    <input type="text" class="form-control" style="margin-left:74.7%;width:26%;margin-top:-1%" placeholder="Discount amount">
    <button type="submit" class="btn btn-default" style="margin-left:102%;margin-top:-5.7%;width:9.85%">Go!</button>
  </form>
  <form method="post" style="margin-top:-10%;margin-right:16%">
    <input type="text" class="form-control" style="margin-left:74.7%;width:55%;margin-top:1%" placeholder="Enter the number of days">
    <button type="submit" class="btn btn-default" style="margin-left:133%;margin-top:-12.7%;width:21.5%">Go!</button>
  </form>
  <form method="post" style="margin-top: -10%;width: 45%;margin-right: 40%;margin-left: -42.7%;">
    <input type="text" class="form-control" style="margin-left:74.7%;width:100%;margin-top:-1%" placeholder="Enter the number of days">
    <button type="submit" class="btn btn-default" style="margin-left:181%;margin-top:-23.7%;width:41.85%">Go!</button>
  </form>

</div>

                <div class="col-md-6" style="margin-left:-52.8%;width:42%;margin-top:27%">
                      <div class="row" style="margin-right: 0px;width:80%;">
                          <div class="mini-stat clearfix" style="padding-top: 36px;">
                          <span class="mini-stat-icon" style="background:blue;"><i class="fa fa-chevron-down"></i></span>
                              <div class="mini-stat-info" style="margin-bottom: 27px;">
                                  <span>12</span>
                                  Leads not contacted in last X days
                              </div>
                          </div>
                      </div>
                      <div class="row" style="margin-right: 0px;width:80%;margin-left:83%;margin-top:-35.7%">
                          <div class="mini-stat clearfix" style="padding-top: 36px;">
                          <span class="mini-stat-icon" style="background:crimson;"><i class="fa fa-chevron-down"></i></span>
                              <div class="mini-stat-info" style="margin-bottom: 27px;">
                                  <span>16</span>
                                  Leads not contacted in last X days
                              </div>
                          </div>
                      </div>
                      <div class="row" style="margin-right: 0px;width:80%;margin-left:169%;margin-top:-35.7%">
                          <div class="mini-stat clearfix" style="padding-top: 36px;">
                          <span class="mini-stat-icon" style="background:orange;"><i class="fa fa-chevron-down"></i></span>
                              <div class="mini-stat-info" style="margin-bottom: 27px;">
                                  <span>19</span>
                                  Leads not contacted in last X days
                              </div>
                          </div>
                      </div>
                  </div>
            </div>
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
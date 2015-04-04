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
    <title>Routes</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="js/select2/select2.css" />

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false"></script>
    <script>
    var map;
    var locations = [{cname: "abc", lat:23.19, lon:72.63, place:"Infocity, Gandhinagar, India"}, 
                    {cname: "xyz",lat:23.02, lon:72.57, place:"Ahmedabad, India"}, 
                    {cname: "qwer", lat:21.17, lon:72.83, place:"Surat, India"}];
    
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    function initialize() {
      directionsDisplay = new google.maps.DirectionsRenderer();
      var abad = new google.maps.LatLng(23.02, 72.57);
      var mapOptions = {
        zoom: 6,
        center: abad
      }
      map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
      directionsDisplay.setMap(map);
    }
    function calcRoute() {
      var start = 'Baroda, Gujarat, India';
      var end = 'Baroda, Gujarat, India';
      var waypts = [];
      var checkboxArray = document.getElementById('e9');
      if(checkboxArray.selectedIndex >= 0) {
          for (var i = 0; i < checkboxArray.length; i++) {
            if (checkboxArray.options[i].selected == true) {
              waypts.push({
                  location:/*locations[Number(checkboxArray[i].value)].cname+"<br>"+*/locations[Number(checkboxArray[i].value)].place,
                  stopover:true});
            }
          }

          var request = {
              origin: start,
              destination: end,
              waypoints: waypts,
              optimizeWaypoints: true,
              travelMode: google.maps.TravelMode.DRIVING
          };

          directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
              var route = response.routes[0];
              var summaryPanel = document.getElementById('directions_panel');
              summaryPanel.innerHTML = '';
              // For each route, display summary information.

              for (var i = 0; i < route.legs.length; i++) {
                var routeSegment = i + 1;
                summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                summaryPanel.innerHTML += '<b>'+route.legs[i].start_address+'</b>' + ' to ';
                summaryPanel.innerHTML += '<b>'+route.legs[i].end_address+'</b>' + '<br>';
                summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
              }
            }
          });  
      }
       else {
         initialize();
         var summaryPanel = document.getElementById('directions_panel');
         summaryPanel.innerHTML = '';
       }
      
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<?php include("includes/sidebar.php"); ?>
<section id="main-content">
        <section class="wrapper">
            <!-- page start-->
            <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h4>Generate Route</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <div class="form-inline">
                            <div class="form-group">
                                <label>Select Companies To Visit</label>
                            </div> 
                            <div class="form-group">
                                <select multiple name="e9" id="e9" style="width:300px" class="populate">
                                <option value="0">abc</option>
                                <option value="1">xyz</option>
                                <option value="2">qwer</option>
                                <!-- <option value="3">qwsdaer</option>
                                <option value="4">asdqwer</option>
                                <option value="5">qwgher</option>
                                <option value="6">qweytr</option>
                                <option value="7">qzxcwer</option> -->

                            </select>
                            </div>
                            <button class="btn btn-success" onclick="calcRoute();">Show Route</button>
                        </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <div class="row">
            
            <div class="col-sm-6">
                <section class="panel">
                    <!-- <header class="panel-heading">
                        Clients Within Proximity
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header> -->
                    <div class="panel-body">

                        <div id="googleMap" style="height:380px;"></div>

                    </div>
                </section>
            </div>
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Route Details
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div id="directions_panel" style="background-color:#FFEE77;"></div>
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

<!--clock init-->
<script src="js/select2/select2.js"></script>
<script src="js/select-init.js"></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
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
    <title>Clients</title>
    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <script src="http://maps.google.com/maps?file=api&v=3&key=AIzaSyBfgel079s6ly4yusiUhn-K9MfCmPlzWoM" type="text/javascript"></script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <?php
        $query = mysqli_query($connection, "SELECT * FROM companies");
        $totalcompany = intval(mysqli_num_rows($query));
        $companies = array($totalcompany);
        $latitudes = array($totalcompany);
        $longitudes = array($totalcompany);
        $address = array($totalcompany);
        for($i = 0 ; $i < $totalcompany ; $i++){
            $result = mysqli_fetch_array($query);
            $companies[$i] = $result[1];
            $latitudes[$i] = $result[21];
            $longitudes[$i] = $result[22];
            $address[$i] = $result[3].$result[4].$result[5].$result[7];
        }

    ?>
    <script>
        var companies = <?php echo json_encode($companies); ?>;
        var latitudes = <?php echo json_encode($latitudes); ?>;
        var longitudes = <?php echo json_encode($longitudes); ?>;
        var address = <?php echo json_encode($address); ?>;
        var l = <?php echo json_encode($totalcompany); ?>;

        // var locations = [{cname: "abc", lat:23.19, lon:72.63, place:"Infocity, Gandhinagar, India"}, 
        //             {cname: "xyz",lat:23.02, lon:72.57, place:"Ahmedabad, India"}, 
        //             {cname: "qwer", lat:21.17, lon:72.83, place:"Surat, India"}];
        //              alert(locations[0].cname);
       
        var locations = [];
        //var len = oFullResponse.results.length;
        for (var i = 0; i < l; i++) {
            locations.push({
                cname: companies[i],
                lat: latitudes[i],
                lon: longitudes[i],
                place: address[i]
            });
        }
    var map;
    
    function calculateDistance(location1, location2) {
        try {
            var glatlng1 = new GLatLng(locations[location1].lat, locations[location1].lon);
            var glatlng2 = new GLatLng(locations[location2].lat, locations[location2].lon);
            var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);
            var kmdistance = (miledistance * 1.609344).toFixed(1);
            return kmdistance;    
        }
        catch(error) {
            alert(error);
        }
        
    }
    function proximity() {
        var proximityDistance = Number(document.getElementById("distance").value);
        var company = document.getElementById("company").value;
        console.log("pd="+proximityDistance);
        console.log("sc="+company);
        if(proximityDistance > 0) {
            var myCenter = new google.maps.LatLng(locations[company].lat, locations[company].lon);
            var mapProp = {
            center:myCenter,
            zoom:5,
            mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            for (i = 0; i < locations.length; i++) {
                var distance = calculateDistance(Number(company), i);
                console.log("d"+i+" "+company+"="+distance);
                if(distance <= proximityDistance) {
                    console.log("true");
                    initializeMap(i);
                }
            }    
        }
        
    }
    function initializeMap(address) {

        var point = new google.maps.LatLng(locations[address].lat,locations[address].lon);
        
        var marker=new google.maps.Marker({position:point,});
        marker.setMap(map);
        var infowindow = new google.maps.InfoWindow({
            content:locations[address].cname+"<br>"+locations[address].place
            });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
             
    }

    function initialize() {
        
        
        //var latlong = getlatlng(address); 
        //alert(latlong[0]+"     "+latlong[1]);
        var myCenter = new google.maps.LatLng(21,78);
        var mapProp = {
        center:myCenter,
        zoom:4,
        mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        initializeMap(0);    
        
        initializeMap(1);
        
        initializeMap(2);
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
                        <h4>Clients Within Proximity</h4>
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <div class="form-inline">
                            <div class="form-group">
                                <label>Select Company</label>
                            </div> 
                            <div class="form-group">
                                <select class="form-control" id="company" placeholder="Select Company">
                                <?php
                                $query = mysqli_query($connection, "SELECT * FROM companies");
                                $rows = mysqli_num_rows($query);
                                for($i=0; $i <$rows ; $i++){
                                    $result = mysqli_fetch_array($query);
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $result[1]; ?></option>
                                <?php } ?>
                            </select>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="distance">Distance</label>
                                <input class="form-control" id="distance" placeholder="Enter Distance in Kms" required>
                            </div>
                            <button class="btn btn-success" onclick="proximity()">Show</button>
                        </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
            <div class="row">
            <div class="col-sm-12">
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
        </div>
            
        </section>
    </section>
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<script type="text/javascript">
    
</script>
<script src="js/jquery.js"></script>
<script src="js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->

<!--clock init-->
<!--common script init for all pages-->
<script src="js/scripts.js"></script>
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
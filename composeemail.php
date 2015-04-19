<?php session_start(); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/checksession.php"); ?>

<?php

if(isset($_POST['submit'])){
    $execute = "SELECT * FROM companies WHERE companyid!=0 ";
    if(isset($_POST['type']) && $_POST['type'] != ''){
        $type = $_POST['type'];
        $execute = $execute."AND type='$type' ";
    }
    if(isset($_POST['branch']) && $_POST['branch'] != ''){
        $branch = $_POST['branch'];
        $execute = $execute."AND branch='$branch' ";
    }
    if(isset($_POST['city']) && $_POST['city'] != ''){
        $city = $_POST['city'];
        $execute = $execute."AND city='$city' ";
    }
    if(isset($_POST['state']) && $_POST['state'] != ''){
        $state = $_POST['state'];
        $execute = $execute."AND state='$state' ";
    }
    if(isset($_POST['status']) && $_POST['status'] != ''){
        $status = $_POST['status'];
        if($status = 'Active Leads Only')
            $execute = $execute."AND companyid=(SELECT customer FROM opportunities WHERE status='Initial' OR status='Quoted' OR status='Negotiation')";
        if($status = 'Active Opportunities Only')
            $execute = $execute."AND companyid=(SELECT customer FROM leads WHERE status='New' OR status='Active')";
    }
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
        <title>Compose Email</title>
        <!--Core CSS -->
        <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!--icheck-->
        <link href="js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

        <!-- Custom styles for this template -->
        <link href="css/style1.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />
        
    </head>
    <?php include("includes/sidebar.php"); ?>
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->
                    <form method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                      <select class="form-control" id="source" name="type">
                                        <optgroup label="">
                                          <option value="">Select Type</option>
                                          <option value="Leads">Leads</option>
                                          <option value="Prospect">Prospect</option>
                                          <option value="Our Machine Holder">Our Machine Holder</option>
                                      </optgroup>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <select class="form-control" id="source" name="status">
                                    <optgroup label="">
                                      <option value="">Select Status</option>
                                      <option value="Active Leads Only">Active Leads Only</option>
                                      <option value="Active Opportunities Only">Active Opportunities Only</option>
                                  </optgroup>
                              </select>
                          </div>
                          <div class="form-group">
                              <select class="form-control" id="source" name="branch">
                                <optgroup label="">
                                  <option value="">Select Branch</option>
                                  <?php
                                    $query = mysqli_query($connection, "SELECT * FROM branches");
                                    $rows = mysqli_num_rows($query);
                                    for($i = 0 ; $i < $rows ; $i++){
                                        $result = mysqli_fetch_array($query);
                                  ?>
                                  <option value="<?php echo $result[1]; ?>"><?php echo $result[1]; ?></option>
                                  <?php } ?>
                              </optgroup>
                          </select>
                      </div>
                      <div class="form-group">
                          <select class="form-control" id="source">
                            <optgroup label="">
                              <option value="">Select City</option>
                              <?php
                                    $query = mysqli_query($connection, "SELECT DISTINCT city FROM companies");
                                    $rows = mysqli_num_rows($query);
                                    for($i = 0 ; $i < $rows ; $i++){
                                        $result = mysqli_fetch_array($query);
                                  ?>
                                  <option value="<?php echo $result[0]; ?>"><?php echo $result[0]; ?></option>
                                  <?php } ?>
                          </optgroup>
                      </select>
                  </div>
                  <div class="form-group">
                      <select class="form-control" id="source">
                        <optgroup label="">
                          <option value="">Select State</option>
                          <?php
                                    $query = mysqli_query($connection, "SELECT DISTINCT state FROM companies");
                                    $rows = mysqli_num_rows($query);
                                    for($i = 0 ; $i < $rows ; $i++){
                                        $result = mysqli_fetch_array($query);
                                  ?>
                                  <option value="<?php echo $result[0]; ?>"><?php echo $result[0]; ?></option>
                                  <?php } ?>
                      </optgroup>
                  </select>
              </div>
              <div class="col-lg-3">

              </div>
              <div class="col-lg-2">

                <button type="submit" name="submit" class="btn btn-primary">Show</button>
            </div>
            </form>
                                   <!--  <li><a href="#"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                                    <li><a href="#"> <i class="fa fa-certificate"></i> Important</a></li>
                                    <li><a href="#"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-info pull-right inbox-notification">123</span></a></a></li>
                                    <li><a href="#"> <i class="fa fa-trash-o"></i> Trash</a></li> -->
                                </ul>
                            </div>
                        </section>
                        <?php if(isset($execute)){ ?>
                        <section class="panel">
                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked labels-info "  style="overflow-y:scroll;max-height:300px">
                                    <li> <h4>Contacts</h4> </li>
                                    <?php
                                        $query = mysqli_query($connection, $execute);
                                        $rows = mysqli_num_rows($query);
                                        for($i=0; $i<$rows ; $i++){
                                            $result = mysqli_fetch_array($query);
                                    ?>
                                    <li>  
                                        <div class="checkbox single-row">
                                            <input id="<?php echo $i ; ?>" value="<?php echo $result['email']; ?>" type="checkbox">
                                            <label><?php echo $result['companyname']; ?></label>
                                        </div>
                                    </li>
                                    <?php } ?>
                                    <script type="text/javascript">
                                        var len = <?php echo json_encode($rows); ?>;        
                                    </script>
                                </ul>
                            </div>
                        </section>
                        <?php } ?>
                    </div>
                    <div class="col-sm-9">
                        <section class="panel">
                            <header class="panel-heading wht-bg">
                               <h4 class="gen-case"> Compose Mail

                               </h4>
                           </header>
                           <div class="panel-body">

                            <div class="compose-mail">
                                <!-- <form role="form-horizontal" method="post"> -->
                                    

                                    <div class="form-group hidden">
                                        <label for="cc" class="">Cc:</label>
                                        <input type="text" tabindex="2" id="cc" class="form-control">
                                    </div>

                                    <div class="form-group hidden">
                                        <label for="bcc" class="">Bcc:</label>
                                        <input type="text" tabindex="2" id="bcc" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="subject" class="">Subject:</label>
                                        <input type="text" tabindex="1" id="subject" class="form-control">
                                    </div>

                                    <div class="compose-editor">
                                        <textarea class="wysihtml5 form-control" rows="9" id = "editor"></textarea>
                                        <input type="file" id="inputFileToLoad" class="default" onchange="loadImageFileAsURL()">
                                    </div>
                                    <div class="compose-btn">
                                        <button type="button" class="btn btn-primary btn-sm" onclick="sendmail()"><i class="fa fa-check"></i> Send</button>
                                        <button HTTP-EQUIV="refresh" class="btn btn-sm"><i class="fa fa-times"></i> Discard</button>
                                    </div>

                                <!-- </form> -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </section>

    </section>
    <script type="text/javascript" src="https://mandrillapp.com/api/docs/js/mandrill.js"></script>
    <script type="text/javascript">
    var attachment=false;
    var type;
    var content;
    var filename;
    function loadImageFileAsURL()
    {
        filename = document.getElementById("inputFileToLoad").files[0].name;
        var filesSelected = document.getElementById("inputFileToLoad").files;
        if (filesSelected.length > 0)
        {
            attachment = true;
            var fileToLoad = filesSelected[0];

            var fileReader = new FileReader();
           
            fileReader.onload = function(fileLoadedEvent) 
            {
               // alert("yah");

                var encode =  fileLoadedEvent.target.result;
                var data = encode.split(";");
                type = data[0].split(":")[1];
                content = data[1].split(",")[1];
                     
            };

            fileReader.readAsDataURL(fileToLoad);
        }
    }
    function sendmail() {
        emailjson = [];
        //alert("here"); 
        for(i = 0; i < len; i++) {
            if(document.getElementById(i)) {
                if(document.getElementById(i).checked == true) {
                item = {}
                item["email"] = document.getElementById(i).value;
                emailjson.push(item); 
                }    
            }
            
        }
        var m = new mandrill.Mandrill('lzMg5wTxhG_ZfWJRGuuiGQ');
       
        if(attachment) {

            var params = {
            "message": {
                "from_email":"siddharthMachines@gmail.com",
                "to": emailjson,
                "subject": document.getElementById("subject").value,
                "text": document.getElementById("editor").value,
                "attachments": [
                    {
                        "type": type,
                        "name": filename,
                        "content": content
                    }
                ]
            }
        };    
        }
        else {
            var params = {
            "message": {
                "from_email":"siddharth@gmail.com",
                "to": emailjson,
                "subject": document.getElementById("subject").value,
                "html": document.getElementById("editor").value
                
            }
        };
        }
        
        m.messages.send(params, function(res) {
                var result = JSON.stringify(res[0]["status"]);
                //alert(result);
               if(result == "\"sent\"" || result == "\"queued\"") {
                    alert("Mail Sent.");
                   window.location="composeemail.php";                
                 }
                 else
                   alert("Mail cannot be sent.");
                
                //alert(res);
    // window.location="dashboard.php";

            }, function(err) {
                console.log(JSON.stringify(err));
        });


    }
    </script>
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <script src="js/jquery.js"></script>
    <script src="bs3/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <!--Easy Pie Chart-->
    <script src="js/easypiechart/jquery.easypiechart.js"></script>
    <!--Sparkline Chart-->
    <script src="js/sparkline/jquery.sparkline.js"></script>
    <!--jQuery Flot Chart-->
    <script type="text/javascript" src="js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
    <script type="text/javascript" src="js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

    <!-- // <script src="js/flot-chart/jquery.flot.js"></script> -->
    <!-- // <script src="js/flot-chart/jquery.flot.tooltip.min.js"></script> -->
    <!-- <script src="js/flot-chart/jquery.flot.resize.js"></script>
    <script src="js/flot-chart/jquery.flot.pie.resize.js"></script> -->


    <script src="js/iCheck/jquery.icheck.js"></script>

    <!--common script init for all pages-->
    <script src="js/scripts.js"></script>

    <!--icheck init -->
    <script src="js/icheck-init.js"></script>

    <script type="text/javascript">
        //wysihtml5 start

        $('.wysihtml5').wysihtml5();

        //wysihtml5 end
    </script>
    <!--script for this page-->
</body>

<!-- Mirrored from bucketadmin.themebucket.net/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:12:48 GMT -->
</html>
<?php require_once("includes/footer.php"); ?>
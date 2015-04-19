<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("checklogin.php"); ?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bucketadmin.themebucket.net/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:13:08 GMT -->
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.html">

    <title>Login</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

  <?php if(isset($toprint)){ ?>
    <div class="container">
    <div class="row" >
    <div class="col-md-4">
    </div>
      <div class="col-md-4">
        <div class="panel" style="margin-top: 5%">
          <section class = "panel-body">Your Password has been set to : <?php echo $toprint ; ?>
          </section>
        </div>
      </div>
    </div>
    <?php } ?>

      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading" style="background: #A60A27">Siddharth Machineries<br><br>Sales Portal</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" name="uname" class="form-control" placeholder="User ID" autofocus>
                <input type="password" name="pwd" class="form-control" placeholder="Password">
            </div>
			<?php echo $error ; ?> 
            <label class="checkbox" style="margin-top:35px">
                <!--<input type="checkbox" value="remember-me"> Remember me -->
                <span class="pull-right" style="margin-top:28px">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" name="submit" type="submit" style="margin-top:-65px">Sign in</button>

        <!--<div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>-->

          </div>
        </div>
      </form>

          <!-- Modal -->
        
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post" id="resetform">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix" id="femail">
                      </div>
                      <div class="modal-body">
                          <input name="confirmreset" type="hidden" class="form-control placeholder-no-fix" id="confirmreset">
                      </div>
                      <div class="modal-footer">
                        <div style="margin-top:16px">
                          <button class="btn btn-success" type="button" onclick="sendMail()" name="resetpassword" style="margin-left:100px;margin-bottom:16px" >Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
          <!-- modal -->
        

<script type="text/javascript" src="https://mandrillapp.com/api/docs/js/mandrill.js"></script> 
    <script type="text/javascript">
      function sendMail() {
        var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for( var i=0; i < 8; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));

          var e = document.getElementById("femail").value;
          link = window.location.href + "?email=" + e + "&reset=" + text;
        //alert(text);
        //return true;
        //return false;
        var m = new mandrill.Mandrill('lzMg5wTxhG_ZfWJRGuuiGQ');
        var params = {
                "message": {
                    "from_email":"noreply@somewhere.com",
                    "to": [{"email": e}],
                    "subject": "Password Reset",
                    "text": "Follow the link to reset your password for Siddharth Machineries portal: " + link
                    //"async": false
                }
            };
            var result = false;
            var f = m.messages.send(params, function(res) {
                    var status = JSON.stringify(res[0]["status"]);
                    //alert(result);
                    if(status == "\"sent\"" || status == "\"queued\"") {
                      document.getElementById("confirmreset").value = text;
                      document.getElementById("resetform").submit();
                    }
                    else
                      result = false;
                }, function(err) {
                    console.log(JSON.stringify(err));
                    //return false;
            });
              //return true;
      }
    </script>

    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="js/jquery.js"> </script>
    <script src="bs3/js/bootstrap.min.js"></script>

  </body>

<!-- Mirrored from bucketadmin.themebucket.net/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Jul 2014 11:13:08 GMT -->
</html>
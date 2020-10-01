<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <title>Login to Visual HR</title>
    <link rel="icon" href="images/favicons.ico" />
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel=stylesheet href=vendor/animate.css/animate.css />
    <link rel=stylesheet href=vendor/bootstrap/dist/css/bootstrap.css />

    <link rel=stylesheet href=styles/style.css>
    <style type="text/css">
        .field-icon {
  position: relative;
}
    </style>
</head>

<body onLoad="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" style="font-size:17px;background-image: url('images/back/back2.jpg'); background-size: cover;">
      
    
    <!-- <div class=back-link>
        <a id=animation-btn href=register.html class="btn btn-success">Back to Register</a>
    </div> -->
    <div class=login-container>
        <div class=row>
            <div class=col-md-12>
                <div class="text-center m-b-md animated-panel bounceIn" style="animation-delay: 0.1s;">
                    <h5>Welcome to!</h5>
                    <h2>Visual HR</h2>
                </div>
                <div class="hpanel animated-panel zoomIn" style="animation-delay: 0.1s;">
                    <div class="panel-body no-shadow">
                        <form action="php/login.php" id=loginForm method="post" style="font-size: 17px;">
                            <div class=form-group style="padding:25px 0 20px 0;">
                                <label class=control-label for=username>Username</label>
                                <div class="input-group m-b"><span class="input-group-addon"><img src="images/name_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <input type=text placeholder="Admin" title="Please enter you username" required value name=username id=username class=form-control>
                                </div>
                            </div>
                            <div class=form-group style="padding:0px 0 15px 0;">
                                <label class=control-label for=password>Password</label>
                                <div class="input-group m-b"><span class="input-group-addon"><img src="images/password_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input id="password_field" type="password" placeholder="*****" class="form-control" name="password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" style="font-size:17px;">
                              <span toggle="#password_field" class="fa fa-fw fa-eye field-icon toggle-password input-group-addon"></span>
                              </div>
                                
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block">Login</button>
                            <a class="btn btn-default btn-block" href="register.php">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class=row>
            <div class="col-md-12 text-center animated-panel bounceIn" style="animation-delay: 0.1s;">
                <strong>Software Engineering , UIT</strong>
                <br/> 2019 
            </div>
        </div>
    </div>
    <script src=vendor/jquery/dist/jquery.min.js></script>
    <script src=vendor/jquery-ui/jquery-ui.min.js></script>
    <script src=vendor/bootstrap/dist/js/bootstrap.min.js></script>
    <script src=vendor/metisMenu/dist/metisMenu.min.js></script>
    <script src=vendor/iCheck/icheck.min.js></script>
    <script type="text/javascript">
        function noBack()
        {
            window.history.forward();
        }
</script>
<script>
   $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
   </script>
</body>

</html>
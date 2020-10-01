<?php
session_start();
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>No more admin available </title>
      <link rel="icon" href="images/favicons.ico" />
      <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
      <link rel="stylesheet" href="styles/style.css">
   </head>
   <body class="light-skin blank">
      <div class="login-container">
         <i class="pe-7s-way text-primary big-icon"></i>
         <h1><?php echo $_SESSION["no_more_admin"];?>!</h1>
         <h2>Sorry!!!</h2>
         <strong style="font-size: 17px;">Login as a registered admin!</strong>
         <br><br>
         <div class=back-link>
            <a id=animation-btn href=login.php class="btn btn-primary">Back to Login</a>
         </div>
      </div>
     
   </body>
</html>
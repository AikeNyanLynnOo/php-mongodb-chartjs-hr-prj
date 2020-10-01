<?php
session_start();

function checkAdminExist($admin){

  $filter = ["position"=>$admin];

  try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query($filter);

    $rows = $manager->executeQuery("project.admin",$query);
    $result = $rows->toArray();
    return count($result);
  } catch (MongoDB\Driver\Exception\Exception $e) {
    die("error encountered!".$e);
  }

}

if (checkAdminExist("CEO")>0 and checkAdminExist("GENERAL_MANAGER")>0 and checkAdminExist("OPERATION_MANAGER")>0 and checkAdminExist("SALES_MANAGER")>0 and checkAdminExist("HR_MANAGER")>0 and checkAdminExist("IT_MANAGER")>0 and checkAdminExist("WAREHOUSE_MANAGER")>0 and checkAdminExist("FINANCE_MANAGER")>0) {
  $_SESSION["no_more_admin"]="No more admin available";
  header('Location:no_more_admin.php');
}else{
  unset($_SESSION["no_more_admin"]);
}

?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Registeration</title>
      <link rel="icon" href="images/man.png" />
      <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
      <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
      <link rel="stylesheet" href="vendor/animate.css/animate.css" />
      <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
      <link rel="stylesheet" href="styles/style.css">
   </head>
   <body class="light-skin blank">
    <!-- <div class=back-link>
        <a id=animation-btn href=login.php class="btn btn-default">Back to Login</a>
    </div> -->
      <div class="content" style="margin-top:-20px;margin-left:400px;margin-right:400px;>
         <div class="row">
            <div class="col-md-12">
               <div class="text-center m-b-md">
                  <h2>Registration</h2>
                 
               </div>
               <div class="hpanel">
                  <div class="panel-body no-shadow th-border">
                     <form action="php/add_admin.php" id="loginForm" method="POST" style="font-size: 17px;">
                        <div class="row">
                           <div class="form-group col-lg-12">
                              <label>Username</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/name_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="" value="" id="username" class="form-control" name="username" required placeholder="admin" style="font-size:17px;">
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Email Address</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/mail_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="" value="" id="email" class="form-control" name="email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="admin@gmail.com" style="font-size:17px;">
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Password</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/password_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="password" value="" id="password" class="form-control" name="password" required placeholder="*****" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" style="font-size:17px;">
                              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password input-group-addon"></span>
                            </div>
                              <p>- at least length 8<br>- contains at least one letter/number/special character.</p>
                           </div>
                           <br>
                           <div class="form-group col-lg-12">
                              <label>Confirm Password</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/confirm_password_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="password" value="" id="confirm" class="form-control" name="password" required placeholder="*****" style="font-size:17px;">
                              <span toggle="#confirm" class="fa fa-fw fa-eye field-icon toggle-confirm input-group-addon"></span>
                            </div>
                           </div>   
                           <div class="form-group col-lg-12">
                              <label>Position</label><br>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/position_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="position" style="height: 35px;width: 100%;" required style="font-size:17px;">
                                  <?php 
                                  if (checkAdminExist("CEO")==0) {
                                    echo '<option value="CEO">CEO</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("GENERAL_MANAGER")==0) {
                                    echo '<option value="GENERAL_MANAGER">General Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>

                                  <?php 
                                  if (checkAdminExist("OPERATION_MANAGER")==0) {
                                    echo '<option value="OPERATION_MANAGER">Operation Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("SALES_MANAGER")==0) {
                                    echo '<option value="SALES_MANAGER">Sales Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("HR_MANAGER")==0) {
                                    echo '<option value="HR_MANAGER">HR Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("IT_MANAGER")==0) {
                                    echo '<option value="IT_MANAGER">IT Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("WAREHOUSE_MANAGER")==0) {
                                    echo '<option value="WAREHOUSE_MANAGER">Warehouse Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("FINANCE_MANAGER")==0) {
                                    echo '<option value="FINANCE_MANAGER">Finance  Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                </select> 
                              </div>
                           </div>
                           <div>                    
                              <a href="login.php" style="text-decoration: underline;font-size: 15px;margin-left: 15px;">Already have an account?</a>
                           </div>
                        </div>
                        <br><br>
                        
                        <div class="text-center">
                           <input type="submit" name="submit" id="submit" value="Register" class="btn btn-primary" />
                           <input type="reset" name="reset" id="reset" value="Cancel" class="btn btn-default" />
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 text-center">
                <strong>Software Engineering , UIT</strong>
                <br/> 2019 
            </div>
         </div>
      </div>
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script>
         var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
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

   $(".toggle-confirm").click(function() {

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
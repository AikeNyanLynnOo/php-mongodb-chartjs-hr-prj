<?php
session_start();

//get current manager

function getCurManager($position){
$toReturn = "blah";

if ($position == "CEO") {
  $toReturn = "CEO";
}elseif ($position == "GENERAL_MANAGER") {
  $toReturn = "General Manager";
}elseif ($position == "OPERATION_MANAGER") {
  $toReturn = "Operations Manager";
}elseif ($position == "SALES_MANAGER") {
  $toReturn = "Sales Manager";
}elseif ($position == "HR_MANAGER") {
  $toReturn = "HR Manager";
}elseif ($position == "IT_MANAGER") {
  $toReturn = "IT Manager";
}elseif ($position == "WAREHOUSE_MANAGER") {
  $toReturn = "Warehouse Manager";
}elseif ($position == "FINANCE_MANAGER") {
  $toReturn = "Finance Manager";
}else{
}
  return $toReturn;   
}

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


function getProfileImagePathAdmin($idd){
$path = "admin_default.png";
$filter = ["id"=>$idd];

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $rows = $manager->executeQuery("project.test",$query);
  $result = $rows->toArray();
  if (count($result)==0){
      return $path;
  }else{
    $path = $result[0]->Image;
  }

  return $path;
} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encoutered!".$e);
}
}

//getProfilePhoto

function getProfileImagePath($idd){
$path = "admin_default.png";
$filter = ["id"=>$idd];

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $rows = $manager->executeQuery("project.test",$query);
  $result = $rows->toArray();
  if (count($result)==0){
      return $path;
  }else{
    $path = $result[0]->Image;
  }

  return $path;
} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encoutered!".$e);
}
}

function position_check($pos){
  if ($pos == $_GET["position"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    header("Location:login.php");
}
else{
      echo'
<!DOCTYPE html>
<html>
   <head>
      <meta charset=utf-8>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <title>Admin Profile</title>
    <link rel="icon" href="images/favicons.ico" />
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">
    
   </head>
   <body class="light-skin fixed-navbar sidebar-scroll">
    <div id="header">
        <div class="color-line"></div>
        <div id="logo" class="light-version">
           <span style="font-size:20px;">
           Visual HR
           </span>
        </div>
        <nav role="navigation">
           <div class="header-link hide-menu">
              <i class="fa fa-bars"></i>
           </div>
           <div class="small-logo">
              <span class="text-primary">Visual HR</span>
           </div>
           <div class="navbar-right">
              <ul class="nav navbar-nav no-borders">
                 <li class="dropdown">';
                    echo" <a href='profile.php?id=".$_SESSION["id"]."&username=".$_SESSION["username"]."&email=".$_SESSION["email"]."&password=".$_SESSION["password"]."&position=".$_SESSION["position"]."'>";
                    echo '<img src="upload/'.getProfileImagePathAdmin((string)$_SESSION["id"]).'" style="height:40px;display:block;width:40px;margin-top:-8px;" class="img-circle img-small" >
                    </a>
                 </li>
                 <li>
                <div style="vertical-align:middle;line-height:25px;font-size:20px;margin-right:50px;margin-top:3px;margin-left:15px;color:#fff;width:auto;">'.$_SESSION["username"]."<br>".'<p style="font-size:16px;">'.getCurManager($_SESSION["position"]).'</p></div>

                </li>
                 <li class="dropdown">
                        <a href="logout.php">
                            <i class="pe-7s-upload pe-rotate-90"></i>
                        </a>
                    </li>
              </ul>
           </div>
        </nav>
     </div>
     <aside id="menu">
        <div id="navigation">
           <ul class="nav" id="side-menu">
              <li>
                 <a href="index.php">
                 <span class="nav-label" style="font-size:17px;">Dashboard</span>
                 
                 </a>
              </li>
              <li>
                 <a href="employees.php">
                 <span class="nav-label" style="font-size:17px;">Employees</span>
                 
                 </a>
              </li>';
              if ($_SESSION["position"] == "CEO" or $_SESSION["position"] == "HR_MANAGER" or $_SESSION["position"] == "GENERAL_MANAGER") {
                echo '<li>
                 <a href="orgchart1.php">
                 <span class="nav-label" style="font-size:17px;">Admin team</span>
                 </a>
              </li>';
              }
              echo'
              
           </ul>
        </div>
     </aside>
      <div id="wrapper">
      <div class=back-link>
            <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="font-size:17px;margin-left:30px;margin-top:30px;">Back</a>
         </div>
         <div class="content" style="margin-left:300px;margin-right:300px;">
            <div class="row" style="margin-top:30px;">
               <div class="col-lg-12">
                 <div class="hpanel">
                 <form action="php/upload_photo_admin.php" method="POST" enctype="multipart/form-data">
                          
                          <img src="upload/'.getProfileImagePath($_GET["id"]).'" style="height:120px;display:block;margin-left:0;margin-right:auto;width:120px;" class="img-circle img-small" /><br>
                        
                        </form><br>
                  <div class="panel-body no-shadow th-border">
                     <form action="php/update_admin_view.php" id="loginForm" method="POST" style="font-size:17px;">
                        <div class="row">
                           <div class="form-group col-lg-12">
                              <input type="hidden" value="'.$_GET["id"].'" id="id" class="form-control" name="id" style="font-size:17px;" required>
                           </div>
                           <div class="form-group col-lg-12">
                              <label>Username</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/name_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["username"].'" id="username" class="form-control" style="font-size:17px;" name="username" required>
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Email Address</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/mail_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["email"].'" id="email" class="form-control" style="font-size:17px;" name="email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                              </div>
                             <p> - Must be a valid email address.</p> 
                           </div><br>
                           <input type="hidden" value="'.$_GET["password"].'" id="password" class="form-control" style="font-size:17px;" name="password" required>
                           <div class="form-group col-lg-12">
                              <label>Position</label><br>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/position_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="position" style="width:100%;height: 35px" style="font-size:17px;"  required>';
                                  if (checkAdminExist("CEO")==0 or $_GET["position"]=="CEO") {
                                    echo '<option value="CEO" '.position_check("CEO").'>CEO</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("GENERAL_MANAGER")==0 or $_GET["position"]=="GENERAL_MANAGER") {
                                    echo '<option value="GENERAL_MANAGER" '.position_check("GENERAL_MANAGER").'>General Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>

                                  <?php 
                                  if (checkAdminExist("OPERATION_MANAGER")==0 or $_GET["position"]=="OPERATION_MANAGER") {
                                    echo ' <option value="OPERATION_MANAGER" '.position_check("OPERATION_MANAGER").'>Operation Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("SALES_MANAGER")==0 or $_GET["position"]=="SALES_MANAGER") {
                                    echo '<option value="SALES_MANAGER" '.position_check("SALES_MANAGER").'>Sales Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("HR_MANAGER")==0 or $_GET["position"]=="HR_MANAGER") {
                                    echo '<option value="HR_MANAGER" '.position_check("HR_MANAGER").'>HR Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("IT_MANAGER")==0 or $_GET["position"]=="IT_MANAGER") {
                                    echo '<option value="IT_MANAGER" '.position_check("IT_MANAGER").'>IT Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("WAREHOUSE_MANAGER")==0  or $_GET["position"]=="WAREHOUSE_MANAGER") {
                                    echo '<option value="WAREHOUSE_MANAGER" '.position_check("WAREHOUSE_MANAGER").'>Warehouse Manager</option>';
                                  }else{
                                  echo '';
                                  }

                                  ?>
                                  <?php 
                                  if (checkAdminExist("FINANCE_MANAGER")==0 or $_GET["position"]=="FINANCE_MANAGER") {
                                    echo '<option value="FINANCE_MANAGER" '.position_check("FINANCE_MANAGER").'>Finance Manager</option>';
                                  }else{
                                  echo '';
                                  }
                                  
                                  echo '
                                </select> 
                                </div>
                           </div>   
                           
                        </div>
                        <br><br><br>
                        <div class="text-center">
                           <a href="retire_admin.php?id='.$_GET["id"]."&Name=".$_GET["username"].'"class="btn btn-primary text-center" style="margin-left:25px;margin-right:25px;font-size:17px;">Turnover</a> |
                           <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary text-center" style="margin-right:25px;margin-left:25px;"/>     |      
                           <a href="dismiss_admin.php?id='.$_GET["id"]."&Name=".$_GET["username"].'"class="btn btn-primary"  style="background-color:red;margin-left:25px;font-size:17px;">Dismiss</a>
                        </div>

                     </form>
                  </div>
               </div> 
            </div> 
        </div>
    </div>
    <footer class="footer">
            <span class="pull-right">
            <h4 style="color:#c97ce5;">Software Engineering</h4>
            </span>
            <h4 style="color:#c97ce5;">University of Information Technology</h4>
         </footer>
      </div>
        
         
      </div>
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="vendor/datatables/media/js/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="vendor/pdfmake/build/pdfmake.min.js"></script>
      <script src="vendor/pdfmake/build/vfs_fonts.js"></script>
      <script src="vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
      <script src="scripts/devdap.js"></script>
            

   </body>
</html>';
}
?>

<script>
  
  function goBack(){
    window.history.back();
  }
</script>

<script>$(function(){$("#example1").dataTable({ajax:"api/datatables.json",dom:"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",lengthMenu:[[10,25,50,-1],[10,25,50,"All"]],buttons:[{extend:"copy",className:"btn-sm"},{extend:"csv",title:"ExampleFile",className:"btn-sm"},{extend:"pdf",title:"ExampleFile",className:"btn-sm"},{extend:"print",className:"btn-sm"}]});$("#example2").dataTable()});</script>  
    



       











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
$path = "profile_default2.png";
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
    <title>Employee Information</title>
    <link rel="icon" href="images/favicons.ico" />
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">

    <style type="text/css">
    table td {height:39.5px;}
    </style>
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
              <li class="active">
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
         <div class="content">
         <div class=back-link>
            <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="font-size:17px;">Back to Employees</a>
         </div>
            <div class="row" style="margin-top:100px;">
            
               <div class="col-lg-6">
                 <div class="hpanel">
                  <div class="panel-body th-border" >
                     <form action="php/update_budget.php" id="loginForm" method="POST" >
                        <li class="pe-7s-cash fa-4x text-warning pull-right"></li>
                        <div class="form-group col-lg-12">
                              <input type="hidden" value="'.$_GET['id'].'" id="id" class="form-control" name="id">
                           </div> 
                        <div class="form-group col-lg-12">
                              <input type="hidden" value="'.$_GET['total_budget'].'" id="total_budget" class="form-control" name="total_budget">
                           </div> 
                        <div class="form-group col-lg-12">
                             <h4>Total Budget</h4>
                             <h3 class="m-xs">$ '.number_format($_GET['total_budget']).'</h3>
                        </div>
                        <br>
                        <div class="form-group col-lg-12">
                             <h4>Total Salary</h4>
                             <h3 class="m-xs">$ '.number_format($_GET['total_salary']).'</h3>
                        </div>
                        <br>
                        <div class="form-group col-lg-12">
                              <label><h4>Income $</h4></label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/salary_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="" id="income" class="form-control" name="income">
                              </div>
                           </div><br>
                         <div class="form-group col-lg-12">
                              <label><h4>Loss $</h4></label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/salary_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="" id="loss" class="form-control" name="loss">
                              </div>
                           </div><br>   
                        <div class="text-center">
                           <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary text-center" style="width:80px;"/>
                        </div>

                     </form>
                  </div>
               </div> 
            </div> 

            <div class="col-lg-6">
                  <div class="hpanel">
                     <div class="panel-heading">
                        
                        <h3>Salary by Department based on total salary</h3>
                     </div>
                     <div class="panel-body th-border">
                        <div class="table-responsive">
                           <table cellpadding="1" cellspacing="1" class="table table-condensed"  style="font-size:17px">
                              <thead>
                                 <tr>
                                    <th>Department</th>
                                    <th>Total Salary $</th>
                                    <th>Percent used %</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Operation</td>
                                    <td>$ '.$_GET['op_sal'].'</td>
                                    <td>'.round(($_GET['op_sal']/$_GET['total_salary'])*100).' %</td>
                                 </tr>
                                 <tr>
                                    <td>Sales</td>
                                    <td>$ '.$_GET['sales_sal'].'</td>
                                    <td>'.round(($_GET['sales_sal']/$_GET['total_salary'])*100).' %</td>
                                 </tr>
                                 <tr>
                                    <td>Human Resources</td>
                                    <td>$ '.$_GET['hr_sal'].'</td>
                                    <td>'.round(($_GET['hr_sal']/$_GET['total_salary'])*100).' %</td>
                                 </tr>
                                 <tr>
                                    <td>IT</td>
                                    <td>$ '.$_GET['it_sal'].'</td>
                                    <td>'.round(($_GET['it_sal']/$_GET['total_salary'])*100).' %</td>
                                 </tr>
                                 <tr>
                                    <td>Warehouse</td>
                                    <td>$ '.$_GET['wh_sal'].'</td>
                                    <td>'.round(($_GET['wh_sal']/$_GET['total_salary'])*100).' %</td>
                                 </tr>
                                 <tr>
                                    <td>Finance</td>
                                    <td>$ '.$_GET['fi_sal'].'</td>
                                    <td>'.round(($_GET['fi_sal']/$_GET['total_salary'])*100).' %</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
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
    



       











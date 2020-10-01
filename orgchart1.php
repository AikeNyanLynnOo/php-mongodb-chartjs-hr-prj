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

//get data with id

function getDataWithID($id){
    $admindata =[];

  $filter = ["_id"=>$id];
  try {
      $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
          $query = new MongoDB\Driver\Query($filter);

          $result = $manager->executeQuery("project.admin",$query);
          $rows = $result->toArray();
          
          $admindata[0] = $rows[0]->_id;
          $admindata[1] = $rows[0]->username;
          $admindata[2] = $rows[0]->email;
          $admindata[3] = $rows[0]->password;
          $admindata[4] = $rows[0]->position;

    return $admindata;
  } catch (MongoDB\Driver\Exception\Exception $e) {
    die("error encountered!".$e);
  }
}



//checkAdminExist
function checkAdminExist($manager_type){
$filter = ["position"=>$manager_type];

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $row = $manager->executeQuery("project.admin",$query);
  $result = $row->toArray();

  if (count($result)>0) {
    return true;
  }else{
    return false;
  }
} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
}
  
}

//getid to get profile image
function getID($position){
  $ID;
  $filter = ["position"=>$position];
  try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $rows = $manager->executeQuery("project.admin",$query);
  $result = $rows->toArray();

  $ID = $result[0]->_id;
  return $ID;
  } catch (MongoDB\Driver\Exception\Exception $e) {
    die("error encountered!".$e);
  }
}

//getProfilePhotoofAdmin

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

//getName of admin

function getNameOfAdmin($position){
  $name = "";

  $filter = ["position"=>$position];
  try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $rows = $manager->executeQuery("project.admin",$query);
  $result = $rows->toArray();

  $name = $result[0]->username;
  return $name;
  } catch (MongoDB\Driver\Exception\Exception $e) {
    die("error encountered!".$e);
  }
}

//getEmployeeNumber

function getEmpNumber($position){

  $toReturn;
  switch ($position) {
    case 'CEO':
    $toReturn = getEmpNumberByDept([])+1;
      break;
    case 'GENERAL_MANAGER':
    $toReturn = getEmpNumberByDept([]);
      break;
    case 'OPERATION_MANAGER':
    $toReturn = getEmpNumberByDept(["Department"=>"Operations"]);
      break;
    case 'SALES_MANAGER':
    $toReturn = getEmpNumberByDept(["Department"=>"Sales"]);
      break;
    case 'HR_MANAGER':
    $toReturn = getEmpNumberByDept(["Department"=>"Human Resources"]);
      break;
    case 'IT_MANAGER':
    $toReturn = getEmpNumberByDept(["Department"=>"IT"]);
      break;  
    case 'WAREHOUSE_MANAGER':
    $toReturn = getEmpNumberByDept(["Department"=>"Warehouse"]);
      break;
    case 'FINANCE_MANAGER':
    $toReturn = getEmpNumberByDept(["Department"=>"Finance"]);
      break;  
    
    default:
      
      break;
  }
return $toReturn;
}

//getempnumber by department 
function getEmpNumberByDept($filter1){

  $filter = $filter1;
  try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query($filter);

    $rows = $manager->executeQuery("project.employee",$query);
    return count($rows->toArray());
  } catch (MongoDB\Driver\Exception\Exception $e) {
    die("error encountered!".$e);
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
    <link rel="stylesheet" href="styles/orgchart.css">
    
   </head>
   <body class="light-skin fixed-navbar sidebar-scroll" style="font-weight:bold;">
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
                echo '<li class="active">
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
            <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="font-size:17px;margin-left:30px;margin-top:30px;float:left;">Back</a>
         </div>
         <div class = "content" style="text-align: center;width: 100%;">
            <div class="row">
               <div class="container-fluid content" style="display: inline-block;">
                  <div class="row">
        <div class="col-md-12">
            <div class="tree">
                <ul>
                    <li>';
                    if ($_SESSION["position"] == "HR_MANAGER" or $_SESSION["position"] == "GENERAL_MANAGER") {
                    echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("CEO"))[0]."&username=".getDataWithID(getID("CEO"))[1]."&email=".getDataWithID(getID("CEO"))[2]."&password=".getDataWithID(getID("CEO"))[3]."&position=".getDataWithID(getID("CEO"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    CEO
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("CEO")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("CEO").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("CEO").   
                                ' employees</div>
                                </div>

                                </a>
                                <ul>
                            <li>';      
                    }else{
                      echo" <a href='profile.php?id=".$_SESSION["id"]."&username=".$_SESSION["username"]."&email=".$_SESSION["email"]."&password=".$_SESSION["password"]."&position=".$_SESSION["position"]."'>";

                         echo' <div class="container-fluid">
                                <div class="row">
                                    CEO
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("CEO")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("CEO").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("CEO").   
                                ' employees</div>
                            </div>

                        </a>
                        <ul>
                            <li>';
                    }
                            if ($_SESSION["position"] == "CEO" or $_SESSION["position"] == "HR_MANAGER") {
                              if (checkAdminExist("GENERAL_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("GENERAL_MANAGER"))[0]."&username=".getDataWithID(getID("GENERAL_MANAGER"))[1]."&email=".getDataWithID(getID("GENERAL_MANAGER"))[2]."&password=".getDataWithID(getID("GENERAL_MANAGER"))[3]."&position=".getDataWithID(getID("GENERAL_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    General Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("GENERAL_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("GENERAL_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("GENERAL_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                            }else{
                              echo" <a href='profile.php?id=".$_SESSION["id"]."&username=".$_SESSION["username"]."&email=".$_SESSION["email"]."&password=".$_SESSION["password"]."&position=".$_SESSION["position"]."'>";

                         echo' <div class="container-fluid">
                                <div class="row">
                                    General Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("GENERAL_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("GENERAL_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("GENERAL_MANAGER").   
                                ' employees</div>
                            </div>

                        </a>';

                            }
                            
                              echo '
                                <ul>

                                
                                  <li>';
                                        if (checkAdminExist("OPERATION_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("OPERATION_MANAGER"))[0]."&username=".getDataWithID(getID("OPERATION_MANAGER"))[1]."&email=".getDataWithID(getID("OPERATION_MANAGER"))[2]."&password=".getDataWithID(getID("OPERATION_MANAGER"))[3]."&position=".getDataWithID(getID("OPERATION_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    Operation Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("OPERATION_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("OPERATION_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("OPERATION_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                                echo' 
                                </li>
                                    <li>';
                                        if (checkAdminExist("SALES_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("SALES_MANAGER"))[0]."&username=".getDataWithID(getID("SALES_MANAGER"))[1]."&email=".getDataWithID(getID("SALES_MANAGER"))[2]."&password=".getDataWithID(getID("SALES_MANAGER"))[3]."&position=".getDataWithID(getID("SALES_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    Sales Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("SALES_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("SALES_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("SALES_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                                echo'
                                    </li>
                                    <li>';
                                    if ($_SESSION["position"] == "CEO" or $_SESSION["position"] == "GENERAL_MANAGER") {
                                      if (checkAdminExist("HR_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("HR_MANAGER"))[0]."&username=".getDataWithID(getID("HR_MANAGER"))[1]."&email=".getDataWithID(getID("HR_MANAGER"))[2]."&password=".getDataWithID(getID("HR_MANAGER"))[3]."&position=".getDataWithID(getID("HR_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    HR Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("HR_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("HR_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("HR_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                            }else{
                                echo" <a href='profile.php?id=".$_SESSION["id"]."&username=".$_SESSION["username"]."&email=".$_SESSION["email"]."&password=".$_SESSION["password"]."&position=".$_SESSION["position"]."'>";

                         echo' <div class="container-fluid">
                                <div class="row">
                                    HR Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("HR_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("HR_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("HR_MANAGER").   
                                ' employees</div>
                            </div>

                        </a>';
                            }
                                        
                                echo'
                                    </li>
                                    <li>';
                                        if (checkAdminExist("IT_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("IT_MANAGER"))[0]."&username=".getDataWithID(getID("IT_MANAGER"))[1]."&email=".getDataWithID(getID("IT_MANAGER"))[2]."&password=".getDataWithID(getID("IT_MANAGER"))[3]."&position=".getDataWithID(getID("IT_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    IT Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("IT_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("IT_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("IT_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                                echo'
                                    </li>
                                    <li>';
                                        if (checkAdminExist("WAREHOUSE_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("WAREHOUSE_MANAGER"))[0]."&username=".getDataWithID(getID("WAREHOUSE_MANAGER"))[1]."&email=".getDataWithID(getID("WAREHOUSE_MANAGER"))[2]."&password=".getDataWithID(getID("WAREHOUSE_MANAGER"))[3]."&position=".getDataWithID(getID("WAREHOUSE_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    Warehouse Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("WAREHOUSE_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("WAREHOUSE_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("WAREHOUSE_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                                echo'
                                    </li>
                                    <li>';
                                        if (checkAdminExist("FINANCE_MANAGER")) {
                                echo" <a href='view_admin_profile.php?id=".getDataWithID(getID("FINANCE_MANAGER"))[0]."&username=".getDataWithID(getID("FINANCE_MANAGER"))[1]."&email=".getDataWithID(getID("FINANCE_MANAGER"))[2]."&password=".getDataWithID(getID("FINANCE_MANAGER"))[3]."&position=".getDataWithID(getID("FINANCE_MANAGER"))[4]."'>";

                                    echo' <div class="container-fluid">
                                <div class="row">
                                    Finance Manager
                                </div>
                                <div class="row" style="margin-top: 25px;">
                                    <img src="upload/'.getProfileImagePathAdmin((string)getID("FINANCE_MANAGER")).'" style="height:60px;display:inline-block;width:60px;margin-top:-8px;" class="img-circle img-small">
                                </div>
                                <div class="row" style="margin-top:7px;">'
                                    .getNameOfAdmin("FINANCE_MANAGER").
                                '</div><br>
                                <div class="row">'
                                 .getEmpNumber("FINANCE_MANAGER").   
                                ' employees</div>
                                </div>

                                </a>';
                              }
                                echo'
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>
                </ul>
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
    



       











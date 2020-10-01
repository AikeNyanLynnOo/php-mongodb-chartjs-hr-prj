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


//show selected value

$selectedvalue="All";
if (isset($_POST["selection"])) {
  $selectedvalue=$_POST["selection"];
}

function showSelectedValue($value,$selectedval){
if ($value==$selectedval) {
  return "selected";
}else{
  return '';
}
}

//getting employee table by department
$filter = "";
switch ($selectedvalue) {
  case 'All':
    $filter = [];
    break;
  case 'Operations':
      $filter = ["Department"=>"Operations"];
      break;  
  case 'Sales':
      $filter = ["Department"=>"Sales"];
      break;  
  case 'Human Resources':
      $filter = ["Department"=>"Human Resources"];
      break;  
  case 'IT':
      $filter = ["Department"=>"IT"];
      break;  
  case 'Warehouse':
      $filter = ["Department"=>"Warehouse"];
      break;  
  case 'Finance':
      $filter = ["Department"=>"Finance"];
      break;    
  
  default:
    $filter = [];
    break;
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

function get_current_department(){
  $dept_current = "";
  switch ($_SESSION['position']) {
    case 'CEO':
      $dept_current = "All";
      break;
    case 'GENERAL_MANAGER':
      $dept_current = "All";  
      break;  
    case 'OPERATION_MANAGER':
      $dept_current = "Operation";
      break;
    case 'SALES_MANAGER':
      $dept_current = "Sales";
      break;
    case 'HR_MANAGER':
      $dept_current = "HR";
      break;
    case 'IT_MANAGER':
      $dept_current = "IT";
      break;  
    case 'WAREHOUSE_MANAGER':
      $dept_current = "Warehouse";
      break;
    case 'FINANCE_MANAGER':
      $dept_current = "Finance";
      break;    
  }
  return $dept_current;
}
if (!isset($_SESSION['username']) and !isset($_SESSION['password'])) {
    header("Location:login.php");
}
else{

    if ($_SESSION['position']=="HR_MANAGER") {
      echo'
     
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Employees</title>
      <link rel="icon" href="images/favicons.ico" />
      <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
      <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
      <link rel="stylesheet" href="vendor/animate.css/animate.css" />
      <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
      <link rel="stylesheet" href="vendor/fooTable/css/footable.core.min.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
      <link rel="stylesheet" href="styles/style.css">
   <style type="text/css">
   #loading {
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 1;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}

#loading-image {
  position: absolute;
  top: 180px;
  margin-left:-95px;
  z-index: 100;

}
table tr td{
  font-size:16px;
}
   </style>      

   </head>
   
   <body class="light-skin fixed-navbar sidebar-scroll">

   <div id="loading">
  <p style="margin-top: 180px;font-size:20px;">loading...</p> 
  <img id="loading-image" src="images/loading.png" alt="Loading..." />
  </div>
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
                
                <li>';

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
              <li class="active">
                 <a href="employees.php">
                 <span class="nav-label" style="font-size:17px;">Employees</span>
                 </a>
              </li>';
                echo '<li>
                 <a href="orgchart1.php">
                 <span class="nav-label" style="font-size:17px;">Admin team</span>
                 </a>
              </li>';
              echo'
           </ul>
        </div>
     </aside>
      <div id="wrapper">
         <div class="content">
            <div class="row">
               <div class="col-lg-12">
                  <div class="hpanel">
                     <a href="add_employee_form.php" class="btn btn-primary text-center" style="margin-top:20px;margin-bottom:15px;font-size:17px;"> <p class="pe-7s-plus" style="margin-top:10px;"></p>  Add employees</a><br>
                     <div class="panel-heading" style="font-size:17px;">
                         <div class="pull-right">Export  :  <button id="json" class="btn btn-primary">TO JSON</button> <button id="csv" class="btn btn-info">TO CSV</button>  <button id="pdf" class="btn btn-danger">TO PDF</button></div>
                     </div>
                     <form action="employees.php" method="POST" id="my_form" style="margin-bottom:20px;font-size:17px;">
                                
                                <select onchange="myFunction()" name="selection" id="my_selection" style="width:15%;height: 35px">
                                   <option value="" '.showSelectedValue("All",$selectedvalue).'>All</option>
                                   <option value="Operations" '.showSelectedValue("Operations",$selectedvalue).'>Operations</option>
                                   <option value="Sales" '.showSelectedValue("Sales",$selectedvalue).'>Sales</option>
                                   <option value="Human Resources" '.showSelectedValue("Human Resources",$selectedvalue).'>Human Resources</option>
                                   <option value="IT" '.showSelectedValue("IT",$selectedvalue).'>IT</option>
                                   <option value="Warehouse" '.showSelectedValue("Warehouse",$selectedvalue).'>Warehouse</option>
                                   <option value="Finance" '.showSelectedValue("Finance",$selectedvalue).'>Finance</option>
                                </select>
                     </form> 
                     <div class="panel-body no-shadow">
                        <input type="text" class="form-control input-sm m-b-md" id="filter" placeholder="Search in table">
                        <table id="example1" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
                           <thead style="font-size:17px;">
                              <tr>
                                 <th>Name</th>
                                 <th>Birthday</th>
                                 <th>Department</th>                               
                                 <th>Education</th>
                                 <th>Marital_status</th>
                                 <th>Race</th>
                                 <th>Sex</th>
                                 <th>Native country</th>
                                 <th>Salary</th>
                                 <th>Manager satisfaction</th>
                                 <th>Late times</th>
                                 <th></th>
                                 <th></th>
                              </tr>   
                           </thead>
                           <tbody>';
                           try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $rows = $manager->executeQuery("project.employee",$query);
  foreach ($rows as $row) {
                            echo'
                              <tr>
                                 <td>'.$row->Name.'</td>
                                 <td>'.$row->Age.'</td>
                                 <td>'.$row->Department.'</td>
                                 <td>'.$row->Education.'</td>
                                 <td>'.$row->Marital_status.'</td>
                                 <td>'.$row->Race.'</td>
                                 <td>'.$row->Sex.'</td>
                                 <td>'.$row->Native_Country.'</td>
                                 <td>'.$row->Salary.'</td>
                                 <td>'.$row->Performance_rating.'</td>
                                 <td>'.$row->Late_times.'</td>
                                 <td><a href="employee_pp_deleable.php?id='.$row->_id."&Name=".$row->Name."&Age=".$row->Age."&Department=".$row->Department."&Position=".$row->Position."&Education=".$row->Education."&Marital_status=".$row->Marital_status."&Race=".$row->Race."&Sex=".$row->Sex."&Hours_Per_Week=".$row->Hours_Per_Week."&Native_Country=".$row->Native_Country."&Salary=".$row->Salary."&Start_Date=".$row->Start_Date."&Performance_rating=".$row->Performance_rating."&Leader_review=".$row->Leader_review."&Member_review=".$row->Member_review."&Late_times=".$row->Late_times."&Excuse_times=".$row->Excuse_times."&Absent_W_Excuse=".$row->Absent_W_Excuse."&Mistakes=".$row->Mistakes."&Bonus=".$row->Bonus."&Best_Employee=".$row->Best_Employee."&Address=".$row->Address."&Mail=".$row->Mail.'" class="btn btn-success" style="background-color:#c97ce5;">Edit</a></td>
                                 <td><a onclick="javascript:confirmationDelete($(this));return false;" href="delete_choose_employee.php?id='.$row->_id."&Name=".$row->Name."&Age=".$row->Age."&Department=".$row->Department."&Position=".$row->Position."&Education=".$row->Education."&Marital_status=".$row->Marital_status."&Race=".$row->Race."&Sex=".$row->Sex."&Hours_Per_Week=".$row->Hours_Per_Week."&Native_Country=".$row->Native_Country."&Salary=".$row->Salary."&Start_Date=".$row->Start_Date."&Performance_rating=".$row->Performance_rating."&Leader_review=".$row->Leader_review."&Member_review=".$row->Member_review."&Late_times=".$row->Late_times."&Excuse_times=".$row->Excuse_times."&Absent_W_Excuse=".$row->Absent_W_Excuse."&Mistakes=".$row->Mistakes."&Bonus=".$row->Bonus."&Best_Employee=".$row->Best_Employee."&Address=".$row->Address."&Mail=".$row->Mail.'" class="btn btn-primary" style="background-color:red;">Delete</a></td>
                              </tr>';
                           }
} catch (MongoDB\Driver\Exception\Exception $e) {
  die("Error encountered!".$e);
}
                           
                           echo'
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="16">
                                    <ul class="pagination pull-right"></ul>
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
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
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="vendor/fooTable/dist/footable.all.min.js"></script>
      <script src="scripts/devdap.js"></script>
      
      <script language="javascript" type="text/javascript">
     $(window).load(function() {
     $("#loading").hide();
  });
</script>
      <script language="javascript">
      function confirmationDelete(anchor){
        var conf = confirm("Are you sure to delete?");
        if(conf){
          window.location=anchor.attr("href");
        }
      }
</script>
<script type="text/javascript">
    
    function myFunction(){
      document.getElementById("my_form").submit();
    }
</script>      
   </body>
</html>';
}

elseif ($_SESSION["position"] == "CEO" or $_SESSION["position"] == "GENERAL_MANAGER") {
  echo'
     
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Employees</title>
      <link rel="icon" href="images/favicons.ico" />
      <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
      <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
      <link rel="stylesheet" href="vendor/animate.css/animate.css" />
      <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
      <link rel="stylesheet" href="vendor/fooTable/css/footable.core.min.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
      <link rel="stylesheet" href="styles/style.css">
   <style type="text/css">
   #loading {
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 1;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}

#loading-image {
  position: absolute;
  top: 180px;
  margin-left:-95px;
  z-index: 100;

}
table tr td{
  font-size:16px;
}
   </style>      

   </head>
   
   <body class="light-skin fixed-navbar sidebar-scroll">

   <div id="loading">
  <p style="margin-top: 180px;font-size:20px;">loading...</p> 
  <img id="loading-image" src="images/loading.png" alt="Loading..." />
  </div>
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
                
                <li>';

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
              <li class="active">
                 <a href="employees.php">
                 <span class="nav-label" style="font-size:17px;">Employees</span>
                 </a>
              </li>';
                echo '<li>
                 <a href="orgchart1.php">
                 <span class="nav-label" style="font-size:17px;">Admin team</span>
                 </a>
              </li>';
              echo'
           </ul>
        </div>
     </aside>
      <div id="wrapper">
         <div class="content">
            <div class="row">
               <div class="col-lg-12">
                  <div class="hpanel">
                     <a href="add_employee_form.php" class="btn btn-primary text-center" style="margin-top:20px;margin-bottom:15px;font-size:17px;"> <p class="pe-7s-plus" style="margin-top:10px;"></p>  Add employees</a><br>
                     <div class="panel-heading" style="font-size:17px;">
                         <div class="pull-right">Export  :  <button id="json" class="btn btn-primary">TO JSON</button> <button id="csv" class="btn btn-info">TO CSV</button>  <button id="pdf" class="btn btn-danger">TO PDF</button></div>
                     </div>
                     <form action="employees.php" method="POST" id="my_form" style="margin-bottom:20px;font-size:17px;">
                                
                                <select onchange="myFunction()" name="selection" id="my_selection" style="width:15%;height: 35px">
                                   <option value="" '.showSelectedValue("All",$selectedvalue).'>All</option>
                                   <option value="Operations" '.showSelectedValue("Operations",$selectedvalue).'>Operations</option>
                                   <option value="Sales" '.showSelectedValue("Sales",$selectedvalue).'>Sales</option>
                                   <option value="Human Resources" '.showSelectedValue("Human Resources",$selectedvalue).'>Human Resources</option>
                                   <option value="IT" '.showSelectedValue("IT",$selectedvalue).'>IT</option>
                                   <option value="Warehouse" '.showSelectedValue("Warehouse",$selectedvalue).'>Warehouse</option>
                                   <option value="Finance" '.showSelectedValue("Finance",$selectedvalue).'>Finance</option>
                                </select>
                     </form> 
                     <div class="panel-body no-shadow">
                        <input type="text" class="form-control input-sm m-b-md" id="filter" placeholder="Search in table">
                        <table id="example1" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
                           <thead style="font-size:17px;">
                              <tr>
                                 <th>Name</th>
                                 <th>Birthday</th>
                                 <th>Department</th>                               
                                 <th>Education</th>
                                 <th>Marital_status</th>
                                 <th>Race</th>
                                 <th>Sex</th>
                                 <th>Native country</th>
                                 <th>Salary</th>
                                 <th>Manager satisfaction</th>
                                 <th>Late times</th>
                                 <th></th>
                              </tr>   
                           </thead>
                           <tbody>';
                           try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query($filter);

  $rows = $manager->executeQuery("project.employee",$query);
  foreach ($rows as $row) {
                            echo'
                              <tr>
                                 <td>'.$row->Name.'</td>
                                 <td>'.$row->Age.'</td>
                                 <td>'.$row->Department.'</td>
                                 <td>'.$row->Education.'</td>
                                 <td>'.$row->Marital_status.'</td>
                                 <td>'.$row->Race.'</td>
                                 <td>'.$row->Sex.'</td>
                                 <td>'.$row->Native_Country.'</td>
                                 <td>'.$row->Salary.'</td>
                                 <td>'.$row->Performance_rating.'</td>
                                 <td>'.$row->Late_times.'</td>
                                 <td><a href="employee_pp_ceo_view.php?id='.$row->_id."&Name=".$row->Name."&Age=".$row->Age."&Department=".$row->Department."&Position=".$row->Position."&Education=".$row->Education."&Marital_status=".$row->Marital_status."&Race=".$row->Race."&Sex=".$row->Sex."&Hours_Per_Week=".$row->Hours_Per_Week."&Native_Country=".$row->Native_Country."&Salary=".$row->Salary."&Start_Date=".$row->Start_Date."&Performance_rating=".$row->Performance_rating."&Leader_review=".$row->Leader_review."&Member_review=".$row->Member_review."&Late_times=".$row->Late_times."&Excuse_times=".$row->Excuse_times."&Absent_W_Excuse=".$row->Absent_W_Excuse."&Mistakes=".$row->Mistakes."&Bonus=".$row->Bonus."&Best_Employee=".$row->Best_Employee."&Address=".$row->Address."&Mail=".$row->Mail.'" class="btn btn-success" style="background-color:#c97ce5;">View Info</a></td>
                              </tr>';
                           }
} catch (MongoDB\Driver\Exception\Exception $e) {
  die("Error encountered!".$e);
}
                           
                           echo'
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="16">
                                    <ul class="pagination pull-right"></ul>
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
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
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="vendor/fooTable/dist/footable.all.min.js"></script>
      <script src="scripts/devdap.js"></script>
      
      <script language="javascript" type="text/javascript">
     $(window).load(function() {
     $("#loading").hide();
  });
</script>
      <script language="javascript">
      function confirmationDelete(anchor){
        var conf = confirm("Are you sure to delete?");
        if(conf){
          window.location=anchor.attr("href");
        }
      }
      </script>
<script type="text/javascript">
    
    function myFunction(){
      document.getElementById("my_form").submit();
    }
</script>       
   </body>
</html>';
}
else{
     $selectedvalue = get_current_department();

        echo'
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Employees</title>
      <link rel="icon" href="images/favicons.ico" />
      <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
      <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
      <link rel="stylesheet" href="vendor/animate.css/animate.css" />
      <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
      <link rel="stylesheet" href="vendor/fooTable/css/footable.core.min.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
      <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
      <link rel="stylesheet" href="styles/style.css">
      
      <style type="text/css">
   #loading {
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
   position: fixed;
   display: block;
   opacity: 1;
   background-color: #fff;
   z-index: 99;
   text-align: center;
}

#loading-image {
  position: absolute;
  top: 180px;
  margin-left:-95px;
  z-index: 100;

}
table tr td{
  font-size:16px;
}
   </style>

   </head>
   <body class="light-skin fixed-navbar sidebar-scroll">    

   <div id="loading">
  <p style="margin-top: 180px;font-size:20px;">loading...</p> 
  <img id="loading-image" src="images/loading.png" alt="Loading..." />
  </div>               
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
              <li class="active">
                 <a href="employees.php">
                 <span class="nav-label" style="font-size:17px;">Employees</span>
                 </a>
              </li>';
              echo'
           </ul>
        </div>
     </aside>
      <div id="wrapper">
         <div class="content">
            <div class="row">
               <div class="col-lg-12">
                  <div class="hpanel">
                  <a href="add_employee_form.php" class="btn btn-primary text-center" style="margin-top:20px;margin-bottom:15px;font-size:17px;"><p class="pe-7s-plus" style="margin-top:10px;"></p> Add employees</a><br>
                     <div class="panel-heading" style="font-size:17px;margin-bottom:10px;">
                        Employees in '.get_current_department().' Department
                        <div class="pull-right">Export  :  <button id="json" class="btn btn-primary">TO JSON</button> <button id="csv" class="btn btn-info">TO CSV</button>  <button id="pdf" class="btn btn-danger">TO PDF</button></div>
                     </div>
                     <div class="panel-body no-shadow">
                        <input type="text" class="form-control input-sm m-b-md" id="filter" placeholder="Search in table">
                        <table id="example1" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
                           <thead style="font-size:17px;">
                              <tr>
                                 <th>Name</th>
                                 <th>Birthday</th>
                                 <th>Department</th>                               
                                 <th>Education</th>
                                 <th>Marital_status</th>
                                 <th>Race</th>
                                 <th>Sex</th>
                                 <th>Hours per week</th>
                                 <th>Native country</th>
                                 <th>Salary</th>
                                 <th>Manager satisfaction</th>
                                 <th>Late times</th>
                                 <th></th>
                                 <th></th>
                              </tr>  
                           </thead>
                           <tbody>';

                           $filter_manage_level = [];
                           $operation = "Operations";
                           $sales = "Sales";
                           $hr = "Human Resources";
                           $it = "IT";
                           $wh = "Warehouse";
                           $fi = "Finance";

                           try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

  switch ($_SESSION['position']) {
    case 'OPERATION_MANAGER':
      $filter_manage_level=["Department"=>$operation];
      $dept_current = "Operation";
      break;
    case 'SALES_MANAGER':
      $filter_manage_level=["Department"=>$sales];
      $dept_current = "Sales";
      break;
    case 'HR_MANAGER':
      $filter_manage_level=["Department"=>$hr];
      $dept_current = "HR";
      break;
    case 'IT_MANAGER':
      $filter_manage_level=["Department"=>$it];
      $dept_current = "IT";
      break;  
    case 'WAREHOUSE_MANAGER':
      $filter_manage_level=["Department"=>$wh];
      $dept_current = "Warehouse";
      break;
    case 'FINANCE_MANAGER':
      $filter_manage_level=["Department"=>$fi];
      $dept_current = "Finance";
      break;    
  }
  $query = new MongoDB\Driver\Query($filter_manage_level);

  $rows = $manager->executeQuery("project.employee",$query);
  foreach ($rows as $row) {
                            echo'
                              <tr>
                                 <td>'.$row->Name.'</td>
                                 <td>'.$row->Age.'</td>
                                 <td>'.$row->Department.'</td>
                                 <td>'.$row->Education.'</td>
                                 <td>'.$row->Marital_status.'</td>
                                 <td>'.$row->Race.'</td>
                                 <td>'.$row->Sex.'</td>
                                 <td>'.$row->Hours_Per_Week.'</td>
                                 <td>'.$row->Native_Country.'</td>
                                 <td>'.$row->Salary.'</td>
                                 <td>'.$row->Performance_rating.'</td>
                                 <td>'.$row->Late_times.'</td>
                                 <td><a href="employee_pp_deleable.php?id='.$row->_id."&Name=".$row->Name."&Age=".$row->Age."&Department=".$row->Department."&Position=".$row->Position."&Education=".$row->Education."&Marital_status=".$row->Marital_status."&Race=".$row->Race."&Sex=".$row->Sex."&Hours_Per_Week=".$row->Hours_Per_Week."&Native_Country=".$row->Native_Country."&Salary=".$row->Salary."&Start_Date=".$row->Start_Date."&Performance_rating=".$row->Performance_rating."&Leader_review=".$row->Leader_review."&Member_review=".$row->Member_review."&Late_times=".$row->Late_times."&Excuse_times=".$row->Excuse_times."&Absent_W_Excuse=".$row->Absent_W_Excuse."&Mistakes=".$row->Mistakes."&Bonus=".$row->Bonus."&Best_Employee=".$row->Best_Employee."&Address=".$row->Address."&Mail=".$row->Mail.'" class="btn btn-success" style="background-color:#c97ce5;">Edit</a></td>
                                 <td><a onclick="javascript:confirmationDelete($(this));return false;" href="delete_choose_employee.php?id='.$row->_id."&Name=".$row->Name."&Age=".$row->Age."&Department=".$row->Department."&Position=".$row->Position."&Education=".$row->Education."&Marital_status=".$row->Marital_status."&Race=".$row->Race."&Sex=".$row->Sex."&Hours_Per_Week=".$row->Hours_Per_Week."&Native_Country=".$row->Native_Country."&Salary=".$row->Salary."&Start_Date=".$row->Start_Date."&Performance_rating=".$row->Performance_rating."&Leader_review=".$row->Leader_review."&Member_review=".$row->Member_review."&Late_times=".$row->Late_times."&Excuse_times=".$row->Excuse_times."&Absent_W_Excuse=".$row->Absent_W_Excuse."&Mistakes=".$row->Mistakes."&Bonus=".$row->Bonus."&Best_Employee=".$row->Best_Employee."&Address=".$row->Address."&Mail=".$row->Mail.'" class="btn btn-primary" style="background-color:red;">Delete</a></td>
                              </tr>';
                           }
} catch (MongoDB\Driver\Exception\Exception $e) {
  die("Error encountered!".$e);
}
                           
                           echo'
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="12">
                                    <ul class="pagination pull-right"></ul>
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        
         <footer class="footer">
            <span class="pull-right">
            <h5 style="color:#c97ce5;">Software Engineering</h5>
            </span>
            <h5 style="color:#c97ce5;">University of Information Technology</h5>
         </footer>
      </div>
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="vendor/fooTable/dist/footable.all.min.js"></script>
      <script src="scripts/devdap.js"></script>

      <script language="javascript" type="text/javascript">
     $(window).load(function() {
     $("#loading").hide();
  });
</script>
      <script language="javascript">
      function confirmationDelete(anchor){
        var conf = confirm("Are you sure to delete?");
        if(conf){
          window.location=anchor.attr("href");
        }
      }
      </script>
      
   </body>
</html>';
      }
}
?>        
<script>$(function(){$("#example1").footable();$("#example2").footable()});</script>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script src="src/tableHTMLExport.js"></script>
<script>
  $('#json').on('click',function(){
    $("#example1").tableHTMLExport({type:'json',filename:'<?php echo $selectedvalue.'_employees';?>.json'});
  })
  $('#csv').on('click',function(){
    $("#example1").tableHTMLExport({type:'csv',filename:'<?php echo $selectedvalue.'_employees';?>.csv'});
  })
  $('#pdf').on('click',function(){
    $("#example1").tableHTMLExport({type:'pdf',filename:'<?php echo $selectedvalue.'_employees';?>.pdf'});
  })
  </script>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
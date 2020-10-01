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


$first_part = explode("_", $_SESSION["position"]);
if ($first_part[0] == "HR") {
  $first_part[0] = "HUMAN RESOURCES";
}

function showDisabled($first_part){
  if (strpos(strtoupper($_GET["Department"]),$first_part[0]) !== false or $_SESSION["position"]== "HR_MANAGER") {
    return "";
  }else{
    return "disabled";
  }
}

function showReadonly($first_part){
  if (strpos(strtoupper($_GET["Department"]),$first_part[0]) !== false or $_SESSION["position"]== "HR_MANAGER") {
    return "";
  }else{
    return "readonly";
  }   
}

//check selected
function value_selected_be($pos){
  if ($pos == $_GET["Best_Employee"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}

function value_selected($pos){
  if ($pos == $_GET["Department"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_position($pos){
  if ($pos == $_GET["Position"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
//Show rating star

function showStar($star_number){
   switch ($star_number) {
     case 0:
       return '<img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>';
       break;
     case 1:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>';
       break;
     case 2:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>';
       break;
     case 3:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>';
       break;
     case 4:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>';
       break;
     case 5:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>';
       break;       
     default:
       return '<img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank_white.png" style="width:17px;height:17px;"/>';
       break;
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
    <title>'.$_GET["Name"].'</title>
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
         
            <div class="row" style="margin-top:20px;">
            
               <div class="col-lg-6">
                 <div class="hpanel">
                  <div class="panel-body th-border" >
                     <img src="upload/'.getProfileImagePath($_GET["id"]).'" style="height:120px;display:block;margin-left:0;margin-right:auto;width:120px;" class="img-circle img-small" /><br>
                          <h3>'.$_GET["Name"].'</h3>
                          <div class="text-muted font-bold m-b-xs">'.$_GET["Mail"].'</div>
                          <h5>
                              '.$_GET["Address"].'
                          </h5>
                  </div>
                  <div class="panel-body no-padding">
                        <ul class="list-group" style="font-size:17px;">
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Age'].'</span>
                              Birthday
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Department'].'</span>
                              Department
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Position'].'</span>
                              Position
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Education'].'</span>
                              Education
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Marital_status'].'</span>
                              Marital_status
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Race'].'</span>
                              Race
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Sex'].'</span>
                              Sex
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Hours_Per_Week'].'</span>
                              Hours_Per_Week
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Native_Country'].'</span>
                              Native_Country
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Start_Date'].'</span>
                              Start_Date
                           </li>

                           <li class="list-group-item">
                              <span class="badge badge-primary" style"background:gray;">'.showStar($_GET["Performance_rating"]).'</span>
                              Manager satisfaction
                           </li>

                           <li class="list-group-item">
                              <span class="badge badge-primary" style"background:gray;">'.showStar($_GET["Leader_review"]).'</span>
                              Leader_review
                           </li>

                           <li class="list-group-item">
                              <span class="badge badge-primary" style"background:gray;">'.showStar($_GET["Member_review"]).'</span>
                              Member review
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Late_times'].'</span>
                              Late times this week
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Excuse_times'].'</span>
                              Excuse times this month
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Absent_W_Excuse'].'</span>
                              Absent times without excuse
                           </li>
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Mistakes'].'</span>
                              Mistakes
                           </li>
                           
                        </ul>
                     </div>
               </div> 
            </div> 

            <div class="col-lg-6">
                  <div class="hpanel">
                     <div class="panel-heading">
                        
                        <h3>Penalties!</h3>
                     </div>
                     <div class="panel-body th-border">

                     <form action="php/update_employee_from_index.php" method="POST">

                        <input type="hidden" value="'.$_GET["id"].'" id="id" class="form-control" name="id" required>
                           
                              <input type="hidden" value="'.$_GET["Name"].'" id="name" class="form-control" name="Name" required>

                              <input type="hidden" value="'.$_GET["Age"].'" id="age" class="form-control" name="Age" required>
                           
                              <input type="hidden" value="'.$_GET["Education"].'" id="education" class="form-control" name="Education" required>

                              <input type="hidden" value="'.$_GET["Marital_status"].'" id="marital_status" class="form-control" name="Marital_status" required>
                           
                              <input type="hidden" value="'.$_GET["Race"].'" id="race" class="form-control" name="Race" required>

                              <input type="hidden" value="'.$_GET["Sex"].'" id="sex" class="form-control" name="Sex" required>
                           
                              <input type="hidden" value="'.$_GET["Hours_Per_Week"].'" id="hours_per_week" class="form-control" name="Hours_Per_Week" required>

                              <input type="hidden" value="'.$_GET["Native_Country"].'" id="native_country" class="form-control" name="Native_Country" required>
                           
                              <input type="hidden" value="'.$_GET["Start_Date"].'" id="start_date" class="form-control" name="Start_Date" required>

                              <input type="hidden" value="'.$_GET["Performance_rating"].'" id="performance_rating" class="form-control" name="Performance_rating" required>
                           
                              <input type="hidden" value="'.$_GET["Late_times"].'" id="late_times" class="form-control" name="Late_times" required>

                              <input type="hidden" value="'.$_GET["Excuse_times"].'" id="excuse_times" class="form-control" name="Excuse_times" required>
                           
                              <input type="hidden" value="'.$_GET["Absent_W_Excuse"].'" id="absent_w_excuse" class="form-control" name="Absent_W_Excuse" required>

                              <input type="hidden" value="'.$_GET["Mistakes"].'" id="mistakes" class="form-control" name="Mistakes" required>

                              <input type="hidden" value="'.$_GET["Address"].'" id="address" class="form-control" name="Address" required>

                              <input type="hidden" value="'.$_GET["Mail"].'" id="mail" class="form-control" name="Mail" required>

                        <div class="form-group col-lg-12">
                              <label><h4>Salary $</h4></label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/salary_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["Salary"].'" id="income" class="form-control" name="Salary" '.showReadonly($first_part).'>
                              </div>
                           </div><br>
                        <div class="form-group col-lg-12">
                              <label><h4>Deduction by percentage</h4></label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/minus_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="salary_minus" style="width:100%;height: 35px"  required '.showDisabled($first_part).'>
                                  <option value="0" selected>0 %</option>
                                  <option value="5">5 %</option>
                                  <option value="10">10 %</option>
                                  <option value="15">15 %</option>
                                  <option value="20">20 %</option>
                                  <option value="30">30 %</option>
                                  <option value="40">40 %</option>
                                  <option value="50">50 %</option>
                                </select>
                                </div>
                           </div><br>      
                         <div class="form-group col-lg-12">
                              <input type="hidden" value="'.$_GET["Bonus"].'" id="loss" class="form-control" name="Bonus">
                           </div><br>   
                          <div class="form-group col-lg-12">
                              <label><h4>Position</h4></label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/position_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Position" style="width:100%;height: 35px"  required '.showDisabled($first_part).'>
                                  <option value="Operation Manager" '.value_selected_position("Operation Manager").'>Operation Manager</option>
                                  <option value="Sales Manager" '.value_selected_position("Sales Manager").'>Sales Manager</option>
                                  <option value="HR Manager" '.value_selected_position("HR Manager").'>HR Manager</option>
                                  <option value="IT Manager" '.value_selected_position("IT Manager").'>IT Manager</option>
                                  <option value="Warehouse Manager" '.value_selected_position("Warehouse Manager").'>Warehouse Manager</option>
                                  <option value="Finance Manager" '.value_selected_position("Finance Manager").'>Finance Manager</option>
                                  <option value="Office Manager" '.value_selected_position("Office Manager").'>Office Manager</option>
                                  <option value="Team Leader" '.value_selected_position("Team Leader").'>Team Leader</option>
                                  <option value="Supervisor" '.value_selected_position("Supervisor").'>Supervisor</option>
                                  <option value="Member" '.value_selected_position("Member").'>Member</option>
                                </select>
                                </div>
                           </div><br>
                         <div class="form-group col-lg-12">
                              <label><h4>Department</h4></label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/depart_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Department" style="width:100%;height: 35px"  required '.showDisabled($first_part).'>
                                  <option value="Operations" '.value_selected("Operations").'>Operations</option>
                                  <option value="Sales" '.value_selected("Sales").'>Sales</option>
                                  <option value="Resources" '.value_selected("Human Resources").'>Human Resources</option>
                                  <option value="IT" '.value_selected("IT").'>IT</option>
                                  <option value="Warehouse" '.value_selected("Warehouse").'>Warehouse</option>
                                  <option value="Finance" '.value_selected("Finance").'>Finance</option>
                                </select> 
                                </div>
                           </div><br>
                           <div class="form-group col-lg-12" hidden>
                              <label>Best employee</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/best_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Best_Employee" style="width:100%;height: 35px"  required '.showDisabled($first_part).'>
                                  <option value="0" '.value_selected_be(0).'>0</option>
                                  <option value="1" '.value_selected_be(1).'>1</option>
                                  <option value="2" '.value_selected_be(2).'>2</option>
                                  <option value="3" '.value_selected_be(3).'>3</option>
                                  <option value="4" '.value_selected_be(4).'>4</option>
                                  <option value="5" '.value_selected_be(5).'>5</option>
                                  <option value="1" '.value_selected_be(6).'>6</option>
                                  <option value="2" '.value_selected_be(7).'>7</option>
                                  <option value="3" '.value_selected_be(8).'>8</option>
                                  <option value="4" '.value_selected_be(9).'>9</option>
                                  <option value="5" '.value_selected_be(10).'>10</option>
                                </select>
                                </div>
                           </div><br>   
                           <br>
                           <div class="text-center">';
                           if (strpos(strtoupper($_GET["Department"]),$first_part[0]) !== false or $_SESSION["position"] == "HR_MANAGER") {
                             echo '

                           <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="margin-right:25px;font-size:17px;">Back to Home</a> |  
                           <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary text-center" style="width:80px;font-size:17px;margin-right:25px;margin-left:25px;"/>   |   
                           <a href="dismiss.php?id='.$_GET["id"]."&Name=".$_GET["Name"]."&Age=".$_GET["Age"]."&Department=".$_GET["Department"]."&Position=".$_GET["Position"]."&Education=".$_GET["Education"]."&Marital_status=".$_GET["Marital_status"]."&Race=".$_GET["Race"]."&Sex=".$_GET["Sex"]."&Hours_Per_Week=".$_GET["Hours_Per_Week"]."&Native_Country=".$_GET["Native_Country"]."&Salary=".$_GET["Salary"]."&Start_Date=".$_GET["Start_Date"]."&Performance_rating=".$_GET["Performance_rating"]."&Late_times=".$_GET["Late_times"]."&Excuse_times=".$_GET["Excuse_times"]."&Absent_W_Excuse=".$_GET["Absent_W_Excuse"]."&Mistakes=".$_GET["Mistakes"]."&Bonus=".$_GET["Bonus"]."&Best_Employee=".$_GET["Best_Employee"].'"class="btn btn-primary text-center" style="background-color:red;margin-left:25px;font-size:17px;">Dismiss</a>';
                         }else{
                          echo'<a id=animation-btn onclick="goBack()" class="btn btn-primary" style="margin-right:25px;font-size:17px;">Back to Home</a>';
                         }
                         echo'</div>
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
    



       











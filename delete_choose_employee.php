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
function value_selected_native($pos){
  if ($pos == $_GET["Native_Country"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_performance($pos){
  if ($pos == $_GET["Performance_rating"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_late($pos){
  if ($pos == $_GET["Late_times"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_excuse($pos){
  if ($pos == $_GET["Excuse_times"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_absent_w($pos){
  if ($pos == $_GET["Absent_W_Excuse"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_mistake($pos){
  if ($pos == $_GET["Mistakes"]) {
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
    <title>Employee Information</title>
    <link rel="icon" href="images/favicons.ico" />
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">

    <style>
    .upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.btnChoose {
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.upload-btn-wrapper input[type=file] {
  font-size: 30px;
  position:absolute;
  display: block;
  margin-left: auto;
  margin-right: auto;
  top: 0;
  opacity: 0;
}
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
            <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="font-size:17px;margin-top:30px;margin-left:30px;">Back to Employees</a>
         </div>
         <div class="content" style="margin-left:300px;margin-right:300px;">

            <div class="row" style="margin-top:-10px;">
            
               <div class="col-lg-12">
               <div class="text-center m-b-md">
                  <h2>Choose Operation!</h2>
                 
               </div>
                 <div class="hpanel">
                  <div class="panel-body th-border">
                     <img src="upload/'.getProfileImagePath($_GET["id"]).'" style="height:120px;display:block;margin-left:0;margin-right:auto;width:120px;" class="img-circle img-small" /><br>
                          <h3>'.$_GET["Name"].'</h3>
                          <div class="text-muted font-bold m-b-xs">'.$_GET["Mail"].'</div>
                          <h5>
                              '.$_GET["Address"].'
                          </h5>
                          <div class="pull-right" style="margin-top:-7%;">
                           <a href="retire.php?id='.$_GET["id"]."&Name=".$_GET["Name"]."&Age=".$_GET["Age"]."&Department=".$_GET["Department"]."&Position=".$_GET["Position"]."&Education=".$_GET["Education"]."&Marital_status=".$_GET["Marital_status"]."&Race=".$_GET["Race"]."&Sex=".$_GET["Sex"]."&Hours_Per_Week=".$_GET["Hours_Per_Week"]."&Native_Country=".$_GET["Native_Country"]."&Salary=".$_GET["Salary"]."&Start_Date=".$_GET["Start_Date"]."&Performance_rating=".$_GET["Performance_rating"]."&Late_times=".$_GET["Late_times"]."&Excuse_times=".$_GET["Excuse_times"]."&Absent_W_Excuse=".$_GET["Absent_W_Excuse"]."&Mistakes=".$_GET["Mistakes"]."&Bonus=".$_GET["Bonus"]."&Best_Employee=".$_GET["Best_Employee"].'"class="btn btn-primary text-center" style="margin-left:25px;margin-right:25px;font-size:17px;">Turnover</a>      |    
                           <a href="dismiss.php?id='.$_GET["id"]."&Name=".$_GET["Name"]."&Age=".$_GET["Age"]."&Department=".$_GET["Department"]."&Position=".$_GET["Position"]."&Education=".$_GET["Education"]."&Marital_status=".$_GET["Marital_status"]."&Race=".$_GET["Race"]."&Sex=".$_GET["Sex"]."&Hours_Per_Week=".$_GET["Hours_Per_Week"]."&Native_Country=".$_GET["Native_Country"]."&Salary=".$_GET["Salary"]."&Start_Date=".$_GET["Start_Date"]."&Performance_rating=".$_GET["Performance_rating"]."&Late_times=".$_GET["Late_times"]."&Excuse_times=".$_GET["Excuse_times"]."&Absent_W_Excuse=".$_GET["Absent_W_Excuse"]."&Mistakes=".$_GET["Mistakes"]."&Bonus=".$_GET["Bonus"]."&Best_Employee=".$_GET["Best_Employee"].'"class="btn btn-primary text-center" style="background-color:red;margin-left:25px;font-size:17px;">Dismiss</a>
                        </div>
                  </div>
                  <div class="panel-body no-padding">
                        <ul class="list-group" style="font-size:15px;font-weight:bold;">
                           <li class="list-group-item">
                              <span class="badge badge-primary" style="font-size:17px;background:gray;">'.$_GET['Age'].'</span>
                              Age
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
                              <span class="badge badge-primary" style"background:gray;">'.showStar($_GET["Performance_rating"]).'</span>
                              Manager satisfaction
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
    



       











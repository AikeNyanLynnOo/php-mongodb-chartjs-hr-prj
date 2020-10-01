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


//

//performance table
function getEmployeesByPerformance($perform){
  $result;
  try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(["Performance_rating"=>$perform]);

  $rows = $manager->executeQuery("project.employee",$query);
  $result = $rows->toArray();
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("error encountered!".$e);
}

	return $result;
}

// 

function getDepartmentEmpByPerformance($perform,$depart){
  $result;
  try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $query = new MongoDB\Driver\Query(["Performance_rating"=>$perform,"Department"=>$depart]);

  $rows = $manager->executeQuery("project.employee",$query);
  $result = $rows->toArray();
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("error encountered!".$e);
}

	return $result;
}

$all_result5 = getEmployeesByPerformance(5);
$all_result4 = getEmployeesByPerformance(4);
$all_result3 = getEmployeesByPerformance(3);
$all_result2 = getEmployeesByPerformance(2);
$all_result1 = getEmployeesByPerformance(1);
$all_result0 = getEmployeesByPerformance(0);


$op_result5 = getDepartmentEmpByPerformance(5,"Operations");
$op_result4 = getDepartmentEmpByPerformance(4,"Operations");
$op_result3 = getDepartmentEmpByPerformance(3,"Operations");
$op_result2 = getDepartmentEmpByPerformance(2,"Operations");
$op_result1 = getDepartmentEmpByPerformance(1,"Operations");
$op_result0 = getDepartmentEmpByPerformance(0,"Operations");

$sales_result5 = getDepartmentEmpByPerformance(5,"Sales");
$sales_result4 = getDepartmentEmpByPerformance(4,"Sales");
$sales_result3 = getDepartmentEmpByPerformance(3,"Sales");
$sales_result2 = getDepartmentEmpByPerformance(2,"Sales");
$sales_result1 = getDepartmentEmpByPerformance(1,"Sales");
$sales_result0 = getDepartmentEmpByPerformance(0,"Sales");

$hr_result5 = getDepartmentEmpByPerformance(5,"Human Resources");
$hr_result4 = getDepartmentEmpByPerformance(4,"Human Resources");
$hr_result3 = getDepartmentEmpByPerformance(3,"Human Resources");
$hr_result2 = getDepartmentEmpByPerformance(2,"Human Resources");
$hr_result1 = getDepartmentEmpByPerformance(1,"Human Resources");
$hr_result0 = getDepartmentEmpByPerformance(0,"Human Resources");

$it_result5 = getDepartmentEmpByPerformance(5,"IT");
$it_result4 = getDepartmentEmpByPerformance(4,"IT");
$it_result3 = getDepartmentEmpByPerformance(3,"IT");
$it_result2 = getDepartmentEmpByPerformance(2,"IT");
$it_result1 = getDepartmentEmpByPerformance(1,"IT");
$it_result0 = getDepartmentEmpByPerformance(0,"IT");

$wh_result5 = getDepartmentEmpByPerformance(5,"Warehouse");
$wh_result4 = getDepartmentEmpByPerformance(4,"Warehouse");
$wh_result3 = getDepartmentEmpByPerformance(3,"Warehouse");
$wh_result2 = getDepartmentEmpByPerformance(2,"Warehouse");
$wh_result1 = getDepartmentEmpByPerformance(1,"Warehouse");
$wh_result0 = getDepartmentEmpByPerformance(0,"Warehouse");

$fi_result5 = getDepartmentEmpByPerformance(5,"Finance");
$fi_result4 = getDepartmentEmpByPerformance(4,"Finance");
$fi_result3 = getDepartmentEmpByPerformance(3,"Finance");
$fi_result2 = getDepartmentEmpByPerformance(2,"Finance");
$fi_result1 = getDepartmentEmpByPerformance(1,"Finance");
$fi_result0 = getDepartmentEmpByPerformance(0,"Finance");


function sortAllAscending($all_result0,$all_result1,$all_result2,$all_result3,$all_result4,$all_result5){
  $all_result=[];
for ($i=0; $i < sizeof($all_result0) ; $i++) { 
    array_push($all_result, $all_result0[$i]);
}
for ($i=0; $i < sizeof($all_result1) ; $i++) { 
    array_push($all_result, $all_result1[$i]);
}
for ($i=0; $i < sizeof($all_result2) ; $i++) { 
    array_push($all_result, $all_result2[$i]);
}
for ($i=0; $i < sizeof($all_result3) ; $i++) { 
    array_push($all_result, $all_result3[$i]);
}
for ($i=0; $i < sizeof($all_result4) ; $i++) { 
    array_push($all_result, $all_result4[$i]);
}
for ($i=0; $i < sizeof($all_result5) ; $i++) { 
    array_push($all_result, $all_result5[$i]);
}   
return $all_result;
}

	switch ($selectedvalue) {
		case 'All':
			$all_result_desc = sortAllAscending($all_result0,$all_result1,$all_result2,$all_result3,$all_result4,$all_result5);
			break;
		case 'Operations':
            $all_result_desc = sortAllAscending($op_result0,$op_result1,$op_result2,$op_result3,$op_result4,$op_result5);
		    break;
		case 'Sales':
            $all_result_desc = sortAllAscending($sales_result0,$sales_result1,$sales_result2,$sales_result3,$sales_result4,$sales_result5);
		    break;
		case 'Human Resources':
            $all_result_desc = sortAllAscending($hr_result0,$hr_result1,$hr_result2,$hr_result3,$hr_result4,$hr_result5);
		    break;
		case 'IT':
            $all_result_desc = sortAllAscending($it_result0,$it_result1,$it_result2,$it_result3,$it_result4,$it_result5);
		    break;
		case 'Warehouse':
            $all_result_desc = sortAllAscending($wh_result0,$wh_result1,$wh_result2,$wh_result3,$wh_result4,$wh_result5);
		    break;
		case 'Finance':
            $all_result_desc = sortAllAscending($fi_result0,$fi_result1,$fi_result2,$fi_result3,$fi_result4,$fi_result5);
		    break;                      
		default:
			$all_result_desc = sortAllAscending($all_result0,$all_result1,$all_result2,$all_result3,$all_result4,$all_result5);
			break;
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

//showing star
function showStar($star_number){
   switch ($star_number) {
     case 0:
       return '<img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>';
       break;
     case 1:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>';
       break;
     case 2:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>';
       break;
     case 3:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>';
       break;
     case 4:
       return '<img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_fill.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>';
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
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>
       <img src="images/star_blank.png" style="width:17px;height:17px;"/>';
       break;
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
    <link rel="stylesheet" href="vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" />
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
         <div class="content" style="margin-left:10px;margin-right:10px;">
            <div class="row" style="margin-top:10px;">
               <div class="col-lg-12">
                 <div class="hpanel">
                    <form action="all_employee_performance_worst.php" method="POST" id="my_form">
                                
                                <select onchange="myFunction()" name="selection" id="my_selection" style="width:15%;height: 35px" class="pull-right">
                                   <option value="All" '.showSelectedValue("All",$selectedvalue).'>All</option>
                                   <option value="Operations" '.showSelectedValue("Operations",$selectedvalue).'>Operations</option>
                                   <option value="Sales" '.showSelectedValue("Sales",$selectedvalue).'>Sales</option>
                                   <option value="Human Resources" '.showSelectedValue("Human Resources",$selectedvalue).'>Human Resources</option>
                                   <option value="IT" '.showSelectedValue("IT",$selectedvalue).'>IT</option>
                                   <option value="Warehouse" '.showSelectedValue("Warehouse",$selectedvalue).'>Warehouse</option>
                                   <option value="Finance" '.showSelectedValue("Finance",$selectedvalue).'>Finance</option>
                                </select>
                     </form>
                     <div class="panel-heading" style="font-size:17px;">
                        Employees ordered by performance
                     </div>
                     
                     
                     <div class="panel-body no-shadow">
                        <input type="text" class="form-control input-sm m-b-md" id="filter" placeholder="Search in table">
                        <table id="example1" class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
                           <thead style="font-size:17px;">
                              <tr>
                                 <th>Picture</th>
                                 <th>Name</th>
                                 <th>Position</th>                               
                                 <th>Department</th>
                                 <th>Mail</th>
                                 <th>Manager satisfaction</th>
                              </tr>   
                           </thead>
                           <tbody>';
                try {
                	for ($i=0; $i < sizeof($all_result_desc) ; $i++) { 
                		echo '
                            <tr>
                              <td><img src="upload/'.getProfileImagePath((string)$all_result_desc[$i]->_id).'" style="height:40px;display:block;margin-left:8px;margin-right:auto;width:40px;" class="img-circle img-small" ></td>
                              <td>'.$all_result_desc[$i]->Name.'</td>
                              <td>'.$all_result_desc[$i]->Position.'</td>
                              <td>'.$all_result_desc[$i]->Department.'</td>
                              <td>'.$all_result_desc[$i]->Mail.'</td>
                              <td>'.showStar($all_result_desc[$i]->Performance_rating).'</td>
                            </tr>';
                	}
                	    
                           	
                           } catch (MongoDB\Driver\Exception\Exception $e) {
                           	 die("error encountered".$e);
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
      <script src="vendor/fooTable/dist/footable.all.min.js"></script>
      <script src="scripts/devdap.js"></script>
      

      <script language="javascript" type="text/javascript">
     $(window).load(function() {
     $("#loading").hide();
  });
</script>

  <script type="text/javascript">
    
    function myFunction(){
      document.getElementById("my_form").submit();
    }
  </script>
   </body>
</html>';
}
?>
<script>$(function(){$("#example1").footable();$("#example2").footable()});</script>  
    



       











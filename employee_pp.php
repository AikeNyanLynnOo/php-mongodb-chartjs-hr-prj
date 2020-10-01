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
function value_selected_edu($pos){
  if ($pos == $_GET["Education"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_marital($pos){
  if ($pos == $_GET["Marital_status"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_race($pos){
  if ($pos == $_GET["Race"]) {
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
function value_selected_Leader_review($pos){
  if ($pos == $_GET["Leader_review"]) {
                                  return "selected";
                                }else{
                                  return '';
                                }
}
function value_selected_member_review($pos){
  if ($pos == $_GET["Member_review"]) {
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
function value_checked($pos){
  if ($pos == $_GET["Sex"]) {
                                  return "checked";
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
         <div class="content" style="margin-left:300px;margin-right:300px;">
            <div class="row" style="margin-top:30px;">
               <div class="col-lg-12">
                 <div class="hpanel">
                        <form action="php/update_photo.php" method="POST" enctype="multipart/form-data">
                          <div class="upload-btn-wrapper pull-right">
                          <button class="btn btnChoose btn-primary"><i class="pe-7s-browser"></i> Browse</button>
                          <input type="file" name="file" />
                          <button type="submit" name="submit" style="margin-left:auto;margin-right:auto;width:auto;margin-top:7px;" class="btn btn-primary btn-block"><i class="pe-7s-upload"></i> Upload</button>
                          </div>
                          
                          <input type="hidden" value="'.$_GET["id"].'" id="id" class="form-control" name="id" required>
                          <input type="hidden" value="'.$_GET["Name"].'" id="name" class="form-control" name="Name" required>
                          <img src="upload/'.getProfileImagePath($_GET["id"]).'" style="height:120px;display:block;margin-left:0;margin-right:auto;width:120px;" class="img-circle img-small" /><br>
                          <h3>'.$_GET['Name'].'</h3>
                          <div class="text-muted font-bold m-b-xs">'.$_GET["Mail"].'</div>
                          <h5>
                              '.$_GET["Address"].'
                          </h5>

                        </form><br>
                  <div class="panel-body no-shadow th-border">
                     <form action="php/update_employee.php" id="loginForm" method="POST" style="font-size:17px;">
                        <div class="row">
                              <input type="hidden" value="'.$_GET["id"].'" id="id" class="form-control" name="id" required>
                           
                              <input type="hidden" value="'.$_GET["Name"].'" id="name" class="form-control" name="Name" required>
                           
                           <div class="form-group col-lg-12">
                              <label>Birthday (mm/dd/yyyy)</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/calendar_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="date" value="'.date('Y-m-d',strtotime($_GET["Age"])).'" id="age" class="form-control" name="Age" style="padding-bottom:40px;" required>   
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                             <label>Department</label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/depart_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Department" style="width:100%;height: 35px"  required>
                                  <option value="Operations" '.value_selected("Operations").'>Operations</option>
                                  <option value="Sales" '.value_selected("Sales").'>Sales</option>
                                  <option value="Human Resources" '.value_selected("Human Resources").'>Human Resources</option>
                                  <option value="IT" '.value_selected("IT").'>IT</option>
                                  <option value="Warehouse" '.value_selected("Warehouse").'>Warehouse</option>
                                  <option value="Finance" '.value_selected("Finance").'>Finance</option>
                                </select> 
                                </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                             <label>Position</label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/position_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Position" style="width:100%;height: 35px"  required>
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
                               <label>Education</label><br>
                               <div class="input-group m-b"><span class="input-group-addon"><img src="images/edu_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Education" style="width:100%;height: 35px"  required>
                                  <option value="9th" '.value_selected_edu("9th").'>9th</option>
                                  <option value="10th" '.value_selected_edu("10th").'>10th</option>
                                  <option value="11th" '.value_selected_edu("11th").'>11th</option>
                                  <option value="HS-grad" '.value_selected_edu("HS-grad").'>HS-grad</option>
                                  <option value="Some-college" '.value_selected_edu("Some-college").'>Some-college</option>
                                  <option value="Bachelors" '.value_selected_edu("Bachelors").'>Bachelors</option>
                                  <option value="Masters" '.value_selected_edu("Masters").'>Masters</option>
                                  <option value="Doctorate" '.value_selected_edu("Doctorate").'>Doctorate</option>
                                </select> 
                                </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                             <label>Marital_status</label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/marital_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Marital_status" style="width:100%;height: 35px"  required>
                                  <option value="Single" '.value_selected_marital("Single").'>Single</option>
                                  <option value="Married" '.value_selected_marital("Married").'>Married</option>
                                  <option value="Divorced" '.value_selected_marital("Divorced").'>Divorced</option>
                                  <option value="Separated" '.value_selected_marital("Separated").'>Separated</option>
                                  <option value="Widowed" '.value_selected_marital("Widowed").'>Widowed</option>
                                </select> 
                                </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Race</label><br>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/race_field.png" alt="name" style="height:20px;width:20px;"></span>
                               <select name="Race" style="width:100%;height: 35px"  required>
                                  <option value="White" '.value_selected_race("White").'>White</option>
                                  <option value="Black" '.value_selected_race("Black").'>Black</option>
                                  <option value="Asian-Pac-Islander" '.value_selected_race("Asian-Pac-Islander").'>Asian-Pac-Islander</option>
                                  <option value="Amer-Indian-Eskimo" '.value_selected_race("Amer-Indian-Eskimo").'>Amer-Indian-Eskimo</option>
                                  <option value="Other" '.value_selected_race("Other").'>Other</option>
                                </select>
                                </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Sex</label><br>
                               <input type="radio" name="Sex" value="Male" '.value_checked("Male").' required> Male 
                               <input type="radio" name="Sex" value="Female" style="margin-left:30px;" '.value_checked("Female").' required> Female
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Mail</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/mail_field.png" alt="mail" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["Mail"].'" id="mail" class="form-control" name="Mail" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" style="font-size:17px;" />
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Address</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/address_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["Address"].'" id="address" class="form-control" name="Address" required style="font-size:17px;"/>
                              </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Hours_Per_Week</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/hpw_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["Hours_Per_Week"].'" id="hours_per_week" class="form-control" name="Hours_Per_Week" required/>
                              </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Native_Country</label><br>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/native_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select id="Native_Country" name="Native_Country" style="width:100%;height: 35px"  required>
                                    <option value="Afghanistan" '.value_selected_native("Afghanistan").'>Afghanistan</option>
                                    <option value="Albania" '.value_selected_native("Albania").'>Albania</option>
                                    <option value="Algeria" '.value_selected_native("Algeria").'>Algeria</option>
                                    <option value="Andorra" '.value_selected_native("Andorra").'>Andorra</option>
                                    <option value="Antigua and Barbuda" '.value_selected_native("Antigua and Barbuda").'>Antigua and Barbuda</option>
                                    <option value="Argentina" '.value_selected_native("Argentina").'>Argentina</option>
                                    <option value="Armenia" '.value_selected_native("Armenia").'>Armenia</option>
                                    <option value="Australia" '.value_selected_native("Australia").'>Australia</option>
                                    <option value="Austria" '.value_selected_native("Austria").'>Austria</option>
                                    <option value="Azerbaijan" '.value_selected_native("Azerbaijan").'>Azerbaijan</option>
                                    <option value="Bahamas" '.value_selected_native("Bahamas").'>Bahamas</option>
                                    <option value="Bahrain" '.value_selected_native("Bahrain").'>Bahrain</option>
                                    <option value="Bangladesh" '.value_selected_native("Bangladesh").'>Bangladesh</option>
                                    <option value="Barbados" '.value_selected_native("Barbados").'>Barbados</option>
                                    <option value="Belarus" '.value_selected_native("Belarus").'>Belarus</option>
                                    <option value="Belgium" '.value_selected_native("Belgium").'>Belgium</option>
                                    <option value="Belize" '.value_selected_native("Belize").'>Belize</option>
                                    <option value="Benin" '.value_selected_native("Benin").'>Benin</option>
                                    <option value="Bhutan" '.value_selected_native("Bhutan").'>Bhutan</option>
                                    <option value="Bolivia" '.value_selected_native("Bolivia").'>Bolivia</option>
                                    <option value="Bosnia and Herzegovina" '.value_selected_native("Bosnia and Herzegovina").'>Bosnia and Herzegovina</option>
                                    <option value="Botswana" '.value_selected_native("Botswana").'>Botswana</option>
                                    <option value="Brazil" '.value_selected_native("Brazil").'>Brazil</option>
                                    <option value="Brunei" '.value_selected_native("Brunei").'>Brunei</option>
                                    <option value="Bulgaria" '.value_selected_native("Bulgaria").'>Bulgaria</option>
                                    <option value="Burkina Faso" '.value_selected_native("Burkina Faso").'>Burkina Faso</option>
                                    <option value="Burundi" '.value_selected_native("Burundi").'>Burundi</option>
                                    <option value="Cambodia" '.value_selected_native("Cambodia").'>Cambodia</option>
                                    <option value="Cameroon" '.value_selected_native("Cameroon").'>Cameroon</option>
                                    <option value="Canada" '.value_selected_native("Canada").'>Canada</option>
                                    <option value="Cape Verde" '.value_selected_native("Cape Verde").'>Cape Verde</option>
                                    <option value="Central African Republic" '.value_selected_native("Central African Republic").'>Central African Republic</option>
                                    <option value="Chad" '.value_selected_native("Chad").'>Chad</option>
                                    <option value="Chile" '.value_selected_native("Chile").'>Chile</option>
                                    <option value="China" '.value_selected_native("China").'>China</option>
                                    <option value="Colombia" '.value_selected_native("Colombia").'>Colombia</option>
                                    <option value="Comoros" '.value_selected_native("Comoros").'>Comoros</option>
                                    <option value="Congo" '.value_selected_native("Congo").'>Congo</option>
                                    <option value="Costa Rica" '.value_selected_native("Costa Rica").'>Costa Rica</option>
                                    <option value="Cote d Ivoire" '.value_selected_native("Cote d Ivoire").'>Cote d Ivoire</option>
                                    <option value="Croatia" '.value_selected_native("Croatia").'>Croatia</option>
                                    <option value="Cuba" '.value_selected_native("Cuba").'>Cuba</option>
                                    <option value="Cyprus" '.value_selected_native("Cyprus").'>Cyprus</option>
                                    <option value="Czech Republic" '.value_selected_native("Czech Republic").'>Czech Republic</option>
                                    <option value="Denmark" '.value_selected_native("Denmark").'>Denmark</option>
                                    <option value="Djibouti" '.value_selected_native("Djibouti").'>Djibouti</option>
                                    <option value="Dominica" '.value_selected_native("Dominica").'>Dominica</option>
                                    <option value="Dominican Republic" '.value_selected_native("Dominican Republic").'>Dominican Republic</option>
                                    <option value="East Timor" '.value_selected_native("East Timor").'>East Timor</option>
                                    <option value="Ecuador" '.value_selected_native("Ecuador").'>Ecuador</option>
                                    <option value="Egypt" '.value_selected_native("Egypt").'>Egypt</option>
                                    <option value="El Salvador" '.value_selected_native("El Salvador").'>El Salvador</option>
                                    <option value="Equatorial Guinea" '.value_selected_native("Equatorial Guinea").'>Equatorial Guinea</option>
                                    <option value="Eritrea" '.value_selected_native("Eritrea").'>Eritrea</option>
                                    <option value="Estonia" '.value_selected_native("Estonia").'>Estonia</option>
                                    <option value="Ethiopia" '.value_selected_native("Ethiopia").'>Ethiopia</option>
                                    <option value="Fiji" '.value_selected_native("Fiji").'>Fiji</option>
                                    <option value="Finland" '.value_selected_native("Finland").'>Finland</option>
                                    <option value="France" '.value_selected_native("France").'>France</option>
                                    <option value="Gabon" '.value_selected_native("Gabon").'>Gabon</option>
                                    <option value="Gambia" '.value_selected_native("Gambia").'>Gambia</option>
                                    <option value="Georgia" '.value_selected_native("Georgia").'>Georgia</option>
                                    <option value="Germany" '.value_selected_native("Germany").'>Germany</option>
                                    <option value="Ghana" '.value_selected_native("Ghana").'>Ghana</option>
                                    <option value="Greece" '.value_selected_native("Greece").'>Greece</option>
                                    <option value="Grenada" '.value_selected_native("Grenada").'>Grenada</option>
                                    <option value="Guatemala" '.value_selected_native("Guatemala").'>Guatemala</option>
                                    <option value="Guinea" '.value_selected_native("Guinea").'>Guinea</option>
                                    <option value="Guinea-Bissau" '.value_selected_native("Guinea-Bissau").'>Guinea-Bissau</option>
                                    <option value="Guyana" '.value_selected_native("Guyana").'>Guyana</option>
                                    <option value="Haiti" '.value_selected_native("Haiti").'>Haiti</option>
                                    <option value="Honduras" '.value_selected_native("Honduras").'>Honduras</option>
                                    <option value="Hong Kong" '.value_selected_native("Hong Kong").'>Hong Kong</option>
                                    <option value="Hungary" '.value_selected_native("Hungary").'>Hungary</option>
                                    <option value="Iceland" '.value_selected_native("Iceland").'>Iceland</option>
                                    <option value="India" '.value_selected_native("India").'>India</option>
                                    <option value="Indonesia" '.value_selected_native("Indonesia").'>Indonesia</option>
                                    <option value="Iran" '.value_selected_native("Iran").'>Iran</option>
                                    <option value="Iraq" '.value_selected_native("Iraq").'>Iraq</option>
                                    <option value="Ireland" '.value_selected_native("Ireland").'>Ireland</option>
                                    <option value="Israel" '.value_selected_native("Israel").'>Israel</option>
                                    <option value="Italy" '.value_selected_native("Italy").'>Italy</option>
                                    <option value="Jamaica" '.value_selected_native("Jamaica").'>Jamaica</option>
                                    <option value="Japan" '.value_selected_native("Japan").'>Japan</option>
                                    <option value="Jordan" '.value_selected_native("Jordan").'>Jordan</option>
                                    <option value="Kazakhstan" '.value_selected_native("Kazakhstan").'>Kazakhstan</option>
                                    <option value="Kenya" '.value_selected_native("Kenya").'>Kenya</option>
                                    <option value="Kiribati" '.value_selected_native("Kiribati").'>Kiribati</option>
                                    <option value="North Korea" '.value_selected_native("North Korea").'>North Korea</option>
                                    <option value="South Korea" '.value_selected_native("South Korea").'>South Korea</option>
                                    <option value="Kuwait" '.value_selected_native("Kuwait").'>Kuwait</option>
                                    <option value="Kyrgyzstan" '.value_selected_native("Kyrgyzstan").'>Kyrgyzstan</option>
                                    <option value="Laos" '.value_selected_native("Laos").'>Laos</option>
                                    <option value="Latvia" '.value_selected_native("Latvia").'>Latvia</option>
                                    <option value="Lebanon" '.value_selected_native("Lebanon").'>Lebanon</option>
                                    <option value="Lesotho" '.value_selected_native("Lesotho").'>Lesotho</option>
                                    <option value="Liberia" '.value_selected_native("Afghanistan").'>Liberia</option>
                                    <option value="Libya" '.value_selected_native("Libya").'>Libya</option>
                                    <option value="Liechtenstein" '.value_selected_native("Liechtenstein").'>Liechtenstein</option>
                                    <option value="Lithuania" '.value_selected_native("Lithuania").'>Lithuania</option>
                                    <option value="Luxembourg" '.value_selected_native("Luxembourg").'>Luxembourg</option>
                                    <option value="Macedonia" '.value_selected_native("Macedonia").'>Macedonia</option>
                                    <option value="Madagascar" '.value_selected_native("Madagascar").'>Madagascar</option>
                                    <option value="Malawi" '.value_selected_native("Malawi").'>Malawi</option>
                                    <option value="Malaysia" '.value_selected_native("Malaysia").'>Malaysia</option>
                                    <option value="Maldives" '.value_selected_native("Maldives").'>Maldives</option>
                                    <option value="Mali" '.value_selected_native("Mali").'>Mali</option>
                                    <option value="Malta" '.value_selected_native("Malta").'>Malta</option>
                                    <option value="Marshall Islands" '.value_selected_native("Marshall Islands").'>Marshall Islands</option>
                                    <option value="Mauritania" '.value_selected_native("Mauritania").'>Mauritania</option>
                                    <option value="Mauritius '.value_selected_native("Mauritius").'">Mauritius</option>
                                    <option value="Mexico" '.value_selected_native("Mexico").'>Mexico</option>
                                    <option value="Micronesia" '.value_selected_native("Micronesia").'>Micronesia</option>
                                    <option value="Moldova" '.value_selected_native("Moldova").'>Moldova</option>
                                    <option value="Monaco" '.value_selected_native("Monaco").'>Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro" '.value_selected_native("Montenegro").'>Montenegro</option>
                                    <option value="Morocco" '.value_selected_native("Morocco").'>Morocco</option>
                                    <option value="Mozambique" '.value_selected_native("Mozambique").'>Mozambique</option>
                                    <option value="Myanmar" '.value_selected_native("Myanmar").'>Myanmar</option>
                                    <option value="Namibia" '.value_selected_native("Namibia").'>Namibia</option>
                                    <option value="Nauru" '.value_selected_native("Nauru").'>Nauru</option>
                                    <option value="Nepal" '.value_selected_native("Nepal").'>Nepal</option>
                                    <option value="Netherlands" '.value_selected_native("Netherlands").'>Netherlands</option>
                                    <option value="New Zealand" '.value_selected_native("New Zealand").'>New Zealand</option>
                                    <option value="Nicaragua" '.value_selected_native("Nicaragua").'>Nicaragua</option>
                                    <option value="Niger" '.value_selected_native("Niger").'>Niger</option>
                                    <option value="Nigeria" '.value_selected_native("Nigeria").'>Nigeria</option>
                                    <option value="Norway" '.value_selected_native("Norway").'>Norway</option>
                                    <option value="Oman" '.value_selected_native("Oman").'>Oman</option>
                                    <option value="Pakistan" '.value_selected_native("Pakistan").'>Pakistan</option>
                                    <option value="Palau" '.value_selected_native("Palau").'>Palau</option>
                                    <option value="Panama" '.value_selected_native("Panama").'>Panama</option>
                                    <option value="Papua New Guinea" '.value_selected_native("Papua New Guinea").'>Papua New Guinea</option>
                                    <option value="Paraguay" '.value_selected_native("Paraguay").'>Paraguay</option>
                                    <option value="Peru" '.value_selected_native("Peru").'>Peru</option>
                                    <option value="Philippines" '.value_selected_native("Philippines").'>Philippines</option>
                                    <option value="Poland" '.value_selected_native("Poland").'>Poland</option>
                                    <option value="Portugal" '.value_selected_native("Portugal").'>Portugal</option>
                                    <option value="Puerto Rico" '.value_selected_native("Puerto Rico").'>Puerto Rico</option>
                                    <option value="Qatar" '.value_selected_native("Qatar").'>Qatar</option>
                                    <option value="Romania" '.value_selected_native("Romania").'>Romania</option>
                                    <option value="Russia" '.value_selected_native("Russia").'>Russia</option>
                                    <option value="Rwanda" '.value_selected_native("Rwanda").'>Rwanda</option>
                                    <option value="Saint Kitts and Nevis" '.value_selected_native("Saint Kitts and Nevis").'>Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia" '.value_selected_native("Saint Lucia").'>Saint Lucia</option>
                                    <option value="Saint Vincent and the Grenadines" '.value_selected_native("Saint Vincent and the Grenadines").'>Saint Vincent and the Grenadines</option>
                                    <option value="Samoa" '.value_selected_native("Samoa").'>Samoa</option>
                                    <option value="San Marino" '.value_selected_native("San Marino").'>San Marino</option>
                                    <option value="Sao Tome and Principe" '.value_selected_native("Sao Tome and Principe").'>Sao Tome and Principe</option>
                                    <option value="Saudi Arabia" '.value_selected_native("Saudi Arabia").'>Saudi Arabia</option>
                                    <option value="Senegal" '.value_selected_native("Senegal").'>Senegal</option>
                                    <option value="Serbia and Montenegro" '.value_selected_native("Serbia and Montenegro").'>Serbia and Montenegro</option>
                                    <option value="Seychelles" '.value_selected_native("Seychelles").'>Seychelles</option>
                                    <option value="Sierra Leone" '.value_selected_native("Sierra Leone").'>Sierra Leone</option>
                                    <option value="Singapore" '.value_selected_native("Singapore").'>Singapore</option>
                                    <option value="Slovakia" '.value_selected_native("Slovakia").'>Slovakia</option>
                                    <option value="Slovenia" '.value_selected_native("Slovenia").'>Slovenia</option>
                                    <option value="Solomon Islands" '.value_selected_native("Solomon Islands").'>Solomon Islands</option>
                                    <option value="Somalia" '.value_selected_native("Somalia").'>Somalia</option>
                                    <option value="South Africa" '.value_selected_native("South Africa").'">South Africa</option>
                                    <option value="Spain" '.value_selected_native("Spain").'>Spain</option>
                                    <option value="Sri Lanka" '.value_selected_native("Sri Lanka").'>Sri Lanka</option>
                                    <option value="Sudan" '.value_selected_native("Sudan").'>Sudan</option>
                                    <option value="Suriname" '.value_selected_native("Suriname").'>Suriname</option>
                                    <option value="Swaziland" '.value_selected_native("Swaziland").'>Swaziland</option>
                                    <option value="Sweden" '.value_selected_native("Sweden").'>Sweden</option>
                                    <option value="Switzerland" '.value_selected_native("Switzerland").'>Switzerland</option>
                                    <option value="Syria" '.value_selected_native("Syria").'>Syria</option>
                                    <option value="Taiwan" '.value_selected_native("Taiwan").'>Taiwan</option>
                                    <option value="Tajikistan" '.value_selected_native("Tajikistan").'>Tajikistan</option>
                                    <option value="Tanzania" '.value_selected_native("Tanzania").'>Tanzania</option>
                                    <option value="Thailand" '.value_selected_native("Thailand").'>Thailand</option>
                                    <option value="Togo" '.value_selected_native("Togo").'>Togo</option>
                                    <option value="Tonga" '.value_selected_native("Tonga").'>Tonga</option>
                                    <option value="Trinidad and Tobago" '.value_selected_native("Trinidad and Tobago").'>Trinidad and Tobago</option>
                                    <option value="Tunisia" '.value_selected_native("Tunisia").'>Tunisia</option>
                                    <option value="Turkey" '.value_selected_native("Turkey").'>Turkey</option>
                                    <option value="Turkmenistan" '.value_selected_native("Turkmenistan").'>Turkmenistan</option>
                                    <option value="Tuvalu" '.value_selected_native("Tuvalu").'>Tuvalu</option>
                                    <option value="Uganda" '.value_selected_native("Uganda").'>Uganda</option>
                                    <option value="Ukraine" '.value_selected_native("Ukraine").'>Ukraine</option>
                                    <option value="United Arab Emirates" '.value_selected_native("United Arab Emirates").'>United Arab Emirates</option>
                                    <option value="United Kingdom" '.value_selected_native("United Kingdom").'>United Kingdom</option>
                                    <option value="United States" '.value_selected_native("United States").'>United States</option>
                                    <option value="Uruguay" '.value_selected_native("Uruguay").'>Uruguay</option>
                                    <option value="Uzbekistan" '.value_selected_native("Uzbekistan").'>Uzbekistan</option>
                                    <option value="Vanuatu" '.value_selected_native("Vanuatu").'>Vanuatu</option>
                                    <option value="Vatican City" '.value_selected_native("Vatican City").'>Vatican City</option>
                                    <option value="Venezuela" '.value_selected_native("Venezuela").'>Venezuela</option>
                                    <option value="Vietnam" '.value_selected_native("Vietnam").'>Vietnam</option>
                                    <option value="Yemen" '.value_selected_native("Yemen").'>Yemen</option>
                                    <option value="Zambia" '.value_selected_native("Zambia").'>Zambia</option>
                                    <option value="Zimbabwe" '.value_selected_native("Zimbabwe").'>Zimbabwe</option>
                                  </select>
                                  </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Salary:</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/salary_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["Salary"].'" id="salary" class="form-control" name="Salary" required />
                              </div>
                           </div><br>

                           <div class="form-group col-lg-12">
                              <label>Start date (mm/dd/yyyy)</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/start_date_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="date" value="'.date('Y-m-d',strtotime($_GET["Start_Date"])).'" id="start_date" class="form-control" name="Start_Date" required style="padding-bottom:40px;"/>
                              </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Manager satisfaction</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/performance_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Performance_rating" style="width:100%;height: 35px"  required>
                                  <option value="1" '.value_selected_performance(1).'>1</option>
                                  <option value="2" '.value_selected_performance(2).'>2</option>
                                  <option value="3" '.value_selected_performance(3).'>3</option>
                                  <option value="4" '.value_selected_performance(4).'>4</option>
                                  <option value="5" '.value_selected_performance(5).'>5</option>
                                </select>
                                </div>
                           </div><br>

                           <div class="form-group col-lg-12">
                              <label>Leader review</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/performance_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Leader_review" style="width:100%;height: 35px"  required>
                                  <option value="1" '.value_selected_Leader_review(1).'>1</option>
                                  <option value="2" '.value_selected_Leader_review(2).'>2</option>
                                  <option value="3" '.value_selected_Leader_review(3).'>3</option>
                                  <option value="4" '.value_selected_Leader_review(4).'>4</option>
                                  <option value="5" '.value_selected_Leader_review(5).'>5</option>
                                </select>
                                </div>
                           </div><br>

                           <div class="form-group col-lg-12">
                              <label>Member review</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/performance_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Member_review" style="width:100%;height: 35px"  required>
                                  <option value="1" '.value_selected_member_review(1).'>1</option>
                                  <option value="2" '.value_selected_member_review(2).'>2</option>
                                  <option value="3" '.value_selected_member_review(3).'>3</option>
                                  <option value="4" '.value_selected_member_review(4).'>4</option>
                                  <option value="5" '.value_selected_member_review(5).'>5</option>
                                </select>
                                </div>
                           </div><br>   
                            <div class="form-group col-lg-12">
                              <label>Late times</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/late_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Late_times" style="width:100%;height: 35px"  required>
                                  <option value="0" '.value_selected_late(0).'>0</option>
                                  <option value="1" '.value_selected_late(1).'>1</option>
                                  <option value="2" '.value_selected_late(2).'>2</option>
                                  <option value="3" '.value_selected_late(3).'>3</option>
                                  <option value="4" '.value_selected_late(4).'>4</option>
                                </select>
                                </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Excuse times</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/excuse_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Excuse_times" style="width:100%;height: 35px"  required>
                                  <option value="0" '.value_selected_excuse(0).'>0</option>
                                  <option value="1" '.value_selected_excuse(1).'>1</option>
                                  <option value="2" '.value_selected_excuse(2).'>2</option>
                                  <option value="3" '.value_selected_excuse(3).'>3</option>
                                  <option value="4" '.value_selected_excuse(4).'>4</option>
                                  <option value="5" '.value_selected_excuse(5).'>5</option>
                                </select>
                                </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Absent Without Excuse</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/absent_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Absent_W_Excuse" style="width:100%;height: 35px"  required>
                                  <option value="0" '.value_selected_absent_w(0).'>0</option>
                                  <option value="1" '.value_selected_absent_w(1).'>1</option>
                                  <option value="2" '.value_selected_absent_w(2).'>2</option>
                                  <option value="3" '.value_selected_absent_w(3).'>3</option>
                                </select>
                                </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Mistakes</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/mistake_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Mistakes" style="width:100%;height: 35px"  required>
                                  <option value="0" '.value_selected_mistake(0).'>0</option>
                                  <option value="1" '.value_selected_mistake(1).'>1</option>
                                  <option value="2" '.value_selected_mistake(2).'>2</option>
                                  <option value="3" '.value_selected_mistake(3).'>3</option>
                                  <option value="4" '.value_selected_mistake(4).'>4</option>
                                  <option value="5" '.value_selected_mistake(5).'>5</option>
                                </select>
                                </div>
                           </div><br>


                           <div class="form-group col-lg-12">
                              <label>Bonus $:</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/bonus_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="'.$_GET["Bonus"].'" id="bonus" class="form-control" name="Bonus" required />
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label><h4>Increase salary by percentage</h4></label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/plus_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="salary_plus" style="width:100%;height: 35px"  required>
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
                              <label><h4>Deduction of salary by percentage</h4></label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/minus_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="salary_minus" style="width:100%;height: 35px"  required>
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
                           <div class="form-group col-lg-12" style="margin-top:20px;">
                              <label>Best employee:</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/best_field.png" alt="name" style="height:20px;width:20px;"></span><input type="text" value="'.$_GET['Best_Employee'].'" id="best_employee" class="form-control" name="Best_Employee" readonly required/> <span class="input-group-addon">times</span></div>
                           </div><br>
                           
                        </div>
                        <br><br>
                        <div class="text-center">
                        <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="font-size:17px;margin-top:20px;margin-right:25px;">Cancel</a>|
                           <input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary text-center" style="width:80px;font-size:17px;margin-left:25px;"/>
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
    



       











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

function dept_current($dept){

$dept_str = $_SESSION['position'];

  if (strpos($dept, $dept_str) !== false) {
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
            <a id=animation-btn onclick="goBack()" class="btn btn-primary" style="font-size:17px;margin-left:30px;margin-top:30px;">Back to Employees</a>
         </div>
         <div class="content" style="margin-left:300px;margin-right:300px;">
            <div class="row" style="margin-top:30px;">
               <div class="col-lg-12">
               <div class="text-center m-b-md">
                  <h2>Fill employee information!</h2>
                 
               </div>
                 <div class="hpanel">
                  <div class="panel-body no-shadow th-border">
                     <form action="php/add_employee.php" id="loginForm" method="POST" style="font-size:17px;">
                        <div class="row">
                           
                           <div class="form-group col-lg-12">
                              <input type="hidden" value="" id="id" class="form-control" name="id" required>
                           </div>
                           
                           <div class="form-group col-lg-12">
                              <label>Name</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/name_field.png" alt="name" style="height:20px;width:20px;"></span><input type="text" value="" id="name" class="form-control" name="Name" required>
                              </div>
                           </div><br>

                           <div class="form-group col-lg-12">
                              <label>Birthday (mm/dd/yyyy)</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/calendar_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="date" value="" id="age" class="form-control" name="Age" style="padding-bottom:40px;" required>   
                              </div>
                           </div><br>

                           <div class="form-group col-lg-12">
                             <label>Department</label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/depart_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Department" style="width:100%;height: 35px" required>
                                  <option value="" '.dept_current("CEO_GENERAL_MANAGER").'></option>
                                  <option value="Operations" '.dept_current("OPERATION_MANAGER").'>Operations</option>
                                  <option value="Sales" '.dept_current("SALES_MANAGER").'>Sales</option>
                                  <option value="Human Resources" '.dept_current("HR_MANAGER").'>Human Resources</option>
                                  <option value="IT" '.dept_current("IT_MANAGER").'>IT</option>
                                  <option value="Warehouse" '.dept_current("WAREHOUSE_MANAGER").'>Warehouse</option>
                                  <option value="Finance" '.dept_current("FINANCE_MANAGER").'>Finance</option>
                                </select>
                              </div>
                           </div><br>

                           <div class="form-group col-lg-12">
                             <label>Position</label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/position_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Position" style="width:100%;height: 35px"  required>
                                  <option value="" selected="selected"></option>
                                  <option value="Operation Manager">Operation Manager</option>
                                  <option value="Sales Manager">Sales Manager</option>
                                  <option value="HR Manager">HR Manager</option>
                                  <option value="IT Manager">IT Manager</option>
                                  <option value="Warehouse Manager">Warehouse Manager</option>
                                  <option value="Finance Manager">Finance Manager</option>
                                  <option value="Office Manager">Office Manager</option>
                                  <option value="Team Leader">Team Leader</option>
                                  <option value="Supervisor">Supervisor</option>
                                  <option value="Member">Member</option>
                                </select> 
                             </div>   
                           </div><br>

                            <div class="form-group col-lg-12">
                               <label>Education</label><br>
                               <div class="input-group m-b"><span class="input-group-addon"><img src="images/edu_field.png" alt="name" style="height:20px;width:20px;"></span>
                                <select name="Education" style="width:100%;height: 35px"  required>
                                  <option value="" selected="selected"></option>
                                  <option value="9th">9th</option>
                                  <option value="10th">10th</option>
                                  <option value="11th">11th</option>
                                  <option value="HS-grad">HS-grad</option>
                                  <option value="Some-college">Some-college</option>
                                  <option value="Bachelors">Bachelors</option>
                                  <option value="Masters">Masters</option>
                                  <option value="Doctorate">Doctorate</option>
                                </select> 
                                </div>
                           </div><br>

                            <div class="form-group col-lg-12">
                             <label>Marital status</label><br>
                             <div class="input-group m-b"><span class="input-group-addon"><img src="images/marital_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <select name="Marital_status" style="width:100%;height: 35px"  required>
                                  <option value="" selected="selected"></option>
                                  <option value="Single">Single</option>
                                  <option value="Married">Married</option>
                                  <option value="Divorced">Divorced</option>
                                  <option value="Separated">Separated</option>
                                  <option value="Widowed">Widowed</option>
                                </select> 
                                </div>
                           </div><br>

                            <div class="form-group col-lg-12">
                              <label>Race</label><br>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/race_field.png" alt="name" style="height:20px;width:20px;"></span>
                               <select name="Race" style="width:100%;height: 35px"  required>
                                  <option value="" selected="selected"></option>
                                  <option value="White">White</option>
                                  <option value="Black">Black</option>
                                  <option value="Asian-Pac-Islander">Asian-Pac-Islander</option>
                                  <option value="Amer-Indian-Eskimo">Amer-Indian-Eskimo</option>
                                  <option value="Other">Other</option>
                                </select>
                                </div>
                           </div><br>

                            <div class="form-group col-lg-12">
                              <label>Sex</label><br>
                               <input type="radio" name="Sex" value="Male" required> Male 
                               <input type="radio" name="Sex" value="Female" style="margin-left:30px;" required> Female
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Mail</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/mail_field.png" alt="mail" style="height:20px;width:20px;"></span>
                              <input type="text" value="" id="mail" class="form-control" name="Mail" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}" placeholder="employee@gmail.com" style="font-size:17px;"/>
                              </div>
                           </div><br>
                           <div class="form-group col-lg-12">
                              <label>Address</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/address_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="" id="address" class="form-control" name="Address" required style="font-size:17px;"/>
                              </div>
                           </div><br>
                            <div class="form-group col-lg-12">
                              <label>Hours Per Week</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/hpw_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="text" value="" id="hours_per_week" class="form-control" name="Hours_Per_Week" required />
                              </div>
                           </div><br>

<div class="form-group col-lg-12">
  <label>Native Country</label><br>
  <div class="input-group m-b"><span class="input-group-addon"><img src="images/native_field.png" alt="name" style="height:20px;width:20px;"></span>
       <select name="Native_Country" style="width:100%;height: 35px" required>
  <option value="" selected="selected"></option>
  <option value="Afghanistan">Afghanistan</option>
  <option value="Albania">Albania</option>
  <option value="Algeria">Algeria</option>
  <option value="Andorra">Andorra</option>
  <option value="Antigua and Barbuda">Antigua and Barbuda</option>
  <option value="Argentina">Argentina</option>
  <option value="Armenia">Armenia</option>
  <option value="Australia">Australia</option>
  <option value="Austria">Austria</option>
  <option value="Azerbaijan">Azerbaijan</option>
  <option value="Bahamas">Bahamas</option>
  <option value="Bahrain">Bahrain</option>
  <option value="Bangladesh">Bangladesh</option>
  <option value="Barbados">Barbados</option>
  <option value="Belarus">Belarus</option>
  <option value="Belgium">Belgium</option>
  <option value="Belize">Belize</option>
  <option value="Benin">Benin</option>
  <option value="Bhutan">Bhutan</option>
  <option value="Bolivia">Bolivia</option>
  <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
  <option value="Botswana">Botswana</option>
  <option value="Brazil">Brazil</option>
  <option value="Brunei">Brunei</option>
  <option value="Bulgaria">Bulgaria</option>
  <option value="Burkina Faso">Burkina Faso</option>
  <option value="Burundi">Burundi</option>
  <option value="Cambodia">Cambodia</option>
  <option value="Cameroon">Cameroon</option>
  <option value="Canada">Canada</option>
  <option value="Cape Verde">Cape Verde</option>
  <option value="Central African Republic">Central African Republic</option>
  <option value="Chad">Chad</option>
  <option value="Chile">Chile</option>
  <option value="China">China</option>
  <option value="Colombia">Colombia</option>
  <option value="Comoros">Comoros</option>
  <option value="Congo">Congo</option>
  <option value="Costa Rica">Costa Rica</option>
  <option value="Cote d Ivoire">Cote d Ivoire</option>
  <option value="Croatia">Croatia</option>
  <option value="Cuba">Cuba</option>
  <option value="Cyprus">Cyprus</option>
  <option value="Czech Republic">Czech Republic</option>
  <option value="Denmark">Denmark</option>
  <option value="Djibouti">Djibouti</option>
  <option value="Dominica">Dominica</option>
  <option value="Dominican Republic">Dominican Republic</option>
  <option value="East Timor">East Timor</option>
  <option value="Ecuador">Ecuador</option>
  <option value="Egypt">Egypt</option>
  <option value="El Salvador">El Salvador</option>
  <option value="Equatorial Guinea">Equatorial Guinea</option>
  <option value="Eritrea">Eritrea</option>
  <option value="Estonia">Estonia</option>
  <option value="Ethiopia">Ethiopia</option>
  <option value="Fiji">Fiji</option>
  <option value="Finland">Finland</option>
  <option value="France">France</option>
  <option value="Gabon">Gabon</option>
  <option value="Gambia">Gambia</option>
  <option value="Georgia">Georgia</option>
  <option value="Germany">Germany</option>
  <option value="Ghana">Ghana</option>
  <option value="Greece">Greece</option>
  <option value="Grenada">Grenada</option>
  <option value="Guatemala">Guatemala</option>
  <option value="Guinea">Guinea</option>
  <option value="Guinea-Bissau">Guinea-Bissau</option>
  <option value="Guyana">Guyana</option>
  <option value="Haiti">Haiti</option>
  <option value="Honduras">Honduras</option>
  <option value="Hong Kong">Hong Kong</option>
  <option value="Hungary">Hungary</option>
  <option value="Iceland">Iceland</option>
  <option value="India">India</option>
  <option value="Indonesia">Indonesia</option>
  <option value="Iran">Iran</option>
  <option value="Iraq">Iraq</option>
  <option value="Ireland">Ireland</option>
  <option value="Israel">Israel</option>
  <option value="Italy">Italy</option>
  <option value="Jamaica">Jamaica</option>
  <option value="Japan">Japan</option>
  <option value="Jordan">Jordan</option>
  <option value="Kazakhstan">Kazakhstan</option>
  <option value="Kenya">Kenya</option>
  <option value="Kiribati">Kiribati</option>
  <option value="North Korea">North Korea</option>
  <option value="South Korea">South Korea</option>
  <option value="Kuwait">Kuwait</option>
  <option value="Kyrgyzstan">Kyrgyzstan</option>
  <option value="Laos">Laos</option>
  <option value="Latvia">Latvia</option>
  <option value="Lebanon">Lebanon</option>
  <option value="Lesotho">Lesotho</option>
  <option value="Liberia">Liberia</option>
  <option value="Libya">Libya</option>
  <option value="Liechtenstein">Liechtenstein</option>
  <option value="Lithuania">Lithuania</option>
  <option value="Luxembourg">Luxembourg</option>
  <option value="Macedonia">Macedonia</option>
  <option value="Madagascar">Madagascar</option>
  <option value="Malawi">Malawi</option>
  <option value="Malaysia">Malaysia</option>
  <option value="Maldives">Maldives</option>
  <option value="Mali">Mali</option>
  <option value="Malta">Malta</option>
  <option value="Marshall Islands">Marshall Islands</option>
  <option value="Mauritania">Mauritania</option>
  <option value="Mauritius">Mauritius</option>
  <option value="Mexico">Mexico</option>
  <option value="Micronesia">Micronesia</option>
  <option value="Moldova">Moldova</option>
  <option value="Monaco">Monaco</option>
  <option value="Mongolia">Mongolia</option>
  <option value="Montenegro">Montenegro</option>
  <option value="Morocco">Morocco</option>
  <option value="Mozambique">Mozambique</option>
  <option value="Myanmar">Myanmar</option>
  <option value="Namibia">Namibia</option>
  <option value="Nauru">Nauru</option>
  <option value="Nepal">Nepal</option>
  <option value="Netherlands">Netherlands</option>
  <option value="New Zealand">New Zealand</option>
  <option value="Nicaragua">Nicaragua</option>
  <option value="Niger">Niger</option>
  <option value="Nigeria">Nigeria</option>
  <option value="Norway">Norway</option>
  <option value="Oman">Oman</option>
  <option value="Pakistan">Pakistan</option>
  <option value="Palau">Palau</option>
  <option value="Panama">Panama</option>
  <option value="Papua New Guinea">Papua New Guinea</option>
  <option value="Paraguay">Paraguay</option>
  <option value="Peru">Peru</option>
  <option value="Philippines">Philippines</option>
  <option value="Poland">Poland</option>
  <option value="Portugal">Portugal</option>
  <option value="Puerto Rico">Puerto Rico</option>
  <option value="Qatar">Qatar</option>
  <option value="Romania">Romania</option>
  <option value="Russia">Russia</option>
  <option value="Rwanda">Rwanda</option>
  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
  <option value="Saint Lucia">Saint Lucia</option>
  <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
  <option value="Samoa">Samoa</option>
  <option value="San Marino">San Marino</option>
  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
  <option value="Saudi Arabia">Saudi Arabia</option>
  <option value="Senegal">Senegal</option>
  <option value="Serbia and Montenegro">Serbia and Montenegro</option>
  <option value="Seychelles">Seychelles</option>
  <option value="Sierra Leone">Sierra Leone</option>
  <option value="Singapore">Singapore</option>
  <option value="Slovakia">Slovakia</option>
  <option value="Slovenia">Slovenia</option>
  <option value="Solomon Islands">Solomon Islands</option>
  <option value="Somalia">Somalia</option>
  <option value="South Africa">South Africa</option>
  <option value="Spain">Spain</option>
  <option value="Sri Lanka">Sri Lanka</option>
  <option value="Sudan">Sudan</option>
  <option value="Suriname">Suriname</option>
  <option value="Swaziland">Swaziland</option>
  <option value="Sweden">Sweden</option>
  <option value="Switzerland">Switzerland</option>
  <option value="Syria">Syria</option>
  <option value="Taiwan">Taiwan</option>
  <option value="Tajikistan">Tajikistan</option>
  <option value="Tanzania">Tanzania</option>
  <option value="Thailand">Thailand</option>
  <option value="Togo">Togo</option>
  <option value="Tonga">Tonga</option>
  <option value="Trinidad and Tobago">Trinidad and Tobago</option>
  <option value="Tunisia">Tunisia</option>
  <option value="Turkey">Turkey</option>
  <option value="Turkmenistan">Turkmenistan</option>
  <option value="Tuvalu">Tuvalu</option>
  <option value="Uganda">Uganda</option>
  <option value="Ukraine">Ukraine</option>
  <option value="United Arab Emirates">United Arab Emirates</option>
  <option value="United Kingdom">United Kingdom</option>
  <option value="United States">United States</option>
  <option value="Uruguay">Uruguay</option>
  <option value="Uzbekistan">Uzbekistan</option>
  <option value="Vanuatu">Vanuatu</option>
  <option value="Vatican City">Vatican City</option>
  <option value="Venezuela">Venezuela</option>
  <option value="Vietnam">Vietnam</option>
  <option value="Yemen">Yemen</option>
  <option value="Zambia">Zambia</option>
  <option value="Zimbabwe">Zimbabwe</option>
                           </select>
                           </div>
</div><br>

                            

                           <div class="form-group col-lg-12">
                              <label>Salary:</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/salary_field.png" alt="name" style="height:20px;width:20px;"></span><input type="text" value="" id="salary" class="form-control" name="Salary" required /></div>
                           </div><br>

                           <div class="form-group col-lg-12">
                              <label>Start date (mm/dd/yyyy)</label>
                              <div class="input-group m-b"><span class="input-group-addon"><img src="images/start_date_field.png" alt="name" style="height:20px;width:20px;"></span>
                              <input type="date" value="" id="start_date" class="form-control" name="Start_Date"  style="padding-bottom:40px;" required/>
                              </div>
                           </div><br>
                           
                           <div class="form-group col-lg-12" hidden>
                             <label>Manager satisfaction</label><br>
                              <select name="Performance_rating" style="width:100%;height: 35px" required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select> 
                           </div><br>

                           <div class="form-group col-lg-12" hidden>
                             <label>Leader reivew</label><br>
                              <select name="Leader_review" style="width:100%;height: 35px" required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select> 
                           </div><br>

                           <div class="form-group col-lg-12" hidden>
                             <label>Member review</label><br>
                              <select name="Member_review" style="width:100%;height: 35px" required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select> 
                           </div><br> 
                           
                           <div class="form-group col-lg-12" hidden>
                             <label>Late times</label><br>
                              <select name="Late_times" style="width:100%;height: 35px"  required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                </select> 
                           </div><br> 

                           <div class="form-group col-lg-12" hidden>
                             <label>Excuse times</label><br>
                              <select name="Excuse_times" style="width:100%;height: 35px"  required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select> 
                           </div><br> 


                           <div class="form-group col-lg-12" hidden>
                             <label>Absent times without excuse</label><br>
                              <select name="Absent_W_Excuse" style="width:100%;height: 35px"  required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select> 
                           </div><br>

                           <div class="form-group col-lg-12" hidden>
                             <label>Mistakes</label><br>
                              <select name="Mistakes" style="width:100%;height: 35px"  required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                </select> 
                           </div><br> 

                           <div class="form-group col-lg-12" hidden>
                              <label>Bonus $:</label><br>
                              <input type="text" value="0" id="bonus" class="form-control" name="Bonus" required/>
                           </div><br>
                        

                           <div class="form-group col-lg-12" hidden>
                             <label>Best Employee times</label><br>
                              <select name="Best_Employee" style="width:100%;height: 35px"  required>
                                  <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                </select> 
                           </div><br>    



                           
                        </div>
                        <br><br>
                        <div class="text-center">
                           <input type="submit" name="submit" id="submit" value="Add employee" class="btn btn-primary text-center" style="font-size:17px;"/>
                        </div>
                     </form>
                  
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
<script>  function goBack(){
    window.history.back();
  }
</script>

<script>$(function(){$("#example1").dataTable({ajax:"api/datatables.json",dom:"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",lengthMenu:[[10,25,50,-1],[10,25,50,"All"]],buttons:[{extend:"copy",className:"btn-sm"},{extend:"csv",title:"ExampleFile",className:"btn-sm"},{extend:"pdf",title:"ExampleFile",className:"btn-sm"},{extend:"print",className:"btn-sm"}]});$("#example2").dataTable()});</script>  
    



       











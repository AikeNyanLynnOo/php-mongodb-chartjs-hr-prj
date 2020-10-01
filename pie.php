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

//Show rating star

function showStar($star_number){
   switch ($star_number) {
     case 0:
       return '<img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>';
       break;
     case 1:
       return '<img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>';
       break;
     case 2:
       return '<img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>';
       break;
     case 3:
       return '<img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>';
       break;
     case 4:
       return '<img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>';
       break;
     case 5:
       return '<img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>
       <img src="images/star_fill.png" style="width:24px;height:24px;"/>';
       break;       
     default:
       return '<img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>
       <img src="images/star_blank.png" style="width:24px;height:24px;"/>';
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


//top employees 

$topEmployeeArray = getTopEmployees();
$badEmployeeArray = getBadEmployeesIDs();

function getTopEmployees(){
$toReturn = [];
$Late_times = 0;
$Excuse_times = 0;
$Absent_W_Excuse = 0;
$Mistakes = 0;
$filter = ["Absent_W_Excuse"=>$Absent_W_Excuse,
           "Excuse_times"=>$Excuse_times,
           "Mistakes"=>$Mistakes,
          ];

try {
          $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
          $query = new MongoDB\Driver\Query($filter);

          $result = $manager->executeQuery("project.employee",$query);
          $rows = $result->toArray();
          $i = 0;
         foreach ($rows as $row) {
          if (($row->Performance_rating == 5 or $row->Performance_rating == 4 or $row->Performance_rating == 3) and ($row->Leader_review == 5 or $row->Leader_review == 4 or $row->Leader_review == 3) and ($row->Member_review == 5 or $row->Member_review == 4 or $row->Member_review == 3) and ($row->Late_times == 0 or $row->Late_times == 1)) {
            $toReturn[$i] = $row->_id;
          }
          
          $i++;
         }
          return $toReturn;
          } catch (MongoDB\Driver\Exception\Exception $e) {
            die("error encountered".$e);
          }          
}

//bad_employees
function getBadEmployeesIDs(){
$toReturn = [];
$filter = ["Absent_W_Excuse"=>3];
try {
          $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
          $query = new MongoDB\Driver\Query([]);

          $result = $manager->executeQuery("project.employee",$query);
          $rows = $result->toArray();
         foreach ($rows as $row) {
          if ((($row->Performance_rating == 1) and ($row->Excuse_times == 5)) 
               or ($row->Late_times == 4) or ($row->Leader_review == 1 and $row->Member_review == 1)
               or (($row->Absent_W_Excuse == 3) and ($row->Mistakes == 3))) {
            array_push($toReturn,$row->_id);
          }
         }
          return $toReturn;
          } catch (MongoDB\Driver\Exception\Exception $e) {
            die("error encountered".$e);
          }          
}

function getDataWithID($id){
    $EmployeeData =[];

  $filter = ["_id"=>$id];
  try {
      $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
          $query = new MongoDB\Driver\Query($filter);

          $result = $manager->executeQuery("project.employee",$query);
          $rows = $result->toArray();
          
          $EmployeeData[0] = $rows[0]->_id;
          $EmployeeData[1] = $rows[0]->Name;
          $EmployeeData[2] = $rows[0]->Age;
          $EmployeeData[3] = $rows[0]->Department;
          $EmployeeData[4] = $rows[0]->Position;
          $EmployeeData[5] = $rows[0]->Education;
          $EmployeeData[6] = $rows[0]->Marital_status;
          $EmployeeData[7] = $rows[0]->Race;
          $EmployeeData[8] = $rows[0]->Sex;
          $EmployeeData[9] = $rows[0]->Hours_Per_Week;
          $EmployeeData[10] = $rows[0]->Native_Country;
          $EmployeeData[11] = $rows[0]->Salary;
          $EmployeeData[12] = $rows[0]->Start_Date;
          $EmployeeData[13] = $rows[0]->Performance_rating;
          $EmployeeData[14] = $rows[0]->Late_times;
          $EmployeeData[15] = $rows[0]->Excuse_times;
          $EmployeeData[16] = $rows[0]->Absent_W_Excuse;
          $EmployeeData[17] = $rows[0]->Mistakes;
          $EmployeeData[18] = $rows[0]->Bonus;
          $EmployeeData[19] = $rows[0]->Best_Employee;
          $EmployeeData[20] = $rows[0]->Address;
          $EmployeeData[21] = $rows[0]->Mail;
          $EmployeeData[22] = $rows[0]->Leader_review;
          $EmployeeData[23] = $rows[0]->Member_review;

    return $EmployeeData;
  } catch (MongoDB\Driver\Exception\Exception $e) {
    die("error encountered!".$e);
  }
}

//reason for dismissing and retire

$fire_all = getTotalDismiss();
$fire_tmm = getReasonDismiss("Too many mistakes");
$fire_awe = getReasonDismiss("Absent without excuse");
$fire_emt = getReasonDismiss("Excuse many times");
$fire_lmt = getReasonDismiss("Late many times");
$fire_pp = getReasonDismiss("Poor performance");


$retire_all = getTotalRetire();
$retire_h = getReasonRetire("Health");
$retire_cftf = getReasonRetire("Caring for the family");
$retire_ftpi = getReasonRetire("Freedom to persue interests");
$retire_dwc = getReasonRetire("Dissatisfaction with career");
$retire_op = getReasonRetire("Other personals");


function getTotalDismiss(){
 $count = 0;
$filter = ["Fire" => "Y"];
$query = new MongoDB\Driver\Query($filter);

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $results = $manager->executeQuery("project.endjob",$query);

  foreach ($results as $result) {
    $count++;
  }
return $count;

} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
} 
}

function getTotalRetire(){
 $count = 0;
$filter = ["Fire" => "N"];
$query = new MongoDB\Driver\Query($filter);

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $results = $manager->executeQuery("project.endjob",$query);

  foreach ($results as $result) {
    $count++;
  }
return $count;

} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
} 
}

function getReasonDismiss($reason){
$count = 0;
$filter = ["Fire_Reason" => $reason];
$query = new MongoDB\Driver\Query($filter);

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $results = $manager->executeQuery("project.endjob",$query);

  foreach ($results as $result) {
    $count++;
  }
return $count;

} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
}
}

function getReasonRetire($reason){
$count = 0;
$filter = ["Retire_Reason" => $reason];
$query = new MongoDB\Driver\Query($filter);

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $results = $manager->executeQuery("project.endjob",$query);

  foreach ($results as $result) {
    $count++;
  }
return $count;

} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
}
}




//performance by department

$operationMaleandFemale = getAveragePerformance("Operations");
$salesMaleandFemale = getAveragePerformance("Sales");
$hrMaleandFemale = getAveragePerformance("Human Resources");
$itMaleandFemale = getAveragePerformance("IT");
$whMaleandFemale = getAveragePerformance("Warehouse");
$fiMaleandFemale = getAveragePerformance("Finance");


function getAveragePerformance($depart){
$male_and_female = [];

    $male_and_female[0] = round(getOperationsPerformanceMale($depart),4);
    $male_and_female[1] = round(getOperationsPerformanceFemale($depart),4);
    
return $male_and_female;
}

function getOperationsPerformanceMale($depart){
$perform_total = 0;  
$late_total = 0;
$excuse_total = 0;
$absent_total = 0;
$mistake_total = 0;
$bonus_total = 0;
$count = 0;
$filter = ["Sex" => "Male","Department" => $depart];
$query = new MongoDB\Driver\Query($filter);

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $results = $manager->executeQuery("project.employee",$query);

  foreach ($results as $result) {
    $perform_total += $result->Performance_rating;
    $late_total += $result->Late_times;
    $excuse_total += $result->Excuse_times;
    $absent_total += $result->Absent_W_Excuse;
    $mistake_total += $result->Mistakes;
    $bonus_total += $result->Bonus;
    $count++;
  }
return (($perform_total+$bonus_total)-($late_total+$excuse_total+$absent_total+$mistake_total))/$count;

} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
}

}
function getOperationsPerformanceFemale($depart){
$perform_total = 0;  
$late_total = 0;
$excuse_total = 0;
$absent_total = 0;
$mistake_total = 0;
$bonus_total = 0;
$count = 0;
$filter = ["Sex" => "Female","Department" => $depart];
$query = new MongoDB\Driver\Query($filter);

try {
  $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
  $results = $manager->executeQuery("project.employee",$query);

  foreach ($results as $result) {
    $perform_total += $result->Performance_rating;
    $late_total += $result->Late_times;
    $excuse_total += $result->Excuse_times;
    $absent_total += $result->Absent_W_Excuse;
    $mistake_total += $result->Mistakes;
    $bonus_total += $result->Bonus;
    $count++;
  }
return (($perform_total+$bonus_total)-($late_total+$excuse_total+$absent_total+$mistake_total))/$count;

} catch (MongoDB\Driver\Exception\Exception $e) {
  die("error encountered!".$e);
}
}

//weekly and monthly analysis reset

// $current_Day = date("D");
// $last_day = date("t",strtotime(date("d-m-Y")));
// $current_day = date("d");

// if ($current_Day == "Sun") {
//   weeklyAnalysisReset();
// }
// if ($current_day == $last_day) {
//   monthlyAnalysisReset();
// }

// function weeklyAnalysisReset(){
//   try {
//     $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
//     $query = new MongoDB\Driver\Query([]);

//     $rows = $manager->executeQuery("project.droptest",$query);
//     foreach ($rows as $row) {
//       resetWeeklyLateTime($row->_id,$row->Name,$row->Age,$row->Department,$row->Position,$row->Education,$row->Marital_status,$row->Race,$row->Sex,$row->Hours_Per_Week,$row->Native_Country,$row->Salary,$row->Start_Date,$row->Performance_rating,$row->Excuse_times,$row->Absent_W_Excuse,$row->Mistakes,$row->Bonus,$row->Best_Employee);
//     }
//   } catch (MongoDB\Driver\Exception\Exception $e) {
//     die("Error encountered!".$e);
//   }
// }

// function monthlyAnalysisReset(){
//   try {
//     $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
//     $query = new MongoDB\Driver\Query([]);

//     $rows = $manager->executeQuery("project.droptest",$query);
//     foreach ($rows as $row) {
//       resetMonthlyExcuseTime($row->_id,$row->Name,$row->Age,$row->Department,$row->Position,$row->Education,$row->Marital_status,$row->Race,$row->Sex,$row->Hours_Per_Week,$row->Native_Country,$row->Salary,$row->Start_Date,$row->Performance_rating,$row->Late_times,$row->Absent_W_Excuse,$row->Mistakes,$row->Bonus,$row->Best_Employee);
//     }
//   } catch (MongoDB\Driver\Exception\Exception $e) {
//     die("Error encountered!".$e);
//   }
// }

// function resetWeeklyLateTime($ID,$name,$age,$depart,$position,$edu,$marital,$race,$sex,$hpw,$native,$salary,$start,$performance,$excuse,$absent,$mistake,$bonus,$best)
// {  

// $bulk = new MongoDB\Driver\BulkWrite;
// $id = $ID;
// $Name = $name;
// $Age = $age;
// $Department = $depart;
// $Position = $position;
// $Education = $edu;
// $Marital_status = $marital;
// $Race = $race;
// $Sex = $sex;
// $Hours_Per_Week = $hpw;
// $Native_Country = $native;
// $Salary = $salary;
// $Start_Date = $start;
// $Performance_rating = $performance;
// $Late_times = 0;
// $Excuse_times = $excuse;
// $Absent_W_Excuse = $absent;
// $Mistakes = $mistake;
// $Bonus = $bonus;
// $Best_Employee = $best;

// try {
//   $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
//   [
//     'Name'=>$Name,
//     'Age'=>$Age,
//     'Department'=>$Department,
//     'Position'=>$Position,
//     'Education'=>$Education,
//     'Marital_status'=>$Marital_status,
//     'Race'=>$Race,
//     'Sex'=>$Sex,
//     'Hours_Per_Week'=>$Hours_Per_Week,
//     'Native_Country'=>$Native_Country,
//     'Salary'=>$Salary,
//     'Start_Date'=>$Start_Date,
//     'Performance_rating'=>$Performance_rating,
//     'Late_times'=>$Late_times,
//     'Excuse_times'=>$Excuse_times,
//     'Absent_W_Excuse'=>$Absent_W_Excuse,
//     'Mistakes'=>$Mistakes,
//     'Bonus'=>$Bonus,
//     'Best_Employee'=>$Best_Employee
//   ]);
//     $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
//     $result = $manager->executeBulkWrite('project.droptest',$bulk);
  
// } catch (MongoDB\Driver\Exception $e) {
//   die("Error encountered!".$e);
// }
// }

// function resetMonthlyExcuseTime($ID,$name,$age,$depart,$position,$edu,$marital,$race,$sex,$hpw,$native,$salary,$start,$performance,$late,$absent,$mistake,$bonus,$best)
// {  

// $bulk = new MongoDB\Driver\BulkWrite;
// $id = $ID;
// $Name = $name;
// $Age = $age;
// $Department = $depart;
// $Position = $position;
// $Education = $edu;
// $Marital_status = $marital;
// $Race = $race;
// $Sex = $sex;
// $Hours_Per_Week = $hpw;
// $Native_Country = $native;
// $Salary = $salary;
// $Start_Date = $start;
// $Performance_rating = $performance;
// $Late_times = $late;
// $Excuse_times = 0;
// $Absent_W_Excuse = $absent;
// $Mistakes = $mistake;
// $Bonus = $bonus;
// $Best_Employee = $best;

// try {
//   $bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
//   [
//     'Name'=>$Name,
//     'Age'=>$Age,
//     'Department'=>$Department,
//     'Position'=>$Position,
//     'Education'=>$Education,
//     'Marital_status'=>$Marital_status,
//     'Race'=>$Race,
//     'Sex'=>$Sex,
//     'Hours_Per_Week'=>$Hours_Per_Week,
//     'Native_Country'=>$Native_Country,
//     'Salary'=>$Salary,
//     'Start_Date'=>$Start_Date,
//     'Performance_rating'=>$Performance_rating,
//     'Late_times'=>$Late_times,
//     'Excuse_times'=>$Excuse_times,
//     'Absent_W_Excuse'=>$Absent_W_Excuse,
//     'Mistakes'=>$Mistakes,
//     'Bonus'=>$Bonus,
//     'Best_Employee'=>$Best_Employee
//   ]);
//     $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
//     $result = $manager->executeBulkWrite('project.droptest',$bulk);
  
// } catch (MongoDB\Driver\Exception $e) {
//   die("Error encountered!".$e);
// }
// }

//budget to salary ratio
function getTotalSalary(){
$salary_total = 0;
    try {
      $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
      $query_all_salary = new MongoDB\Driver\Query([]);
      $result_all_salary = $manager->executeQuery("project.employee",$query_all_salary);

      $results_salary = $result_all_salary->toArray();
      foreach ($results_salary as $results_sal) {
        $salary_total+=(int)$results_sal->Salary;
      }
      return $salary_total;
    } catch (MongoDb\Driver\Exception\Exception $e) {
        die("Error encountered".$e);
    }
}

function getTotalBudget(){
$ret_arr = null;  
$salary_total = 0;
    try {
      $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
      $query_all_salary = new MongoDB\Driver\Query([]);
      $result_all_salary = $manager->executeQuery("project.budget",$query_all_salary);

      $results_salary = $result_all_salary->toArray();
      $id = $results_salary[0]->_id;
      foreach ($results_salary as $results_sal) {
        $salary_total+=$results_sal->Budget;
      }
      $ret_arr = [$id,$salary_total];
      return $ret_arr;
    } catch (MongoDb\Driver\Exception\Exception $e) {
        die("Error encountered".$e);
    }
}

function getDeptSalary($dept){
$salary_tot = 0;
$filter_sal = ["Department"=>$dept];
    try {
      $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
      $query_salary = new MongoDB\Driver\Query($filter_sal);
      $result_salary = $manager->executeQuery("project.employee",$query_salary);

      $results_salary = $result_salary->toArray();
      foreach ($results_salary as $results_sal) {
        $salary_tot+=$results_sal->Salary;
      }
      return $salary_tot;
    } catch (MongoDb\Driver\Exception\Exception $e) {
        die("Error encountered".$e);
    }
}

//get last five months
function getLastFiveMonths_F(){
$current_month = date('F');
$last_five_months_arr = [];
$last_five_months_arr1 = [];
for ($i=0; $i<5 ; $i++ ) { 
  $last_five_months_arr[$i] = date('F',strtotime("-$i month"));
}
$last_five_months_arr1 = array_reverse($last_five_months_arr);
return $last_five_months_arr1;
}

function getLastFiveMonths_n(){
$current_month = date('n');
$last_five_months_arr = [];
$last_five_months_arr1 = [];
for ($i=0; $i<5 ; $i++ ) { 
  $last_five_months_arr[$i] = date('n',strtotime("-$i month"));
}
$last_five_months_arr1 = array_reverse($last_five_months_arr);
return $last_five_months_arr1;
}


$last_five_months_F = implode('","', getLastFiveMonths_F());
$last_five_months_n = getLastFiveMonths_n();

function getMonthlyStringAppoint($last_five_months_n){
  $MonthlyStringAppoint = [];
  for ($i=0; $i < sizeof($last_five_months_n); $i++) { 
    $MonthlyStringAppoint[$i]=getMonthlyAppoint($last_five_months_n[$i]);
  }
  return $MonthlyStringAppoint;
}


function getMonthlyStringDismissal($last_five_months_n){
  $MonthlyStringDismissal = [];
  for ($i=0; $i < sizeof($last_five_months_n); $i++) { 
    $MonthlyStringDismissal[$i]=getMonthlyDismissal($last_five_months_n[$i]);
  }
  return $MonthlyStringDismissal;
}
 
     $monthlyStringAppoint = '"'.implode('","',getMonthlyStringAppoint($last_five_months_n)).'"';
     $monthlyStringDismissal = '"'.implode('","',getMonthlyStringDismissal($last_five_months_n)).'"';
    

//monthly appointment and dismissal

function getMonthlyAppoint($month){
$total = 0;
    try {
      $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
      $query_all = new MongoDB\Driver\Query([]);
      $result_all = $manager->executeQuery("project.employee",$query_all);

      $results = $result_all->toArray();
      foreach ($results as $result) {
        if (date("n",strtotime(str_replace('/', '-', $result->Start_Date))) == $month) {
        $total++; 
        }
      }
      return $total;
    } catch (MongoDb\Driver\Exception\Exception $e) {
        die("Error encountered".$e);
    }
}

function getMonthlyDismissal($month){ 
$total = 0;
    try {
      $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
      $query_all = new MongoDB\Driver\Query([]);
      $result_all = $manager->executeQuery("project.endjob",$query_all);

      $results = $result_all->toArray();
      foreach ($results as $result) {
        if ((date("n",strtotime(str_replace('/', '-', $result->Retire_Date))) == $month) or (date("n",strtotime(str_replace('/', '-', $result->Fire_Date))) == $month)) {
        $total++; 
        }
      }
      return $total;
    } catch (MongoDb\Driver\Exception\Exception $e) {
        die("Error encountered".$e);
    }
}


//calling functions
$total_salary = getTotalSalary();
$total_bg = getTotalBudget();
$total_budget = $total_bg[1];
$total_sal_op = getDeptSalary("Operations");
$total_sal_sales = getDeptSalary("Sales");
$total_sal_hr = getDeptSalary("Human Resources");
$total_sal_it = getDeptSalary("IT");
$total_sal_wh = getDeptSalary("Warehouse");
$total_sal_fi = getDeptSalary("Finance");


//for charts
$male = "Male";
$female = "Female";
$operation = "Operations";
$sales = "Sales";
$hr = "Human Resources";
$it = "IT";
$wh = "Warehouse";
$fi = "Finance";

//Male to female ratio
$filter_male = ["Sex" => $male];
$filter_female = ["Sex" => $female];
$query_male = new MongoDB\Driver\Query($filter_male);
$query_female = new MongoDB\Driver\Query($filter_female);


//Employee percentage by department
//operation department male and female
$filter_operation = ["Department"=>$operation];
$filter_operation_m = ["Department" => $operation,"Sex"=> $male];
$filter_operation_f = ["Department" => $operation,"Sex"=> $female];

$query_operation = new MongoDB\Driver\Query($filter_operation);
$query_operation_m = new MongoDB\Driver\Query($filter_operation_m);
$query_operation_f = new MongoDB\Driver\Query($filter_operation_f);

//sales department male and female
$filter_sales = ["Department"=>$sales];
$filter_sales_m = ["Department" => $sales,"Sex"=> $male];
$filter_sales_f = ["Department" => $sales,"Sex"=> $female];

$query_sales = new MongoDB\Driver\Query($filter_sales);
$query_sales_m = new MongoDB\Driver\Query($filter_sales_m);
$query_sales_f = new MongoDB\Driver\Query($filter_sales_f);

//HR department male and female
$filter_hr = ["Department"=>$hr];
$filter_hr_m = ["Department" => $hr,"Sex"=> $male];
$filter_hr_f = ["Department" => $hr,"Sex"=> $female];

$query_hr = new MongoDB\Driver\Query($filter_hr);
$query_hr_m = new MongoDB\Driver\Query($filter_hr_m);
$query_hr_f = new MongoDB\Driver\Query($filter_hr_f);

//IT department male and female
$filter_it = ["Department"=>$it];
$filter_it_m = ["Department" => $it,"Sex"=> $male];
$filter_it_f = ["Department" => $it,"Sex"=> $female];

$query_it = new MongoDB\Driver\Query($filter_it);
$query_it_m = new MongoDB\Driver\Query($filter_it_m);
$query_it_f = new MongoDB\Driver\Query($filter_it_f);

//Warehouse department male and female
$filter_wh = ["Department"=>$wh];
$filter_wh_m = ["Department" => $wh,"Sex"=> $male];
$filter_wh_f = ["Department" => $wh,"Sex"=> $female];

$query_wh = new MongoDB\Driver\Query($filter_wh);
$query_wh_m = new MongoDB\Driver\Query($filter_wh_m);
$query_wh_f = new MongoDB\Driver\Query($filter_wh_f);

//Finance department male and female
$filter_fi = ["Department"=>$fi];
$filter_fi_m = ["Department" => $fi,"Sex"=> $male];
$filter_fi_f = ["Department" => $fi,"Sex"=> $female];

$query_fi = new MongoDB\Driver\Query($filter_fi);
$query_fi_m = new MongoDB\Driver\Query($filter_fi_m);
$query_fi_f = new MongoDB\Driver\Query($filter_fi_f);
try {
   
   $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');

   //male to female pie chart overall
   $query_all = new MongoDB\Driver\Query([]);
   $result_all = $manager->executeQuery("project.employee",$query_all);
   $row_all = $result_all->toArray();
   $all_count = count($row_all);

   $result_male = $manager->executeQuery('project.employee', $query_male);
   $row_male = $result_male->toArray();
   $male_count = count($row_male);
   
   $result_female = $manager->executeQuery('project.employee', $query_female);
   $row_female = $result_female->toArray();
   $female_count = count($row_female);

   //employee percentage by department
   //male to female count by operation department
   $result_operation = $manager->executeQuery('project.employee',$query_operation);
   $row_operation = $result_operation->toArray();
   $operation_count = count($row_operation);   

   $result_operation_m = $manager->executeQuery('project.employee',$query_operation_m);
   $row_operation_m = $result_operation_m->toArray();
   $operation_m_count = count($row_operation_m);

   $result_operation_f = $manager->executeQuery('project.employee',$query_operation_f);
   $row_operation_f = $result_operation_f->toArray();
   $operation_f_count = count($row_operation_f);

   //male to female count by sales department
   $result_sales = $manager->executeQuery('project.employee',$query_sales);
   $row_sales = $result_sales->toArray();
   $sales_count = count($row_sales);   

   $result_sales_m = $manager->executeQuery('project.employee',$query_sales_m);
   $row_sales_m = $result_sales_m->toArray();
   $sales_m_count = count($row_sales_m);

   $result_sales_f = $manager->executeQuery('project.employee',$query_sales_f);
   $row_sales_f = $result_sales_f->toArray();
   $sales_f_count = count($row_sales_f);

   //male to female count by HR department
   $result_hr = $manager->executeQuery('project.employee',$query_hr);
   $row_hr = $result_hr->toArray();
   $hr_count = count($row_hr);   

   $result_hr_m = $manager->executeQuery('project.employee',$query_hr_m);
   $row_hr_m = $result_hr_m->toArray();
   $hr_m_count = count($row_hr_m);

   $result_hr_f = $manager->executeQuery('project.employee',$query_hr_f);
   $row_hr_f = $result_hr_f->toArray();
   $hr_f_count = count($row_hr_f);

   //male to female count by IT department
   $result_it = $manager->executeQuery('project.employee',$query_it);
   $row_it = $result_it->toArray();
   $it_count = count($row_it);   

   $result_it_m = $manager->executeQuery('project.employee',$query_it_m);
   $row_it_m = $result_it_m->toArray();
   $it_m_count = count($row_it_m);

   $result_it_f = $manager->executeQuery('project.employee',$query_it_f);
   $row_it_f = $result_it_f->toArray();
   $it_f_count = count($row_it_f);

   //male to female count by Warehouse department
   $result_wh = $manager->executeQuery('project.employee',$query_wh);
   $row_wh = $result_wh->toArray();
   $wh_count = count($row_wh);   

   $result_wh_m = $manager->executeQuery('project.employee',$query_wh_m);
   $row_wh_m = $result_wh_m->toArray();
   $wh_m_count = count($row_wh_m);

   $result_wh_f = $manager->executeQuery('project.employee',$query_wh_f);
   $row_wh_f = $result_wh_f->toArray();
   $wh_f_count = count($row_wh_f);

   //male to female count by Finance department
   $result_fi = $manager->executeQuery('project.employee',$query_fi);
   $row_fi = $result_fi->toArray();
   $fi_count = count($row_fi);   

   $result_fi_m = $manager->executeQuery('project.employee',$query_fi_m);
   $row_fi_m = $result_fi_m->toArray();
   $fi_m_count = count($row_fi_m);

   $result_fi_f = $manager->executeQuery('project.employee',$query_fi_f);
   $row_fi_f = $result_fi_f->toArray();
   $fi_f_count = count($row_fi_f);

} catch (MongoDB\Driver\Exception\Exception $e) {
   die("Error encountered".$e);
}

//check username and password

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
    <title>Welcome to Visual HR</title>
    <link rel="icon" href="images/favicons.ico" />
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="vendor/c3/c3.min.css" />
    <link rel="stylesheet" href="vendor/chartist/custom/chartist.css" />
    <link rel="stylesheet" href="vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="styles/style.css">
    
      
</head>
<body class="light-skin fixed-navbar sidebar-scroll" style="font-size:16px;">

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
        <div id="navigation" style="width:300px">
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
         <div class="normalheader">
            <div class="hpanel">
               <div class="panel-body">
                        <h5 style="font-size:16px;">
                        Best employees for rewards in this week '.date('F').'
                        </h5>
               <a href="all_employee_performance_best.php" class="btn btn-primary text-center pull-right" style="margin-top:-1.5%;margin-right:-1%;">Show all >></a><br><br>';
               for ($i=0; $i < 5 ; $i++) {
                 echo '
                      <div class="panel-body th-border" style="width:19%;overflow:hidden;float:left;margin-right:1%;">
                        <a href="best_employee_profile.php?id='.getDataWithID($topEmployeeArray[$i])[0]."&Name=".getDataWithID($topEmployeeArray[$i])[1]."&Age=".getDataWithID($topEmployeeArray[$i])[2]."&Department=".getDataWithID($topEmployeeArray[$i])[3]."&Position=".getDataWithID($topEmployeeArray[$i])[4]."&Education=".getDataWithID($topEmployeeArray[$i])[5]."&Marital_status=".getDataWithID($topEmployeeArray[$i])[6]."&Race=".getDataWithID($topEmployeeArray[$i])[7]."&Sex=".getDataWithID($topEmployeeArray[$i])[8]."&Hours_Per_Week=".getDataWithID($topEmployeeArray[$i])[9]."&Native_Country=".getDataWithID($topEmployeeArray[$i])[10]."&Salary=".getDataWithID($topEmployeeArray[$i])[11]."&Start_Date=".getDataWithID($topEmployeeArray[$i])[12]."&Performance_rating=".getDataWithID($topEmployeeArray[$i])[13]."&Late_times=".getDataWithID($topEmployeeArray[$i])[14]."&Excuse_times=".getDataWithID($topEmployeeArray[$i])[15]."&Absent_W_Excuse=".getDataWithID($topEmployeeArray[$i])[16]."&Mistakes=".getDataWithID($topEmployeeArray[$i])[17]."&Bonus=".getDataWithID($topEmployeeArray[$i])[18]."&Best_Employee=".getDataWithID($topEmployeeArray[$i])[19]."&Address=".getDataWithID($topEmployeeArray[$i])[20]."&Mail=".getDataWithID($topEmployeeArray[$i])[21]."&Leader_review=".getDataWithID($topEmployeeArray[$i])[22]."&Member_review=".getDataWithID($topEmployeeArray[$i])[23].'" class="btn text-center pull-right" style="margin-top:-2%;margin-right:-2%;">Profile <i class="pe-7s-up-arrow pe-rotate-90"></i></a>
                        <img alt="logo" class="img-circle m-b m-t-md" style="width:128px;height:128px;" src="upload/'.getProfileImagePath((string)getDataWithID($topEmployeeArray[$i])[0]).'">
                        <h3>'.getDataWithID($topEmployeeArray[$i])[1].'</h3>
                        <div class="text-muted font-bold m-b-xs">'.getDataWithID($topEmployeeArray[$i])[4].'</div>
                        <div class="text-muted font-bold m-b-xs">'.getDataWithID($topEmployeeArray[$i])[3].'</div><br>
                        <span class="badge badge-success"><h5>Manager satisfaction</h5></span>
                        <p style="margin-top:5px;">
                           '.showStar(getDataWithID($topEmployeeArray[$i])[13]).'
                        </p>
                        
                    </div>';
               }
                   
                   
               echo '</div>
            </div>
         </div>
         <div class="content">
            <div class="row">
               
              <div class="col-lg-4">
                  <div class="hpanel">
                     <div class="panel-heading">
                        
                        Employee percentage by Department
                     </div>
                     <div class="panel-body">
                        <div>
                           <canvas id="barOptions" height="271"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            
              <div class="col-lg-4">
                  <div class="hpanel">
                     <div class="panel-heading">
                       
                     Male to Female ratio
                     </div>
                     <div class="panel-body no-border">
                          <div>
                              <div id="pie"></div>
                          </div>
                      </div>
                  </div>
               </div>
              <div class="col-lg-4">
                      <div class="hpanel">
                          <div class="panel-heading">
                              Salary to Budget Ratio
                          </div>
                          <div class="panel-body" style="height:360px;">
                              <div>
                                  <div id="gauge" style="margin-top:-7px;"></div>
                              </div>
                              <br>
                              <div style="margin-left:10%;">
                              <h4>Total Salary</h4>
                              <h3 class="m-xs">$ '.number_format($total_salary).'</h3>
                              <h4 style="margin-top:20px;">Budget</h4>
                              <h3 class="m-xs">$ '.number_format($total_budget).'</h3>
                              </div>
                              <br>
                              
                              <a href="budget.php?op_sal='.$total_sal_op."&sales_sal=".$total_sal_sales."&hr_sal=".$total_sal_hr."&it_sal=".$total_sal_it."&wh_sal=".$total_sal_wh."&fi_sal=".$total_sal_fi."&total_budget=".$total_budget."&total_salary=".$total_salary."&id=".$total_bg[0].'" style="margin-left:70%;margin-top:-90px;" class="btn btn-primary text-center">Details >></a>
                          </div>
                      </div>
                  </div>
            </div>
            <div class="row">
               
               <div class="col-lg-6">
                  <div class="hpanel">
                     <div class="panel-heading">
                        Appointment and dismissal in last five months
                     </div>
                     <div class="panel-body">
                        <div>
                           <canvas id="singleBarOptions" height="140"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="hpanel">
                     <div class="panel-heading">
                        
                        Employees performance by departments
                     </div>
                     <div class="panel-body">
                        <div>
                           <canvas id="lineOptions" height="140"></canvas>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="hpanel">
                     <div class="panel-heading">
                        percentage for each dismissal reason
                     </div>
                     <div class="panel-body">
                        <div>
                           <div id="ct-chart4" class="ct-perfect-fourth"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="hpanel">
                     <div class="panel-heading">
                        percentage for each turnover reason
                     </div>
                     <div class="panel-body">
                        <div>
                           <div id="ct-chart3" class="ct-perfect-fourth"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-lg-12">
                  <div class="hpanel">
                     <div class="panel-heading">
                        Doughnut bar chart
                     </div>
                     <div class="panel-body">
                        <div style="width:29%;margin:0 auto;font-size:17px;">
                           <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

                        </div>
                     </div>
                  </div>
               </div>
               
            </div>
            
            <div>
            <div class="hpanel">
               <div class="panel-body">
                        <h5 style="font-size:16px;">
                        Employees for penalties in this week '.date('F').'
                        </h5>
               <a href="all_employee_performance_worst.php" class="btn btn-primary text-center pull-right" style="margin-top:-1.5%;margin-right:-1%;background:#e74c3c;">Show all >></a><br><br>';
               for ($i=0; $i < 5 ; $i++) {
                 echo '
                      <div class="panel-body th-border" style="width:19%;overflow:hidden;float:left;margin-right:1%;">
                        <a href="worst_employee_profile.php?id='.getDataWithID($badEmployeeArray[$i])[0]."&Name=".getDataWithID($badEmployeeArray[$i])[1]."&Age=".getDataWithID($badEmployeeArray[$i])[2]."&Department=".getDataWithID($badEmployeeArray[$i])[3]."&Position=".getDataWithID($badEmployeeArray[$i])[4]."&Education=".getDataWithID($badEmployeeArray[$i])[5]."&Marital_status=".getDataWithID($badEmployeeArray[$i])[6]."&Race=".getDataWithID($badEmployeeArray[$i])[7]."&Sex=".getDataWithID($badEmployeeArray[$i])[8]."&Hours_Per_Week=".getDataWithID($badEmployeeArray[$i])[9]."&Native_Country=".getDataWithID($badEmployeeArray[$i])[10]."&Salary=".getDataWithID($badEmployeeArray[$i])[11]."&Start_Date=".getDataWithID($badEmployeeArray[$i])[12]."&Performance_rating=".getDataWithID($badEmployeeArray[$i])[13]."&Late_times=".getDataWithID($badEmployeeArray[$i])[14]."&Excuse_times=".getDataWithID($badEmployeeArray[$i])[15]."&Absent_W_Excuse=".getDataWithID($badEmployeeArray[$i])[16]."&Mistakes=".getDataWithID($badEmployeeArray[$i])[17]."&Bonus=".getDataWithID($badEmployeeArray[$i])[18]."&Best_Employee=".getDataWithID($badEmployeeArray[$i])[19]."&Address=".getDataWithID($badEmployeeArray[$i])[20]."&Mail=".getDataWithID($badEmployeeArray[$i])[21]."&Leader_review=".getDataWithID($badEmployeeArray[$i])[22]."&Member_review=".getDataWithID($badEmployeeArray[$i])[23].'" class="btn text-center pull-right" style="margin-top:-2%;margin-right:-2%;">Profile <i class="pe-7s-up-arrow pe-rotate-90"></i></a>
                        <img alt="logo" class="img-circle m-b m-t-md" style="width:128px;height:128px;" src="upload/'.getProfileImagePath((string)getDataWithID($badEmployeeArray[$i])[0]).'">
                        <h3>'.getDataWithID($badEmployeeArray[$i])[1].'</h3>
                        <div class="text-muted font-bold m-b-xs">'.getDataWithID($badEmployeeArray[$i])[4].'</div>
                        <div class="text-muted font-bold m-b-xs">'.getDataWithID($badEmployeeArray[$i])[3].'</div><br>
                        <span class="badge badge-success"><h5>Manager satisfaction</h5></span>
                        <p style="margin-top:5px;">
                           '.showStar(getDataWithID($badEmployeeArray[$i])[13]).'
                        </p>
                        
                    </div>';
               }
                   
                   
               echo '</div>
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
      
    
</body>


</html>';
}

?>

    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.resize.js"></script>
    <script src="vendor/jquery-flot/jquery.flot.pie.js"></script>
    <script src="vendor/flot.curvedlines/curvedLines.js"></script>
    <script src="vendor/jquery.flot.spline/index.js"></script>
    <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
    <script src="vendor/iCheck/icheck.min.js"></script>
    <script src="vendor/peity/jquery.peity.min.js"></script>
    <script src="vendor/sparkline/index.js"></script>
    <script src="vendor/chartjs/Chart.min.js"></script>
    <script src="scripts/devdap.js"></script>
    <script src="scripts/charts.js"></script>
    <script>$(function () { var a = [[0, 55], [1, 48], [2, 40], [3, 36], [4, 40], [5, 60], [6, 50], [7, 51]]; var e = [[0, 56], [1, 49], [2, 41], [3, 38], [4, 46], [5, 67], [6, 57], [7, 59]]; var d = { series: { splines: { show: true, tension: 0.4, lineWidth: 1, fill: 0.4 }, }, grid: { tickColor: "#f0f0f0", borderWidth: 1, borderColor: "f0f0f0", color: "#6a6c6f" }, colors: ["#C97CE5", "#F8F9FB"], }; $.plot($("#flot-line-chart"), [a, e], d); var c = [{ label: "line", data: [[1, 10], [2, 26], [3, 16], [4, 36], [5, 32], [6, 51]] }]; var b = { series: { lines: { show: true, lineWidth: 0, fill: true, fillColor: "#EFDEF7" } }, colors: ["#62cb31"], grid: { show: false }, legend: { show: false } }; $.plot($("#flot-income-chart"), c, b) });</script>
    <script>$(function () { var c = { labels: ["January", "February", "March", "April"], datasets: [{ label: "Example dataset", backgroundColor: "rgba(201,124,229,0.3)", borderColor: "rgba(201,124,229,0.7)", pointBackgroundColor: "rgba(130,67,152,1)", pointBorderColor: "#fff", pointHoverBackgroundColor: "#fff", pointHoverBorderColor: "rgba(26,179,148,1)", data: [17, 21, 19, 24] }] }; var b = { responsive: true, legend: { display: false } }; var a = document.getElementById("lineOptions").getContext("2d"); new Chart(a, { type: "line", data: c, options: b }) });</script>



      

      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/chartjs/Chart.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="scripts/devdap.js"></script>
      <script>$(function(){var B={labels:["Operations","Sales","HR","IT","Warehouse","Finance"],datasets:[{label:"Male",backgroundColor:"rgba(79,178,135,1)",borderColor:"rgba(11,122,74,1)",pointBorderWidth:1,pointBackgroundColor:"rgba(79,178,135,1)",pointRadius:3,pointBorderColor:"#ffffff",borderWidth:1,data:[<?php echo $operationMaleandFemale[0];?>,<?php echo $salesMaleandFemale[0];?>,<?php echo $hrMaleandFemale[0];?>,<?php echo $itMaleandFemale[0];?>,<?php echo $whMaleandFemale[0];?>,<?php echo $fiMaleandFemale[0];?>]},{label:"Female",backgroundColor:"rgba(247,211,134,1)",borderColor:"rgba(250,177,20,1)",pointBorderWidth:1,pointBackgroundColor:"rgba(220,220,220,1)",pointRadius:3,pointBorderColor:"#ffffff",borderWidth:1,data:[<?php echo $operationMaleandFemale[1];?>,<?php echo $salesMaleandFemale[1];?>,<?php echo $hrMaleandFemale[1];?>,<?php echo $itMaleandFemale[1];?>,<?php echo $whMaleandFemale[1];?>,<?php echo $fiMaleandFemale[1];?>]}]};var r={responsive:true};var q=document.getElementById("lineOptions").getContext("2d");new Chart(q,{type:"bar",data:B,options:r});var p={labels:["January","February","March","April","May","June","July"],datasets:[{label:"Dt 1",backgroundColor:"rgba(255,228,170,0.8)",data:[33,48,40,19,54,27,54],lineTension:0,pointBorderWidth:1,pointBackgroundColor:"rgba(130,67,152,1)",pointRadius:3,pointBorderColor:"#ffffff",borderWidth:1}]};var s={responsive:true,legend:{display:false}};var A={responsive:true};var v={labels:["Operations","Sales","HR","IT","Warehouse","Finance"],datasets:[{label:"Male",backgroundColor:"rgba(145,110,255,1)",borderColor:"rgba(100,58,232,1)",highlightFill:"rgba(145,110,255,1)",highlightStroke:"rgba(145,110,255,1)",borderWidth:1,data:[<?php echo round(($operation_m_count/$operation_count)*100);?>,<?php echo round(($sales_m_count/$sales_count)*100);?>,<?php echo round(($hr_m_count/$hr_count)*100);?>,<?php echo round(($it_m_count/$it_count)*100);?>,<?php echo round(($wh_m_count/$wh_count)*100);?>,<?php echo round(($fi_m_count/$fi_count)*100);?>]},{label:"Female",backgroundColor:"rgba(255,175,73,1)",borderColor:"rgba(255,143,0,1)",highlightFill:"#ffaf49",highlightStroke:"#ffaf49",borderWidth:1,data:[<?php echo round(($operation_f_count/$operation_count)*100);?>,<?php echo round(($sales_f_count/$sales_count)*100);?>,<?php echo round(($hr_f_count/$hr_count)*100);?>,<?php echo round(($it_f_count/$it_count)*100);?>,<?php echo round(($wh_f_count/$wh_count)*100);?>,<?php echo round(($fi_f_count/$fi_count)*100);?>]}]};var q=document.getElementById("barOptions").getContext("2d");new Chart(q,{type:"bar",data:v,options:A});var w={responsive:true,legend:{display:false}};var C={labels:[<?php echo '"'.$last_five_months_F.'"';?>],datasets:[{label:"Appoint",backgroundColor:"rgba(127, 54, 217,0.5)",borderColor:"rgba(130, 28, 255,1)",highlightFill:"rgba(130, 28, 255,1)",highlightStroke:"rgba(130, 28, 255,1)",borderWidth:1,data:[<?php echo $monthlyStringAppoint;?>]},{label:"Dismiss",backgroundColor:"rgba(18, 153, 166,0.5)",borderColor:"rgba(17, 139, 150,1)",highlightFill:"rgba(17, 139, 150,1)",highlightStroke:"rgba(17, 139, 150,1)",borderWidth:1,data:[<?php echo $monthlyStringDismissal;?>]}]};var q=document.getElementById("singleBarOptions").getContext("2d");new Chart(q,{type:"bar",data:C,options:w});var t={labels:["App","Software","Laptop"],datasets:[{data:[20,120,100],backgroundColor:["rgba(255,228,170,0.6)","rgba(255,228,170,0.8)","rgba(255,228,170,1)"],hoverBackgroundColor:["rgba(130,67,152,0.6)","rgba(130,67,152,0.8)","rgba(130,67,152,1)"]}]};var D={responsive:true};var q=document.getElementById("doughnutChart").getContext("2d");new Chart(q,{type:"doughnut",data:t,options:D});var u={labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"],datasets:[{label:"Dt 1",backgroundColor:"rgba(79,178,135,0.4)",borderColor:"rgba(79,178,135,0.6)",pointBackgroundColor:"rgba(79,178,135,0.8)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"#62cb31",borderWidth:1,data:[65,59,66,45,56,55,40]},{label:"Dt 2",backgroundColor:"rgba(79,178,135,0.6)",borderColor:"rgba(79,178,135,0.6)",pointBackgroundColor:"rgba(79,178,135,0.8)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"#62cb31",borderWidth:1,data:[28,12,40,19,63,27,87]}]};var y={responsive:true};var q=document.getElementById("radarChart").getContext("2d");new Chart(q,{type:"radar",data:u,options:y})});</script>


      
      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="vendor/d3/d3.min.js"></script>
      <script src="vendor/c3/c3.min.js"></script>
      <script src="scripts/devdap.js"></script>
      <script>$(function(){c3.generate({bindto:"#lineChart",data:{columns:[["data1",100,30,200,100,400,150,250],["data2",50,20,10,40,15,25]],colors:{data1:"#824398",data2:"#C97CE5"}}});c3.generate({bindto:"#areaChart",data:{columns:[["data1",300,350,300,0,0,0],["data2",130,100,140,200,150,50]],types:{data1:"area",data2:"area-spline"},colors:{data1:"#FFE4AA",data2:"#9560A8"}}});c3.generate({bindto:"#scatter",data:{xs:{data1:"data1_x",data2:"data2_x"},columns:[["data1_x",3.2,3.2,3.1,2.3,2.8,2.8,3.3,2.4,2.9,2.7,2,3,2.2,2.9,2.9,3.1,3,2.7,2.2,2.5,3.2,2.8,2.5,2.8,2.9,3,2.8,3,2.9,2.6,2.4,2.4,2.7,2.7,3,3.4,3.1,2.3,3,2.5,2.6,3,2.6,2.3,2.7,3,2.9,2.9,2.5,2.8],["data2_x",3.3,2.7,3,2.9,3,3,2.5,2.9,2.5,3.6,3.2,2.7,3,2.5,2.8,3.2,3,3.8,2.6,2.2,3.2,2.8,2.8,2.7,3.3,3.2,2.8,3,2.8,3,2.8,3.8,2.8,2.8,2.6,3,3.4,3.1,3,3.1,3.1,3.1,2.7,3.2,3.3,3,2.5,3,3.4,3],["data1",1.4,1.5,1.5,1.3,1.5,1.3,1.6,1,1.3,1.4,1,1.5,1,1.4,1.3,1.4,1.5,1,1.5,1.1,1.8,1.3,1.5,1.2,1.3,1.4,1.4,1.7,1.5,1,1.1,1,1.2,1.6,1.5,1.6,1.5,1.3,1.3,1.3,1.2,1.4,1.2,1,1.3,1.2,1.3,1.3,1.1,1.3],["data2",2.5,1.9,2.1,1.8,2.2,2.1,1.7,1.8,1.8,2.5,2,1.9,2.1,2,2.4,2.3,1.8,2.2,2.3,1.5,2.3,2,2,1.8,2.1,1.8,1.8,1.8,2.1,1.6,1.9,2,2.2,1.5,1.4,2.3,2.4,1.8,1.8,2.1,2.4,2.3,1.9,2.3,2.5,2.3,1.9,2,2.3,1.8]],colors:{data1:"#824398",data2:"#727272"},type:"scatter"}});c3.generate({bindto:"#stocked",data:{columns:[["Male",30,200,100,400,150,250],["Female",50,20,10,40,15,25]],colors:{data1:"#FFE4AA",data2:"#4FB287"},type:"bar",groups:[["Male","Female"]]}});c3.generate({bindto:"#gauge",data:{columns:[["Salary",<?php echo round(($total_salary/$total_budget)*100);?>]],type:"gauge"},color:{pattern:["#C97CE5","#F8F9FB"]}});c3.generate({bindto:"#pie",data:{columns:[["Male",<?php echo round(($male_count/$all_count)*100);?>],["Female",<?php echo round(($female_count/$all_count)*100);?>]],colors:{Male:"#c97ce5",Female:"#ebc0fa"},type:"pie"}})});</script>

      <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("deptPerform",
    {
      data: [
      {
        type: "bar",
        showInLegend: true,
        legendText: "Male",
        color: "#FFE4AA",
        dataPoints: [
        { y: 198, label: "Operations"},
        { y: 201, label: "Sales"},
        { y: 202, label: "HR"},
        { y: 236, label: "IT"},
        { y: 395, label: "Warehouse"},
        { y: 957, label: "Finance"}
        ]
      },
      {
        type: "bar",
        showInLegend: true,
        legendText: "Female",
        color: "#4FB287",
        dataPoints: [
        { y: 166, label: "Operations"},
        { y: 144, label: "Sales"},
        { y: 223, label: "HR"},
        { y: 272, label: "IT"},
        { y: 319, label: "Warehouse"},
        { y: 759, label: "Finance"}
        ]
      },
      
      ]
    });

chart.render();
}
</script> 

      <script src="vendor/jquery/dist/jquery.min.js"></script>
      <script src="vendor/jquery-ui/jquery-ui.min.js"></script>
      <script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
      <script src="vendor/iCheck/icheck.min.js"></script>
      <script src="vendor/chartist/dist/chartist.min.js"></script>
      <script src="vendor/sparkline/index.js"></script>
      <script src="scripts/devdap.js"></script>
      <script>$(function(){new Chartist.Line("#ct-chart1",{labels:["Monday","Tuesday","Wednesday","Thursday","Friday"],series:[[6,8,7,4,6],[5,7,6,3,5],[4,6,5,2,4]]},{fullWidth:true,chartPadding:{right:40}});new Chartist.Line("#ct-chart7",{labels:[1,2,3,4,5,6,7,8],series:[[5,9,7,8,5,3,5,4]]},{low:0,showArea:true});new Chartist.Bar("#ct-chart3",{labels:["Health","Caring for the family","Freedom to persue interests","Dissatisfaction with career","Other personals"],series:[[<?php echo round(($retire_h/$retire_all)*100);?>,<?php echo round(($retire_cftf/$retire_all)*100);?>,<?php echo round(($retire_ftpi/$retire_all)*100);?>,<?php echo round(($retire_dwc/$retire_all)*100);?>,<?php echo round(($retire_op/$retire_all)*100);?>]]},{stackBars:true,axisY:{labelInterpolationFnc:function(c){return(c)+"%"}}}).on("draw",function(c){if(c.type==="bar"){c.element.attr({style:"stroke-width: 30px"})}});new Chartist.Bar("#ct-chart4",{labels:["Too many mistakes","Absent without excuse","Excuse many times","Late many times","Poorly perform"],series:[[<?php echo round(($fire_tmm/$fire_all)*100);?>,<?php echo round(($fire_awe/$fire_all)*100);?>,<?php echo round(($fire_emt/$fire_all)*100);?>,<?php echo round(($fire_lmt/$fire_all)*100);?>,<?php echo round(($fire_pp/$fire_all)*100);?>]]},{seriesBarDistance:10,reverseData:true,horizontalBars:true,axisY:{offset:70}});var b={series:[10,5,5]};var a=function(d,c){return d+c+"%"};new Chartist.Pie("#ct-chart5",b,{labelInterpolationFnc:function(c){return Math.round(c/b.series.reduce(a)*100)+"%"}});new Chartist.Pie("#ct-chart6",{series:[25,25,25,25]},{donut:true,donutWidth:60,startAngle:270,total:200,showLabel:false})});</script>



<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportFileName: "Doughnut Chart",
	exportEnabled: true,
	// animationEnabled: true,
	// title:{
	// 	text: "Monthly Expense"
	// },
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "doughnut",
		innerRadius: 50,
		showInLegend: true,
		toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
		indexLabel: "{name} - #percent%",
		dataPoints: [
			{ y: 100, name: "Food" },
			{ y: 120, name: "Insurance" },
			{ y: 300, name: "Travelling" },
			{ y: 800, name: "Housing" }
		]
	}]
});
chart.render();

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();
}

}
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
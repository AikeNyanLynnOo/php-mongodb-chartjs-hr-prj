<?php
$bulk = new MongoDB\Driver\BulkWrite;


function calculateSalary(){
	$old_salary;
	$new_salary;
	$bonus = 0;
		$old_salary = (int)$_POST["Salary"];
		$new_salary = $old_salary + ((int)$_POST["salary_plus"]/100)*$old_salary - ((int)$_POST["salary_minus"]/100)*$old_salary;
		$bonus = ((int)$_POST["salary_plus"]/100)*$old_salary;
	return [$new_salary,$bonus];
}


$age = (string)$_POST["Age"];
$new_age = str_replace("-", "/", $age);

$start = (string)$_POST["Start_Date"];
$new_start = str_replace("-", "/", $start);

$id = $_POST["id"];
$Name = $_POST["Name"];
$Age = $new_age;
$Department = $_POST["Department"];
$Position = $_POST["Position"];
$Education = $_POST["Education"];
$Marital_status = $_POST["Marital_status"];
$Race = $_POST["Race"];
$Sex = $_POST["Sex"];
$Mail = $_POST["Mail"];
$Address = $_POST["Address"];
$Hours_Per_Week = (int)$_POST["Hours_Per_Week"];
$Native_Country = $_POST["Native_Country"];
$Salary = (int)calculateSalary()[0];
$Start_Date = $new_start;
$Performance_rating = (int)$_POST["Performance_rating"];
$Leader_review = (int)$_POST["Leader_review"];
$Member_review = (int)$_POST["Member_review"];
$Late_times = (int)$_POST["Late_times"];
$Excuse_times = (int)$_POST["Excuse_times"];
$Absent_W_Excuse = (int)$_POST["Absent_W_Excuse"];
$Mistakes = (int)$_POST["Mistakes"];
$Bonus = (int)calculateSalary()[1];
$Best_Employee = (int)$_POST["Best_Employee"];

try {
	$bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
	[
		'Name'=>$Name,
		'Age'=>$Age,
		'Department'=>$Department,
		'Position'=>$Position,
		'Education'=>$Education,
		'Marital_status'=>$Marital_status,
		'Race'=>$Race,
		'Sex'=>$Sex,
		'Hours_Per_Week'=>$Hours_Per_Week,
		'Native_Country'=>$Native_Country,
		'Salary'=>$Salary,
		'Start_Date'=>$Start_Date,
		'Performance_rating'=>$Performance_rating,
		'Leader_review'=>$Leader_review,
		'Member_review'=>$Member_review,
		'Late_times'=>$Late_times,
		'Excuse_times'=>$Excuse_times,
		'Absent_W_Excuse'=>$Absent_W_Excuse,
		'Mistakes'=>$Mistakes,
		'Bonus'=>$Bonus,
		'Best_Employee'=>$Best_Employee,
		'Address'=>$Address,
		'Mail'=>$Mail,
	]);
    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.employee',$bulk);
    header("Location:../employees.php");
	
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}
?>
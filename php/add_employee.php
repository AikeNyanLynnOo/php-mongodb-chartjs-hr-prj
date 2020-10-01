<?php
$bulk = new MongoDB\Driver\BulkWrite;

$age = (string)$_POST["Age"];
$new_age = str_replace("-", "/", $age);

$start = (string)$_POST["Start_Date"];
$new_start = str_replace("-", "/", $start);

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
$Salary = (int)$_POST["Salary"];
$Start_Date = $new_start;
$Performance_rating = $_POST["Performance_rating"];
$Leader_review = $_POST["Leader_review"];
$Member_review = $_POST["Member_review"];
$Late_times = $_POST["Late_times"];
$Excuse_times = $_POST["Excuse_times"];
$Absent_W_Excuse = $_POST["Absent_W_Excuse"];
$Mistakes = $_POST["Mistakes"];
$Bonus = (int)$_POST["Bonus"];
$Best_Employee = $_POST["Best_Employee"];

$user = [
	"_id" => new MongoDB\BSON\ObjectId,
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
];

try {
	$bulk->insert($user);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.employee',$bulk);
    echo "Successfully created!";
    header("Location: ../employees.php");
	
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("Error Encountered:".$e);
}
?>
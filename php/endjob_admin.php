<?php
session_start();
addToRetire();

function addToRetire(){
$bulk = new MongoDB\Driver\BulkWrite;
$Name = $_POST["Name"];
$Age = (int)$_POST["Age"];
$Department = $_POST["Department"];
$Sex = $_POST["Sex"];
$Fire = $_POST["Fire"];
$Fire_Date = $_POST["Fire_Date"];
$Fire_Reason = $_POST["Fire_Reason"];
$Retire_Date = $_POST["Retire_Date"];
$Retire_Reason = $_POST["Retire_Reason"];
	$employee = [
	    "_id" => new MongoDB\BSON\ObjectId,
	    'Name'=>$Name,
		'Age'=>$Age,
		'Department'=>$Department,
		'Sex'=>$Sex,
		'Fire'=>$Fire,
		'Fire_Date'=>$Fire_Date,
		'Fire_Reason'=>$Fire_Reason,
		'Retire_Date'=>$Retire_Date,
		'Retire_Reason'=>$Retire_Reason,

];
try {
	$bulk->insert($employee);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.endjob',$bulk);
    echo "Successfully created!";

} catch (MongoDB\Driver\Exception\Exception $e) {
	die("Error Encountered:".$e);
}

deleteFromEmployee();
if ($_SESSION["username"] == $_POST["Name"]) {
	header("Location: ../login.php");
}else{
    header("Location: ../index.php");	
}


}
function deleteFromEmployee(){
	$bulk1 = new MongoDB\Driver\BulkWrite;
    $id_delete = $_POST["id"];
try {
	$bulk1->delete(['_id' => new MongoDB\BSON\ObjectId($id_delete)]);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
	$result = $manager->executeBulkWrite('project.admin',$bulk1);
	
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}
}
?>
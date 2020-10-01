<?php
$bulk = new MongoDB\Driver\BulkWrite;

$id = $_GET["id"];

try {
	$bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
	$result = $manager->executeBulkWrite('project.employee',$bulk);
	header("Location:../employees.php");
	
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}
?>
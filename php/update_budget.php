<?php

$bulk = new MongoDB\Driver\BulkWrite;

$id = $_POST['id'];
$total_budget = ((int)$_POST["total_budget"]+(int)$_POST["income"])-(int)$_POST["loss"];


try {
	$bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
	[
		'Budget'=>$total_budget,
	
	]);
    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.budget',$bulk);
    header("Location:../index.php");
	
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}
?>
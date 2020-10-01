<?php
$bulk = new MongoDB\Driver\BulkWrite;

$id = $_POST["id"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$position = $_POST["position"];

try {
	$bulk->update(['_id' => new MongoDB\BSON\ObjectId($id)],
	[
		'username'=>$username,
		'email'=>$email,
		'password'=>$password,
		'position'=>$position,
	]);
    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.admin',$bulk);
    header("Location:../orgchart1.php");
	
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}
?>
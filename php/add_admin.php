<?php
$bulk = new MongoDB\Driver\BulkWrite;
$username = $_POST["username"];
$email = $_POST["email"];
$password = base64_encode($_POST["password"]);
$position = $_POST["position"];



$user = [
	"_id" => new MongoDB\BSON\ObjectId,
	"username" => $username,
    "email" => $email,
    "password" => $password,
    "position" => $position,
];

try {
	$bulk->insert($user);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.admin',$bulk);
    echo "Successfully created!";
    header("Location: ../login.php");
	
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("Error Encountered:".$e);
}


    
?>
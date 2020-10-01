<?php
session_start();


$username = $_POST["username"];
$password = $_POST["password"];

$filter = [
	"username" => $username,
    "password" => base64_encode($password),
];

$query = new MongoDB\Driver\Query($filter);
try {
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeQuery('project.admin', $query);
    $row = $result->toArray();
    $id = $row[0]->_id;
    $user = $row[0]->username;
    $email = $row[0]->email;
    $password = $row[0]->password;
    $position = $row[0]->position;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $user;
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    $_SESSION["position"] = $position;
    header("Location: ../index.php");
	
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("Error Encountered:".$e);
} 
?>
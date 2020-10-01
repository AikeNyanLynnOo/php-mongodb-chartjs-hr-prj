<?php

if (isset($_POST["submit"])) {

	$bulk = new MongoDB\Driver\BulkWrite;
    $user = [
	"_id" => new MongoDB\BSON\ObjectId,
	"Name" => $_POST["Name"],
];
    if ($_FILES["file"]) {
        // if (move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES["file"]["name"])) {

            $user["Image"] = $_FILES["file"]["name"];
	// } else{
	// 	echo "Failed to upload the image";
	// }
}
	
try {
	$bulk->insert($user);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.test',$bulk);
    echo "Successfully created!";
    header("Location: ../test.php");

	
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("Error Encountered:".$e);
}
}
?>
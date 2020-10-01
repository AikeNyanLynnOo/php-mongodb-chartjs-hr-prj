<?php
$bulk = new MongoDB\Driver\BulkWrite;

$id = $_GET["id"];

try {
	$bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
	$result = $manager->executeBulkWrite('project.admin',$bulk);
	
	deleteProfile(getID($id)[0]);
    deleteInFolder(getID($id)[1]);
    header("Location:../register.php");
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}



function getID($id){
$ID = null;
$Image = "";
$filter = ["id"=>$id];

try {
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$query = new MongoDB\Driver\Query($filter);

	$rows = $manager->executeQuery("project.test",$query);
	$result = $rows->toArray();
	if (count($result)>0){
			$ID = $result[0]->_id;
			$Image = $result[0]->Image;
	}
	return [$ID,$Image];
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("error encoutered!".$e);
}
}

function deleteProfile($id){
	$bulk = new MongoDB\Driver\BulkWrite;
try {
	$bulk->delete(['_id' => new MongoDB\BSON\ObjectId($id)]);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
	$result = $manager->executeBulkWrite('project.test',$bulk);
	
} catch (MongoDB\Driver\Exception $e) {
	die("Error encountered!".$e);
}
}
function deleteInFolder($Image){
	unlink($Image);
}

?>
<?php
session_start();
$id = $_POST["id"];// emp id to get
$name = $_POST['username'];//emp name to get

if (getPhotoID($id)!=null) {
	updateProfile(getPhotoID($id),$id,$name);
}else{
	insertNewProfile($id,$name);
}

function getPhotoID($id){

$ID = null;
$filter = ["id"=>$id];

try {
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$query = new MongoDB\Driver\Query($filter);

	$rows = $manager->executeQuery("project.test",$query);
	$result = $rows->toArray();
	if (count($result)>0){
			$ID = $result[0]->_id;
	}
	return $ID;
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("error encoutered!".$e);
}
}

function updateProfile($ID,$id,$name){
    
    $bulk = new MongoDB\Driver\BulkWrite;
   //unlinking from folder if exist
	if (isset($_FILES['file'])) {
		$old_name = explode(".", $_FILES['file']['name']);
		$new_name = $id.$name.'.'.end($old_name);
		$new_name_without_extension = $id.$name;
		$files = glob("../upload/".$new_name_without_extension."*");
		foreach ($files as $file) {
			unlink($file);
		}
		
	//	
		if (move_uploaded_file($_FILES['file']['tmp_name'], '../upload/'.$new_name)) {
			try {
	        $bulk->update(['_id' => new MongoDB\BSON\ObjectId($ID)],
	        [
		         "id" => $id,
                 "Name" => $name,    
                 "Image" => $new_name,
	        ]);
            $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
            $result = $manager->executeBulkWrite('project.test',$bulk);
            header("Location:../index.php");
	
            } catch (MongoDB\Driver\Exception $e) {
	            die("Error encountered!".$e);
              }
		}
		else{
			echo "creat failed!";
		}
	}
}

function getCurrentEmployee($id){
$filter = ["_id"=>$id];
try {
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$query = new MongoDB\Driver\Query($filter);

	$rows = $manager->executeQuery("project.employee",$query);
	$result = $rows->toArray();

	return $result;
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("error encoutered!".$e);
}
}
function insertNewProfile($id,$name){

    $bulk = new MongoDB\Driver\BulkWrite;
    $data = [   
	        "_id" => new MongoDB\BSON\ObjectId,
	        "id" => $id,
            "Name" => $name,    
	];

	//unlinking from if exist
	if (isset($_FILES['file'])) {
		$old_name = explode(".", $_FILES['file']['name']);
		$new_name = $id.$name.'.'.end($old_name);
		$new_name_without_extension = $id.$name;
		$files = glob("../upload/".$new_name_without_extension."*");
		foreach ($files as $file) {
			unlink($file);
		}
	//inserting to db	
		if (move_uploaded_file($_FILES['file']['tmp_name'], '../upload/'.$new_name)) {
			$data['Image'] = $new_name;
		}
		else{
			echo "creat failed!";
		}
	}
try {
	$bulk->insert($data);
	$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('project.test',$bulk);
    header("Location:../index.php");
	
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("Error Encountered:".$e);
}
}

?>
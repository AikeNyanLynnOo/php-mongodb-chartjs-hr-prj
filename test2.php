<?php

function getEmpPerformance($dept,$perform){
$count = 0;	
$filter = ["Department"=>$dept];

try {

	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$query = new MongoDB\Driver\Query($filter);

$results = $manager->executeQuery("project.employee",$query);

if ($perform == "bad") {
	foreach ($results as $result) {
	if (($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 >=1 and ($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 <=2) {
			$count++;
		}
}
}elseif ($perform == "normal") {
	foreach ($results as $result) {
	if (($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 >=2 and ($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 <=3) {
			$count++;
		}
}
}elseif ($perform == "good") {
	foreach ($results as $result) {
	if (($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 >=3 and ($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 <=4) {
			$count++;
		}
}
}elseif ($perform == "very good") {
	foreach ($results as $result) {
	if (($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 >=4 and ($result->Performance_rating + $result->Leader_review + $result->Member_review)/3 <=5) {
			$count++;
		}
}
}else{

}



return $count;
	
} catch (MongoDB\Driver\Exception\Exception $e) {
	die("error encountered".$e);
}


}

echo getEmpPerformance("Sales","bad");
echo "<br>";
echo getEmpPerformance("Sales","normal");
echo "<br>";
echo getEmpPerformance("Sales","good");
echo "<br>";
echo getEmpPerformance("Sales","very good");

?>


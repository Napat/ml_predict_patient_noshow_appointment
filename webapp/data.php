<?php
require_once("db.php");
if($_POST["columnValue"] != "") {
	//SELECT * FROM `patient` WHERE `PatientId` REGEXP '1' ORDER BY `ID` ASC LIMIT 0, 200
	$sql = "SELECT * FROM patient ORDER BY ID ASC LIMIT 0, ".$_POST["columnValue"];
	$conn = db_con();
	$patien = $conn->query($sql, MYSQLI_USE_RESULT);

	$patien_array = array();
	// while( $row = $patien->fetch_array()){
	while( $row = $patien->fetch_assoc()){
		$patien_array[] = $row;
	}
	$patien->free();
	
	$data = $patien_array;
}
else {
	$data = db_get_first_200_patien();
}
$json_object = new stdClass();
$json_object->medical_data = $data;
echo json_encode($json_object);
?>

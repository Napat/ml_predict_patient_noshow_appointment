<?php 
require_once("db.php");
// echo $_POST["patient_id"];
//db
$patient_id = $_POST["patient_id"];

// if multi id, DELETE FROM table WHERE id IN (?,?,?,?,?,?,?,?)
$sql = "DELETE FROM patient
			WHERE PatientId = '".$patient_id."' ";
$query = mysqli_query(db_con(),$sql);
if(mysqli_affected_rows(db_con())) {
	echo "Record delete successfully";
}else{
	echo "Record delete successfully";
}
mysqli_close(db_con());
?>

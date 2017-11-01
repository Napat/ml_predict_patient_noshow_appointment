<?php  
require_once("db.php");

// echo "Hello_World";
// echo "<pre>", print_r($_POST, true),"</pre>";


$data = array(
				"patient_id"=>$_POST["patient_id"],
				"appointment_id"=>$_POST["appointment_id"],
				"gender"=>$_POST["gender"],
				"scheduled_day"=>$_POST["scheduled_day"],
				"appointment_day"=>$_POST["appointment_day"],
				"age"=>$_POST["age"]
	);

$sql =" INSERT INTO patient (PatientId, AppointmentID, Gender, ScheduledDay, AppointmentDay, Age)
		VALUES ('".$_POST["patient_id"]."'
						, '".$_POST["appointment_id"]."'
						, '".$_POST["gender"]."'
						, '".$_POST["scheduled_day"]."'
						, '".$_POST["appointment_day"]."'
						, '".$_POST["age"]."')
";


$query = mysqli_query(db_con(),$sql);
if($query) {
	echo "Record add successfully";
}else{
	echo "Record add Error!!";
}
mysqli_close(db_con());

?>

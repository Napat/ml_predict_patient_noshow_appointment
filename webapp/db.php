<?php
date_default_timezone_set("Asia/Bangkok"); 
function db_con()
{
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "forth_medical";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	mysqli_set_charset($conn,"utf8mb4");
	return $conn;
}
function db_get_first_200_patien()
{
	$sql = "SELECT * FROM patient LIMIT 0, 200";
	$conn = db_con();
	$patien = $conn->query($sql, MYSQLI_USE_RESULT);

	$patien_array = array();
	// while( $row = $patien->fetch_array()){
	while( $row = $patien->fetch_assoc()){
		$patien_array[] = $row;
	}
	$patien->free();
	return $patien_array;
}






///////////////////////////////////////////
/////////////////
////////
////
// SQL SAMPLE
function db_get_time_slot_enable_array()
{
	$sql = "SELECT * FROM wp_iqo_time_slot WHERE enable = 1";
	$conn = db_con();
	$time_slot_result = $conn->query($sql);

	$db_time_slot = array();
	while( $row = $time_slot_result->fetch_array()){
		$db_time_slot[] = $row;
	}
	$time_slot_result->free();
	return $db_time_slot;
}

function db_add_time_slot($date_ofweek, $time_text, $machine_available)
{
	$sql = "INSERT INTO wp_iqo_time_slot (time_slot_date_ofweek	, time_text	, machine_available, enable) VALUES ($date_ofweek, $time_text, $machine_available, 1)";
	$conn = db_con();
	$result = $conn->query($sql);

	if($result == TRUE)
	{
		return mysql_insert_id();
	}
	return $result;
}

// db_get_booked("2017-07-29")
function db_get_booked($date)
{
	if(!isset($date))
	{
		return null;
	}
	$sql = "SELECT * FROM wp_iqo_booking WHERE (DATE(booking_date) = '$date')
			AND (booking_active = 1)";
	$conn = db_con();
	$booked_result = $conn->query($sql);
	$db_booked = array();
	while( $row = $booked_result->fetch_array()){
		$db_booked[] = $row;
	}
	$booked_result->free();
	return $db_booked;
}
// db_get_booked_range("2017-07-29", "2017-08-4")
function db_get_booked_range($from_date, $to_date)
{
	if(!isset($from_date) || !isset($to_date))
	{
		return null;
	}
	$sql = "SELECT * FROM wp_iqo_booking WHERE (DATE(booking_date) BETWEEN '$from_date' AND '$to_date')
			AND (booking_active = 1)";
	$conn = db_con();
	$booked_result = $conn->query($sql);
	$db_booked = array();
	while( $row = $booked_result->fetch_array()){
		$db_booked[] = $row;
	}
	$booked_result->free();
	return $db_booked;
}
function db_is_this_booked($book_date, $time_slot, $machine)
{
	$ret = false;
	if(!isset($book_date) || !isset($time_slot) || !isset($machine))
	{
		echo "Parameter error!!<br>\n";
		return $ret;
	}
	$book_date = date("Y-m-d",strtotime($book_date));

	$sql = "SELECT booking_id FROM wp_iqo_booking 
			WHERE (booking_date = '$book_date') 
			AND (booking_time_slot = $time_slot) 
			AND (booking_machine = $machine)
			AND (booking_active = 1)";
	$conn = db_con();
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		// echo "FOUND : ".$result->num_rows." row<br>\n";
		$ret = true;
	}
	else{
		echo $conn->error;
	}
	$result->close();
	return $ret;
}
function db_add_booking($book_date, $time_slot, $machine, $student_name)
{
	$ret = false;
	if(!isset($book_date) || !isset($time_slot) || !isset($machine) || !isset($student_name))
	{
		echo "Parameter error!!";
		return $ret;
	}
	$book_date = date("Y-m-d",strtotime($book_date));

	if(db_is_this_booked($book_date, $time_slot, $machine))
	{
		echo "This already booked<br>\n";
		return $ret;
	}
	
	$create_time = date("Y-m-d H:i:s",strtotime("now"));
	$sql = "INSERT INTO wp_iqo_booking (booking_date, booking_time_slot, booking_machine, student, create_time) 
			VALUES ('$book_date', $time_slot, $machine, '$student_name', '$create_time')";
	$conn = db_con();
	$conn->query($sql);
	if($conn->insert_id > 0)
	{
		$ret = true;
	}
	else{
		echo $conn->error;
	}
	return $ret;
}
function db_cancel_booking($booking_id,$date, $time_slot, $machine)
{
	$ret = false;
	if(!isset($booking_id))
	{
		return $ret;
	}

	if(db_is_this_booked($date, $time_slot, $machine))
	{
		$sql = "UPDATE wp_iqo_booking SET booking_active = 0 WHERE booking_id = $booking_id";
		$conn = db_con();
		$conn->query($sql);
		if($conn->affected_rows == 1)
		{
			$ret = true;
		}
	}
	else {
		echo "This is not booked<br>";
	}
	return $ret;
}
?>


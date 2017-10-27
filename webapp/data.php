<?php
require_once("db.php");
$data = db_get_first_200_patien();

$json_object = new stdClass();
$json_object->medical_data = $data;
echo json_encode($json_object);
?>

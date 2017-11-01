<?php  
	require_once("db.php");

	$data = array(
				"rowid"=>$_POST["rowid"],
				"columnName"=>$_POST["columnName"],
				"columnValue"=>$_POST["columnValue"]
			 );

	// SQL query string
	//UPDATE `patient` SET `Gender` = 'M' WHERE `patient`.`ID` = 84474;
	$sql = "UPDATE patient SET ".$_POST["columnName"]." = '".$_POST["columnValue"]."' WHERE ID = '".$_POST["rowid"]."'";
	
	// Edit each row data
	$result = mysqli_query(db_con(),$sql);

	// Report result of query
	if($result) {
		echo "Record update successfully";
	}else{
		echo "Record update Error!!";
	}
	// Close connection
	mysqli_close(db_con());
?>

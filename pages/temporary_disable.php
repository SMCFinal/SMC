<?php
include('../_stream/config.php');
$id = $_GET['del_id'];
	$deletequery = mysqli_query($connect, "UPDATE patient_registration SET category = ' ' WHERE id='$id'");
	if (!$deletequery) {
		echo "Error";
	}else{
		header("LOCATION:patients_list.php");
	}
?>
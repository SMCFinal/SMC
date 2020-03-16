<?php
include('../_stream/config.php');
$id = $_GET['del_id'];
$room_id = $_GET['room_id'];
	$deletequery = mysqli_query($connect, "UPDATE patient_registration SET category = ' ' WHERE id='$id'");
	$update = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$room_id'");
	if (!$deletequery) {
		echo "Error";
	}else{
		header("LOCATION:patients_list.php");
	}
?>
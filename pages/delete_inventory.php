<?php
include('../_stream/config.php');
$id = $_GET['del_id'];
	$deletequery = mysqli_query($connect, "DELETE FROM `inventory_items` WHERE id='$id'");
	if (!$deletequery) {
	}else{
		header("LOCATION:inventory_list.php");
	}
?>
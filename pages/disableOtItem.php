<?php
include('../_stream/config.php');
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

	$id = $_GET['del_id'];
	
	$deletequery = mysqli_query($connect, "UPDATE `ot_items` SET `ot_item_status`= '0' WHERE id='$id'");
	
	if (!$deletequery) {
		echo mysqli_error($deletequery);
	}else{
		header("LOCATION:ot_items_list.php");
	}
?>
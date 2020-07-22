<?php
include('../_stream/config.php');
	session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
$id = $_GET['del_id'];
	$deletequery = mysqli_query($connect, "DELETE FROM `inventory_items` WHERE id='$id'");
	if (!$deletequery) {
	}else{
		header("LOCATION:inventory_list.php");
	}
?>
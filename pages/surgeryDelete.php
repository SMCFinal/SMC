<?php
include('../_stream/config.php');
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}
$id = $_GET['del_id'];
	$deletequery = mysqli_query($connect, "UPDATE surgeries SET status = '0' WHERE id='$id'");
	if (!$deletequery) {
	}else{
		header("LOCATION:surgeries_list.php");
	}
?>
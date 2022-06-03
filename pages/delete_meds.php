<?php
	include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    
    $id = $_GET['id'];
    $surg_id = $_GET['surg_id'];

    $deleteQuery = mysqli_query($connect, "DELETE FROM `surgery_medicines` WHERE surg_med_id = '$id'");

    if ($deleteQuery) {
    	echo '<script>window.location.href = "view_medicines.php?id='.$surg_id.'"</script>';
    }
?>
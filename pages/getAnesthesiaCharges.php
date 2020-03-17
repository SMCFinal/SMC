<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

	$output = '';
	$no_models='';
	$query = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '".$_POST["AnesData"]."'");

	while ($row = mysqli_fetch_array($query)) {
					$output.= $row['salary'];
					// '<input class="form-control" placeholder="Anesthesia Charges" type="number" name="anesthesia_charges" value='.$row['salary'].'>';
			// $output.= '<option value='.$row['member_id'].'>'."Anesthetic. ".$row['name'].'</option>';
	}
	echo $output;

?>
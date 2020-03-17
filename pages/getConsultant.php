<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

	$output = '';
	$no_models='';
	$query = mysqli_query($connect, "SELECT surgeries.*,  staff_members.name, staff_members.salary, staff_category.category_name FROM `surgeries`
	INNER JOIN staff_members ON staff_members.id = surgeries.member_id
    INNER JOIN staff_category ON staff_category.id = staff_members.category_id
	WHERE surgeries.surgery_name = '".$_POST["surgeryData"]."'");

	while ($row = mysqli_fetch_array($query)) {
		if ($row['category_name'] == 'Anesthesia' || $row['category_name'] == 'anesthesia') {
			$output.= '<option value='.$row['member_id'].'>'."Anesthetic. ".$row['name'].'</option>';
		}else {
		}
	}
	echo $output;

?>
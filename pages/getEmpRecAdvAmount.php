<?php

	 include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }
	$output = '';
        
	$no_models='';
	$query = mysqli_query($connect, "SELECT * FROM `emp_advance_payment` WHERE adv_status = '1' AND emp_id = '".$_POST["empId"]."' ");
	$fetchQuery = mysqli_fetch_assoc($query);

	// $dateAccepted = $fetchQuery['adv_dop'];
	// $expolode_date = explode("-", $dateAccepted);

	// $year = $expolode_date[0];
	// $month = $expolode_date[1];

	$salaryEmp = mysqli_query($connect, "SELECT * FROM `employee_registration` WHERE id = '".$_POST["empId"]."'");
	$fetchSalaryEmp = mysqli_fetch_assoc($salaryEmp);

	$output = $fetchQuery['adv_amount'];

	echo $thisMonthSalary = $fetchSalaryEmp['emp_salary'] - $fetchQuery['adv_amount'];
	echo "|";
	if ($output == '') {
        	echo $output = 0;
        }else{
			echo $output;
        }
?>
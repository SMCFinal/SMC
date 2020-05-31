<?php
include('../_stream/config.php');
	$id = $_GET['del_id'];
	$room_id = $_GET['room_id'];

	$postpond_data = mysqli_query($connect, "SELECT * FROM patient_registration WHERE id = '$id'");
	$fetch_postpond_data = mysqli_fetch_assoc($postpond_data);


	$name = $fetch_postpond_data['patient_name'];
	$Age = $fetch_postpond_data['patient_age'];
	$Gender = $fetch_postpond_data['patient_gender'];
	$Address = $fetch_postpond_data['patient_address'];
	$patient_cnic = $fetch_postpond_data['patient_cnic'];
	$patient_contact = $fetch_postpond_data['patient_contact'];
	$address_city = $fetch_postpond_data['city_id'];
	$patientRoom = $fetch_postpond_data['room_id'];
	$DateOfAdmission = $fetch_postpond_data['patient_doa'];
	$consultant = $fetch_postpond_data['patient_consultant'];
	$yearlyNumber = $fetch_postpond_data['patient_yearly_no'];
	$attendantName = $fetch_postpond_data['attendent_name'];
	$disease = $fetch_postpond_data['patient_disease'];



	$patient_doop = $fetch_postpond_data['patient_doop'];
	$patient_operation = $fetch_postpond_data['patient_operation'];
	$consultant_charges = $fetch_postpond_data['consultant_charges'];
	$anasthetic_name = $fetch_postpond_data['anasthetic_name'];
	$anesthesia_charges = $fetch_postpond_data['anesthesia_charges'];

	$currentPatient = 'postponePatient';

	if (empty($patient_doop)) {
		$patient_doop = '0000-00-00';
	}

	if (empty($patient_operation)) {
		$patient_operation = '0';
	}

	if (empty($consultant_charges)) {
		$consultant_charges = '0';
	}

	if (empty($anasthetic_name)) {
		$anasthetic_name = '0';
	}

	if (empty($anesthesia_charges)) {
		$anesthesia_charges = '0';
	}

	
	$postponePatientQuery = mysqli_query($connect, 
            "INSERT INTO postpone_patient(
            patient_name, 
            patient_age, 
            patient_gender, 
            patient_address, 
            city_id,
            room_id, 
            patient_doa, 
            patient_disease, 
            patient_consultant, 
            attendent_name, 
            category, 
            patient_yearly_no,
            patient_cnic,
            patient_contact,
            patient_doop,
            patient_operation,
            consultant_charges,
            anasthetic_name,
            anesthesia_charges
            )VALUES(
            '$name', 
            '$Age', 
            '$Gender', 
            '$Address', 
            '$address_city', 
            '$patientRoom', 
            '$DateOfAdmission', 
            '$disease', 
            '$consultant', 
            '$attendantName', 
            '$currentPatient',
            '$yearlyNumber', 
            '$patient_cnic', 
            '$patient_contact',
            '$patient_doop',
            '$patient_operation',
            '$consultant_charges',
            '$anasthetic_name',
            '$anesthesia_charges'
            )
           ");

	
	$deletequery = mysqli_query($connect, "DELETE FROM `patient_registration` WHERE id=' $id '");
	// $deletequery = mysqli_query($connect, "UPDATE patient_registration SET category = ' ' WHERE id='$id'");
	$update = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$room_id'");



	if (!$deletequery) {
		echo "Error";
	}else{
		header("LOCATION:patients_list.php");
	}
?>
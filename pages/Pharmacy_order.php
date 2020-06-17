<?php
	include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }


     $medicineCategory = $_GET['medicineCategory'];
     $category = $_GET['Category'];
     $qty = $_GET['qty'];
     $patient = $_GET['patient'];
     $reference_number = $_GET['reference_number'];

     $status = 0;
     $medcinePrice = 0;

     $arrayExplodeMed = explode(" ", $medicineCategory);

     $arrayExplodeCat = explode(" ", $category);

     $arrayExplodeQty = explode(" ", $qty);

     $medicineCategoryId = $arrayExplodeMed[0];
     $categoryId = $arrayExplodeCat[0];
     $quantityMedicine = $arrayExplodeQty[0];

     // echo $medicineCategoryId .'*****'.$categoryId.'*****'.$quantityMedicine.'*****';

     $query = mysqli_query($connect, "INSERT INTO medicine_order(med_id, cat_id, med_qty, med_price, patient_id, reference_no)VALUES('$medicineCategoryId', '$categoryId', '$quantityMedicine', '$medcinePrice', '$patient', '$reference_number')");

     if(!$query) {
            echo mysqli_error($query);
        }else {
            echo "Done";
        }



?>
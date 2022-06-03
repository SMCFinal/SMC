<?php
	include('../_stream/config.php');
        session_start();
            if (empty($_SESSION["user"])) {
            header("LOCATION:../index.php");
        }


     $medicineCategory = $_GET['medicineCategory'];
     $category = $_GET['Category'];
     $qty = $_GET['qty'];
     $surgery_id = $_GET['surgery_id'];

     $status = 0;
     $medcinePrice = 0;

     $arrayExplodeMed = explode(" ", $medicineCategory);

     $arrayExplodeCat = explode(" ", $category);

     $arrayExplodeQty = explode(" ", $qty);

     $medicineCategoryId = $arrayExplodeMed[0];
     $categoryId = $arrayExplodeCat[0];
     $quantityMedicine = $arrayExplodeQty[0];

     // echo $medicineCategoryId .'*****'.$categoryId.'*****'.$quantityMedicine.'*****'.$surgery_id;

     // surgery_medicines

     $query = mysqli_query($connect, "INSERT INTO surgery_medicines(med_id, cat_id, med_qty, surgery_id)VALUES('$medicineCategoryId', '$categoryId', '$quantityMedicine', '$surgery_id')");

     if(!$query) {
            echo mysqli_error($query);
        }else {
            echo "Done";
        }



?>
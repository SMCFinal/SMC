<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    $query = mysqli_query($connect, "UPDATE expense SET expense_status = '0' WHERE id = '$id'");

    if ($query) {
    	header("LOCATION:expense_clear.php");
    }
?>
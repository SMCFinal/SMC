<?php 
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    $checkStatus = mysqli_query($connect, "SELECT * FROM rooms WHERE id = '$id'");

    $fetch_checkStatus = mysqli_fetch_assoc($checkStatus);

    $status = $fetch_checkStatus['status'];

    if ($status === '0') {
        $changeStatus = mysqli_query($connect, "UPDATE rooms SET status = '1' WHERE id = '$id'");

        if ($changeStatus) {
            header("LOCATION: rooms_list.php");
        }
    }elseif ($status === '1') {
        $changeStatus = mysqli_query($connect, "UPDATE rooms SET status = '0' WHERE id = '$id'");

        if ($changeStatus) {
            header("LOCATION: rooms_list.php");
        }
    }

?>
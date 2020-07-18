<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$error = '';

$id = $_GET['id'];



if (isset($_POST['Upload'])) {
    $ref_no = $_POST['ref_no'];
    $file= $_FILES['fileUpload'];
    $file_name= $file['name'];
    $file_name=preg_replace("/\s+/", "", $file_name);
    $temp= $file['tmp_name'];

    $file_ext=pathinfo($file_name,PATHINFO_EXTENSION);
    $file_name=pathinfo($file_name,PATHINFO_FILENAME);

    $newName = $file_name.date("miYis").'.'.$file_ext;

    $saveto = "../_labFiles/".$newName;

    if (move_uploaded_file($temp, $saveto)) {
        // echo "Done";
    }else{
      echo "Error File Uploading";
    }


    $querySum = mysqli_query($connect, "SELECT lab_order.*, SUM(lab_test_category.test_price) AS totalPriceLab, lab_test_category.* FROM `lab_order`
                                            INNER JOIN lab_test_category ON lab_test_category.id = lab_order.lab_test_id
                                            WHERE lab_order.reference_no = '$ref_no' GROUP BY lab_order.reference_no");
    $fetch_querySum = mysqli_fetch_assoc($querySum);
    $totalTestPrice = $fetch_querySum['totalPriceLab'];
    $patient = $fetch_querySum['pat_id'];


    $uploadQUery = mysqli_query($connect, "INSERT INTO lab_test_report(pat_id, reference_no, total_price, uploaded_file)VALUES('$patient', '$ref_no', '$totalTestPrice', '$saveto')");

    $updateQuery = mysqli_query($connect, "UPDATE lab_order SET lab_status = '0' WHERE reference_no = '$ref_no'");

    if (!$updateQuery) {
        echo "ERROR";
    }else {
        header("LOCATION:lab_test_list_view.php");
    }


    // $updateQuery = mysqli_query($connect, "UPDATE medicine_order SET pharmacy_status = '0' WHERE reference_no = '$ref_no'");

    // if (!$updateQuery) {
    //     $error = "Not Done. Please Try Again!";
    // }else {
    //     // header("LOCATION:pharmacy_list.php");
    // }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>SMC</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
       <link href="../assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
.table thead th {
    border-bottom: none;

}

.table thead td,
.table thead th {
    border-bottom: 1px solid #dee2e6;
    border-top: none;

}
</style>

<body onload="JavaScript:AutoRefresh(3000);">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- <div class="container-fluid p-0 fixed-top ">
        <div class="p-3" style="background-color: #60d09d">
            <h3 class=" d-inline text-white">Lab | SHAH MEDICAL &amp; SURGICAL CENTER</h3>
            <span class=" d-inline text-white" style="float: right;"><b>Developed By DCS PVT LTD.</b>
            </span>
        </div>
    </div> -->
    <div class="container  p-5"></div>
    <div class="container-fluid mt-3">
       <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Upload</h4>
                        <p class="text-muted m-b-30 font-14">Upload patient test result.<b><i> (Please upload PDF)</i></b>
                        </p>
                        <div align="right">
                            <a href="lab_test_upload.php?id=<?php echo $id ?>" class="btn btn-danger waves-effect waves-light">Remove File <i class="fa fa-trash"></i></a>
                        </div><br>
                        
                        <form  method="POST" enctype="multipart/form-data" class="dropzone">
                            <!-- <form action="#" class="dropzone"> -->
                            <div class="m-b-30">
                                <input type="hidden" name="ref_no" required="" value="<?php echo $id ?>" >
                                <div class="fallback">
                                    <input type="file" name="fileUpload" required="" class="btn btn-default">
                                </div>
                            </div>
                            <div class="text-center m-t-15" >
                                <button style="position: absolute; margin-top: 15%;" name="Upload" class="btn btn-primary btn-lg waves-effect waves-light" type="submit">Send Files</button>
                            </div>
                            <!-- </form> -->
                        </form>    

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
    <?php include '../_partials/jquery.php'?>
    <?php include '../_partials/app.php'?>

        <!-- Dropzone js -->
        <script src="../assets/plugins/dropzone/dist/dropzone.js"></script>
</body>

</html>
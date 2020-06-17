<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$error = '';

$id = $_GET['ref_no'];
$name = $_GET['name'];
$room = $_GET['room'];

if (isset($_POST['completeOrder'])) {
    $ref_no = $_POST['refNo'];

    $updateQuery = mysqli_query($connect, "UPDATE medicine_order SET pharmacy_status = '0' WHERE reference_no = '$ref_no'");
    if (!$updateQuery) {
        $error = "Not Done. Please Try Again!";
    }else {
        header("LOCATION:pharmacy_list.php");
    }
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
    <div class="container-fluid p-0 fixed-top ">
        <div class="p-3" style="background-color: #60d09d">
            <!-- <a href="index.html" class="logo "><img src="../assets/images/logo.png" height="20" alt="logo"></a> -->
            <h3 class=" d-inline text-white">Pharmacy | SHAH MEDICAL &amp; SURGICAL CENTER</h3>
            <span class=" d-inline text-white" style="float: right;"><b>Developed By DCS PVT LTD.</b>
                <!-- <a href="signout.php" class="btn btn-danger btn-sm ml-3">Logout </a> -->
                <!-- <button  name="Deleteme"></button> -->
            </span>
        </div>
    </div>
    <div class="container  p-5"></div>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h3 class=" d-inline "><?php echo $name ?></h3>
                        <h3 class=" d-inline " style="float: right;"><?php echo $room ?></h3>
                        </span>
                        <!-- <h4 class="mt-0 header-title text-center">HR Staff List</h4> -->
                        <form method="POST">
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Medicine Name</th>
                                    <th>Medicine Category</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <input type="hidden" name="refNo" value="<?php echo $id ?>">
                            <tbody>
                                <?php 
                                    $itr = 1;
                                        $queryListMedicines = mysqli_query($connect, "SELECT medicine_order.*, add_medicines.medicine_name, medicine_category.category_name FROM `medicine_order`
                                            INNER JOIN add_medicines ON add_medicines.id = medicine_order.med_id
                                            INNER JOIN medicine_category ON medicine_category.id = medicine_order.cat_id
                                            WHERE medicine_order.reference_no = '$id'");
                                       
                                        while ($rowList = mysqli_fetch_assoc($queryListMedicines)) {
                                            echo '
                                            <tr>
                                                <td>'.$itr++.'</td>
                                                <td>'.$rowList['medicine_name'].'</td>
                                                <td>'.$rowList['category_name'].'</td>
                                                <td>'.$rowList['med_qty'].'</td>
                                            </tr>
                                            ';

                                        }
                                        ?>
                            </tbody>
                        </table>
                         <button class="btn btn-primary btn-sm ml-3"  name="completeOrder" style="float: right;" type="submit"> Complete</button>
                     </form>
                    </div>
                    <?php  echo $error ?>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- <footer class="footer mt-5 " style="position: relative;left: 0px;background-color: white">
        ©2020 <b>SMC</b> <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Team DCS.</span>
    </footer> -->
    <!-- END wrapper -->
    <!-- jQuery  -->
    <?php include '../_partials/jquery.php'?>
    <?php include '../_partials/app.php'?>
    <!-- <script type="text/javascript">
        $("html, body").animate({ scrollTop: $(document).height() }, 4000);
setTimeout(function() {
   $('html, body').animate({scrollTop:0}, 8000);
},4000);
setInterval(function(){
     // 4000 - it will take 4 secound in total from the top of the page to the bottom
$("html, body").animate({ scrollTop: $(document).height() }, 4000);
setTimeout(function() {
   $('html, body').animate({scrollTop:0}, 8000);
},4000);

},4000);
    </script> -->
    <!--  <script type="text/javascript">
            $(document).ready(function () {
                setTimeout(function(){
                  location.reload(true);
                }, 30000);
            });
        </script> -->
</body>

</html>
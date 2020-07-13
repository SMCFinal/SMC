<?php
include('../_stream/config.php');
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

include '../_stream/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
        border-bottom:none;

    }
    .table thead td,.table thead th {
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
            <h3 class=" d-inline text-white">Lab | SHAH MEDICAL &amp; SURGICAL CENTER</h3>
            <span  class=" d-inline text-white" style="float: right;"><b>Developed By DCS PVT LTD.</b>
                <a href="signout.php" class="btn btn-danger btn-sm ml-3">Logout </a>
             <!-- <button class="btn btn-danger btn-sm ml-3" name="Deleteme" >Logout</button> -->
         </span>
        </div>
    </div>
    <div class="container  p-5"></div>
    <div class="container-fluid mt-3">
        <div class="row">
              <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title text-center">HR Staff List</h4> -->
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Patient Name</th>
                                    <th>Floor #</th>
                                    <th>Room #</th>
                                      <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $itr = 1;
                            $retQuery = mysqli_query($connect, "SELECT medicine_order.*, patient_registration.patient_name, patient_registration.patient_contact, patient_registration.attendent_name ,patient_registration.room_id, rooms.*, floors.* FROM `medicine_order`
                                INNER JOIN patient_registration ON patient_registration.id = medicine_order.patient_id
                                INNER JOIN rooms ON rooms.id = patient_registration.room_id
                                INNER JOIN floors ON floors.id = rooms.floor_id
                                WHERE medicine_order.pharmacy_status = '1'
                                GROUP BY medicine_order.reference_no  ORDER BY medicine_order.reference_no ASC");
                            while ($rowRetOrders = mysqli_fetch_assoc($retQuery)) {
                                        echo '
                                         <tr>
                                            <td>'.$itr++.'</td>
                                            <td>'.$rowRetOrders['patient_name'].'</td>
                                            <td>'.$rowRetOrders['floor_name'].'</td>
                                            <td>'.$rowRetOrders['room_number'].'</td>
                                            
                                            <td class="text-center"><a href="./lab_view.php?ref_no='.$rowRetOrders['reference_no'].'&name='.$rowRetOrders['patient_name'].'&room='.$rowRetOrders['room_number'].'" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a></td>

                                        </tr>

                                        ';
                                    }
                            ?>
                            </tbody>
                        </table>

                  </div>
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
<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

// $id = $_GET['id'];

// $error = '';
// $alreadyExist = '';

// if (isset($_POST['addRoom'])) {
//     $roomNo = $_POST['roomNo'];
//     $floorNumber = $_POST['floorNo'];
//     $roomPrice = $_POST['roomPrice'];
//     $roomType = $_POST['roomType'];

//     $selectQuery = mysqli_query($connect, "SELECT COUNT(*)AS CountedRooms FROM rooms WHERE room_number = '$roomNo'");
//     $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

//     if ($fetch_selectQuery['CountedRooms'] == 0) {
//         $insertQuery = mysqli_query($connect, "INSERT INTO rooms(room_number, floor_id, room_price, room_type)VALUES('$roomNo', '$floorNumber', '$roomPrice', '$roomType')");

//         if (!$insertQuery) {
//             $error = 'Room Not Added!';
//         } else {
//             header("LOCATION:rooms_list.php");
//         }
//     } else {
//         $alreadyExist = 'Room Already Exist';
//     }

// }

include '../_partials/header.php';
?>
<style type="text/css">
.btn-xxl {
    min-width: 250px;

    padding: 20px 40px;
    font-size: 35px;
    border-radius: 8px;
    color: white !important;
}
</style>
<!-- ION Slider -->
<link href="../assets/plugins/ion-rangeslider/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
<link href="../assets/plugins/ion-rangeslider/ion.rangeSlider.skinModern.css" rel="stylesheet" type="text/css" />
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Observation History</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title text-center ">Observation Details</h4> -->
                        <form method="POST">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">BP</h4>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>High</th>
                                                        <th>Low</th>
                                                        <th>Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td class="text-center"><a href="patients_observation_bp_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mt-0">Pulse</h5>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Pulse Rate</th>
                                                        <th>Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td class="text-center"><a href="patients_observation_pulse_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Urine</h4>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Urine Measurement</th>
                                                        <th>Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td class="text-center"><a href="patients_observation_urine_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mt-0">Respiratory</h5>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Respiratory Measurement</th>
                                                        <th>Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td class="text-center"><a href="patients_observation_respiratory_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h4 class="mt-0 header-title">Drain</h4>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Respiratory Measurement</th>
                                                        <th>Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td class="text-center"><a href="patients_observation_drain.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mt-0">N/G</h5>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>N/G Measurement</th>
                                                        <th>Date</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td>a</td>
                                                        <td class="text-center"><a href="patients_observation_ng_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
</div> <!-- content -->
<?php include '../_partials/footer.php'?>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<?php include '../_partials/jquery.php'?>
<!-- Required datatable js -->
<?php include('../_partials/datatable.php') ?>
<!-- Responsive examples -->
<?php include('../_partials/responsive.php') ?>
<!-- Datatable init js -->
<!-- <?php include('../_partials/datatableInit.php') ?> -->
<script type="text/javascript">
$('.datatable').dataTable({
    "searching": false,
    "ordering": false,
    "info": false,
    paging: false
});
</script>
<!-- App js -->
<?php include '../_partials/app.php'?>
</script>
</body>

</html>
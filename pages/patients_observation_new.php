<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$error = '';
$alreadyExist = '';

if (isset($_POST['addRoom'])) {
    $roomNo = $_POST['roomNo'];
    $floorNumber = $_POST['floorNo'];
    $roomPrice = $_POST['roomPrice'];
    $roomType = $_POST['roomType'];

    $selectQuery = mysqli_query($connect, "SELECT COUNT(*)AS CountedRooms FROM rooms WHERE room_number = '$roomNo'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    if ($fetch_selectQuery['CountedRooms'] == 0) {
        $insertQuery = mysqli_query($connect, "INSERT INTO rooms(room_number, floor_id, room_price, room_type)VALUES('$roomNo', '$floorNumber', '$roomPrice', '$roomType')");

        if (!$insertQuery) {
            $error = 'Room Not Added!';
        } else {
            header("LOCATION:rooms_list.php");
        }
    } else {
        $alreadyExist = 'Room Already Exist';
    }

}

include '../_partials/header.php';
?>
<!-- ION Slider -->
<link href="../assets/plugins/ion-rangeslider/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
<link href="../assets/plugins/ion-rangeslider/ion.rangeSlider.skinModern.css" rel="stylesheet" type="text/css" />
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Patient Observation</h5>
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
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" name="patientName" type="text" placeholder="Patient Name" id="example-text-input">
                                </div>
                                <label class="col-sm-2  col-form-label">M.R No.</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" value="" placeholder="Yearly No." name="patientYearlyNumber" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">BP</label>
                                <div class="col-sm-4">
                                    <span>Low</span>
                                    <input type="text" id="range_bp" value="">
                                    <span>High</span>

                                </div>
                               
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pulse</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Pulse">
                                </div>
                                <label class="col-sm-2 col-form-label">Urine</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Urine">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Respiratory</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Respiratory">
                                </div>
                                <label class="col-sm-2 col-form-label">Drain</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="Drain">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">N/G</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" placeholder="N/G">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="addMedicine" class="btn btn-primary waves-effect waves-light">Submit</button>
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
<script src="../assets/plugins/ion-rangeslider/ion.rangeSlider.min.js"></script>
<script src="../assets/pages/rangeslider-init.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#range_bp").ionRangeSlider({
        type: "double",
        grid: true,
        min: 0,
        max: 200,
        from: 50,
        to: 200
    });
})
</script>
<!-- App js -->
<?php include '../_partials/app.php'?>
</script>
</body>

</html>
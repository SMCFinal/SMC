<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$id = $_GET['id'];

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
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <a  href="patients_observation_bp.php?id=<?php echo $id ?>" name="addMedicine" class="btn btn-primary waves-effect waves-light btn-xxl" style="width: 80%;padding: 8%; box-shadow: 5px 5px 5px 5px #ccc; ">Blood Pressure</a>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <a href="patients_observation_pulse.php?id=<?php echo $id ?>"  name="addMedicine" class="btn btn-primary waves-effect waves-light btn-xxl" style="width: 80%;padding: 8%; box-shadow: 5px 5px 5px 5px #ccc; ">Pulse</a>
                                </div>
                            </div>

                            <div class="form-group row">
                               <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                   
                                    <a href="patients_observation_urine.php?id=<?php echo $id ?>"  name="addMedicine" class="btn btn-primary waves-effect waves-light btn-xxl" style="width: 80%;padding: 8%; box-shadow: 5px 5px 5px 5px #ccc; ">Urine</a>
                                </div>


                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <a href="patients_observation_respiratory.php?id=<?php echo $id ?>"  name="addMedicine" class="btn btn-primary waves-effect waves-light btn-xxl" style="width: 80%;padding: 8%; box-shadow: 5px 5px 5px 5px #ccc; ">Respiratory</a>
                                </div>
                            </div>

                            <div class="form-group row">
                               <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                   
                                    <a  href="patients_observation_drain.php?id=<?php echo $id ?>" name="addMedicine" class="btn btn-primary waves-effect waves-light btn-xxl" style="width: 80%;padding: 8%; box-shadow: 5px 5px 5px 5px #ccc; ">Drain</a>
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                   
                                    <a href="patients_observation_ng.php?id=<?php echo $id ?>"  name="addMedicine" class="btn btn-primary waves-effect waves-light btn-xxl" style="width: 80%;padding: 8%; box-shadow: 5px 5px 5px 5px #ccc; ">N/G</a>
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
<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$pat_id = $_GET['pat_id'];
$row_id = $_GET['id'];


$retUrineData = mysqli_query($connect, "SELECT * FROM pat_observation_urine WHERE id = '$row_id'");
$fetch_retUrineData = mysqli_fetch_assoc($retUrineData);


$error = '';
$alreadyExist = '';


$id = $_GET['id'];
if (isset($_POST['updateUrineMeasurement'])) {
    $id = $_POST['id'];
    $pat_id = $_POST['pat_id'];
    $urineMeasurement = $_POST['urineMeasurement'];
    $manualDate = $_POST['manualDate'];

    $updateUrineMeasurementQuery = mysqli_query($connect, "UPDATE pat_observation_urine SET urine_measurement = '$urineMeasurement', manual_date = '$manualDate' WHERE id = '$id'");

        if (!$updateUrineMeasurementQuery) {
            $error = 'Urine Measure Not Added! Try Again!';
        } else {
            header("LOCATION:patients_observation_history.php?id=".$pat_id."");
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
                <h5 class="page-title">Patient Observation Urine</h5>
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
                                
                                <label class="col-sm-2 col-form-label">Urine</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="urineMeasurement" placeholder="Urine" required="" value="<?php echo $fetch_retUrineData['urine_measurement'] ?>">
                                </div>
                            </div>
                           

                            <input type="hidden" name="id" value="<?php echo $row_id ?>">
                            <input type="hidden" name="pat_id" value="<?php echo $pat_id ?>">
                               <br>
                                <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date &amp; Time</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input class="form-control form_datetime" name="manualDate"  placeholder="dd/mm/yyyy-hh:mm" autoclear="" value="<?php echo $fetch_retUrineData['manual_date'] ?>">
                                        <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                    </div>
                                </div>
                                </div><hr>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="updateUrineMeasurement" class="btn btn-primary waves-effect waves-light">Update</button>
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
<?php include('../_partials/datetimepicker.php') ?>
</script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
</script>
</body>

</html>
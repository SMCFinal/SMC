<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$pat_id = $_GET['pat_id'];
$row_id = $_GET['id'];


$retBPData = mysqli_query($connect, "SELECT * FROM pat_observation_bp WHERE id = '$row_id'");
$fetch_retBPData = mysqli_fetch_assoc($retBPData);


$error = '';
$alreadyExist = '';

if (isset($_POST['updateBpMeasure'])) {
    $pat_id = $_POST['pat_id'];
    $id = $_POST['id'];
    $bpMeasure = $_POST['bpMeasure'];

    $explodeBP = explode(";", $bpMeasure);
    $lowBp = $explodeBP[0];
    $highBp = $explodeBP[1];
    $manualDate = $_POST['manualDate'];

     // mysqli_query($db,"INSERT INTO stockdetails (`itemdescription`,`itemnumber`,`sellerid`,`purchasedate`,`otherinfo`,`numberofitems`,`isitdelivered`,`price`) VALUES ('$itemdescription','$itemnumber','$sellerid','$purchasedate','$otherinfo','$numberofitems','$numberofitemsused','$isitdelivered','$price')") or die(mysqli_error($db));

    $updateBpMeasureQuery = mysqli_query($connect, "UPDATE `pat_observation_bp` SET
        bp_low = '$lowBp', 
        bp_high = '$highBp', 
        manual_date = '$manualDate' 
        WHERE id = '$id'");


    if (!$updateBpMeasureQuery) {
        $error = 'BP Measurement Not Updated. Try Again!';
        echo mysqli_error($updateBpMeasureQuery);
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
                <h5 class="page-title">Patient Observation BP Edit</h5>
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
                                <label class="col-sm-2 col-form-label">BP</label>
                                <div class="col-sm-4">
                                    <span>Low</span>
                                    <input type="text" id="range_bp" name="bpMeasure">
                                    <span>High</span>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $row_id ?>">
                                <input type="hidden" name="pat_id" value="<?php echo $pat_id ?>">
                            </div><br>
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date &amp; Time</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input class="form-control form_datetime" name="manualDate"  placeholder="dd/mm/yyyy-hh:mm" autoclear="" value="<?php echo $fetch_retBPData['manual_date'] ?>">
                                    <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                                </div>
                            </div>
                            </div><hr>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-4">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="updateBpMeasure" class="btn btn-primary waves-effect waves-light">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h3><?php echo $error ?></h3>
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
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
</script>
</body>

<script type="text/javascript">
    // var bpLow =  document.getElementsByTagName('form')[0].children[0].children[1].children[1].children[0].children[3].innerText
    // var IntLow = parseInt(bpLow)
    
    // var bpHigh = document.getElementsByClassName('irs-from')[0].innerText;
    // var IntLow = parseInt(bpHigh)


    // console.log(IntLow)
</script>
</html>
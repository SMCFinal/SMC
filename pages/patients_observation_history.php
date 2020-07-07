<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}

$id = $_GET['id'];


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
                                            <h5 class="card-title mt-0">Blood Pressure</h5>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Low</th>
                                                        <th>High</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectMeasureBP = mysqli_query($connect, "SELECT * FROM `pat_observation_bp` WHERE pat_id = '$id'");
                                                    $itr = 1;
                                                    while ($rowBP = mysqli_fetch_assoc($selectMeasureBP)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$itr++.'</td>
                                                                <td>'.$rowBP['bp_low'].'</td>
                                                                <td>'.$rowBP['bp_high'].'</td>
                                                                <td>'.substr($rowBP['manual_date'], 0,10).'</td>';

                                                                $time = substr($rowBP['manual_date'], 10);
                                                                $time12Hr = date('h:i A', strtotime($time));


                                                                echo '<td>'.$time12Hr.'</td>
                                                                <td class="text-center">
                                                                    <a href="patients_observation_bp_edit.php?pat_id='.$id.'&id='.$rowBP['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a>
                                                                </td>
                                                            </tr>
                                                        ';
                                                    }
                                                    ?>
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
                                                        <th>Time</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectMeasurePulse = mysqli_query($connect, "SELECT * FROM `pat_observation_pulse` WHERE pat_id = '$id'");
                                                    $itr = 1;
                                                    while ($rowPulse = mysqli_fetch_assoc($selectMeasurePulse)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$itr++.'</td>
                                                                <td>'.$rowPulse['pulse_rate'].'</td>
                                                                <td>'.substr($rowPulse['manual_date'], 0,10).'</td>';

                                                                $time = substr($rowPulse['manual_date'], 10);
                                                                $time12Hr = date('h:i A', strtotime($time));


                                                                echo '<td>'.$time12Hr.'</td>
                                                                <td class="text-center"><a href="patients_observation_pulse_edit.php?pat_id='.$id.'&id='.$rowPulse['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                            </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr style="background-color:green;">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="card-title mt-0">Urine</h5>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>U/Measurement</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectMeasureUrine = mysqli_query($connect, "SELECT * FROM `pat_observation_urine` WHERE pat_id = '$id'");
                                                    $itr = 1;
                                                    while ($rowUrine = mysqli_fetch_assoc($selectMeasureUrine)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$itr++.'</td>
                                                                <td>'.$rowUrine['urine_measurement'].'</td>
                                                                <td>'.substr($rowUrine['manual_date'], 0,10).'</td>';

                                                                $time = substr($rowUrine['manual_date'], 10);
                                                                $time12Hr = date('h:i A', strtotime($time));


                                                                echo '<td>'.$time12Hr.'</td>

                                                                <td class="text-center"><a href="patients_observation_urine_edit.php?pat_id='.$id.'&id='.$rowUrine['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                            </tr>
                                                        ';
                                                    }
                                                    ?>
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
                                                        <th>R/Measurement</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectMeasureRespiratory = mysqli_query($connect, "SELECT * FROM `pat_observation_respiratory` WHERE pat_id = '$id'");
                                                    $itr = 1;
                                                    while ($rowRespiratory = mysqli_fetch_assoc($selectMeasureRespiratory)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$itr++.'</td>
                                                                <td>'.$rowRespiratory['respiratory_measurement'].'</td>
                                                                <td>'.substr($rowRespiratory['manual_date'], 0,10).'</td>';

                                                                $time = substr($rowRespiratory['manual_date'], 10);
                                                                $time12Hr = date('h:i A', strtotime($time));


                                                                echo '<td>'.$time12Hr.'</td>
                                                                <td class="text-center"><a href="patients_observation_respiratory_edit.php?pat_id='.$id.'&id='.$rowRespiratory['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                            </tr>
                                                        ';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <hr style="background-color:green;">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-sm-3" align="center">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <h5 class="card-title mt-0">Drain</h5>
                                            <table id="" class="datatable table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>D/Measurement</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectMeasureDrain = mysqli_query($connect, "SELECT * FROM `pat_observation_drain` WHERE pat_id = '$id'");
                                                    $itr = 1;
                                                    while ($rowDrain = mysqli_fetch_assoc($selectMeasureDrain)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$itr++.'</td>
                                                                <td>'.$rowDrain['drain_measurement'].'</td>
                                                                <td>'.substr($rowDrain['manual_date'], 0,10).'</td>';

                                                                $time = substr($rowDrain['manual_date'], 10);
                                                                $time12Hr = date('h:i A', strtotime($time));


                                                                echo '<td>'.$time12Hr.'</td>
                                                                <td class="text-center"><a href="patients_observation_drain_edit.php?pat_id='.$id.'&id='.$rowDrain['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                            </tr>
                                                        ';
                                                    }
                                                    ?>
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
                                                        <th>Time</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $selectMeasureNG = mysqli_query($connect, "SELECT * FROM `pat_observation_ng` WHERE pat_id = '$id'");
                                                    $itr = 1;
                                                    while ($rowNG = mysqli_fetch_assoc($selectMeasureNG)) {
                                                        echo '
                                                            <tr>
                                                                <td>'.$itr++.'</td>
                                                                <td>'.$rowNG['ng_measurement'].'</td>
                                                                <td>'.substr($rowNG['manual_date'], 0,10).'</td>';

                                                                $time = substr($rowNG['manual_date'], 10);
                                                                $time12Hr = date('h:i A', strtotime($time));


                                                                echo '<td>'.$time12Hr.'</td>
                                                                <td class="text-center"><a href="patients_observation_ng_edit.php?pat_id='.$id.'&id='.$rowNG['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>
                                                            </tr>
                                                        ';
                                                    }
                                                    ?>
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
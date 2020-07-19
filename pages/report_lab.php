<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }


    if (isset($_POST['report'])) {
        // $doctor = $_POST['doctor'];
        $DateStart = $_POST['start'];
        $DateEnd = $_POST['end'];

        $fromDate = date("Y-m-d", strtotime($DateStart));
        $toDate = date("Y-m-d", strtotime($DateEnd));
        
        header("LOCATION:report_lab_list.php?fromDate=".$fromDate."&toDate=".$toDate."");
    }

include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Lab Report</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title">Test Details</h4> -->
                        <form method="POST">
                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Select Doctor</label>
                                <div class="col-sm-6">
                                    <?php
                                    $select_option = mysqli_query($connect, "SELECT patient_registration.*, rooms.room_number FROM `patient_registration`
                                        INNER JOIN rooms ON rooms.id = patient_registration.room_id");
                                    
                                        $options = '<select class="form-control select2" name="patientRoom" required="" style="width:100%">';
                                        $options .= '<option value="all">All</option>';
                                          while ($row = mysqli_fetch_assoc($select_option)) {
                                            $options.= '<option value='.$row['id'].'>'.$row['patient_name'].' --- '.$row['room_number'].'</option>';
                                          }
                                        $options.= "</select>";
                                    echo $options;
                                ?>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Date Range</label>
                                <div class="col-sm-6">
                                    <div class="input-daterange input-group" id="date-range">
                                        <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                        <input type="text" class="form-control" name="end" placeholder="End Date" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include '../_partials/cancel.php'?>
                                    <button type="submit" name="report" class="btn btn-primary waves-effect waves-light">Report</button>
                                    <!-- <button ></button> -->
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
<!-- App js -->
<?php include '../_partials/app.php'?>
<?php include '../_partials/datetimepicker.php'?>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>


<script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="../assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

<script src="../assets/pages/form-advanced.js"></script>
<script type="text/javascript">
$('.select2').select2({
    placeholder: 'Select an option',
    allowClear: true

});


</script>
</body>

</html>
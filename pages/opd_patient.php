<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';



    if (isset($_POST['addPatient'])) {
        $emp_name = $_POST['emp_name'];
        $emp_designation = $_POST['emp_designation'];
        $emp_pat_name = $_POST['emp_pat_name'];
        $emp_relation = $_POST['emp_relation'];
        $emp_diagnosis = $_POST['emp_diagnosis'];
        $emp_operation = $_POST['emp_operation'];
        $emp_date = $_POST['emp_date'];
        $emp_days = $_POST['emp_days'];
        
        $insertQuery = mysqli_query($connect, "INSERT INTO `opd_ptcl`(
            `emp_name`,
            `emp_designation`,
            `emp_pat_name`,
            `emp_relation`,
            `emp_diagnosis`,
            `emp_operation`,
            `emp_date`,
            `emp_days`
            ) VALUES (
            '$emp_name',
            '$emp_designation',
            '$emp_pat_name',
            '$emp_relation',
            '$emp_diagnosis',
            '$emp_operation',
            '$emp_date',
            '$emp_days'
        )");


        
        if (!$insertQuery) {
            $error = '
            <div align="center" class="alert alert-danger" role="alert">
                OPD Patient Not Added! Try Again!
            </div>';
        }else {
            header("LOCATION: opd_patient_list.php");
        }
        
        
            
    }


    include('../_partials/header.php');
?>

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Add OPD Patient</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Employee Name" type="text" id="example-text-input" name="emp_name" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" placeholder="Designation"  id="example-text-input" name="emp_designation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Patient Name" type="text" id="example-text-input" name="emp_pat_name" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Relationship</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Relationship" type="text"  id="example-text-input" name="emp_relation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Diagnosis</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Diagnosis" type="text" id="example-text-input" name="emp_diagnosis">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Operation</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Operation" type="text"  id="example-text-input" name="emp_operation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Date of Admission</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Date of Admission" type="date" id="example-text-input" name="emp_date">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">No. of Days</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Number of Days" type="number"  id="example-text-input" name="emp_days" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addPatient">Add OPD Patient</button>
                                </div>
                            </div>
                        </form>
                        <h5>
                            <?php echo $error ?>
                        </h5>
                        <h5>
                            <?php echo $added ?>
                        </h5>
                        <h5>
                            <?php echo $alreadyAdded ?>
                        </h5>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- container fluid -->
</div> <!-- Page content Wrapper -->
</div> <!-- content -->
<?php include('../_partials/footer.php') ?>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<?php include('../_partials/jquery.php') ?>
<!-- Required datatable js -->
<?php include('../_partials/datatable.php') ?>
<!-- Datatable init js -->
<?php include('../_partials/datatableInit.php') ?>
<!-- Buttons examples -->
<?php include('../_partials/buttons.php') ?>
<!-- App js -->
<?php include('../_partials/app.php') ?>
<!-- Responsive examples -->
<?php include('../_partials/responsive.php') ?>
<!-- Sweet-Alert  -->
<?php include('../_partials/sweetalert.php') ?>
 <script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.gender').select2({
        placeholder: 'Baby Gender',
        allowClear:true
    });
});
</script>
</body>

</html>
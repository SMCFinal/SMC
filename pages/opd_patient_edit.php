<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    $id = $_GET['id'];

    $getData = mysqli_query($connect, "SELECT * FROM opd_ptcl WHERE o_id = '$id'");
    $fetch_getData = mysqli_fetch_assoc($getData);



    if (isset($_POST['updatePatient'])) {
        $emp_name = $_POST['emp_name'];
        $emp_designation = $_POST['emp_designation'];
        $emp_pat_name = $_POST['emp_pat_name'];
        $emp_relation = $_POST['emp_relation'];
        $emp_diagnosis = $_POST['emp_diagnosis'];
        $emp_operation = $_POST['emp_operation'];
        $emp_date = $_POST['emp_date'];
        $emp_days = $_POST['emp_days'];
        $id = $_POST['id'];
        
        $updQuery = mysqli_query($connect, "UPDATE `opd_ptcl` SET
            `emp_name` = '$emp_name',
            `emp_designation` = '$emp_designation',
            `emp_pat_name` = '$emp_pat_name',
            `emp_relation` = '$emp_relation',
            `emp_diagnosis` = '$emp_diagnosis',
            `emp_operation` = '$emp_operation',
            `emp_date` = '$emp_date',
            `emp_days` = '$emp_days'
            WHERE o_id = '$id'
            ");


        
        if (!$updQuery) {
            $error = '
            <div align="center" class="alert alert-danger" role="alert">
                OPD Patient Not Updated! Try Again!
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
                <h5 class="page-title">Edit OPD Patient</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Employee Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_getData['emp_name'] ?>" placeholder="Employee Name" type="text" id="example-text-input" name="emp_name" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Designation</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo $fetch_getData['emp_designation'] ?>" type="text" placeholder="Designation"  id="example-text-input" name="emp_designation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Patient Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_getData['emp_pat_name'] ?>" placeholder="Patient Name" type="text" id="example-text-input" name="emp_pat_name" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Relationship</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_getData['emp_relation'] ?>" placeholder="Relationship" type="text"  id="example-text-input" name="emp_relation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Diagnosis</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_getData['emp_diagnosis'] ?>" placeholder="Diagnosis" type="text" id="example-text-input" name="emp_diagnosis">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Operation</label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?php echo $fetch_getData['emp_operation'] ?>" placeholder="Operation" type="text"  id="example-text-input" name="emp_operation" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Date of Admission</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_getData['emp_date'] ?>" placeholder="Date of Admission" type="date" id="example-text-input" name="emp_date">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">No. of Days</label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?php echo $fetch_getData['emp_days'] ?>" placeholder="Number of Days" type="number"  id="example-text-input" name="emp_days" required="">
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="updatePatient">Update OPD Patient</button>
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
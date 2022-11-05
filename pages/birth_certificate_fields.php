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

    $dischargePatient = mysqli_query($connect, "SELECT * FROM `discharge_patients` WHERE id = '$id'");
    $fetch_dischargePatient = mysqli_fetch_assoc($dischargePatient);

    if (isset($_POST['addCertificate'])) {
        $certificate_date = $_POST['certificate_date'];
        $baby_gender = $_POST['baby_gender'];
        $baby_weight = $_POST['baby_weight'];
        $baby_father = $_POST['baby_father'];
        $baby_address = $_POST['baby_address'];
        
        $pat_id = $_POST['pat_id'];

        $insertQuery = mysqli_query($connect, "INSERT INTO `birth_certificate`(
            `certificate_date`,
             `baby_gender`,
              `baby_weight`,
               `baby_father`,
                `baby_address`,
                 `pat_id`
            ) VALUES (
            '$certificate_date',
             '$baby_gender',
              '$baby_weight',
               '$baby_father',
                '$baby_address',
                 '$pat_id'
            )");

        $updateDischargeTable = mysqli_query($connect, "UPDATE discharge_patients SET birth_certificate  = '1' WHERE id = '$pat_id'");

        
        if (!$updateDischargeTable) {
            $error = '
            <div align="center" class="alert alert-danger" role="alert">
                Not Added! Try Again!
            </div>';
        }else {
            header("LOCATION: birth_certificate_list.php");
            // $added = '
            // <div align="center" class="alert alert-primary" role="alert">
            //     Certificate Added!
            // </div>';
        }
        
        
            
    }


    include('../_partials/header.php');
?>

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Prepare Birth Certificate</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">BO</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Name" type="text" id="example-text-input" readonly value="<?php echo $fetch_dischargePatient['patient_name'] ?>" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Date of Operation</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Date of Operation"  id="example-text-input" readonly value="<?php echo $fetch_dischargePatient['patient_doop'] ?>" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Admission Charges" type="date" name="certificate_date" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Baby Gender</label>
                                <div class="col-sm-4">
                                    <select class="form-control gender" name="baby_gender" required="" style="width:100%">
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Weight</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Weight in KG" type="text" name="baby_weight" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Father Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Father Name" type="text" name="baby_father" required="">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Address" type="text" value="<?php echo $fetch_dischargePatient['patient_address'] ?>" name="baby_address" required="">
                                </div>
                            </div>

                            <input type="hidden" name="pat_id" value="<?php echo $id ?>">

                            <hr />

                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addCertificate">Prepare Certificate</button>
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
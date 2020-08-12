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
    $selectQuery = mysqli_query($connect, "SELECT * FROM surgeries WHERE id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    if (isset($_POST['updateSurgery'])) {
        $id = $_POST['id'];
        $updateName = $_POST['updateName'];
        $adm_charges = $_POST['adm_charges'];
        $ot_charges = $_POST['ot_charges'];
        $anes_charges = $_POST['anes_charges'];
        $total_charges = $adm_charges + $ot_charges + $anes_charges;

    
        $updateQuery = mysqli_query($connect, "UPDATE surgeries SET surgery_name = '$updateName', admission_charges = '$adm_charges', ot_charges = '$ot_charges', anethesia_charges = '$anes_charges', total_charges = '$total_charges' WHERE id = '$id'");
        if (!$updateQuery) {
                $error = '<div class="alert alert-danger" role="alert">Surgery not updated!</div>';
            }else {
               header("LOCATION:surgeries_list.php");
            }
        }

    include('../_partials/header.php');
?>
<style type="text/css">
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css"rel="stylesheet"type="text/css">
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Surgeries</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Name" type="text" value="<?php echo $fetch_selectQuery['surgery_name'] ?>" id="example-text-input" name="updateName" required="">
                                </div>


                            <label for="example-text-input" class="col-sm-2 col-form-label">Admission Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Admission Charges" value="<?php echo $fetch_selectQuery['admission_charges'] ?>" type="number" id="example-text-input" name="adm_charges" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">OT Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="OT Charges" type="number" id="example-text-input" value="<?php echo $fetch_selectQuery['ot_charges'] ?>" name="ot_charges" required="">
                                </div>

                                <label for="example-text-input" class="col-sm-2 col-form-label">Anethesia Charges</label>
                                <div class="col-sm-4">
                                    <input class="form-control" placeholder="Anethesia Charges" type="number" id="example-text-input" value="<?php echo $fetch_selectQuery['anethesia_charges'] ?>" name="anes_charges" required="">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="updateSurgery">Update Surgery</button>
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
    $('.specialist').select2({
        placeholder: 'Specilist Name',
  allowClear:true
    });
});
</script>
</body>

</html>
<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    $med_id = $_GET['id'];
    $surg_id = $_GET['surg_id'];

    $queryMeds = mysqli_query($connect, "SELECT surgery_medicines.*, add_medicines.medicine_name FROM surgery_medicines 
    INNER JOIN add_medicines ON add_medicines.id = surgery_medicines.med_id
    WHERE surg_med_id = '$med_id'");


    $fetch_queryMeds = mysqli_fetch_assoc($queryMeds);

    if (isset($_POST['addMedicines'])) {
        $surgery_id = $_POST['surg_id'];
        // $med_id = $_POST['med_id'];
        $med_qty = $_POST['med_qty'];

        $updateQuery = mysqli_query($connect, "UPDATE surgery_medicines SET med_qty = '$med_qty' WHERE surg_med_id = '$med_id' AND surgery_id = '$surgery_id'");

        if ($updateQuery) {
            header("LOCATION: view_medicines.php?id=".$surgery_id."");
        }

        
    }


    include('../_partials/header.php');
?>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Edit Surgery Medicines Quantity</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="med_id" value="<?php echo $med_id ?>">
                            <input type="hidden" name="surg_id" value="<?php echo $surg_id ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Medicine Name</label>
                                <div class="col-md-4">
                                    <input type="text" readonly class="form-control" value="<?php echo $fetch_queryMeds['medicine_name'] ?>" placeholder="Medicine Quantity">
                                </div>

                                <label class="col-sm-2 col-form-label">Medicine Quantity</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="med_qty" value="<?php echo $fetch_queryMeds['med_qty'] ?>" placeholder="Medicine Quantity">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addMedicines">Update Medicines</button>
                                </div>
                            </div>
                            
                        </form>
                        <h5><?php echo $error ?></h5>
                        <h5><?php echo $added ?></h5>
                        <h5><?php echo $alreadyAdded ?></h5>
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


</body>

</html>
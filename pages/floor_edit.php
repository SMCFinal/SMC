<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    $notUpdated = '';
    $alreadyAdded = '';

    $selectQuery = mysqli_query($connect, "SELECT * FROM floors WHERE id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    if (isset($_POST['updateFloor'])) {
        $floorName = $_POST['floorName'];

        $countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedFloors FROM floors WHERE floor_name = '$floorName'");
        $fetch_countQuery = mysqli_fetch_assoc($countQuery);

        if ($fetch_countQuery['countedFloors'] == 0) {
            $updateFloor = mysqli_query($connect, "UPDATE floors SET floor_name = '$floorName'");

            if (!$updateFloor) {
                $notUpdated = 'Not Updated!';
            }else {
                header("LOCATION:floors_list.php");
            }
        }else {
            $alreadyAdded = 'Already Added';
        }
    }

    include('../_partials/header.php') 
?>
<style type="text/css">
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css"rel="stylesheet"type="text/css">
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Floors</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Floor No.</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="text" value="<?php echo $fetch_selectQuery['floor_name'] ?>" name="floorName" id="example-text-input">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" name="updateFloor" class="btn btn-primary waves-effect waves-light">Update Floor</button>
                                </div>
                            </div>
                        </form>
                        <h5><?php echo $alreadyAdded ?></h5>
                        <h5><?php echo $notUpdated ?></h5>
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
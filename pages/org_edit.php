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

    $selectQuery = mysqli_query($connect, "SELECT * FROM select_organization WHERE org_id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    if (isset($_POST['addOrganization'])) {
        $org_name = $_POST['org_name'];
        $id = $_POST['id'];

        $updateQuery = mysqli_query($connect, "UPDATE select_organization SET org_name = '$org_name' WHERE org_id = '$id'");
        
        if (!$updateQuery) {
            $error = 'Not Updated! Try again!';
        }else {
            header("LOCATION: select_organization.php");
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
                <h5 class="page-title">Organizations Edit</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">Organization Name</label>
                                <div class="col-sm-8">
                                    <input type="hidden" name="id" value="<?php echo $fetch_selectQuery['org_id'] ?>">
                                    <input class="form-control" placeholder="PTCL, General etc" type="text" id="example-text-input" name="org_name" required="" value="<?php echo $fetch_selectQuery['org_name']; ?>">
                                </div>
                            </div><hr>
                            <div class="form-group row">
                                <!-- <label for="example-password-input" class="col-sm-2 col-form-label"></label> -->
                                <div class="col-sm-12" align="right">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addOrganization">Edit Organization</button>
                                </div>
                            </div>
                        </form>
                        <h5 align="center"><?php echo $error ?></h5>
                        <h5 align="center"><?php echo $added ?></h5>
                        <h5 align="center"><?php echo $alreadyAdded ?></h5>
                    </div>
                </div>
            </div>
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
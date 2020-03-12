<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $alreadyAdded = '';
    $added = '';
    $error= '';

    if (isset($_POST['addFloor'])) {
        $floorName = $_POST['floorName'];

        $countQuery = mysqli_query($connect, "SELECT COUNT(*)AS countedFloors FROM floors WHERE floor_name = '$floorName'");
        $fetch_countQuery = mysqli_fetch_assoc($countQuery);


        if ($fetch_countQuery['countedFloors'] == 0) {
            $insertQuery = mysqli_query($connect, "INSERT INTO floors(floor_name)VALUES('$floorName')");
            if (!$insertQuery) {
                $error = 'Not Added! Try agian!';
            }else {
                $added = 'Floor Added!';
            }
        }else {
            $alreadyAdded = 'Floor Already Added!';
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
                                    <input class="form-control" placeholder="Floor No." type="text" value="" id="example-text-input" name="floorName" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-password-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <?php include('../_partials/cancel.php') ?>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="addFloor">Add Floor</button>
                                </div>
                            </div>
                        </form>
                        <h5><?php echo $error ?></h5>
                        <h5><?php echo $added ?></h5>
                        <h5><?php echo $alreadyAdded ?></h5>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Floor Details</h4>
                        <a href="floor_new.php" type="button" class="btn btn-primary waves-effect waves-light text-white ml-auto" style="float: right;">Add New Floor</a>
                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Floor No.</th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $retrieve_data = mysqli_query($connect, "SELECT * FROM floors");
                                $iteration = 1;

                                while ($rowFloors = mysqli_fetch_assoc($retrieve_data)) {
                                    echo '
                                    <tr>
                                        <td>'.$iteration++.'</td>
                                        <td>'.$rowFloors['floor_name'].'</td>
                                        <td class="text-center"><a href="floor_edit.php?id='.$rowFloors['id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                        
                                        <td class="text-center"><a type="button" id="sa-warning" class="btn text-white btn-danger waves-effect waves-light">Delete</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                                
                            </tbody>
                        </table>
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
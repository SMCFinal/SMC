<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['ref'];

    $selectQuery = mysqli_query($connect, "SELECT lab_order.id AS labId, lab_order.*, patient_registration.patient_name, patient_registration.attendent_name, patient_registration.patient_address, rooms.room_number, lab_test_category.* FROM `lab_order` 
                                                        INNER JOIN patient_registration ON patient_registration.id = lab_order.pat_id
                                                        INNER JOIN lab_test_category ON lab_test_category.id = lab_order.lab_test_id
                                                        INNER JOIN rooms ON rooms.id = patient_registration.room_id
                                                        WHERE lab_order.reference_no = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    include('../_partials/header.php'); 
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                </div>
                <h5 class="page-title">Patient Test Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                            <a href="lab_test_pending.php" class="btn btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i></a>
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectQuery['patient_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Attendent Name</th>
                                        <td><?php echo $fetch_selectQuery['attendent_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Room Number</th>
                                        <td><?php echo $fetch_selectQuery['room_number'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Test Name</th>
                                        <th>Test Price</th>
                                        <th>Test Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query = mysqli_query($connect, "SELECT lab_order.*, lab_test_category.* FROM `lab_order`
                                    INNER JOIN lab_test_category ON lab_test_category.id = lab_order.lab_test_id
                                    WHERE lab_order.reference_no = '$id'");

                                    $itr = 1;

                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo '
                                            <tr>
                                                <td>'.$itr++.'</td>
                                                <td>'.$row['test_name'].'</td>
                                                <td>'.$row['test_price'].'</td>
                                                <td><b><i>Pending Result</i></b></td>
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

<!-- Buttons examples -->
        <?php include('../_partials/buttons.php') ?>

<!-- Responsive examples -->
        <?php include('../_partials/responsive.php') ?>

<!-- Datatable init js -->
        <?php include('../_partials/datatableInit.php') ?>

<!-- Sweet-Alert  -->
        <?php include('../_partials/sweetalert.php') ?>

<!-- App js -->
        <?php include('../_partials/app.php') ?>

</body>

</html>
<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    $selectQuery = mysqli_query($connect, "SELECT * FROM patient_registration WHERE id = '$id'");
    $fetch_selectQuery = mysqli_fetch_assoc($selectQuery);

    include('../_partials/header.php'); 
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
                        <li class="breadcrumb-item"><a href="#">Tables</a></li>
                        <li class="breadcrumb-item active">Datatable</li>
                    </ol>
                </div>
                <h5 class="page-title">Patient Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title "><?php echo $fetch_selectQuery['patient_name'] ?></h4>
                        
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Registration Number</th>
                                        <td><?php echo $fetch_selectQuery['reg_no'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectQuery['patient_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Age</th>
                                        <td><?php echo $fetch_selectQuery['patient_age'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Gender</th>
                                        <td><?php 
                                        if ($fetch_selectQuery['patient_gender'] == 1) {
                                            echo "Male";
                                        }elseif ($fetch_selectQuery['patient_gender'] == 2) {
                                            echo "Female";
                                        }elseif ($fetch_selectQuery['patient_gender'] == 3) {
                                            echo "Other";
                                        }
                                       ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Address</th>
                                        <td><?php echo $fetch_selectQuery['patient_address'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Date of Admission</th>
                                        <td><?php echo $fetch_selectQuery['patient_doa'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Date of Operation</th>
                                        <td><?php echo $fetch_selectQuery['patient_doop'] ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Disease</th>
                                        <td><?php echo $fetch_selectQuery['patient_disease'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Operation</th>
                                        <td><?php echo $fetch_selectQuery['patient_operation'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Consultant</th>
                                        <td><?php echo $fetch_selectQuery['patient_consultant'] ?></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Yearly No</th>
                                        <td><?php echo $fetch_selectQuery['patient_yearly_no'] ?></td>
                                    </tr>

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
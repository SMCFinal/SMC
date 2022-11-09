<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
    header("LOCATION:../index.php");
}
include '../_partials/header.php';
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">OPD Patients</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"> OPD Patients List </h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emp Name</th>
                                    <th>Designation</th>
                                    <th>Patient Name</th>
                                    <th>DOA</th>
                                    <th class="text-center"><i class="fa fa-edit"></i></th>
                                    <th class="text-center"> <i class="fa fa-money"></i></th>
                                    <th class="text-center"><i class="fa fa-print"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retOPDPatients = mysqli_query($connect, "SELECT * FROM opd_ptcl");
                                    $iteration = 1;

                                    while ($rowretOPDPatients = mysqli_fetch_assoc($retOPDPatients)) {
                                        echo '
                                        <tr>
                                            <td>' . $iteration++ . '</td>
                                            <td>' . $rowretOPDPatients['emp_name'] . '</td>
                                            <td>' . $rowretOPDPatients['emp_designation'] . '</td>
                                            <td>' . $rowretOPDPatients['emp_pat_name'] . '</td>
                                            <td>' . $rowretOPDPatients['emp_date'] . '</td>

                                            <td class="text-center"><a href="opd_patient_edit.php?id=' . $rowretOPDPatients['o_id'] . '" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm"><i class="fa fa-edit"></i> Patient</a></td>';
                                            
                                            if ($rowretOPDPatients['payment_status'] === '0') {
                                                echo '
                                                    <td class="text-center"><a href="opd_patient_charges.php?id=' . $rowretOPDPatients['o_id'] . '" type="button" class="btn text-white btn-success waves-effect waves-light btn-sm"><i class="fa fa-plus"></i> Charges</a></td>
                                                ';
                                            }elseif ($rowretOPDPatients['payment_status'] === '1') {
                                                echo '
                                                    <td class="text-center"><a href="opd_patient_charges_edit.php?id=' . $rowretOPDPatients['o_id'] . '" type="button" class="btn text-white btn-info waves-effect waves-light btn-sm"><i class="fa fa-edit"></i> Charges</a></td>
                                                ';
                                            }
                                            
                                            echo '
                                            <td class="text-center"><a href="opd_patient_print.php?id=' . $rowretOPDPatients['o_id'] . '" type="button" class="btn text-white btn-secondary waves-effect waves-light btn-sm"><i class="fa fa-print"></i> Print</a></td>
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
<?php include '../_partials/footer.php'?>
</div>
<!-- End Right content here -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<!-- jQuery  -->
<?php include '../_partials/jquery.php'?>
<!-- Required datatable js -->
<?php include '../_partials/datatable.php'?>
<!-- Buttons examples -->
<?php include '../_partials/buttons.php'?>
<!-- Responsive examples -->
<?php include '../_partials/responsive.php'?>
<!-- Datatable init js -->
<?php include '../_partials/datatableInit.php'?>
<!-- Sweet-Alert  -->
<?php include '../_partials/sweetalert.php'?>
<!-- App js -->
<?php include '../_partials/app.php'?>
</body>

</html>
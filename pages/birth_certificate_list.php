<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    include('../_partials/header.php');
?>

<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Birth Certificate</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Certificate Details</h4>
                       
                        <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>BO</th>
                                    <th>DOP</th>
                                    <th>Baby Gender</th>
                                    <th>Baby Weight</th>
                                    <th>Father</th>
                                    <th>Address</th>
                                    <th>Certificate Date</th>
                                    <th class="text-center">
                                        <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center">
                                        <i class="fa fa-print"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $retCertificates = mysqli_query($connect, "SELECT birth_certificate.*, discharge_patients.patient_name, discharge_patients.patient_doop FROM `birth_certificate`
                                INNER JOIN discharge_patients ON discharge_patients.id = birth_certificate.pat_id
                                ORDER BY birth_certificate.certificate_date DESC");
                                $iteration = 1;

                                while ($rowCertificates = mysqli_fetch_assoc($retCertificates)) {
                                    echo '
                                    <tr>
                                        <td>'.$iteration++.'</td>
                                        <td>'.$rowCertificates['patient_name'].'</td>
                                        <td>'.substr($rowCertificates['patient_doop'], 0, 10).'</td>';
                                        if ($rowCertificates['baby_gender'] === '1') {
                                            echo '<td>Male</td>';
                                        }else {
                                            echo '<td>Female</td>';
                                        }
                                        echo '
                                        <td>'.$rowCertificates['baby_weight'].' KG</td>
                                        <td>'.$rowCertificates['baby_father'].'</td>
                                        <td>'.$rowCertificates['baby_address'].'</td>
                                        <td>'.$rowCertificates['certificate_date'].'</td>
                                        <td class="text-center"><a href="birth_certificate_edit.php?cert_id='.$rowCertificates['certificate_id'].'&pat_id='.$rowCertificates['pat_id'].'" type="button" class="btn text-white btn-warning waves-effect waves-light">Edit</a></td>
                                        <td class="text-center"><a href="birth_certificate_print.php?cert_id='.$rowCertificates['certificate_id'].'&pat_id='.$rowCertificates['pat_id'].'" type="button" class="btn text-white btn-success waves-effect waves-light">Print</a></td>
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
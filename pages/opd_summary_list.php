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
                <h5 class="page-title">OPD Summary</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"> OPD Summary List </h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="font-family: Georgia !important" >#</th>
                                    <th style="font-family: Georgia !important" >OPD Summary</th>
                                    <th style="font-family: Georgia !important"  class="text-center"><i class="fa fa-eye"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retOPDSummary = mysqli_query($connect, "SELECT ref_no FROM `opd_charges` WHERE ref_no > 0 GROUP BY ref_no ORDER BY ref_no DESC");
                                    $iteration = 1;

                                    while ($rowretOPDSummary = mysqli_fetch_assoc($retOPDSummary)) {
                                        echo '
                                        <tr>
                                            <td style="font-family: Georgia !important" >' . $iteration++ . '</td>
                                            <td style="font-family: Georgia !important" > OPD Summary - ' . $rowretOPDSummary['ref_no'] . '</td>
                                            <td style="font-family: Georgia !important"  class="text-center"><a href="opd_summary_print.php?ref=' . $rowretOPDSummary['ref_no'] . '" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a></td>
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
<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }
    include('../_partials/header.php');
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Patients Observation</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title text-center">Patients List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>M.R No.</th>
                                    <th>Name</th>
                                    <th>Room No.</th>
                                    <th>Address</th>
                                    <th>Case</th>
                                    <th class="text-center"><i class="fa fa-medkit" aria-hidden="true"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Asif</td>
                                    <td>400</td>
                                    <td>Saidu</td>
                                    <td>Aids</td>
                                    <td class="text-center"><a href="#" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">Add Surgery</a></td>
                                </tr>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                        function deleteme(delid) {
                            if (confirm("Do you want to discharge patient?")) {
                                window.location.href = 'temporary_disable.php?del_id=' + delid + '';
                                return true;
                            }
                        }
                        </script>
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
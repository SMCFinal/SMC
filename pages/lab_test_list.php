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

                <h5 class="page-title">Medicines</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <!-- <h4 class="mt-0 header-title text-center">HR Staff List</h4> -->
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Test Name</th>

                                    <th>Price</th>

                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                         <th  class="text-center"><i class="fa fa-trash"></i></th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                            <td>1</td>
                                            <td>abc</td>

                                            <td>abc</td>

                                            <td class="text-center"><a href="./lab_test_view.php" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a></td>
                                             <td class="text-center"><a href="./lab_test_edit.php" class="btn btn-warning"  name="Deleteme" data-original-title="Deactivate User Access">Edit</a></td>
	 <td class="text-center"><button class="btn btn-danger"  name="Deleteme" data-original-title="Deactivate User Access">Delete</button></td>





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
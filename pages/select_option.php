<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    $patCustomId = $_GET['pat_id'];

    include('../_partials/header.php');
?>
<style type="text/css">
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css"rel="stylesheet"type="text/css">
</style>
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Options</h5>
            </div>
        </div>
        <!-- end row --><br><br><br><br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-6">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title" align="center">Please select from below</h4><hr>
                        <?php
	                        echo '
		                        <div align="center">
		                        	<a href="discharge_patient_invoice.php?id='.$id.'&pat_id='.$patCustomId.'" class="btn btn-info btn-lg">Discharge Slip</a>
		                        	<a href="charges_slip.php?id='.$id.'&pat_id='.$patCustomId.'" class="btn btn-success btn-lg">View Fee Slip</a>
		                        	<a href="edit_fees.php?id='.$id.'&pat_id='.$patCustomId.'" class="btn btn-secondary btn-lg">Edit Fee Slip</a>
		                        </div>
	                        ';
                        ?>

                        <a href="">
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-md-3"></div>
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
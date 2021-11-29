<?php
    include('../_stream/config.php');
    session_start();
        if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
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
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <hr>

        <h3 style="font-family: Times;" align="center">Pages Quick Access</h3><hr><br><br><br>
        
        <div class="row" align="center">
            <div class="col-md-3"></div>

            <div class="col-md-2" style="border-right: 1px solid black;">
                <a href="ground_floor_new_patient.php"  style="box-shadow: 5px 5px 5px 3px #ccc" class="btn btn-success btn-lg"><i class="fa fa-id-card"></i><hr><p style="font-size: 16px; width:6.5em;" id="homeText7"> Add Patient</p></a>
            </div>

            <div class="col-md-2"  style="border-right: 1px solid black;">
                <a href="patients_today_list_ground.php"  style="box-shadow: 5px 5px 5px 3px #ccc" class="btn btn-info btn-lg"><i class="fa fa-times"></i><hr><p style="font-size: 16px; width:6.5em;" id="homeText7"> Today's Patient</p></a>
            </div>

            <div class="col-md-2" >
                <a href="patients_list_ground.php"  style="box-shadow: 5px 5px 5px 3px #ccc" class="btn btn-warning btn-lg"><i class="fa fa-phone"></i><hr><p style="font-size: 16px; width:6.5em;" id="homeText7"> All Patients List</p></a>
            </div>

            <div class="col-md-3"></div>
        </div>
        
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
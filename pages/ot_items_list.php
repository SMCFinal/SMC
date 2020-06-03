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

                <h5 class="page-title">Operation Theater</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title"> Items List</h4>
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date of Purchase</th>
                                    <!-- <th>Floor No</th> -->
                                    <!-- <th>Room No</th> -->





                                    <th class="text-center"><i class="mdi mdi-eye"></i></th>
                                    <th class="text-center"> <i class="fa fa-edit"></i>
                                    </th>
                                    <th class="text-center"><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
$selectQueryPatients = mysqli_query($connect, "SELECT * FROM patient_registration WHERE category = 'currentPatient' ORDER BY id ASC");
$iteration = 1;

while ($rowPatients = mysqli_fetch_assoc($selectQueryPatients)) {
	echo '
                                        <tr>
                                            <td>' . $iteration++ . '</td>
                                            <td>' . $rowPatients['patient_yearly_no'] . '</td>
                                            <td>' . $rowPatients['patient_name'] . '</td>
                                            <td>' . $rowPatients['patient_doop'] . '</td>
                                            <td>' . $rowPatients['patient_doa'] . '</td>

                                            <td class="text-center"><a href="ot_items_view.php?id=' . $rowPatients['id'] . '" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a></td>
                                            <td class="text-center"><a href="ot_items_edit.php" type="button" class="btn text-white btn-warning waves-effect waves-light btn-sm">Edit</a></td>



                                            <td class="text-center"><button class="btn btn-danger" onClick="deleteme(' . $rowPatients['id'] . ')" name="Deleteme" data-original-title="Deactivate User Access">Delete</button></td>


                                        </tr>
                                    ';
}
// <td class="text-center"><a href="./user_edit.php" type="button" class="btn text-white btn-warning waves-effect
//waves-light">Edit</a></td>
?>


                            </tbody>
                        </table>
                        <script type="text/javascript">
        function deleteme(delid){
          if (confirm("Do you want to discharge patient?")) {
            window.location.href = 'temporary_disable.php?del_id=' + delid +'';
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
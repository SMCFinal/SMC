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

                <h5 class="page-title">Doctor Visit</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-3">
                    <div class="card-body">
                        
                        <table id="datatable" class="table  dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Anesthetic Name</th>
                                    <th>Charges</th>
                                    <th>Consultant</th>
                                   
                                    <th>Date</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retInventoryItems = mysqli_query($connect, "SELECT doctor_visit_charges.*, patient_registration.patient_name, patient_registration.room_id, patient_registration.patient_consultant, patient_registration.patient_disease, rooms.room_number, staff_members.name FROM `doctor_visit_charges` 
                                        INNER JOIN patient_registration ON patient_registration.id = doctor_visit_charges.pat_id
                                        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                                        INNER JOIN rooms ON rooms.id = patient_registration.room_id GROUP BY patient_registration.id");
                                    $iteration = 1;

                                    while ($rowInventory = mysqli_fetch_assoc($retInventoryItems)) {
                                    	echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowInventory['patient_name'].'</td>
                                            <td>'.$rowInventory['name'].'</td>
                                            <td>'.$rowInventory['patient_disease'].'</td>
                                            <td>'.$rowInventory['visit_charges'].'</td>
                                            <td>'.$rowInventory['room_number'].'</td>
                                            <td class="text-center">
                                                <a href="doctor_visit_charges_list.php?id='.$rowInventory['pat_id'].'" type="button" class="btn text-white btn-primary waves-effect waves-light btn-sm">View</a>
                                            </td>
                                        </tr>
                                    ';
                                    }
                                    ?>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            function deleteme(delid){
                              if (confirm("Do you want delete an item from inventory?")) {
                                window.location.href = 'delete_inventory.php?del_id=' + delid +'';
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
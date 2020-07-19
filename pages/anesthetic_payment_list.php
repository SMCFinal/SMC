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

                <h5 class="page-title">Anesthetic Payment List</h5>
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
                                    <th>Surgery</th>
                                   
                                    <th>Date</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retInventoryItems = mysqli_query($connect, "SELECT anethetic_paid_amount.*, staff_members.*, discharge_patients.patient_operation, surgeries.surgery_name FROM `anethetic_paid_amount`
                                        INNER JOIN staff_members ON staff_members.id = anethetic_paid_amount.aneshthetic_id
                                        INNER JOIN discharge_patients ON discharge_patients.anasthetic_name = anethetic_paid_amount.aneshthetic_id
                                        INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation");
                                    $iteration = 1;

                                    while ($rowInventory = mysqli_fetch_assoc($retInventoryItems)) {
                                    	echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowInventory['name'].'</td>
                                            <td>'.$rowInventory['paid_amount'].'</td>
                                            <td>'.$rowInventory['surgery_name'].'</td>';
                                            
                                            $Date_format = $rowInventory['auto_date']; 
                                            $Date = date('d/M h:i:s A', strtotime($Date_format));
                                            echo '
                                            <td>'.$Date.'</td>
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
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
                                    <th>Dr. Name</th>
                                    <th>Surgery Charges</th>
                                    <th>Visit Charges</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retDoctorData = mysqli_query($connect, "SELECT doctor_paid_amount.*, staff_members.*, discharge_patients.patient_operation, surgeries.surgery_name FROM `doctor_paid_amount`
                                        INNER JOIN staff_members ON staff_members.id = doctor_paid_amount.d_id
                                        INNER JOIN discharge_patients ON discharge_patients.patient_consultant = doctor_paid_amount.d_id
                                        INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation");
                                    $iteration = 1;

                                    while ($rowDoctorData = mysqli_fetch_assoc($retDoctorData)) {
                                    	echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>Dr. '.$rowDoctorData['name'].'</td>
                                            <td>'.$rowDoctorData['total_surgery'].'</td>
                                            <td>'.$rowDoctorData['total_visit'].'</td>
                                            <td>'.$rowDoctorData['total_paid'].'</td>';
                                            
                                            $Date_format = $rowDoctorData['auto_date']; 
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
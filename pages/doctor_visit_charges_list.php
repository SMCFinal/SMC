<?php
include '../_stream/config.php';
session_start();
if (empty($_SESSION["user"])) {
	header("LOCATION:../index.php");
}

$id = $_GET['id'];



// $fetch_queryData = mysqli_fetch_assoc($queryData);


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
                                    <th>Room No</th>
                                    <th>Date &amp; Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $queryData = mysqli_query($connect, "SELECT doctor_visit_charges.*, patient_registration.patient_name, patient_registration.room_id, patient_registration.patient_consultant, patient_registration.patient_disease, rooms.room_number, staff_members.name FROM `doctor_visit_charges` 
                                        INNER JOIN patient_registration ON patient_registration.id = doctor_visit_charges.pat_id
                                        INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                                        INNER JOIN rooms ON rooms.id = patient_registration.room_id
                                        WHERE doctor_visit_charges.pat_id = '$id'");
                                    $iteration = 1;

                                    while ($rowQuery = mysqli_fetch_assoc($queryData)) {
                                    	echo '
                                        <tr>
                                            <td>'.$iteration++.'</td>
                                            <td>'.$rowQuery['name'].'</td>
                                            <td>'.$rowQuery['room_number'].'</td>';

                                            $timezone = date_default_timezone_set('Asia/Karachi');
                                            $date = date('m/d/Y h:i:s a', time());

                                            $Date_format = $rowQuery['visit_date']; 
                                            $Date = date('d/M h:i:s A', strtotime($Date_format));
                                            echo '
                                            <td>'.$Date.'</td>
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
<?php
    include('../_stream/config.php');


    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }



    $roomId = $_GET['room_id'];

    $selectpatientData = mysqli_query($connect, "SELECT patient_registration.*, staff_members.name FROM `patient_registration`
                                INNER JOIN staff_members ON staff_members.id = patient_registration.patient_consultant
                                WHERE patient_registration.room_id = '$roomId'");

    $fetch_selectpatientData = mysqli_fetch_assoc($selectpatientData);

    include('../_partials/header.php'); 
?>
<link href="../assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                
                <h5 class="page-title">Room Details</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">
                        <h4 class="mt-0 header-title "></h4>
                        
                        <div class="table-responsive mt-5">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">M.R. No</th>
                                        <td><?php echo $fetch_selectpatientData['patient_yearly_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td><?php echo $fetch_selectpatientData['patient_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Age</th>
                                        <td><?php echo $fetch_selectpatientData['patient_age']; ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Gender</th>
                                        <td><?php  if ($fetch_selectpatientData['patient_gender'] == 1) {
                                            echo "Male";
                                        }elseif ($fetch_selectpatientData['patient_gender'] == 2) {
                                            echo "Female";
                                        }else {
                                            echo "Other";
                                        }
                                        ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Address</th>
                                        <td><?php echo $fetch_selectpatientData['patient_address']; ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Date of Admission</th>
                                        <td><?php echo $fetch_selectpatientData['patient_doa']; ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Date of Operation</th>

                                        <td><?php if ($fetch_selectpatientData['patient_doop'] == '0000-00-00 00:00:00') {
                                            echo "<span style='color:red'><b>No Date Assigned</b></span>";
                                        }else {
                                            echo $fetch_selectpatientData['patient_doop'];
                                        } ?></td>
                                    </tr>
                                     <tr>
                                        <th scope="row">Disease</th>
                                        <td><?php echo $fetch_selectpatientData['patient_disease']; ?></td>
                                    </tr>

                                    <!-- <tr>
                                        <th scope="row">Operation</th>
                                        <td><?php  $fetch_selectpatientData['patient_']; ?></td>
                                    </tr> -->

                                    <tr>
                                        <th scope="row">Consultant</th>
                                        <td><?php echo $fetch_selectpatientData['name']; ?></td>
                                    </tr>

                                    <!-- <tr>
                                        <th scope="row">Yearly No</th>
                                        <td></td>
                                    </tr> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
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
        <?php include('../_partials/jquery.php') ?>

<!-- Required datatable js -->
        <?php include('../_partials/datatable.php') ?>
>

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
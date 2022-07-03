<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $user = $_SESSION["user"];
    $loginUser = mysqli_query($connect, "SELECT * FROM `login_user` WHERE email = '$user'");
    $fetch_loginUser = mysqli_fetch_assoc($loginUser);

    $userName = $fetch_loginUser['name'];

    $staffMembers = mysqli_query($connect, "SELECT * FROM staff_members WHERE name = '$userName'");
    $fetch_staffMembers = mysqli_fetch_assoc($staffMembers);

    $id = $fetch_staffMembers['id'];


    $queryAnestheticCharges = mysqli_query($connect, "SELECT anesthetic_surgery_charges.*, discharge_patients.patient_doa, rooms.room_number,  discharge_patients.patient_operation, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name,  discharge_patients.organization FROM `anesthetic_surgery_charges` 
        INNER JOIN rooms ON rooms.id = anesthetic_surgery_charges.room_id
        INNER JOIN discharge_patients ON discharge_patients.pat_id = anesthetic_surgery_charges.pat_id
        INNER JOIN surgeries ON surgeries.id = anesthetic_surgery_charges.pat_operation
        INNER JOIN staff_members ON staff_members.id = anesthetic_surgery_charges.pat_consultant
        WHERE anesthetic_surgery_charges.payment_status = '1' AND discharge_patients.organization LIKE '%Sehat%' AND anesthetic_surgery_charges.anesthetic_id = '$id' ORDER BY discharge_patients.patient_doa DESC");

    $queryAnestheticName = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '$id'");
    $fetch_queryAnestheticName = mysqli_fetch_assoc($queryAnestheticName);

    include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Sehat Card Patients Charges</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <form method="POST">
                    <div class="card-body">
                        <input type="hidden" name="d_id" value="<?php echo $id ?>">
                        <h4>Anesthesia Charges <i>Anesthetic. <?php echo $fetch_queryAnestheticName['name'] ?></i></h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Organization</th>
                                        <th>Surgery</th>
                                        <th>Room No</th>
                                        <th>Date & Time</th>
                                        <th>Anesthetic Charges</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $itr = 1;

                                    $totalSum = 0;

                                    while ($rowSurgery = mysqli_fetch_assoc($queryAnestheticCharges)) {
                                        echo '
                                        <tr>
                                            <td>'.$itr++.'</td>
                                            <td>'.$rowSurgery['patient_name'].'</td>
                                            <td>'.$rowSurgery['organization'].'</td>
                                            <td>'.$rowSurgery['surgery_name'].'</td>
                                            <td>'.$rowSurgery['room_number'].'</td>';
                                            
                                            $Date_format = $rowSurgery['patient_doop']; 
                                            $Date = date('d/M h:i:s A', strtotime($Date_format));
                                            echo '
                                            <td>'.$Date.'</td>
                                            <td>'.$rowSurgery['surgery_anes_charges'].'</td>';
                                            $totalSum = $totalSum + $rowSurgery['surgery_anes_charges'];
                                        echo '
                                        </tr>
                                        ';
                                    }
                    
                                        echo '
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td align="right"><strong>Total: </strong></td>
                                                <td><strong>'.$totalSum.'</strong></td>
                                            </tr>
                                        ';
                                        


                                        echo '
                                            <tr>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none" align="right"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                            </tr>
                                        ';
                                    ?>

                            </tbody>
                        </table><br>
                        <div align="center">
                            <?php include '../_partials/cancel.php'; ?>
                        </div>
                        </div>                            
                    </div>
                </form>
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
<?php include '../_partials/jquery.php'?>
<!-- App js -->
<?php include '../_partials/app.php'?>
<?php include '../_partials/datetimepicker.php'?>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.designation').select2({
    placeholder: 'Select an option',
    allowClear: true

});

$('.attendant').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>
<script type="text/javascript" src="../assets/js/select2.min.js"></script>
<script type="text/javascript">
$('.select2').select2({
    placeholder: 'Select an option',
    allowClear: true

});
</script>
</body>

</html>
<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    $queryAnestheticCharges = mysqli_query($connect, "SELECT anesthetic_surgery_charges.*, rooms.room_number,  discharge_patients.patient_operation, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name FROM `anesthetic_surgery_charges` 
INNER JOIN rooms ON rooms.id = anesthetic_surgery_charges.room_id
INNER JOIN discharge_patients ON discharge_patients.pat_id = anesthetic_surgery_charges.pat_id
INNER JOIN surgeries ON surgeries.id = anesthetic_surgery_charges.pat_operation
INNER JOIN staff_members ON staff_members.id = anesthetic_surgery_charges.pat_consultant
WHERE anesthetic_surgery_charges.payment_status = '1' AND anesthetic_surgery_charges.anesthetic_id = '$id'");


    $queryAnestheticName = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '$id'");
    $fetch_queryAnestheticName = mysqli_fetch_assoc($queryAnestheticName);

    if (isset($_POST['payAnestheticCharges'])) {
        $id = $_POST['d_id'];
        $surgery = $_POST['total_surgery'];

        if (empty($surgery)) {
            $surgery = 0;
        }

        $date = date_default_timezone_set('Asia/Karachi');
        $currentDate = date('Y-m-d h:i:s');

        $insertQuery = mysqli_query($connect, "INSERT INTO `anethetic_paid_amount`(`aneshthetic_id`, `paid_amount`)VALUES('$id', '$surgery')");

        $updatePaymentAnes = mysqli_query($connect, "UPDATE anesthetic_surgery_charges SET payment_status = '0', date_of_payment = '$currentDate' WHERE anesthetic_id = '$id'");

    }
include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Anesthetic Charges</h5>
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
                                        <th>Surgery</th>
                                        <th>Room No</th>
                                        <th>Date & Time</th>
                                        <th>Anesthetic Charges</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itr = 1;
                                    while ($rowSurgery = mysqli_fetch_assoc($queryAnestheticCharges)) {
                                        echo '
                                        <tr>
                                            <td>'.$itr++.'</td>
                                            <td>'.$rowSurgery['patient_name'].'</td>
                                            <td>'.$rowSurgery['surgery_name'].'</td>
                                            <td>'.$rowSurgery['room_number'].'</td>';
                                            
                                            $Date_format = $rowSurgery['patient_doop']; 
                                            $Date = date('d/M h:i:s A', strtotime($Date_format));
                                            echo '
                                            <td>'.$Date.'</td>
                                            <td>'.$rowSurgery['surgery_anes_charges'].'</td>
                                        </tr>
                                        ';
                                    }
                                    

                                        $totalSurgeryAmount = mysqli_query($connect, "SELECT SUM(surgery_anes_charges)AS surgerySum FROM `anesthetic_surgery_charges` WHERE anesthetic_id = '$id' AND payment_status = '1'");
                                        $fetch_totalSurgeryAmount = mysqli_fetch_assoc($totalSurgeryAmount);

                    
                                        echo '
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td align="right"><strong>Total: </strong></td>
                                                <td><strong>'.$fetch_totalSurgeryAmount['surgerySum'].'</strong></td>
                                            </tr>
                                        ';
                                        $total = $fetch_totalSurgeryAmount['surgerySum'];
                                        echo '
                                        <input type="hidden" name="total_surgery" value='.$total.'>
                                        ';


                                        echo '
                                            <tr>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none" align="right"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                            </tr>
                                        ';

                                        echo '
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong></strong></td>
                                                <td align="right"><strong>Pay Total: </strong></td>
                                                <td><strong>'.$total.'</strong></td>
                                            </tr>
                                        ';
                                    ?>

                            </tbody>
                        </table><br>
                        <div align="center">
                            <?php include '../_partials/cancel.php'; ?>
                            <button type="submit" name="payAnestheticCharges" class="btn btn-primary waves-effect waves-light">Pay Anesthetic</button>
                             <!-- <a href="" ></a> -->
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
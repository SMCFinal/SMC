<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    $queryDoctorCharges = mysqli_query($connect, "SELECT doctor_surgery_charges.*, rooms.room_number, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name FROM `doctor_surgery_charges` 
        INNER JOIN rooms ON rooms.id = doctor_surgery_charges.room_id
        INNER JOIN discharge_patients ON discharge_patients.pat_id = doctor_surgery_charges.pat_id
        INNER JOIN surgeries ON surgeries.id = doctor_surgery_charges.pat_operation
        INNER JOIN staff_members ON staff_members.id = doctor_surgery_charges.pat_consultant
        WHERE doctor_surgery_charges.payment_status = '1' AND doctor_surgery_charges.payment_status = '$id'");


    $queryDoctorName = mysqli_query($connect, "SELECT * FROM `staff_members` WHERE id = '$id'");
    $fetch_queryDoctorName = mysqli_fetch_assoc($queryDoctorName);

    if (isset($_POST['payDoctorCharges'])) {
        $id = $_POST['d_id'];
        $surgery = $_POST['total_surgery'];
        $visits = $_POST['total_visit'];
        $paided = $_POST['total_paid'];

        if (empty($surgery)) {
            $surgery = 0;
        }

        if (empty($visits)) {
            $visits = 0;
        }

        if (empty($paided)) {
            $paided = 0;
        }

        $date = date_default_timezone_set('Asia/Karachi');
        $currentDate = date('Y-m-d h:i:s');

        $insertQuery = mysqli_query($connect, "INSERT INTO `doctor_paid_amount`(`d_id`, `total_surgery`, `total_visit`, `total_paid`) VALUES ('$id', '$surgery', '$visits', '$paided')");

        $updateDOctorVisits = mysqli_query($connect, "UPDATE discharge_patients_charges SET doctor_payment_status = '0' WHERE  pat_consultant = '$id'");

        $updatePaymentDoctor = mysqli_query($connect, "UPDATE doctor_surgery_charges SET payment_status = '0', date_of_payment = '$currentDate' WHERE pat_consultant = '$id'");

        $updateVisitsPayments = mysqli_query($connect, "UPDATE doctor_visit_charges SET visit_status = '0' WHERE doctor_id = '$id'");




    }
include '../_partials/header.php';
?>
<!-- Top Bar End -->
<div class="page-content-wrapper ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="page-title">Doctor Surgery </h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <form method="POST">
                    <div class="card-body">
                        <input type="hidden" name="d_id" value="<?php echo $id ?>">
                        <h4>Surgeries and Visits <i>Dr. <?php echo $fetch_queryDoctorName['name'] ?></i></h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient</th>
                                        <th>Surgery</th>
                                        <th>Room No</th>
                                        <th>Date & Time</th>
                                        <th>Surgery Charges</th>
                                        <th>Visit Charges</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itr = 1;
                                    while ($rowSurgery = mysqli_fetch_assoc($queryDoctorCharges)) {
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
                                            <td>'.$rowSurgery['surgery_charges'].'</td>
                                            <td>0</td>
                                        </tr>
                                        ';
                                    }
                                    $queryVisits = mysqli_query($connect, "SELECT doctor_visit_charges.*, discharge_patients.patient_name, surgeries.surgery_name, rooms.room_number  FROM `doctor_visit_charges`
                                        INNER JOIN discharge_patients ON discharge_patients.pat_id = doctor_visit_charges.pat_id
                                        INNER JOIN rooms ON rooms.id = doctor_visit_charges.room_id
                                        INNER JOIN staff_members ON staff_members.id = doctor_visit_charges.doctor_id
                                        INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation
                                        WHERE doctor_visit_charges.visit_status = '1' AND doctor_visit_charges.doctor_id = '$id'");
                                      
                                        while ($rowVisits = mysqli_fetch_assoc($queryVisits)) {
                                            echo '
                                            <tr>
                                                <td>'.$itr++.'</td>
                                                <td>'.$rowVisits['patient_name'].'</td>
                                                <td>'.$rowVisits['surgery_name'].'</td>
                                                <td>'.$rowVisits['room_number'].'</td>';
                                            
                                                $VisitDate_format = $rowVisits['visit_date']; 
                                                $VisitDate = date('d/M h:i:s A', strtotime($VisitDate_format));
                                                echo '
                                                <td>'.$VisitDate.'</td>
                                                <td>0</td>
                                                <td>'.$rowVisits['visit_charges'].'</td>
                                            </tr>
                                            ';
                                        }

                                        $totalSurgeryAmount = mysqli_query($connect, "SELECT SUM(surgery_charges)AS surgerySum FROM `doctor_surgery_charges` WHERE pat_consultant = '$id' AND payment_status = '1'");
                                        $fetch_totalSurgeryAmount = mysqli_fetch_assoc($totalSurgeryAmount);

                                        $totalVisitAmount = mysqli_query($connect, "SELECT SUM(visit_charges)AS visitSum FROM `doctor_visit_charges` WHERE doctor_id = '$id' AND visit_status = '1'");
                                        $fetch_totalVisitAmount = mysqli_fetch_assoc($totalVisitAmount);
                                        echo '
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td align="right"><strong>Total: </strong></td>
                                                <td><strong>'.$fetch_totalSurgeryAmount['surgerySum'].'</strong></td>
                                                <td><strong>'.$fetch_totalVisitAmount['visitSum'].'</strong></td>
                                            </tr>
                                        ';
                                        $total = $fetch_totalVisitAmount['visitSum'] + $fetch_totalSurgeryAmount['surgerySum'];

                                        echo '
                                        <input type="hidden" name="total_surgery" value='.$fetch_totalSurgeryAmount['surgerySum'].'>
                                        <input type="hidden" name="total_visit" value='.$fetch_totalVisitAmount['visitSum'].'>
                                        <input type="hidden" name=" total_paid" value='.$total.'>
                                        ';


                                        echo '
                                            <tr>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none" align="right"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                                <td style="border-top:none; border-bottom:none"></td>
                                            </tr>
                                        ';

                                        echo '
                                            <tr>
                                                <td></td>
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
                            <button type="submit" name="payDoctorCharges" class="btn btn-primary waves-effect waves-light">Pay Doctor</button>
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
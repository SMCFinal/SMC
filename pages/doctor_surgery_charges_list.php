<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];
    
    $queryDoctorCharges = mysqli_query($connect, "SELECT doctor_surgery_charges.*, discharge_patients.patient_doa, rooms.room_number, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name, discharge_patients.organization FROM `doctor_surgery_charges` 
        INNER JOIN rooms ON rooms.id = doctor_surgery_charges.room_id
        INNER JOIN discharge_patients ON discharge_patients.pat_id = doctor_surgery_charges.pat_id
        INNER JOIN surgeries ON surgeries.id = doctor_surgery_charges.pat_operation
        INNER JOIN staff_members ON staff_members.id = doctor_surgery_charges.pat_consultant
        WHERE doctor_surgery_charges.payment_status = '1' AND discharge_patients.organization LIKE '%Private%'  AND doctor_surgery_charges.pat_consultant = '$id' ORDER BY discharge_patients.patient_doa ASC LIMIT 100");


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

        // Reference Number
        $checkRefNo = mysqli_query($connect, "SELECT MAX(ref_no) AS refNO FROM charges_confirm_list");
        $checkRefNoFetch = mysqli_fetch_assoc($checkRefNo);
        $ref = $checkRefNoFetch['refNO'];
        if ($ref < 1 OR empty( $ref)) {
            $refNumber =   1;
        }else {
            $refNumber = $ref + 1;
        }


        // Surgery Details
        $arr_sur_pat_name = $_POST['sur_pat_name'];
        $arr_sur_name = $_POST['sur_name'];
        $arr_sur_organization = $_POST['sur_organization'];
        $arr_room_name = $_POST['room_name'];
        $arr_op_time = $_POST['op_time'];
        $arr_sur_charges = $_POST['sur_charges'];

        for ($i=0; $i < sizeof($arr_sur_pat_name); $i++) { 
            $sur_pat_name = $arr_sur_pat_name[$i];
            $sur_organization = $arr_sur_organization[$i];
            $sur_name = $arr_sur_name[$i];
            $room_name = $arr_room_name[$i];
            $op_time = $arr_op_time[$i];
            $sur_charges = $arr_sur_charges[$i];
            $visitChr = "0";
            $refNumber;

            $insertQuerySurCharges = mysqli_query($connect, "INSERT INTO `charges_confirm_list`(`consult_id`, `pat_name`, `org_name`, `sur_name`, `room_name`, `op_vi_time`, `sur_charges`, `vis_cahrges`, `ref_no`) VALUES ('$id', '$sur_pat_name', '$sur_organization', '$sur_name', '$room_name', '$op_time', '$sur_charges', '$visitChr', '$refNumber')");
        }

        // Visit Details
        // $array_vis_pat_name = $_POST['vis_pat_name'];
        // $array_vi_organization = $_POST['vi_organization'];
        // $array_sur_name = $_POST['sur_name'];
        // $array_room_name = $_POST['room_name'];
        // $array_vi_time = $_POST['vi_time'];
        // $array_vi_charges = $_POST['vi_charges'];

        // for ($i=0; $i < sizeof($array_vis_pat_name); $i++) { 
        //     $vis_pat_name = $array_vis_pat_name[$i];
        //     $vi_organization = $array_vi_organization[$i];
        //     $sur_name = $array_sur_name[$i];
        //     $room_name = $array_room_name[$i];
        //     $vi_time = $array_vi_time[$i];
        //     $surChr = "0";
        //     $vi_charges = $array_vi_charges[$i];
        //     $refNumber;

        //     $insertQueryVisCharges = mysqli_query($connect, "INSERT INTO `charges_confirm_list`(`consult_id`, `pat_name`, `org_name`, `sur_name`, `room_name`, `op_vi_time`, `sur_charges`, `vis_cahrges`, `ref_no`) VALUES ('$id', '$vis_pat_name', '$vi_organization', '$sur_name', '$room_name', '$vi_time', '$surChr', '$vi_charges', '$refNumber')");
        // }

        $array_pat_sur_id = $_POST['pat_sur_id'];
        // $array_pat_vis_id = $_POST['pat_vis_id'];

        for ($i=0; $i < sizeof($array_pat_sur_id) ; $i++) { 
            $sur_pat_id = $array_pat_sur_id[$i];
            // $vis_pat_id = $array_pat_vis_id[$i];

            $updateDOctorVisits = mysqli_query($connect, "UPDATE discharge_patients_charges SET doctor_payment_status = '0' WHERE  pat_consultant = '$id' AND pat_id = '$sur_pat_id'");

            $updatePaymentDoctor = mysqli_query($connect, "UPDATE doctor_surgery_charges SET payment_status = '0', date_of_payment = '$currentDate' WHERE pat_consultant = '$id' AND pat_id = '$sur_pat_id'");

            // $updateVisitsPayments = mysqli_query($connect, "UPDATE doctor_visit_charges SET charges_status = '0' WHERE doctor_id = '$id' AND pat_id = '$vis_pat_id'");

        }

        $insertQuery = mysqli_query($connect, "INSERT INTO `doctor_paid_amount`(`d_id`, `total_surgery`, `total_visit`, `total_paid`, `ref_no`) VALUES ('$id', '$surgery', '$visits', '$paided', '$refNumber')");


        if ($insertQuery) {
            header("LOCATION: doctor_payment_list.php");
            // echo '<script>window.location.href = "doctor_payment_list.php"</script>';
        }

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
                                        <th>Organization</th>
                                        <th>Room No</th>
                                        <th>Date & Time</th>
                                        <th>Surgery Charges</th>
                                        <th>Visit Charges</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $itr = 1;

                                    $sumSurgeryAmount = 0;
                                    $sumVisitAmount = 0;

                                    while ($rowSurgery = mysqli_fetch_assoc($queryDoctorCharges)) {
                                        echo '
                                        <tr>
                                            <td>'.$itr++.'</td>
                                            <td>'.$rowSurgery['patient_name'].'</td>
                                            <td>'.$rowSurgery['surgery_name'].'</td>
                                            <td>'.$rowSurgery['organization'].'</td>
                                            <td>'.$rowSurgery['room_number'].'</td>';
                                            
                                            $Date_format = $rowSurgery['patient_doop']; 
                                            $Date = date('d/M h:i:s A', strtotime($Date_format));
                                            
                                            echo '
                                            <td>'.$Date.'</td>
                                            <td>'.$rowSurgery['surgery_charges'].'</td>
                                            <td>0</td>';
                                            $sumSurgeryAmount = $sumSurgeryAmount + $rowSurgery['surgery_charges'];
                                            
                                            echo '
                                            <input type="hidden" name="sur_pat_name[]" value="'.$rowSurgery['patient_name'].'">
                                            <input type="hidden" name="sur_name[]" value="'.$rowSurgery['surgery_name'].'">
                                            <input type="hidden" name="room_name[]" value="'.$rowSurgery['room_number'].'">
                                            <input type="hidden" name="op_time[]" value="'.$rowSurgery['patient_doop'].'">
                                            <input type="hidden" name="sur_charges[]" value="'.$rowSurgery['surgery_charges'].'">
                                            <input type="hidden" name="sur_organization[]" value="'.$rowSurgery['organization'].'">
                                            <input type="hidden" name="pat_sur_id[]" value="'.$rowSurgery['pat_id'].'">
                                        </tr>
                                        ';
                                    }
                                    $queryVisits = mysqli_query($connect, "SELECT doctor_visit_charges.*, discharge_patients.patient_name, surgeries.surgery_name, rooms.room_number, discharge_patients.organization  FROM `doctor_visit_charges`
                                        INNER JOIN discharge_patients ON discharge_patients.pat_id = doctor_visit_charges.pat_id
                                        INNER JOIN rooms ON rooms.id = doctor_visit_charges.room_id
                                        INNER JOIN staff_members ON staff_members.id = doctor_visit_charges.doctor_id
                                        INNER JOIN surgeries ON surgeries.id = discharge_patients.patient_operation
                                        WHERE doctor_visit_charges.visit_status = '0' AND doctor_visit_charges.charges_status = '1' AND discharge_patients.organization LIKE '%Private%' AND doctor_visit_charges.doctor_id = '$id'");
                                      
                                        while ($rowVisits = mysqli_fetch_assoc($queryVisits)) {
                                            echo '
                                            <tr>
                                                <td>'.$itr++.'</td>
                                                <td>'.$rowVisits['patient_name'].'</td>
                                                <td>'.$rowVisits['surgery_name'].'</td>
                                                <td>'.$rowVisits['organization'].'</td>
                                                <td>'.$rowVisits['room_number'].'</td>';
                                            
                                                $VisitDate_format = $rowVisits['visit_date']; 
                                                $VisitDate = date('d/M h:i:s A', strtotime($VisitDate_format));
                                                echo '
                                                <td>'.$VisitDate.'</td>
                                                <td>0</td>
                                                <td>'.$rowVisits['visit_charges'].'</td>';
                                                $sumVisitAmount = $sumVisitAmount + $rowVisits['visit_charges'];
                                            echo '
                                                <input type="hidden" name="vis_pat_name[]" value="'.$rowVisits['patient_name'].'">
                                                <input type="hidden" name="sur_name[]" value="'.$rowVisits['surgery_name'].'">
                                                <input type="hidden" name="room_name[]" value="'.$rowVisits['room_number'].'">
                                                <input type="hidden" name="vi_time[]" value="'.$rowVisits['visit_date'].'">
                                                <input type="hidden" name="vi_charges[]" value="'.$rowVisits['visit_charges'].'">
                                                <input type="hidden" name="vi_organization[]" value="'.$rowVisits['organization'].'">
                                                <input type="hidden" name="pat_vis_id[]" value="'.$rowVisits['pat_id'].'">
                                            </tr>
                                            ';
                                        }

                                        $totalSurgeryAmount = mysqli_query($connect, "SELECT SUM(surgery_charges)AS surgerySum FROM `doctor_surgery_charges` WHERE pat_consultant = '$id' AND payment_status = '1'");
                                        $fetch_totalSurgeryAmount = mysqli_fetch_assoc($totalSurgeryAmount);

                                        $totalVisitAmount = mysqli_query($connect, "SELECT SUM(visit_charges)AS visitSum FROM `doctor_visit_charges` WHERE doctor_id = '$id' AND visit_status = '0' AND charges_status = '1'");
                                        $fetch_totalVisitAmount = mysqli_fetch_assoc($totalVisitAmount);
                                        
                                        echo '
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td align="right"><strong>Total: </strong></td>
                                                <td><strong>'.$sumSurgeryAmount.'</strong></td>
                                                <td><strong>'.$sumVisitAmount.'</strong></td>
                                            </tr>
                                        ';
                                        
                                        $total = $sumSurgeryAmount + $sumVisitAmount;

                                        echo '
                                        <input type="hidden" name="total_surgery" value='.$sumSurgeryAmount.'>
                                        <input type="hidden" name="total_visit" value='.$sumVisitAmount.'>
                                        <input type="hidden" name=" total_paid" value='.$total.'>
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
                                                <td style="border-top:none; border-bottom:none"></td>
                                            </tr>
                                        ';

                                        echo '
                                            <tr>
                                                <td></td>
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
                            <?php
                                if ($total === 0) {
                                    echo '<button class="btn btn-primary waves-effect waves-light" disabled>No Pay!</button>';
                                }else {
                                    echo '<button type="submit" name="payDoctorCharges" class="btn btn-primary waves-effect waves-light">Pay Doctor</button>
                                 ';
                                }
                            ?>
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
<?php
    include('../_stream/config.php');

    session_start();
    if (empty($_SESSION["user"])) {
        header("LOCATION:../index.php");
    }

    $id = $_GET['id'];

    $queryAnestheticCharges = mysqli_query($connect, "SELECT anesthetic_surgery_charges.*, rooms.room_number,  discharge_patients.patient_operation, discharge_patients.patient_name, discharge_patients.patient_doop, surgeries.surgery_name, staff_members.name,  discharge_patients.organization FROM `anesthetic_surgery_charges` 
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
        
        // Reference Number
        $checkRefNo = mysqli_query($connect, "SELECT MAX(ref_no) AS refNO FROM anes_confirm_charges_list");
        $checkRefNoFetch = mysqli_fetch_assoc($checkRefNo);
        $ref = $checkRefNoFetch['refNO'];
        if ($ref < 1 OR empty( $ref)) {
            $refNumber =   1;
        }else {
            $refNumber = $ref + 1;
        }

         // Anesthesia Details
        $array_pat_name = $_POST['pat_name'];
        $array_org_name = $_POST['org_name'];
        $array_sur_name = $_POST['sur_name'];
        $array_room_name = $_POST['room_name'];
        $array_op_time = $_POST['op_time'];
        $array_an_charges = $_POST['an_charges'];

        for ($i=0; $i < sizeof($array_pat_name); $i++) { 
            $pat_name = $array_pat_name[$i];
            $org_name = $array_org_name[$i];
            $sur_name = $array_sur_name[$i];
            $room_name = $array_room_name[$i];
            $op_time = $array_op_time[$i];
            $an_charges = $array_an_charges[$i];
            $refNumber;

            $insertQueryVisCharges = mysqli_query($connect, "INSERT INTO `anes_confirm_charges_list`
                (`anes_id`,
                 `pat_name`,
                  `org_name`,
                   `sur_name`,
                    `room_name`,
                     `op_time`,
                      `an_charges`,
                       `ref_no`
                       ) VALUES (
                       '$id',
                        '$pat_name',
                         '$org_name',
                          '$sur_name',
                           '$room_name',
                            '$op_time',
                              '$an_charges',
                               '$refNumber')");
        }

        $insertQuery = mysqli_query($connect, "INSERT INTO `anethetic_paid_amount`(`aneshthetic_id`, `paid_amount`, `ref_no`)VALUES('$id', '$surgery', '$refNumber')");

        $updatePaymentAnes = mysqli_query($connect, "UPDATE anesthetic_surgery_charges SET payment_status = '0', date_of_payment = '$currentDate' WHERE anesthetic_id = '$id'");

        if($updatePaymentAnes) {
            header("LOCATION: anesthetic_payment_list.php");
        }

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
                                            <input type="hidden" name="pat_name[]"  value="'.$rowSurgery['patient_name'].'">
                                            <input type="hidden" name="org_name[]"  value="'.$rowSurgery['organization'].'">
                                            <input type="hidden" name="sur_name[]"  value="'.$rowSurgery['surgery_name'].'">
                                            <input type="hidden" name="room_name[]"  value="'.$rowSurgery['room_number'].'">
                                            <input type="hidden" name="op_time[]"  value="'.$Date.'">
                                            <input type="hidden" name="an_charges[]"  value="'.$rowSurgery['surgery_anes_charges'].'">
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
                                        <input type="hidden" name="total_surgery" value='.$totalSum.'>
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

                                        echo '
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong></strong></td>
                                                <td align="right"><strong>Pay Total: </strong></td>
                                                <td><strong>'.$totalSum.'</strong></td>
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